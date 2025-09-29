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
            
            // Initialize all components
            this.initializeSlideshow();
            this.initializeVideoPlayer();
            this.initializeTickers();
            this.initializeMeteorologicalCharts();
            
            console.log('✅ IITM Display System initialized successfully');
        } catch (error) {
            console.error('❌ Error initializing display system:', error);
        }
    }

    initializeElements() {
        this.slideshowContainer = document.getElementById('slideshowContainer');
        this.slideshowOverlay = document.getElementById('slideshowOverlay');
        this.videoPlayer = document.getElementById('videoPlayer');
        this.plotContainer = document.getElementById('plotContainer');
        
        if (this.plotContainer) {
            this.plotCards = this.plotContainer.querySelectorAll('.card');
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
        if (!this.data.slideshows || this.data.slideshows.length === 0) {
            console.log('📷 No slideshows available');
            if (this.slideshowOverlay) {
                this.slideshowOverlay.classList.add('slideshow-hidden');
            }
            return;
        }

        console.log(`📷 Initializing slideshow with ${this.data.slideshows.length} items`);
        this.showSlide(0);
    }

    showSlide(index) {
        if (!this.slideshowContainer || !this.data.slideshows[index]) return;

        const slide = this.data.slideshows[index];
        this.slideshowContainer.innerHTML = '';
        
        console.log(`📷 Showing slide ${index + 1}/${this.data.slideshows.length}: ${slide.title}`);

        if (slide.type === 'image' || slide.type === 'gif') {
            const img = document.createElement('img');
            img.src = slide.url;
            img.onload = () => {
                this.slideshowContainer.appendChild(img);
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
            video.loop = false;
            video.onended = () => this.nextSlide();
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
            console.log('📷 Slideshow finished, hiding overlay');
            if (this.slideshowOverlay) {
                this.slideshowOverlay.classList.add('slideshow-hidden');
            }
        } else {
            this.showSlide(this.currentSlideIndex);
        }
    }

    initializeVideoPlayer() {
        const noVideoContent = document.getElementById('noVideoContent');
        
        if (!this.data.videos || this.data.videos.length === 0) {
            console.log('🎥 No videos available');
            if (noVideoContent) {
                noVideoContent.textContent = 'No videos available';
            }
            return;
        }

        console.log(`🎥 Initializing video player with ${this.data.videos.length} videos`);
        
        // Hide no content message and show video player
        if (noVideoContent) {
            noVideoContent.style.display = 'none';
        }
        
        if (this.videoPlayer) {
            this.videoPlayer.style.display = 'block';
            
            // Set first video
            const firstVideo = this.data.videos[0];
            this.videoPlayer.src = firstVideo.url;
            
            // Setup video rotation for multiple videos
            if (this.data.videos.length > 1) {
                this.videoPlayer.addEventListener('ended', () => this.loadNextVideo());
            }
        }
    }

    loadNextVideo() {
        if (!this.data.videos || this.data.videos.length <= 1) return;
        
        this.currentVideoIndex = (this.currentVideoIndex + 1) % this.data.videos.length;
        const video = this.data.videos[this.currentVideoIndex];
        
        console.log(`🎥 Loading next video: ${video.title}`);
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

        // Modern chart options
        const commonOptions = {
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

        let chartConfig = {
            data: {
                labels: data.labels || [],
                datasets: data.datasets || []
            },
            options: commonOptions
        };

        // Set chart type
        if (['line', 'area'].includes(chart_type)) {
            chartConfig.type = 'line';
        } else if (chart_type === 'bar') {
            chartConfig.type = 'bar';
        } else if (['pie', 'doughnut'].includes(chart_type)) {
            chartConfig.type = chart_type;
            // Remove scales for pie/doughnut charts
            delete chartConfig.options.scales;
        } else {
            chartConfig.type = 'bar'; // default
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
}

// Initialize the display system when script loads
const displaySystem = new IITMDisplaySystem();