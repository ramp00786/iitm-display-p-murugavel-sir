<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IITM Display System</title>
<style>
  * { margin:0; padding:0; box-sizing:border-box; }
  html, body { height:100%; width:100%; overflow:hidden; font-family:'Poppins',sans-serif; background:#555; }

  /* ---------- GRID LAYOUT ---------- */
  .wrapper {
    display: grid;
    grid-template-areas:
      "header header"
      "video plots"
      "ticker ticker"
      "ticker2 ticker2";
    grid-template-columns: 1fr 1fr;
    grid-template-rows: auto 1fr auto auto;
    height: 100vh;
    width: 100vw;
    gap: 10px;
    padding: 5px;
    background: skyblue;
  }

  .card1   { grid-area: header; }
  .card2a  { grid-area: video; }
  .card3   { grid-area: plots; }
  .card2b  { grid-area: ticker; }
  .card2c  { grid-area: ticker2; }

  /* ---------- HEADER (card1) ---------- */
  .card1 {
    background:#fff8;
    border:3px solid gray;
    border-radius:10px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding: 10px 20px;
    font-family:'Georgia',serif;
    text-shadow:1px 1px 0 #fff, -1px -1px 0 #999;
    box-shadow:4px 4px 10px rgba(0,0,0,1);
    position:relative;
  }

  .card1::after {
    content: "LIVE DISPLAY MODE";
    position: absolute;
    bottom: 5px;
    right: 20px;
    font-size: 1.2rem;
    font-weight: bold;
    color: rgba(0, 0, 0, 0.1);
    pointer-events: none;
  }

  .card-content { display:flex; align-items:center; justify-content:space-between; width:100%; }
  .left-images { display:flex; flex-direction:row; gap:5px; align-items:center; }
  .iitm-logo, .esso-logo, .moes-logo { height:60px; object-fit:contain; }
  h2 { flex:1; text-align:center; font-size:clamp(14px,2vw,28px); }
  .right-image { display:flex; align-items:center; }

  /* ---------- VIDEO (card2a) ---------- */
  .card2a {
    border:3px solid gray;
    border-radius:10px;
    overflow:hidden;
    box-shadow:4px 4px 10px rgba(0,0,0,1);
    background:#000;
    position: relative;
  }
  .card2a video { width:100%; height:100%; object-fit:fill; }
  .no-content {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #ccc;
    font-size: 1.2rem;
  }

  /* ---------- PLOTS (card3) ---------- */
  .card3 {
    display:flex;
    flex-direction: column;
    border:3px solid gray;
    border-radius:10px;
    background:#f4f4f4;
    box-shadow:4px 4px 10px rgba(0,0,0,1);
    padding:0;
    overflow:hidden;
  }

  .station-bar {
    flex: 0 0 auto;
    display:flex;
    border:2px solid rgb(196, 196, 196);
    border-radius:6px;
    flex-wrap: wrap;
    justify-content: center;
    gap:4px;
    margin:5px 5px;
    position:sticky;
    top: 0;
    background:skyblue;
    z-index:10;
    padding: 4px;
    box-sizing: border-box;
  }

  .station-btn {
    flex: 0 1 auto;
    min-width: 80px;
    max-width: 150px;
    background:#f0f0f0;
    border:2px solid rgb(212, 160, 160);
    border-radius:4px;
    padding:4px 8px;
    margin:2px;
    font-size:1rem;
    cursor:pointer;
    transition:background 0.3s ease;
  }
  .station-btn:hover { background:#ddd; }
  .station-btn.active { background:#b0b0b0; color:white; font-weight:bold; }
  
  .inner-card3 { 
    display:flex; 
    flex-direction:column; 
    gap:60px; 
    flex: 1 1 auto;
    width: 96%; 
    height: 76%;
    position:relative; 
    padding: 20px;
    text-align: center;
    color: #666;
  }

  .tab-content {
    display: none;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    padding: 20px;
  }

  .tab-content.active {
    display: block;
  }

  .chart-card {
    display: none;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    padding: 10px;
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .chart-card.active {
    display: block;
    opacity: 1;
  }

  .chart-card h4 {
    margin-bottom: 15px;
    color: #333;
    font-size: 1.2rem;
  }

  .chart-card canvas {
    width: 100% !important;
    height: calc(100% - 50px) !important;
  }

  .no-charts {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #999;
  }

  /* ---------- TICKERS ---------- */
  .card2b, .card2c {
    border:3px solid gray;
    border-radius:10px;
    overflow:hidden;
    box-shadow:4px 4px 10px rgba(0,0,0,1);
    display:flex;
    align-items:center;
    background:#fff;
    min-height: 60px;
  }
  .card2c { background:#48b5e0; }
  .ticker-wrapper, .ticker-wrapper1 { width:100%; overflow:hidden; }
  .ticker, .ticker1 { display:inline-block; white-space:nowrap; }
  .ticker span, .ticker1 span { margin:0 20px; font-size:1.2rem; }
  .ticker { animation: ticker 70s linear infinite; }
  .ticker1 { animation: ticker1 200s linear infinite; }
  @keyframes ticker { 0%{transform:translateX(100%);} 100%{transform:translateX(-100%);} }
  @keyframes ticker1 { 0%{transform:translateX(100%);} 100%{transform:translateX(-100%);} }

  /* Slideshow overlay */
  .slideshow-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #000;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .slideshow-overlay img, .slideshow-overlay video {
    width: 100wh;
    height: 100vh;
    object-fit: contain;
  }
  .slideshow-hidden { display: none; }

  .admin-link {
    position: fixed;
    top: 10px;
    right: 10px;
    background: rgba(0,0,0,0.7);
    color: white;
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 0.9rem;
    z-index: 10000;
  }
  .admin-link:hover {
    background: rgba(0,0,0,0.9);
    color: white;
    text-decoration: none;
  }
</style>
</head>
<body>

<!-- Admin Link -->
<a href="{{ route('login') }}" class="admin-link">Admin Panel</a>

<!-- Slideshow Overlay -->
@if($slideshows->count() > 0)
<div class="slideshow-overlay" id="slideshowOverlay">
  <div id="slideshowContainer"></div>
</div>
@endif

<div class="wrapper">
  <!-- Header -->
  <div class="card1">
    <div class="card-content">
      <div class="left-images">
        <img src="{{ asset('images/iitm_logo-preview.png') }}" alt="IITM Logo" class="iitm-logo">
        <img src="{{ asset('images/esso-preview.png') }}" alt="Esso Logo" class="esso-logo">
      </div>
      <h2>Indian Institute of Tropical Meteorology, Pune<br> Integrated Instrument Display System</h2>
      <div class="right-image">
        <img src="{{ asset('images/moes_goi-preview.png') }}" alt="MoES Logo" class="moes-logo">
      </div>
    </div>
  </div>

  <!-- Video -->
  <div class="card2a">
    @if($videos->count() > 0)
      <video id="videoPlayer" autoplay muted loop>
        <source src="{{ $videos->first()->url }}" type="{{ $videos->first()->mime_type }}">
        Your browser does not support the video tag.
      </video>
    @else
      <div class="no-content">No videos available</div>
    @endif
  </div>

  <!-- Tickers -->
  <div class="card2b">
    <div class="ticker-wrapper">
      <div class="ticker" id="ticker">
        @if($newsItems->count() > 0)
          @foreach($newsItems as $news)
            <span>{{ $news->title }}</span>
          @endforeach
        @else
          <span>No news items available</span>
        @endif
      </div>
    </div>
  </div>
  
  <div class="card2c">
    <div class="ticker-wrapper1">
      <div class="ticker1" id="ticker1">
        @if($temperatureItems->count() > 0)
          @foreach($temperatureItems as $temp)
            <span>{{ $temp->title }}</span>
          @endforeach
        @else
          <span>No temperature data available</span>
        @endif
      </div>
    </div>
  </div>

  <!-- Plots -->
  <div class="card3">
    @if($meteorologicalTabs->count() > 0)
      <div class="station-bar" id="stationBar">
        @foreach($meteorologicalTabs as $index => $tab)
          <button class="station-btn {{ $index === 0 ? 'active' : '' }}" 
                  data-station="{{ $tab->data_station }}" 
                  data-tab-id="{{ $tab->id }}">
            {{ $tab->heading }}
          </button>
        @endforeach
      </div>
      <div class="inner-card3" id="plotContainer">
        @foreach($meteorologicalTabs as $tabIndex => $tab)
          <div class="tab-content {{ $tabIndex === 0 ? 'active' : '' }}" data-tab-id="{{ $tab->id }}">
            @if($tab->activeCharts->count() > 0)
              @foreach($tab->activeCharts as $chartIndex => $chart)
                <div class="chart-card {{ $chartIndex === 0 ? 'active' : '' }}" data-chart-id="{{ $chart->id }}">
                  <h4>{{ $chart->title }}</h4>
                  <canvas id="chart_{{ $chart->id }}" width="400" height="300"></canvas>
                </div>
              @endforeach
            @else
              <div class="no-charts">
                <p>No charts available for this tab</p>
              </div>
            @endif
          </div>
        @endforeach
      </div>
    @else
      <div class="station-bar">
        <div class="text-center w-100 py-2">
          <span class="text-muted">No meteorological data configured</span>
        </div>
      </div>
      <div class="inner-card3" id="plotContainer">
        <div class="text-center">
          <i class="fas fa-cloud-sun fa-3x text-muted mb-3"></i>
          <p class="text-muted">Meteorological data charts will be displayed here</p>
          <small class="text-muted">Configure charts in the admin panel</small>
        </div>
      </div>
    @endif
  </div>
</div>

<script>
// Slideshow functionality
@if($slideshows->count() > 0)
const slideshows = @json($slideshows->map(function($item) {
  return [
    'url' => $item->url,
    'type' => $item->type,
    'mime_type' => $item->mime_type
  ];
}));

let currentSlideIndex = 0;
const slideshowContainer = document.getElementById('slideshowContainer');
const slideshowOverlay = document.getElementById('slideshowOverlay');
let slideTimeout;

function showSlide(index) {
  const slide = slideshows[index];
  slideshowContainer.innerHTML = '';
  
  if (slide.type === 'image' || slide.type === 'gif') {
    const img = document.createElement('img');
    img.src = slide.url;
    img.onload = () => {
      slideshowContainer.appendChild(img);
      // Show image/GIF for 5 seconds
      slideTimeout = setTimeout(nextSlide, 5000);
    };
  } else if (slide.type === 'video') {
    const video = document.createElement('video');
    video.src = slide.url;
    video.autoplay = true;
    video.muted = true;
    video.loop = false; // Don't loop individual videos
    video.onended = nextSlide; // Move to next slide when video ends
    video.onerror = () => {
      // If video fails to load, wait 5 seconds and move to next
      slideTimeout = setTimeout(nextSlide, 5000);
    };
    slideshowContainer.appendChild(video);
  }
}

function nextSlide() {
  clearTimeout(slideTimeout); // Clear any existing timeout
  currentSlideIndex++;
  
  if (currentSlideIndex >= slideshows.length) {
    // All slides finished, hide slideshow and show main content
    slideshowOverlay.classList.add('slideshow-hidden');
  } else {
    // Show next slide
    showSlide(currentSlideIndex);
  }
}

function startSlideshow() {
  if (slideshows.length > 0) {
    showSlide(0);
  } else {
    // No slides, show main content immediately
    slideshowOverlay.classList.add('slideshow-hidden');
  }
}

// Start slideshow when page loads
document.addEventListener('DOMContentLoaded', startSlideshow);
@endif

// Video player functionality
@if($videos->count() > 1)
const videos = @json($videos->map(function($video) {
  return [
    'url' => $video->url,
    'mime_type' => $video->mime_type
  ];
}));

let currentVideoIndex = 0;
const videoPlayer = document.getElementById('videoPlayer');

function loadNextVideo() {
  currentVideoIndex = (currentVideoIndex + 1) % videos.length;
  const video = videos[currentVideoIndex];
  videoPlayer.src = video.url;
  videoPlayer.load();
}

if (videoPlayer) {
  videoPlayer.addEventListener('ended', loadNextVideo);
}
@endif

// Meteorological Data Management
@if($meteorologicalTabs->count() > 0)
const meteorologicalData = @json($meteorologicalTabs->map(function($tab) {
  return [
    'id' => $tab->id,
    'heading' => $tab->heading,
    'data_station' => $tab->data_station,
    'charts' => $tab->activeCharts->map(function($chart) {
      return [
        'id' => $chart->id,
        'title' => $chart->title,
        'chart_type' => $chart->chart_type,
        'data' => $chart->chartData ? [
          'labels' => $chart->chartData->labels,
          'datasets' => $chart->chartData->datasets
        ] : null
      ];
    })
  ];
}));

let charts = {};
let currentTabIndex = 0;
let currentChartIndex = 0;
let chartRotationInterval;

// Station button functionality
document.querySelectorAll('.station-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    // Remove active from all buttons and tabs
    document.querySelectorAll('.station-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    
    // Add active to clicked button
    this.classList.add('active');
    
    // Show corresponding tab
    const tabId = this.dataset.tabId;
    const tabContent = document.querySelector(`.tab-content[data-tab-id="${tabId}"]`);
    if (tabContent) {
      tabContent.classList.add('active');
      
      // Update current tab index
      currentTabIndex = Array.from(meteorologicalData).findIndex(tab => tab.id == tabId);
      currentChartIndex = 0;
      
      // Initialize charts for this tab
      initializeChartsForTab(currentTabIndex);
      
      // Start chart rotation
      startChartRotation();
    }
  });
});

function initializeChartsForTab(tabIndex) {
  const tab = meteorologicalData[tabIndex];
  if (!tab || !tab.charts) return;
  
  // Destroy existing charts
  Object.values(charts).forEach(chart => chart.destroy());
  charts = {};
  
  // Create new charts
  tab.charts.forEach(chart => {
    if (chart.data) {
      const canvas = document.getElementById(`chart_${chart.id}`);
      if (canvas) {
        const ctx = canvas.getContext('2d');
        charts[chart.id] = new Chart(ctx, getChartConfig(chart));
      }
    }
  });
  
  // Show first chart
  showChart(tabIndex, 0);
}

function showChart(tabIndex, chartIndex) {
  const tab = meteorologicalData[tabIndex];
  if (!tab || !tab.charts || chartIndex >= tab.charts.length) return;
  
  // Hide all charts in current tab
  document.querySelectorAll(`.tab-content[data-tab-id="${tab.id}"] .chart-card`).forEach(card => {
    card.classList.remove('active');
  });
  
  // Show specific chart
  const chart = tab.charts[chartIndex];
  const chartCard = document.querySelector(`.chart-card[data-chart-id="${chart.id}"]`);
  if (chartCard) {
    chartCard.classList.add('active');
  }
}

function nextChart() {
  const currentTab = meteorologicalData[currentTabIndex];
  if (!currentTab || !currentTab.charts) return;
  
  currentChartIndex++;
  
  if (currentChartIndex >= currentTab.charts.length) {
    // Move to next tab
    currentChartIndex = 0;
    currentTabIndex = (currentTabIndex + 1) % meteorologicalData.length;
    
    // Switch tab
    const nextTab = meteorologicalData[currentTabIndex];
    document.querySelectorAll('.station-btn').forEach(btn => {
      btn.classList.toggle('active', btn.dataset.tabId == nextTab.id);
    });
    
    document.querySelectorAll('.tab-content').forEach(content => {
      content.classList.toggle('active', content.dataset.tabId == nextTab.id);
    });
    
    // Initialize charts for new tab
    initializeChartsForTab(currentTabIndex);
  } else {
    // Show next chart in current tab
    showChart(currentTabIndex, currentChartIndex);
  }
}

function startChartRotation() {
  clearInterval(chartRotationInterval);
  chartRotationInterval = setInterval(nextChart, 4000); // 4 seconds per chart
}

function getChartConfig(chartData) {
  const { chart_type, title, data } = chartData;
  
  if (!data || !data.labels || !data.datasets) {
    return {
      type: 'bar',
      data: { labels: ['No Data'], datasets: [{ label: 'No Data', data: [0], backgroundColor: '#ccc' }] },
      options: { responsive: true, maintainAspectRatio: false }
    };
  }
  
  let chartConfig = {
    data: {
      labels: data.labels || [],
      datasets: data.datasets || []
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: chart_type === 'weatherMinMax' || data.datasets?.length > 1
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  };
  
  // Set chart type
  if (['temp24h', 'rh24h', 'pressure24h', 'wind24h', 'rain24h', 'bc24h', 'smpsSizeDist', 'aethWavelength'].includes(chart_type)) {
    chartConfig.type = 'line';
  } else if (chart_type === 'bcVsSmps') {
    chartConfig.type = 'scatter';
  } else {
    chartConfig.type = 'bar';
  }
  
  return chartConfig;
}

function getChartColors(chartType) {
  const colors = {
    weatherCurrent: ['#ff6384', '#36a2eb', '#ffcd56', '#4bc0c0', '#9966ff'],
    weatherMinMax: 'rgba(75,192,192,0.6)',
    temp24h: '#ff6384',
    rh24h: '#36a2eb',
    pressure24h: '#ffcd56',
    wind24h: '#4bc0c0',
    rain24h: '#9966ff',
    smpsSizeDist: 'rgba(255,99,132,0.2)',
    smpsConc: '#36a2eb',
    aethWavelength: 'rgba(75,192,192,0.2)',
    bc24h: '#333',
    bcVsSmps: '#9966ff',
    dailyBcSmps: 'rgba(54,162,235,0.6)'
  };
  
  return colors[chartType] || '#36a2eb';
}

function getChartBorderColors(chartType) {
  const colors = {
    temp24h: '#ff6384',
    rh24h: '#36a2eb',
    pressure24h: '#ffcd56',
    wind24h: '#4bc0c0',
    rain24h: '#9966ff',
    smpsSizeDist: '#ff6384',
    smpsConc: '#36a2eb',
    aethWavelength: '#4bc0c0',
    bc24h: '#333'
  };
  
  return colors[chartType] || '#36a2eb';
}

// Initialize first tab on load
document.addEventListener('DOMContentLoaded', function() {
  if (meteorologicalData.length > 0) {
    setTimeout(() => {
      initializeChartsForTab(0);
      startChartRotation();
    }, 1000);
  }
});

// Add Chart.js library if not already loaded
if (!window.Chart) {
  const script = document.createElement('script');
  script.src = 'https://cdn.jsdelivr.net/npm/chart.js';
  script.onload = () => {
    if (meteorologicalData.length > 0) {
      setTimeout(() => {
        initializeChartsForTab(0);
        startChartRotation();
      }, 500);
    }
  };
  document.head.appendChild(script);
}
@endif

</script>

</body>
</html>