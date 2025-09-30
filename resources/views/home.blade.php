<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IITM Display System</title>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-blue: #0a1a35;
            --secondary-blue: #1a2d53;
            --accent-blue: #2a4d8c;
            --highlight-blue: #3a6bc8;
            --primary-orange: #ff7b25;
            --secondary-orange: #ff9a52;
            --text-light: #ffffff;
            --text-dim: #b8c7e0;
            --border-color: #2a4d8c;
            --card-bg: rgba(26, 45, 83, 0.8);
            --success: #4ade80;
            --warning: #fbbf24;
            --danger: #f87171;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            width: 100%;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
            background: var(--primary-blue);
            color: var(--text-light);
        }

        /* Grid Layout */
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
            gap: 15px;
            padding: 15px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            opacity: 0;
            visibility: hidden;
            transition: opacity 2s ease-in-out;
        }

        .card1 { grid-area: header; }
        .card2a { grid-area: video; }
        .card3 { grid-area: plots; }
        .card2b { grid-area: ticker; }
        .card2c { grid-area: ticker2; }

        /* Header */
        .card1 {
            background: var(--card-bg);
            border: 2px solid var(--border-color);
            border-radius: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            position: relative;
            backdrop-filter: blur(10px);
        }

        .card1::after {
            content: "LIVE DISPLAY MODE";
            position: absolute;
            bottom: 10px;
            right: 30px;
            font-size: 1rem;
            font-weight: 600;
            color: var(--primary-orange);
            opacity: 0.9;
        }

        .card-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .left-images {
            display: flex;
            flex-direction: row;
            gap: 15px;
            align-items: center;
        }

        .iitm-logo, .esso-logo, .moes-logo {
            height: 60px;
            object-fit: contain;
            filter: brightness(0) invert(1);
            opacity: 0.9;
        }

        h2 {
            flex: 1;
            text-align: center;
            font-size: clamp(18px, 2.5vw, 32px);
            font-weight: 600;
            background: linear-gradient(135deg, var(--text-light) 0%, var(--secondary-orange) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0 25px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .right-image {
            display: flex;
            align-items: center;
        }

        /* Video */
        .card2a {
            border: 2px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            background: #000;
        }

        .card2a video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-content {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #ccc;
            font-size: 1.2rem;
        }

        /* Plots Container */
        .card3 {
            display: flex;
            flex-direction: column;
            border: 2px solid var(--border-color);
            border-radius: 16px;
            background: var(--card-bg);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            padding: 0;
            overflow: hidden;
        }

        .station-bar {
            flex: 0 0 auto;
            display: flex;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin: 15px;
            position: sticky;
            top: 0;
            background: var(--secondary-blue);
            z-index: 10;
            padding: 10px;
            box-sizing: border-box;
            backdrop-filter: blur(10px);
        }

        .station-btn {
            flex: 0 1 auto;
            min-width: 120px;
            max-width: 180px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 10px 15px;
            margin: 2px;
            font-size: 1rem;
            font-weight: 500;
            color: var(--text-dim);
            cursor: pointer;
            transition: none;
        }

        .station-btn.active {
            background: var(--primary-orange);
            color: var(--text-light);
            border-color: var(--primary-orange);
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(255, 123, 37, 0.4);
        }
        
        .inner-card3 {
            display: flex;
            flex-direction: column;
            gap: 60px;
            flex: 1 1 auto;
            width: 96%;
            height: 76%;
            position: relative;
            margin: 0 auto;
        }

        .inner-card3 .card {
            position: absolute;
            top: 0;
            left: 0;
            padding: 20px;
            box-sizing: border-box;
            width: 100%;
            height: 90%;
            opacity: 0;
            transition: opacity 0.5s ease;
            display: flex;
            flex-direction: column;
            background: rgba(10, 26, 53, 0.7);
            border-radius: 12px;
        }

        .inner-card3 .card.active {
            opacity: 1;
            z-index: 1;
        }

        .inner-card3 .card h3 {
            margin-bottom: 15px;
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary-orange);
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 10px;
        }

        .inner-card3 .card canvas {
            flex: 1 1 auto;
            width: 100% !important;
            height: 100% !important;
        }

        /* Tickers */
        .card2b, .card2c {
            border: 2px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            background: var(--card-bg);
        }

        .card2c {
            background: var(--secondary-blue);
        }

        .ticker-wrapper, .ticker-wrapper1 {
            width: 100%;
            overflow: hidden;
        }

        .ticker, .ticker1 {
            display: inline-block;
            white-space: nowrap;
            padding: 12px 0;
        }

        .ticker span, .ticker1 span {
            margin: 0 25px;
            font-size: 1.2rem;
            font-weight: 500;
        }

        .ticker {
            animation: ticker 70s linear infinite;
        }

        .ticker1 {
            animation: ticker1 200s linear infinite;
        }

        @keyframes ticker {
            0% { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }

        @keyframes ticker1 {
            0% { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }

        /* Status indicator */
        .status-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .status-live {
            background: var(--success);
            box-shadow: 0 0 10px var(--success);
        }

        .status-update {
            background: var(--primary-orange);
            box-shadow: 0 0 10px var(--primary-orange);
        }

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
            width: 100vw;
            height: 100vh;
            object-fit: contain;
        }
        .slideshow-hidden { display: none; }

        /* Loading Screen */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            z-index: 8888;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
            transition: opacity 1s ease-out;
        }

        .loading-screen.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .loading-content {
            text-align: center;
            max-width: 400px;
        }

        .loading-logo {
            margin-bottom: 30px;
        }

        .loading-text h3 {
            font-size: 2rem;
            font-weight: 600;
            color: var(--text-light);
            margin-bottom: 10px;
            background: linear-gradient(135deg, var(--text-light) 0%, var(--secondary-orange) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .loading-text p {
            font-size: 1.2rem;
            color: var(--text-dim);
            margin-bottom: 40px;
        }

        .loading-spinner {
            display: flex;
            justify-content: center;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(255, 123, 37, 0.2);
            border-top: 3px solid var(--primary-orange);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

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
{{-- <a href="{{ route('login') }}" class="admin-link">Admin Panel</a> --}}

<!-- Slideshow Overlay -->
<div class="slideshow-overlay slideshow-hidden" id="slideshowOverlay">
  <div id="slideshowContainer"></div>
</div>

<!-- Loading Screen (shown while slideshow is running) -->
<div class="loading-screen" id="loadingScreen">
    <div class="loading-content">
        <div class="loading-logo">
            <img src="{{ asset('images/iitm_logo-preview.png') }}" alt="IITM Logo" style="height: 80px; filter: brightness(0) invert(1);">
        </div>
        <div class="loading-text">
            <h3>IITM Display System</h3>
            <p>Preparing meteorological dashboard...</p>
        </div>
        <div class="loading-spinner">
            <div class="spinner"></div>
        </div>
    </div>
</div>

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
            <video id="videoPlayer" autoplay muted loop style="display: none;">
                <!-- Video source will be set by JavaScript -->
                Your browser does not support the video tag.
            </video>
            <div class="no-content" id="noVideoContent">Loading videos...</div>
        </div>

        <!-- Tickers -->
        <div class="card2b">
            <div class="ticker-wrapper">
                <div class="ticker" id="ticker">
                    <span><span class="status-indicator status-live"></span>Loading news...</span>
                </div>
            </div>
        </div>
        <div class="card2c">
            <div class="ticker-wrapper1">
                <div class="ticker1" id="ticker1">
                    <span>Loading temperature data...</span>
                </div>
            </div>
        </div>

        <!-- Plots -->
        <div class="card3">
            <div class="station-bar" id="stationBar">
                <div class="text-center w-100 py-2">
                    <span style="color: var(--text-dim);">Loading meteorological data...</span>
                </div>
            </div>
            <div class="inner-card3" id="plotContainer">
                <div class="card active">
                    <h3>Meteorological Data</h3>
                    <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: var(--text-dim);">
                        <p>Loading charts...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Load Chart.js and our clean JavaScript -->
    <script src="{{ asset('js/display-system.js') }}"></script>

</body>
</html>