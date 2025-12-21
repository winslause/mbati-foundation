<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery | Harold Mbati Foundation</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Lightbox CSS with plugins -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <!-- Additional CSS for plugins -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lg-thumbnail@1.4.0/dist/lg-thumbnail.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lg-zoom@1.4.0/dist/lg-zoom.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lg-fullscreen@1.4.0/dist/lg-fullscreen.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="logo.png">
    <link rel="apple-touch-icon" href="logo.png">

    <style>
        :root {
            --primary: #0f172a;
            --secondary: #1e293b;
            --accent: #f59e0b;
            --glossy: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            color: #1e293b;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Custom Scrollbar - Only for main page */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #f59e0b, #d97706);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #d97706, #b45309);
        }

        /* Disable scrollbars on gallery items and containers */
        .gallery-item *,
        .video-container *,
        .album-images-container * {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;     /* Firefox */
        }

        .gallery-item *::-webkit-scrollbar,
        .video-container *::-webkit-scrollbar,
        .album-images-container *::-webkit-scrollbar {
            display: none; /* Chrome, Safari and Opera */
        }

        /* Glassmorphism Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }

        /* Gallery Item - No Scroll */
        .gallery-item {
            position: relative;
            border-radius: 1rem;
            overflow: hidden;
            transform-style: preserve-3d;
            perspective: 1000px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .gallery-item::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent 50%, rgba(0, 0, 0, 0.8) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .gallery-item:hover::before {
            opacity: 1;
        }

        .gallery-item img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .gallery-item:hover img {
            transform: scale(1.1) rotate(1deg);
        }

        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem;
            background: linear-gradient(to top, rgba(255, 255, 255, 0.9), transparent);
            transform: translateY(100%);
            transition: transform 0.4s ease;
            z-index: 2;
        }

        .gallery-item:hover .gallery-overlay {
            transform: translateY(0);
        }

        /* Category Filter */
        .category-btn {
            padding: 0.75rem 1.5rem;
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 2rem;
            color: #64748b;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .category-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s;
        }

        .category-btn:hover::before {
            left: 100%;
        }

        .category-btn:hover {
            background: rgba(0, 0, 0, 0.1);
            border-color: rgba(245, 158, 11, 0.3);
            color: #1e293b;
        }

        .category-btn.active {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            border-color: transparent;
            box-shadow: 0 4px 20px rgba(245, 158, 11, 0.3);
        }

        /* Loading Animation */
        .loader {
            display: inline-block;
            width: 50px;
            height: 50px;
            border: 3px solid rgba(245, 158, 11, 0.3);
            border-radius: 50%;
            border-top-color: #f59e0b;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Floating Elements */
        .float-element {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        /* Shine Effect */
        .shine-effect {
            position: relative;
            overflow: hidden;
        }

        .shine-effect::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.1) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: rotate(30deg);
            transition: transform 0.6s;
        }

        .shine-effect:hover::after {
            transform: rotate(30deg) translate(50%, 50%);
        }

        /* Video Player */
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 1rem;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            overflow: hidden !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1rem;
            }

            .gallery-item img {
                height: 200px;
            }
        }

        /* Custom Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        /* Pulse Animation */
        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* Modal Loader Styles */
        .modal-loader {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        .modal-loader .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(245, 158, 11, 0.2);
            border-top: 3px solid var(--accent);
            border-radius: 50%;
            animation: modal-spin 1s linear infinite;
        }

        .modal-loader .spinner.small {
            width: 30px;
            height: 30px;
            border-width: 2px;
        }

        @keyframes modal-spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Modal overlay loader */
        .modal-overlay-loader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.3s ease;
        }

        .modal-overlay-loader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .modal-overlay-loader .loader-content {
            text-align: center;
            color: white;
        }

        .modal-overlay-loader .loader-content h3 {
            margin-top: 20px;
            font-size: 1.2rem;
            color: var(--accent);
        }

        /* Content loader for images grid */
        .content-loader {
            display: grid;
            place-items: center;
            min-height: 200px;
            width: 100%;
            transition: opacity 0.3s ease;
        }

        .content-loader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .content-loader .pulse-loader {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--accent), #d97706);
            border-radius: 50%;
            animation: pulse 1.5s ease-in-out infinite;
        }

        /* Skeleton loading for gallery items */
        .skeleton-item {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 1rem;
            min-height: 280px;
            transition: opacity 0.3s ease;
        }

        .skeleton-item.hidden {
            opacity: 0;
            pointer-events: none;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Image loader */
        .image-loader {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
            transition: opacity 0.3s ease;
        }

        .image-loader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Video loader */
        .video-loader {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
            border-radius: 1rem;
            transition: opacity 0.3s ease;
        }

        .video-loader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        /* Album images grid container */
        .album-images-container {
            overflow-y: auto;
            max-height: 70vh;
            padding-right: 8px; /* Space for content */
        }

        /* Hide scrollbar for album images container */
        .album-images-container::-webkit-scrollbar {
            width: 8px;
        }

        .album-images-container::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 4px;
        }

        .album-images-container::-webkit-scrollbar-thumb {
            background: rgba(245, 158, 11, 0.3);
            border-radius: 4px;
        }

        .album-images-container::-webkit-scrollbar-thumb:hover {
            background: rgba(245, 158, 11, 0.5);
        }

        /* Fix for iframe scrollbars */
        iframe {
            overflow: hidden !important;
        }

        /* Ensure images don't have scrollbars */
        img {
            overflow: hidden !important;
        }

        /* Remove scrollbars from all containers inside gallery items */
        .gallery-item > div,
        .gallery-item > div > *,
        .video-container > *,
        #albumImagesGrid > * {
            overflow: hidden !important;
        }
    </style>
</head>
<body class="min-h-screen">
<!-- Gallery Hero Section -->
<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden pt-24">
    <!-- Animated Background -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-primary/30 via-transparent to-accent/10"></div>
        <div class="absolute top-20 left-10 w-64 h-64 bg-accent/5 rounded-full float-element"></div>
        <div class="absolute bottom-20 right-10 w-48 h-48 bg-secondary/5 rounded-full float-element" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/3 w-32 h-32 bg-accent/10 rounded-full float-element" style="animation-delay: 4s;"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 glass-card rounded-full mb-8">
                <div class="w-2 h-2 bg-accent rounded-full animate-pulse"></div>
                <span class="font-medium text-sm tracking-wider text-accent">VISUAL JOURNEY</span>
            </div>

            <h1 class="font-['Montserrat'] text-5xl md:text-7xl font-bold text-black mb-6">
                Our <span class="text-accent">Visual</span> Story
            </h1>

            <p class="text-xl text-gray-700 mb-10 max-w-2xl mx-auto leading-relaxed">
                Experience the impact of Harold Mbati Foundation through stunning visuals that capture moments of transformation, hope, and community empowerment.
            </p>

            <div class="flex flex-wrap gap-4 justify-center">
                <a href="#gallery" class="px-8 py-4 glass-card text-dark font-semibold rounded-full hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-1 flex items-center gap-3 group">
                    <span>Explore Gallery</span>
                    <i class="fas fa-arrow-down group-hover:translate-y-1 transition-transform"></i>
                </a>
                <a href="#videos" class="px-8 py-4 glass-card text-dark font-semibold rounded-full hover:bg-white/10 transition-all duration-300 border border-black/20">
                    <i class="fas fa-play mr-2"></i>
                    <span>Watch Videos</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
        <div class="animate-bounce">
            <i class="fas fa-chevron-down text-white/40 text-2xl"></i>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section id="gallery" class="py-16">
    <div class="container mx-auto px-4">
        <!-- Category Filter -->
        <div class="mb-12">
            <div class="text-center mb-8">
                <h2 class="font-['Montserrat'] text-3xl md:text-4xl font-bold text-dark mb-4">
                    Browse by <span class="text-accent">Category</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Filter through our collection of impactful moments captured across different programs
                </p>
            </div>

            <div class="flex flex-wrap gap-3 justify-center" id="categoryButtons">
                <button class="category-btn active" data-filter="all">
                    <i class="fas fa-th-large mr-2"></i>
                    All Photos
                </button>
                <button class="category-btn" data-filter="youth">
                    <i class="fas fa-users mr-2"></i>
                    Youth Empowerment
                </button>
                <button class="category-btn" data-filter="education">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    Education
                </button>
                <button class="category-btn" data-filter="sports">
                    <i class="fas fa-futbol mr-2"></i>
                    Sports
                </button>
                <button class="category-btn" data-filter="community">
                    <i class="fas fa-hands-helping mr-2"></i>
                    Community
                </button>
                <button class="category-btn" data-filter="events">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Events
                </button>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="gallery-grid" id="galleryContainer">
            <!-- Gallery items will be loaded here -->
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12">
            <button id="loadMore" class="px-8 py-3 glass-card text-dark font-semibold rounded-full hover:bg-white/10 transition-all duration-300 border border-black/20 flex items-center gap-2 mx-auto">
                <span>Load More Photos</span>
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
</section>

<!-- Video Gallery -->
<section id="videos" class="py-16 bg-gradient-to-b from-transparent to-primary/30">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 px-4 py-2 glass-card rounded-full mb-6">
                <i class="fas fa-play text-accent"></i>
                <span class="font-medium text-sm tracking-wider text-accent">VIDEO STORIES</span>
            </div>
            <h2 class="font-['Montserrat'] text-3xl md:text-4xl font-bold text-dark mb-6">
                Watch Our <span class="text-gradient bg-gradient-to-r from-accent to-yellow-400 bg-clip-text text-transparent">Journey</span>
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Experience our impact through compelling video stories that showcase real transformation
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="videosContainer">
            <!-- Videos will be loaded dynamically -->
        </div>
    </div>
</section>

<!-- Featured Albums -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 px-4 py-2 glass-card rounded-full mb-6">
                <i class="fas fa-images text-accent"></i>
                <span class="font-medium text-sm tracking-wider text-accent">FEATURED ALBUMS</span>
            </div>
            <h2 class="font-['Montserrat'] text-3xl md:text-4xl font-bold text-dark mb-6">
                Special <span class="text-gradient bg-gradient-to-r from-accent to-yellow-400 bg-clip-text text-transparent">Collections</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8" id="albumsContainer">
            <!-- Albums will be loaded dynamically -->
        </div>
    </div>
</section>

<!-- Photo of the Day -->
<section class="py-16 bg-gradient-to-b from-primary/30 to-transparent" id="photoOfDaySection">
    <!-- Content will be loaded dynamically -->
</section>

<!-- Album Images Modal -->
<div id="albumImagesModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-2xl max-w-6xl w-full max-h-[90vh] overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-2xl font-bold text-gray-800" id="albumModalTitle">Album Images</h3>
                <button onclick="closeAlbumModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
        </div>
        <div class="album-images-container">
            <!-- Loader for album images -->
            <div id="albumImagesLoader" class="content-loader">
                <div class="modal-loader">
                    <div class="spinner"></div>
                </div>
                <p class="mt-4 text-gray-600">Loading images...</p>
            </div>
            
            <!-- Skeleton loader while loading -->
            <div id="albumImagesSkeleton" class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div class="skeleton-item h-48"></div>
                    <div class="skeleton-item h-48"></div>
                    <div class="skeleton-item h-48"></div>
                    <div class="skeleton-item h-48"></div>
                </div>
            </div>
            
            <div class="p-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="albumImagesGrid">
                <!-- Album images will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Global overlay loader for all modals -->
<div id="globalModalLoader" class="modal-overlay-loader hidden">
    <div class="loader-content">
        <div class="spinner"></div>
        <h3 id="globalLoaderText">Loading content...</h3>
    </div>
</div>

<!-- Lightbox JS with plugins -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lg-thumbnail@1.4.0/dist/lg-thumbnail.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lg-zoom@1.4.0/dist/lg-zoom.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lg-fullscreen@1.4.0/dist/lg-fullscreen.min.js"></script>

<script>
// Utility functions for loaders
function showGlobalLoader(text = "Loading content...") {
    const loader = document.getElementById('globalModalLoader');
    const loaderText = document.getElementById('globalLoaderText');
    if (loader && loaderText) {
        loaderText.textContent = text;
        loader.classList.remove('hidden');
    }
}

function hideGlobalLoader() {
    const loader = document.getElementById('globalModalLoader');
    if (loader) {
        loader.classList.add('hidden');
    }
}

function showAlbumLoader() {
    const loader = document.getElementById('albumImagesLoader');
    const skeleton = document.getElementById('albumImagesSkeleton');
    const grid = document.getElementById('albumImagesGrid');
    
    if (loader) loader.classList.remove('hidden');
    if (skeleton) skeleton.classList.remove('hidden');
    if (grid) grid.innerHTML = '';
}

function hideAlbumLoader() {
    const loader = document.getElementById('albumImagesLoader');
    const skeleton = document.getElementById('albumImagesSkeleton');
    
    if (loader) loader.classList.add('hidden');
    if (skeleton) skeleton.classList.add('hidden');
}

function closeAlbumModal() {
    const modal = document.getElementById('albumImagesModal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        hideAlbumLoader();
    }
}

// Main variables
let currentFilter = 'all';
let visibleItems = 8;
let allGalleryImages = [];
let lightGalleryInstance = null;

// Enhanced lightGallery initialization function
function initLightGallery() {
    const galleryContainer = document.getElementById('galleryContainer');
    if (!galleryContainer || typeof lightGallery === 'undefined') return;
    
    // Wait a bit for DOM to settle
    setTimeout(() => {
        try {
            // Destroy previous instance if it exists
            if (lightGalleryInstance) {
                try {
                    lightGalleryInstance.destroy(true);
                } catch (e) {
                    console.log('Failed to destroy previous lightGallery instance');
                }
                lightGalleryInstance = null;
            }
            
            // Initialize new instance with all plugins
            lightGalleryInstance = lightGallery(galleryContainer, {
                selector: '.gallery-item',
                download: false,
                counter: true,
                showThumbByDefault: false,
                animateThumb: true,
                actualSize: false,
                thumbWidth: 80,
                thumbHeight: '80px',
                thumbMargin: 5,
                speed: 300,
                mode: 'lg-slide',
                cssEase: 'cubic-bezier(0.4, 0, 0.2, 1)',
                // Enable all plugins
                plugins: [
                    lgThumbnail,
                    lgZoom,
                    lgFullscreen
                ],
                // Custom controls
                controls: true,
                nextHtml: '<i class="fas fa-chevron-right"></i>',
                prevHtml: '<i class="fas fa-chevron-left"></i>',
                closeHtml: '<i class="fas fa-times"></i>',
                downloadHtml: '',
                counterHtml: '{current} of {total}',
                // Show controls
                hideControlOnEnd: false,
                loop: true,
                // Mobile settings
                mobileSettings: {
                    controls: true,
                    showCloseIcon: true,
                    download: false
                }
            });
            
            console.log('LightGallery initialized with all controls');
        } catch (error) {
            console.error('Error initializing lightGallery:', error);
        }
    }, 300);
}

// Function to initialize album modal lightGallery
function initAlbumLightGallery() {
    const grid = document.getElementById('albumImagesGrid');
    if (!grid || typeof lightGallery === 'undefined') return;
    
    setTimeout(() => {
        try {
            lightGallery(grid, {
                selector: '.gallery-item',
                download: false,
                counter: true,
                showThumbByDefault: false,
                animateThumb: true,
                actualSize: false,
                thumbWidth: 80,
                thumbHeight: '80px',
                thumbMargin: 5,
                speed: 300,
                mode: 'lg-slide',
                cssEase: 'cubic-bezier(0.4, 0, 0.2, 1)',
                plugins: [
                    lgThumbnail,
                    lgZoom,
                    lgFullscreen
                ],
                controls: true,
                nextHtml: '<i class="fas fa-chevron-right"></i>',
                prevHtml: '<i class="fas fa-chevron-left"></i>',
                closeHtml: '<i class="fas fa-times"></i>',
                downloadHtml: '',
                counterHtml: '{current} of {total}',
                hideControlOnEnd: false,
                loop: true,
                mobileSettings: {
                    controls: true,
                    showCloseIcon: true,
                    download: false
                }
            });
        } catch (error) {
            console.error('Error initializing album lightGallery:', error);
        }
    }, 300);
}

// Load categories from database
function loadCategories() {
    fetch('gallery_handler.php?action=get_categories')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const categoryButtons = document.getElementById('categoryButtons');
                if (categoryButtons) {
                    const existingButtons = categoryButtons.querySelectorAll('.category-btn');
                    existingButtons.forEach(btn => {
                        if (btn.getAttribute('data-filter') !== 'all') {
                            btn.remove();
                        }
                    });

                    data.categories.forEach(category => {
                        const button = document.createElement('button');
                        button.className = 'category-btn';
                        button.setAttribute('data-filter', category.name);

                        let icon = 'fas fa-tag';
                        if (category.name.toLowerCase().includes('youth')) icon = 'fas fa-users';
                        else if (category.name.toLowerCase().includes('education')) icon = 'fas fa-graduation-cap';
                        else if (category.name.toLowerCase().includes('sports')) icon = 'fas fa-futbol';
                        else if (category.name.toLowerCase().includes('community')) icon = 'fas fa-hands-helping';
                        else if (category.name.toLowerCase().includes('events')) icon = 'fas fa-calendar-alt';

                        button.innerHTML = `<i class="${icon} mr-2"></i>${category.name}`;
                        categoryButtons.appendChild(button);
                    });
                }
            }
        })
        .catch(error => console.error('Error loading categories:', error));
}

// Load gallery images from database
function loadGalleryImages(filter = 'all', limit = 8, offset = 0) {
    const galleryContainer = document.getElementById('galleryContainer');
    const loadMoreBtn = document.getElementById('loadMore');
    
    // Show skeleton loader on first load
    if (offset === 0 && galleryContainer) {
        galleryContainer.innerHTML = `
            <div class="col-span-full">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    ${Array.from({length: 8}).map(() => `
                        <div class="relative h-64 overflow-hidden">
                            <div class="skeleton-item h-full"></div>
                        </div>
                    `).join('')}
                </div>
            </div>
        `;
        
        if (loadMoreBtn) {
            loadMoreBtn.style.display = 'none';
        }
    }
    
    const categoryParam = filter === 'all' ? 'all' : filter;
    const url = `gallery_handler.php?action=get_gallery&category=${encodeURIComponent(categoryParam)}&limit=${limit}&offset=${offset}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (offset === 0) {
                    allGalleryImages = data.images;
                } else {
                    allGalleryImages = allGalleryImages.concat(data.images);
                }
                renderGallery();
            } else {
                console.error('Gallery API returned error:', data);
                if (galleryContainer) {
                    galleryContainer.innerHTML = '<p class="text-gray-500 text-center py-8 col-span-full">Failed to load images. Please try again.</p>';
                }
            }
        })
        .catch(error => {
            console.error('Error loading gallery images:', error);
            if (galleryContainer) {
                galleryContainer.innerHTML = '<p class="text-gray-500 text-center py-8 col-span-full">Network error. Please check your connection.</p>';
            }
        });
}

// Render gallery images
function renderGallery() {
    const galleryContainer = document.getElementById('galleryContainer');
    if (!galleryContainer) return;

    const filteredItems = currentFilter === 'all' ?
        allGalleryImages :
        allGalleryImages.filter(item => item.category === currentFilter);

    galleryContainer.innerHTML = '';

    const itemsToShow = filteredItems.slice(0, visibleItems);

    if (itemsToShow.length === 0) {
        galleryContainer.innerHTML = '<p class="text-gray-500 text-center py-8 col-span-full">No images found for this category.</p>';
        return;
    }

    itemsToShow.forEach((item, index) => {
        const galleryItem = document.createElement('a');
        galleryItem.className = `gallery-item animate-fade-in-up`;
        galleryItem.style.animationDelay = `${index * 0.1}s`;
        galleryItem.setAttribute('href', item.image_path);
        galleryItem.setAttribute('data-src', item.image_path);

        galleryItem.innerHTML = `
            <div class="relative h-64 overflow-hidden">
                <div class="image-loader">
                    <div class="spinner small"></div>
                </div>
                <img src="${item.image_path}" 
                     alt="${item.title || 'Gallery image'}" 
                     loading="lazy"
                     class="w-full h-full object-cover"
                     onload="this.classList.add('fade-in'); this.previousElementSibling.classList.add('hidden');"
                     onerror="this.previousElementSibling.classList.add('hidden');">
                <div class="gallery-overlay">
                    <h3 class="font-bold text-dark mb-1">${item.title || ' '}</h3>
                    <p class="text-gray-700 text-sm">${item.description || ''}</p>
                    <div class="mt-3 flex items-center justify-between">
                        <span class="px-2 py-1 bg-accent/20 text-accent text-xs rounded-full">${item.category || 'Uncategorized'}</span>
                        <span class="w-8 h-8 rounded-full bg-black/20 flex items-center justify-center">
                            <i class="fas fa-expand text-dark text-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        `;

        galleryContainer.appendChild(galleryItem);
    });

    // Initialize lightGallery after a short delay
    setTimeout(() => {
        initLightGallery();
    }, 300);

    // Update load more button visibility
    const loadMoreBtn = document.getElementById('loadMore');
    if (loadMoreBtn) {
        if (filteredItems.length <= visibleItems) {
            loadMoreBtn.style.display = 'none';
        } else {
            loadMoreBtn.style.display = 'inline-flex';
        }
    }
}

// Category Filtering
document.addEventListener('click', function(e) {
    const categoryBtn = e.target.closest('.category-btn');
    if (categoryBtn) {
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('active');
        });

        categoryBtn.classList.add('active');
        currentFilter = categoryBtn.getAttribute('data-filter');
        visibleItems = 8;
        loadGalleryImages(currentFilter, visibleItems, 0);
    }
});

// Load More Functionality
document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('loadMore');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            visibleItems += 8;
            loadGalleryImages(currentFilter, visibleItems, 0);
        });
    }
});

// Load videos from database
function loadVideos() {
    const videosContainer = document.getElementById('videosContainer');
    if (!videosContainer) return;
    
    // Show skeleton loader
    videosContainer.innerHTML = `
        <div class="col-span-full">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                ${Array.from({length: 3}).map(() => `
                    <div class="glass-card rounded-2xl overflow-hidden">
                        <div class="skeleton-item h-48"></div>
                        <div class="p-6">
                            <div class="skeleton-item h-4 w-3/4 mb-2"></div>
                            <div class="skeleton-item h-3 w-full"></div>
                            <div class="skeleton-item h-3 w-2/3 mt-2"></div>
                        </div>
                    </div>
                `).join('')}
            </div>
        </div>
    `;
    
    fetch('gallery_handler.php?action=get_videos')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.videos.length > 0) {
                renderVideos(data.videos);
            } else {
                renderDefaultVideos();
            }
        })
        .catch(error => {
            console.error('Error loading videos:', error);
            renderDefaultVideos();
        });
}

// Render videos with loaders
function renderVideos(videos) {
    const videosContainer = document.getElementById('videosContainer');
    if (!videosContainer) return;
    
    videosContainer.innerHTML = '';

    videos.forEach(video => {
        const videoCard = document.createElement('div');
        videoCard.className = 'glass-card rounded-2xl overflow-hidden shine-effect';

        let embedUrl = video.video_url;
        if (video.video_url.includes('youtube.com/watch?v=')) {
            const videoId = video.video_url.split('v=')[1].split('&')[0];
            embedUrl = `https://www.youtube.com/embed/${videoId}?rel=0&modestbranding=1&playsinline=1`;
        } else if (video.video_url.includes('youtu.be/')) {
            const videoId = video.video_url.split('youtu.be/')[1].split('?')[0];
            embedUrl = `https://www.youtube.com/embed/${videoId}?rel=0&modestbranding=1&playsinline=1`;
        }

        videoCard.innerHTML = `
            <div class="video-container">
                <div class="video-loader">
                    <div class="spinner small"></div>
                </div>
                <iframe src="${embedUrl}"
                        title="${video.title}"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        webkitallowfullscreen
                        mozallowfullscreen
                        onload="this.classList.add('fade-in'); this.previousElementSibling.classList.add('hidden');">
                </iframe>
            </div>
            <div class="p-6">
                <h3 class="font-['Montserrat'] text-xl font-bold text-dark mb-2">${video.title}</h3>
                <p class="text-gray-600 text-sm">${video.description || ''}</p>
            </div>
        `;

        videosContainer.appendChild(videoCard);
    });
}

// Fallback videos
function renderDefaultVideos() {
    const videosContainer = document.getElementById('videosContainer');
    if (!videosContainer) return;
    
    videosContainer.innerHTML = `
        <div class="glass-card rounded-2xl overflow-hidden shine-effect">
            <div class="video-container">
                <div class="video-loader">
                    <div class="spinner small"></div>
                </div>
                <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                        title="HMF Impact Story"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        onload="this.classList.add('fade-in'); this.previousElementSibling.classList.add('hidden');">
                </iframe>
            </div>
            <div class="p-6">
                <h3 class="font-['Montserrat'] text-xl font-bold text-dark mb-2">Youth Empowerment Success</h3>
                <p class="text-gray-600 text-sm">How our programs are transforming young lives in Luanda Constituency</p>
            </div>
        </div>
    `;
}

// Load albums from database
function loadAlbums() {
    const albumsContainer = document.getElementById('albumsContainer');
    if (!albumsContainer) return;
    
    // Show skeleton loader
    albumsContainer.innerHTML = `
        <div class="col-span-full">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                ${Array.from({length: 3}).map(() => `
                    <div class="glass-card rounded-2xl overflow-hidden">
                        <div class="skeleton-item h-64"></div>
                    </div>
                `).join('')}
            </div>
        </div>
    `;
    
    fetch('gallery_handler.php?action=get_albums')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.albums.length > 0) {
                renderAlbums(data.albums);
            } else {
                renderDefaultAlbums();
            }
        })
        .catch(error => {
            console.error('Error loading albums:', error);
            renderDefaultAlbums();
        });
}

// Render albums with loaders
function renderAlbums(albums) {
    const albumsContainer = document.getElementById('albumsContainer');
    if (!albumsContainer) return;
    
    albumsContainer.innerHTML = '';

    albums.forEach(album => {
        const albumCard = document.createElement('div');
        albumCard.className = 'glass-card rounded-2xl overflow-hidden group cursor-pointer transform hover:-translate-y-2 transition-all duration-300';
        albumCard.onclick = () => openAlbumModal(album.id, album.title);

        albumCard.innerHTML = `
            <div class="relative h-64 overflow-hidden">
                <div class="image-loader">
                    <div class="spinner small"></div>
                </div>
                <img src="${album.cover_image || 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'}"
                      alt="${album.title}"
                      class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                      onload="this.classList.add('fade-in'); this.previousElementSibling.classList.add('hidden');"
                      onerror="this.previousElementSibling.classList.add('hidden');">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-4 left-4 text-white">
                    <div class="text-sm text-accent font-semibold mb-1">${album.image_count || 0} Photos</div>
                    <h3 class="text-xl font-bold">${album.title}</h3>
                </div>
            </div>
        `;

        albumsContainer.appendChild(albumCard);
    });
}

// Open album modal
function openAlbumModal(albumId, albumTitle) {
    const modal = document.getElementById('albumImagesModal');
    const modalTitle = document.getElementById('albumModalTitle');
    
    if (modal && modalTitle) {
        modalTitle.textContent = albumTitle;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        showAlbumLoader();
        loadAlbumImages(albumId);
    }
}

// Load album images with individual loaders
function loadAlbumImages(albumId) {
    fetch(`gallery_handler.php?action=get_album_images&album_id=${albumId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const images = data.images || [];
                const grid = document.getElementById('albumImagesGrid');
                
                // Hide loader and skeleton
                hideAlbumLoader();
                
                if (!grid) return;
                
                if (images.length === 0) {
                    grid.innerHTML = '<p class="text-gray-500 text-sm col-span-full text-center py-8">No images in this album yet.</p>';
                    return;
                }

                images.forEach(image => {
                    const imageDiv = document.createElement('a');
                    imageDiv.className = 'gallery-item overflow-hidden';
                    imageDiv.setAttribute('href', image.image_path);
                    imageDiv.setAttribute('data-src', image.image_path);

                    imageDiv.innerHTML = `
                        <div class="relative h-48 overflow-hidden">
                            <div class="image-loader">
                                <div class="spinner small"></div>
                            </div>
                            <img src="${image.image_path}" 
                                 alt="${image.title || 'Album image'}" 
                                 class="w-full h-full object-cover rounded-lg"
                                 onload="this.classList.add('fade-in'); this.previousElementSibling.classList.add('hidden');"
                                 onerror="this.previousElementSibling.classList.add('hidden');">
                            <div class="gallery-overlay">
                                <h3 class="font-bold text-dark mb-1">${image.title || ' '}</h3>
                                <p class="text-gray-700 text-sm">${image.description || ''}</p>
                                <div class="mt-3 flex items-center justify-between">
                                    <span class="px-2 py-1 bg-accent/20 text-accent text-xs rounded-full">Album Image</span>
                                    <span class="w-8 h-8 rounded-full bg-black/20 flex items-center justify-center">
                                        <i class="fas fa-expand text-dark text-sm"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    `;

                    grid.appendChild(imageDiv);
                });

                // Initialize lightGallery for the modal
                setTimeout(() => {
                    initAlbumLightGallery();
                }, 300);
            } else {
                const grid = document.getElementById('albumImagesGrid');
                if (grid) {
                    grid.innerHTML = '<p class="text-gray-500 text-sm col-span-full text-center py-8">Failed to load album images.</p>';
                }
                hideAlbumLoader();
            }
        })
        .catch(error => {
            console.error('Error loading album images:', error);
            const grid = document.getElementById('albumImagesGrid');
            if (grid) {
                grid.innerHTML = '<p class="text-gray-500 text-sm col-span-full text-center py-8">Failed to load images. Please try again.</p>';
            }
            hideAlbumLoader();
        });
}

// Fallback albums
function renderDefaultAlbums() {
    const albumsContainer = document.getElementById('albumsContainer');
    if (!albumsContainer) return;
    
    const albumCard = document.createElement('div');
    albumCard.className = 'glass-card rounded-2xl overflow-hidden group cursor-pointer transform hover:-translate-y-2 transition-all duration-300';
    albumCard.onclick = () => openAlbumModal('default', 'Youth Empowerment 2024');

    albumCard.innerHTML = `
        <div class="relative h-64 overflow-hidden">
            <div class="image-loader">
                <div class="spinner small"></div>
            </div>
            <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                  alt="Youth Album"
                  class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                  onload="this.classList.add('fade-in'); this.previousElementSibling.classList.add('hidden');"
                  onerror="this.previousElementSibling.classList.add('hidden');">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
            <div class="absolute bottom-4 left-4 text-white">
                <div class="text-sm text-accent font-semibold mb-1">45 Photos</div>
                <h3 class="text-xl font-bold">Youth Empowerment 2024</h3>
            </div>
        </div>
    `;

    albumsContainer.innerHTML = '';
    albumsContainer.appendChild(albumCard);
}

// Load photo of the day from database
function loadPhotoOfDay() {
    const section = document.getElementById('photoOfDaySection');
    if (!section) return;
    
    // Show skeleton loader
    section.innerHTML = `
        <div class="container mx-auto px-4">
            <div class="glass-card rounded-3xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class="p-8 lg:p-12">
                        <div class="skeleton-item h-6 w-32 mb-6"></div>
                        <div class="skeleton-item h-12 w-3/4 mb-6"></div>
                        <div class="skeleton-item h-4 w-full mb-2"></div>
                        <div class="skeleton-item h-4 w-5/6 mb-2"></div>
                        <div class="skeleton-item h-4 w-4/6 mb-8"></div>
                    </div>
                    <div class="relative min-h-[400px] lg:min-h-full">
                        <div class="skeleton-item absolute inset-0"></div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    fetch('gallery_handler.php?action=get_highlight')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.highlight) {
                renderPhotoOfDay(data.highlight);
            } else {
                renderDefaultPhotoOfDay();
            }
        })
        .catch(error => {
            console.error('Error loading photo of day:', error);
            renderDefaultPhotoOfDay();
        });
}

// Render photo of the day with loader
function renderPhotoOfDay(highlight) {
    const section = document.getElementById('photoOfDaySection');
    if (!section) return;
    
    section.innerHTML = `
        <div class="container mx-auto px-4">
            <div class="glass-card rounded-3xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class="p-8 lg:p-12">
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-accent/10 rounded-full mb-6">
                            <i class="fas fa-crown text-accent"></i>
                            <span class="font-medium text-sm tracking-wider text-accent">PHOTO OF THE DAY</span>
                        </div>
                        <h2 class="font-['Montserrat'] text-3xl md:text-4xl font-bold text-dark mb-6">
                            Today's <span class="text-accent">Highlight</span>
                        </h2>
                        <p class="text-gray-700 mb-8">
                            ${highlight.description || 'A special moment captured during our recent community outreach program in Luanda Constituency, showcasing the joy and hope we bring to the communities we serve.'}
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-accent to-yellow-600 flex items-center justify-center">
                                <i class="fas fa-camera text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-dark">Photographer's Note</h4>
                                <p class="text-gray-600 text-sm">Captured by: James Mwangi • Luanda Constituency</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative min-h-[400px] lg:min-h-full overflow-hidden">
                        <div class="image-loader">
                            <div class="spinner"></div>
                        </div>
                        <img src="${highlight.image_path || 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'}"
                              alt="Photo of the Day"
                              class="absolute inset-0 w-full h-full object-cover"
                              onload="this.classList.add('fade-in'); this.previousElementSibling.classList.add('hidden');"
                              onerror="this.previousElementSibling.classList.add('hidden');">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary/80 via-transparent to-transparent lg:hidden"></div>
                        <div class="absolute bottom-4 right-4 glass-card px-4 py-2 rounded-full">
                            <span class="text-sm text-white">📸 Featured Photo</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// Fallback photo of the day
function renderDefaultPhotoOfDay() {
    const section = document.getElementById('photoOfDaySection');
    if (!section) return;
    
    section.innerHTML = `
        <div class="container mx-auto px-4">
            <div class="glass-card rounded-3xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class="p-8 lg:p-12">
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-accent/10 rounded-full mb-6">
                            <i class="fas fa-crown text-accent"></i>
                            <span class="font-medium text-sm tracking-wider text-accent">PHOTO OF THE DAY</span>
                        </div>
                        <h2 class="font-['Montserrat'] text-3xl md:text-4xl font-bold text-dark mb-6">
                            Today's <span class="text-accent">Highlight</span>
                        </h2>
                        <p class="text-gray-700 mb-8">
                            A special moment captured during our recent community outreach program in Luanda Constituency, showcasing the joy and hope we bring to the communities we serve.
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-accent to-yellow-600 flex items-center justify-center">
                                <i class="fas fa-camera text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-dark">Photographer's Note</h4>
                                <p class="text-gray-600 text-sm">Captured by: James Mwangi • Luanda Constituency</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative min-h-[400px] lg:min-h-full overflow-hidden">
                        <div class="image-loader">
                            <div class="spinner"></div>
                        </div>
                        <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                              alt="Photo of the Day"
                              class="absolute inset-0 w-full h-full object-cover"
                              onload="this.classList.add('fade-in'); this.previousElementSibling.classList.add('hidden');"
                              onerror="this.previousElementSibling.classList.add('hidden');">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary/80 via-transparent to-transparent lg:hidden"></div>
                        <div class="absolute bottom-4 right-4 glass-card px-4 py-2 rounded-full">
                            <span class="text-sm text-white">📸 Featured Photo</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// Initialize on load
document.addEventListener('DOMContentLoaded', function() {
    loadCategories();
    loadGalleryImages();
    loadVideos();
    loadAlbums();
    loadPhotoOfDay();

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Close album modal when clicking outside or escape key
    const albumModal = document.getElementById('albumImagesModal');
    if (albumModal) {
        albumModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeAlbumModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !albumModal.classList.contains('hidden')) {
                closeAlbumModal();
            }
        });
    }
});
</script>
</body>
</html>