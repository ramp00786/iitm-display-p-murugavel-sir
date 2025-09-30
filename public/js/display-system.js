/**
 * IITM Display System - Main JavaScript
 * Clean separation between frontend and backend
 * All data fetched via API calls
 */

class IITMDisplaySystem {
    constructor() {
        this.data = {
            slideshows: [],
            videos: [],
            newsItems: [],
            temperatureItems: [],
            meteorologicalTabs: []
        };
        
        this.currentSlideIndex = 0;
        this.currentVideoIndex = 0;
        this.currentTabIndex = 0;
        this.currentChartIndex = 0;
        this.charts = {};
        this.flipInterval = null;
        this.pauseTime = 5000; // 5 seconds per chart
        
        this.slideTimeout = null;
        this.slideshowContainer = null;
        this.slideshowOverlay = null;
        this.videoPlayer = null;
        this.plotContainer = null;
        this.plotCards = null;
        this.mainWrapper = null;
        this.loadingScreen = null;
        
        this.slideshowCompleted = false;
        this.mainContentLoaded = false;
        
        this.init();
    }

    async init() {
        console.log('🚀 IITM Display System initializing...');
        
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.start());
        } else {
            this.start();
        }
    }

    async start() {
        try {
            // Get DOM elements
            this.initializeElements();
            
            // Fetch all data from API
            await this.fetchAllData();
            
            // Check if we have slideshow content
            const validSlideshows = this.data.slideshows?.filter(slideshow => 
                slideshow.url && 
                slideshow.url !== '/storage/' && 
                slideshow.url !== 'null' && 
                slideshow.url.trim() !== ''
            ) || [];
            
            if (validSlideshows.length > 0) {
                console.log('📷 Starting with slideshow presentation first...');
                // Initialize slideshow first
                this.initializeSlideshow();
                this.setupKeyboardControls();
            } else {
                console.log('📷 No slideshow content - loading main content directly');
                // No slideshow, load main content immediately
                this.slideshowCompleted = true;
                this.loadMainContent();
            }
            
            console.log('✅ IITM Display System initialized successfully');
        } catch (error) {
            console.error('❌ Error initializing display system:', error);
            // On error, still show main content
            this.loadMainContent();
        }
    }

    initializeElements() {
        this.slideshowContainer = document.getElementById('slideshowContainer');
        this.slideshowOverlay = document.getElementById('slideshowOverlay');
        this.videoPlayer = document.getElementById('videoPlayer');
        this.plotContainer = document.getElementById('plotContainer');
        this.mainWrapper = document.querySelector('.wrapper');
        this.loadingScreen = document.getElementById('loadingScreen');
        
        if (this.plotContainer) {
            this.plotCards = this.plotContainer.querySelectorAll('.card');
        }
        
        // Initially hide main content
        if (this.mainWrapper) {
            this.mainWrapper.style.opacity = '0';
            this.mainWrapper.style.visibility = 'hidden';
        }
    }

    async fetchAllData() {
        console.log('📡 Fetching display data from API...');
        
        try {
            const response = await fetch('/api/display-data');
            const result = await response.json();
            
            if (!result.success) {
                throw new Error(result.message || 'Failed to fetch data');
            }
            
            this.data = result.data;
            console.log('📊 Data loaded successfully:', this.data);
            
        } catch (error) {
            console.error('❌ Error fetching data:', error);
            throw error;
        }
    }

    initializeSlideshow() {
        // Filter out slideshows with invalid URLs
        const validSlideshows = this.data.slideshows?.filter(slideshow => 
            slideshow.url && 
            slideshow.url !== '/storage/' && 
            slideshow.url !== 'null' && 
            slideshow.url.trim() !== ''
        ) || [];
        
        if (validSlideshows.length === 0) {
            console.log('📷 No valid slideshows available');
            if (this.slideshowOverlay) {
                this.slideshowOverlay.classList.add('slideshow-hidden');
            }
            return;
        }

        console.log(`📷 Initializing slideshow with ${validSlideshows.length} valid items`);
        
        // Update the data array with only valid slideshows
        this.data.slideshows = validSlideshows;
        
        // Show the slideshow overlay and start the slideshow
        if (this.slideshowOverlay) {
            this.slideshowOverlay.classList.remove('slideshow-hidden');
        }
        
        this.showSlide(0);
    }

    showSlide(index) {
        if (!this.slideshowContainer || !this.data.slideshows[index]) {
            console.error('❌ Cannot show slide - missing container or slide data', {
                hasContainer: !!this.slideshowContainer,
                slideExists: !!this.data.slideshows[index],
                totalSlides: this.data.slideshows?.length || 0
            });
            return;
        }

        const slide = this.data.slideshows[index];
        this.slideshowContainer.innerHTML = '';
        
        console.log(`📷 Showing slide ${index + 1}/${this.data.slideshows.length}: ${slide.title}`, slide);

        if (slide.type === 'image' || slide.type === 'gif') {
            const img = document.createElement('img');
            img.src = slide.url;
            img.onload = () => {
                this.slideshowContainer.appendChild(img);
                console.log(`📷 Image/GIF displayed for 5 seconds: ${slide.title}`);
                // Display images and GIFs for exactly 5 seconds, then move to next
                this.slideTimeout = setTimeout(() => this.nextSlide(), 5000);
            };
            img.onerror = () => {
                console.error('❌ Error loading image:', slide.url);
                this.slideTimeout = setTimeout(() => this.nextSlide(), 1000);
            };
        } else if (slide.type === 'video') {
            const video = document.createElement('video');
            video.src = slide.url;
            video.autoplay = true;
            video.muted = true;
            video.loop = false; // Ensure no looping - play once only
            video.playsInline = true; // Better mobile support
            
            video.onloadeddata = () => {
                console.log(`📷 Video loaded and will play once: ${slide.title} (Duration: ${video.duration}s)`);
            };
            
            video.onended = () => {
                console.log(`📷 Video finished playing: ${slide.title}`);
                this.nextSlide();
            };
            
            video.onerror = () => {
                console.error('❌ Error loading video:', slide.url);
                this.slideTimeout = setTimeout(() => this.nextSlide(), 1000);
            };
            
            this.slideshowContainer.appendChild(video);
        }
    }

    nextSlide() {
        clearTimeout(this.slideTimeout);
        this.currentSlideIndex++;

        if (this.currentSlideIndex >= this.data.slideshows.length) {
            console.log('📷 Slideshow completed - all items displayed once. Loading main content...');
            // Mark slideshow as completed and load main content
            this.slideshowCompleted = true;
            this.hideSlideshow();
            
            // Load main content after a brief delay
            setTimeout(() => {
                this.loadMainContent();
            }, 1000);
        } else {
            this.showSlide(this.currentSlideIndex);
        }
    }

    initializeVideoPlayer() {
        const noVideoContent = document.getElementById('noVideoContent');
        
        // Filter out videos with invalid URLs
        const validVideos = this.data.videos?.filter(video => 
            video.url && 
            video.url !== '/storage/' && 
            video.url !== 'null' && 
            video.url.trim() !== ''
        ) || [];
        
        if (validVideos.length === 0) {
            console.log('🎥 No valid videos available');
            if (noVideoContent) {
                noVideoContent.textContent = 'No videos available';
            }
            return;
        }

        console.log(`🎥 Initializing video player with ${validVideos.length} valid videos`);
        
        // Update the data array with only valid videos
        this.data.videos = validVideos;
        
        // Hide no content message and show video player
        if (noVideoContent) {
            noVideoContent.style.display = 'none';
        }
        
        if (this.videoPlayer) {
            this.videoPlayer.style.display = 'block';
            
            // Set first video
            const firstVideo = validVideos[0];
            this.videoPlayer.src = firstVideo.url;
            
            console.log(`🎥 Loading first video: ${firstVideo.title} - ${firstVideo.url}`);
            
            // Setup video rotation for multiple videos
            if (validVideos.length > 1) {
                this.videoPlayer.addEventListener('ended', () => this.loadNextVideo());
            }
            
            // Handle video load errors
            this.videoPlayer.addEventListener('error', (e) => {
                const currentVideo = this.data.videos[this.currentVideoIndex];
                console.error(`❌ Video load error for: ${currentVideo?.title} - ${currentVideo?.url}`, e);
                
                // Try next video if available
                if (this.data.videos.length > 1) {
                    console.log('🔄 Trying next video due to error...');
                    setTimeout(() => this.loadNextVideo(), 2000);
                } else {
                    console.log('🚫 No other videos available');
                    if (noVideoContent) {
                        noVideoContent.style.display = 'block';
                        noVideoContent.textContent = 'Video playback error';
                    }
                    this.videoPlayer.style.display = 'none';
                }
            });
            
            // Handle successful video load
            this.videoPlayer.addEventListener('loadeddata', () => {
                const currentVideo = this.data.videos[this.currentVideoIndex];
                console.log(`✅ Video loaded successfully: ${currentVideo?.title}`);
            });
        }
    }

    loadNextVideo() {
        if (!this.data.videos || this.data.videos.length <= 1) return;
        
        this.currentVideoIndex = (this.currentVideoIndex + 1) % this.data.videos.length;
        const video = this.data.videos[this.currentVideoIndex];
        
        console.log(`🎥 Loading next video: ${video.title} - ${video.url}`);
        
        if (!video.url || video.url === 'null') {
            console.error(`❌ Invalid URL for video: ${video.title}`);
            // Try next video if available
            if (this.data.videos.length > 1) {
                setTimeout(() => this.loadNextVideo(), 1000);
            }
            return;
        }
        
        this.videoPlayer.src = video.url;
        this.videoPlayer.load();
    }

    initializeTickers() {
        // Update news ticker
        const newsTickerElement = document.getElementById('ticker');
        if (newsTickerElement && this.data.newsItems) {
            this.updateTicker(newsTickerElement, this.data.newsItems, 'news');
        }

        // Update temperature ticker
        const tempTickerElement = document.getElementById('ticker1');
        if (tempTickerElement && this.data.temperatureItems) {
            this.updateTicker(tempTickerElement, this.data.temperatureItems, 'temperature');
        }
    }

    updateTicker(element, items, type) {
        if (!items || items.length === 0) {
            console.log(`📰 No ${type} items available`);
            return;
        }

        console.log(`📰 Updating ${type} ticker with ${items.length} items`);
        
        let tickerHTML = '';
        items.forEach(item => {
            if (type === 'news') {
                tickerHTML += `<span><span class="status-indicator status-live"></span>${item.title}</span>`;
            } else {
                tickerHTML += `<span>${item.title}</span>`;
            }
        });

        element.innerHTML = tickerHTML;
    }

    initializeMeteorologicalCharts() {
        if (!this.data.meteorologicalTabs || this.data.meteorologicalTabs.length === 0) {
            console.log('📊 No meteorological data available');
            this.showEmptyMeteorologicalState();
            return;
        }

        console.log(`📊 Initializing meteorological charts with ${this.data.meteorologicalTabs.length} tabs`);
        
        // Setup Chart.js defaults
        this.setupChartDefaults();
        
        // Create station buttons and chart containers dynamically
        this.createStationButtons();
        this.createChartContainers();
        
        // Setup station button functionality
        this.setupStationButtons();
        
        // Initialize first station after a short delay
        setTimeout(() => {
            this.switchStation(0);
        }, 1000);
    }

    showEmptyMeteorologicalState() {
        const stationBar = document.getElementById('stationBar');
        if (stationBar) {
            stationBar.innerHTML = `
                <div class="text-center w-100 py-2">
                    <span style="color: var(--text-dim);">No meteorological data configured</span>
                </div>
            `;
        }

        if (this.plotContainer) {
            this.plotContainer.innerHTML = `
                <div class="card active">
                    <h3>Meteorological Data</h3>
                    <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: var(--text-dim);">
                        <p>Configure charts in the admin panel</p>
                    </div>
                </div>
            `;
        }
    }

    createStationButtons() {
        const stationBar = document.getElementById('stationBar');
        if (!stationBar) return;

        let buttonsHTML = '';
        this.data.meteorologicalTabs.forEach((tab, index) => {
            buttonsHTML += `
                <button class="station-btn ${index === 0 ? 'active' : ''}" 
                        data-station="${tab.data_station}" 
                        data-tab-id="${tab.id}"
                        data-index="${index}">
                    ${tab.heading}
                </button>
            `;
        });

        stationBar.innerHTML = buttonsHTML;
    }

    createChartContainers() {
        if (!this.plotContainer) return;

        let containersHTML = '';
        let globalIndex = 0;

        this.data.meteorologicalTabs.forEach((tab, tabIndex) => {
            if (tab.charts && tab.charts.length > 0) {
                tab.charts.forEach((chart, chartIndex) => {
                    const isActive = tabIndex === 0 && chartIndex === 0;
                    containersHTML += `
                        <div class="card ${isActive ? 'active' : ''}" 
                             data-tab-id="${tab.id}" 
                             data-chart-id="${chart.id}"
                             data-global-index="${globalIndex}">
                            <h3>${chart.title}</h3>
                            <canvas id="chart_${chart.id}" width="400" height="300"></canvas>
                        </div>
                    `;
                    globalIndex++;
                });
            }
        });

        // If no charts found, show placeholder
        if (containersHTML === '') {
            containersHTML = `
                <div class="card active">
                    <h3>Meteorological Data</h3>
                    <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: var(--text-dim);">
                        <p>No charts available</p>
                    </div>
                </div>
            `;
        }

        this.plotContainer.innerHTML = containersHTML;
        
        // Update plotCards reference
        this.plotCards = this.plotContainer.querySelectorAll('.card');
    }

    setupChartDefaults() {
        Chart.defaults.color = '#b8c7e0';
        Chart.defaults.borderColor = '#2a4d8c';
        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.font.size = 14;
    }

    setupStationButtons() {
        const stationButtons = document.querySelectorAll('.station-btn');
        stationButtons.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                console.log(`🏢 Station button clicked: ${index}`);
                this.switchStation(index);
            });
        });

        // Setup plot container click for manual advance
        if (this.plotContainer) {
            this.plotContainer.addEventListener('click', () => {
                console.log('🖱️ Plot container clicked - advancing to next card');
                this.nextCard();
            });
        }
    }

    switchStation(stationIndex) {
        if (!this.data.meteorologicalTabs[stationIndex]) {
            console.error(`❌ Station index ${stationIndex} not found`);
            return;
        }

        const station = this.data.meteorologicalTabs[stationIndex];
        console.log(`🏢 Switching to station: ${station.heading} (${station.data_station})`);

        this.currentTabIndex = stationIndex;
        
        // Update button states
        document.querySelectorAll('.station-btn').forEach((btn, idx) => {
            btn.classList.toggle('active', idx === stationIndex);
        });

        // Initialize charts for this tab
        this.initializeChartsForTab(stationIndex);

        // Reset chart index and show first chart
        this.currentChartIndex = 0;
        
        // Calculate global card index
        let globalIndex = 0;
        for (let i = 0; i < stationIndex; i++) {
            globalIndex += this.data.meteorologicalTabs[i].charts.length;
        }
        
        this.showCard(globalIndex);
        this.startFlipping();
    }

    initializeChartsForTab(tabIndex) {
        const tab = this.data.meteorologicalTabs[tabIndex];
        if (!tab || !tab.charts) {
            console.log(`📊 No charts found for tab ${tabIndex}`);
            return;
        }

        console.log(`📊 Initializing ${tab.charts.length} charts for tab: ${tab.heading}`);

        tab.charts.forEach((chart, index) => {
            if (chart.data) {
                const canvas = document.getElementById(`chart_${chart.id}`);
                if (canvas) {
                    // Destroy existing chart
                    if (this.charts[chart.id]) {
                        this.charts[chart.id].destroy();
                    }

                    // Create new chart
                    const ctx = canvas.getContext('2d');
                    const chartConfig = this.getChartConfig(chart);
                    this.charts[chart.id] = new Chart(ctx, chartConfig);
                    
                    console.log(`📊 Chart created: ${chart.title} (ID: ${chart.id})`);
                } else {
                    console.error(`❌ Canvas not found for chart ${chart.id}`);
                }
            } else {
                console.log(`📊 No data available for chart: ${chart.title}`);
            }
        });
    }

    getChartConfig(chartData) {
        const { chart_type, title, data } = chartData;

        if (!data || !data.labels || !data.datasets) {
            return {
                type: 'bar',
                data: {
                    labels: ['No Data'],
                    datasets: [{
                        label: 'No Data',
                        data: [0],
                        backgroundColor: '#ccc'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            };
        }

        // Modern chart options for charts with scales (line, bar, area, scatter, bubble)
        const scaledOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#ffffff',
                        font: {
                            size: 14,
                            weight: '500'
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        color: 'rgba(42, 77, 140, 0.5)'
                    },
                    ticks: {
                        color: '#b8c7e0'
                    }
                },
                y: {
                    grid: {
                        color: 'rgba(42, 77, 140, 0.5)'
                    },
                    ticks: {
                        color: '#b8c7e0'
                    },
                    beginAtZero: true
                }
            }
        };

        // Modern chart options for charts without scales (pie, doughnut, polar, radar)
        const nonScaledOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#ffffff',
                        font: {
                            size: 14,
                            weight: '500'
                        }
                    }
                }
            }
        };

        let chartConfig = {
            data: {
                labels: data.labels || [],
                datasets: data.datasets || []
            }
        };

        // Set chart type and appropriate options
        switch (chart_type) {
            case 'line':
                chartConfig.type = 'line';
                chartConfig.options = scaledOptions;
                break;
                
            case 'area':
                chartConfig.type = 'line';
                chartConfig.options = scaledOptions;
                // Ensure fill is enabled for area charts
                if (chartConfig.data.datasets && chartConfig.data.datasets.length > 0) {
                    chartConfig.data.datasets.forEach(dataset => {
                        dataset.fill = true;
                        dataset.backgroundColor = dataset.backgroundColor || 'rgba(75, 192, 192, 0.2)';
                    });
                }
                break;
                
            case 'bar':
                chartConfig.type = 'bar';
                chartConfig.options = scaledOptions;
                break;
                
            case 'pie':
                chartConfig.type = 'pie';
                chartConfig.options = nonScaledOptions;
                break;
                
            case 'doughnut':
                chartConfig.type = 'doughnut';
                chartConfig.options = nonScaledOptions;
                break;
                
            case 'radar':
                chartConfig.type = 'radar';
                chartConfig.options = nonScaledOptions;
                break;
                
            case 'polarArea':
                chartConfig.type = 'polarArea';
                chartConfig.options = nonScaledOptions;
                break;
                
            case 'scatter':
                chartConfig.type = 'scatter';
                chartConfig.options = {
                    ...scaledOptions,
                    scales: {
                        ...scaledOptions.scales,
                        x: {
                            ...scaledOptions.scales.x,
                            type: 'linear',
                            position: 'bottom'
                        },
                        y: {
                            ...scaledOptions.scales.y,
                            type: 'linear'
                        }
                    }
                };
                break;
                
            case 'bubble':
                chartConfig.type = 'bubble';
                chartConfig.options = {
                    ...scaledOptions,
                    scales: {
                        ...scaledOptions.scales,
                        x: {
                            ...scaledOptions.scales.x,
                            type: 'linear',
                            position: 'bottom'
                        },
                        y: {
                            ...scaledOptions.scales.y,
                            type: 'linear'
                        }
                    }
                };
                break;
                
            default:
                // Default to bar chart for unknown types
                chartConfig.type = 'bar';
                chartConfig.options = scaledOptions;
                console.warn(`Unknown chart type: ${chart_type}, defaulting to bar chart`);
        }

        return chartConfig;
    }

    showCard(index) {
        if (!this.plotCards) return;
        
        console.log(`📊 Showing card ${index + 1}/${this.plotCards.length}`);
        this.plotCards.forEach((card, i) => {
            card.classList.toggle('active', i === index);
        });
    }

    nextCard() {
        const currentTab = this.data.meteorologicalTabs[this.currentTabIndex];
        if (!currentTab || !currentTab.charts) {
            console.log('📊 No current tab or charts available');
            return;
        }

        this.currentChartIndex++;
        console.log(`📊 Next card: tab ${this.currentTabIndex}, chart ${this.currentChartIndex}/${currentTab.charts.length}`);

        if (this.currentChartIndex >= currentTab.charts.length) {
            // Move to next station
            this.currentChartIndex = 0;
            this.currentTabIndex = (this.currentTabIndex + 1) % this.data.meteorologicalTabs.length;
            console.log(`📊 Moving to next station: ${this.currentTabIndex}`);
            this.switchStation(this.currentTabIndex);
        } else {
            // Calculate global card index
            let globalIndex = 0;
            for (let i = 0; i < this.currentTabIndex; i++) {
                globalIndex += this.data.meteorologicalTabs[i].charts.length;
            }
            globalIndex += this.currentChartIndex;
            
            this.showCard(globalIndex);
        }
    }

    startFlipping() {
        console.log(`📊 Starting auto-flip with ${this.pauseTime}ms interval`);
        clearInterval(this.flipInterval);
        this.flipInterval = setInterval(() => this.nextCard(), this.pauseTime);
    }

    // Public API for manual control
    pause() {
        clearInterval(this.flipInterval);
        clearTimeout(this.slideTimeout);
        console.log('⏸️ Display system paused');
    }

    resume() {
        this.startFlipping();
        console.log('▶️ Display system resumed');
    }

    refresh() {
        console.log('🔄 Refreshing display data...');
        this.fetchAllData().then(() => {
            this.initializeTickers();
            this.initializeMeteorologicalCharts();
        });
    }

    setupKeyboardControls() {
        document.addEventListener('keydown', (event) => {
            switch(event.key.toLowerCase()) {
                case 's':
                    console.log('🔍 Manual slideshow trigger (S key pressed)');
                    this.startSlideshow();
                    break;
                case 'h':
                    console.log('🔍 Hiding slideshow and loading main content (H key pressed)');
                    this.slideshowCompleted = true;
                    this.hideSlideshow();
                    setTimeout(() => {
                        this.loadMainContent();
                    }, 500);
                    break;
                case 'p':
                    console.log('🔍 Pausing system (P key pressed)');
                    this.pause();
                    break;
                case 'r':
                    console.log('🔍 Resuming system (R key pressed)');
                    this.resume();
                    break;
            }
        });
        console.log('⌨️ Keyboard controls enabled: S=Slideshow, H=Hide, P=Pause, R=Resume');
    }

    startSlideshow() {
        if (this.data.slideshows && this.data.slideshows.length > 0) {
            this.currentSlideIndex = 0;
            this.slideshowCompleted = false;
            
            // Hide main content if showing slideshow
            if (this.mainWrapper && this.mainContentLoaded) {
                this.mainWrapper.style.opacity = '0';
                this.mainWrapper.style.visibility = 'hidden';
            }
            
            if (this.slideshowOverlay) {
                this.slideshowOverlay.classList.remove('slideshow-hidden');
            }
            this.showSlide(0);
        } else {
            console.log('📷 No slideshows available to display');
            // If no slideshow, ensure main content is loaded
            if (!this.mainContentLoaded) {
                this.loadMainContent();
            }
        }
    }

    hideSlideshow() {
        clearTimeout(this.slideTimeout);
        if (this.slideshowOverlay) {
            this.slideshowOverlay.classList.add('slideshow-hidden');
        }
        console.log('📷 Slideshow hidden');
    }

    async loadMainContent() {
        if (this.mainContentLoaded) {
            console.log('📱 Main content already loaded');
            return;
        }

        console.log('📱 Loading main dashboard content with fade-in effect...');
        
        try {
            // Initialize all main content components
            await this.initializeVideoPlayer();
            await this.initializeTickers();
            await this.initializeMeteorologicalCharts();
            
            // Mark as loaded
            this.mainContentLoaded = true;
            
            // Show main content with fade-in effect
            this.showMainContentWithFade();
            
            console.log('✅ Main content loaded successfully with fade-in');
            
        } catch (error) {
            console.error('❌ Error loading main content:', error);
            // Still show the content even if there's an error
            this.showMainContentWithFade();
        }
    }

    showMainContentWithFade() {
        if (!this.mainWrapper) return;
        
        // First hide the loading screen
        if (this.loadingScreen) {
            this.loadingScreen.classList.add('hidden');
            console.log('📱 Loading screen hidden');
        }
        
        // Small delay before showing main content
        setTimeout(() => {
            // Ensure the wrapper is visible but transparent
            this.mainWrapper.style.visibility = 'visible';
            this.mainWrapper.style.transition = 'opacity 2s ease-in-out';
            
            // Trigger fade-in after a small delay to ensure transition works
            setTimeout(() => {
                this.mainWrapper.style.opacity = '1';
                console.log('📱 Main content fade-in started (2s duration)');
            }, 100);
            
            // Log completion
            setTimeout(() => {
                console.log('📱 Main content fade-in completed');
                // Remove loading screen from DOM after transition
                if (this.loadingScreen) {
                    setTimeout(() => {
                        this.loadingScreen.style.display = 'none';
                    }, 1000);
                }
            }, 2100);
        }, 500);
    }
}

// Initialize the display system when script loads
const displaySystem = new IITMDisplaySystem();