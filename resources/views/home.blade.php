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
    max-width: 100%;
    max-height: 100%;
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
    <div class="station-bar">
      <button class="station-btn active" data-station="solapur">Solapur Obs</button>
      <button class="station-btn" data-station="delhi">Delhi Obs</button>
      <button class="station-btn" data-station="chennai">Chennai Obs</button>
      <button class="station-btn" data-station="pune">Pune Obs</button>
    </div>
    <div class="inner-card3" id="plotContainer">
      <div>Meteorological data charts will be displayed here</div>
      <div style="color: #999; font-size: 0.9rem;">Chart integration can be added in future updates</div>
    </div>
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

function showSlide(index) {
  const slide = slideshows[index];
  slideshowContainer.innerHTML = '';
  
  if (slide.type === 'image' || slide.type === 'gif') {
    const img = document.createElement('img');
    img.src = slide.url;
    img.onload = () => {
      slideshowContainer.appendChild(img);
    };
  } else if (slide.type === 'video') {
    const video = document.createElement('video');
    video.src = slide.url;
    video.autoplay = true;
    video.muted = true;
    video.loop = true;
    slideshowContainer.appendChild(video);
  }
}

function nextSlide() {
  currentSlideIndex = (currentSlideIndex + 1) % slideshows.length;
  showSlide(currentSlideIndex);
}

function startSlideshow() {
  if (slideshows.length > 0) {
    showSlide(0);
    setInterval(nextSlide, 5000); // Change slide every 5 seconds
    
    // Hide slideshow after 30 seconds to show main content
    setTimeout(() => {
      slideshowOverlay.classList.add('slideshow-hidden');
    }, 30000);
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

// Station button functionality (placeholder)
document.querySelectorAll('.station-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    document.querySelectorAll('.station-btn').forEach(b => b.classList.remove('active'));
    this.classList.add('active');
    // Here you would load different station data
  });
});
</script>

</body>
</html>