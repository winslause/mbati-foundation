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

    <!-- Lightbox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">

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

        /* Custom Scrollbar */
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

        /* Gallery Item */
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

        /* Lightbox Customization */
        .lg-backdrop {
            background: rgba(0, 0, 0, 0.95) !important;
            backdrop-filter: blur(10px);
        }

        .lg-container {
            z-index: 9999 !important;
        }

        .lg-actions .lg-next, .lg-actions .lg-prev {
            background-color: rgba(245, 158, 11, 0.2) !important;
            border: 1px solid rgba(245, 158, 11, 0.3) !important;
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
        <div class="p-6 overflow-y-auto max-h-[70vh]">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="albumImagesGrid">
                <!-- Album images will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Lightbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>

<script>
let currentFilter = 'all';
let visibleItems = 8;
let allGalleryImages = [];

// Load categories from database
function loadCategories() {
    fetch('gallery_handler.php?action=get_categories')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update category buttons based on database categories
                const categoryButtons = document.getElementById('categoryButtons');
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

                    // Add appropriate icon based on category
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
        })
        .catch(error => console.error('Error loading categories:', error));
}

// Load gallery images from database
function loadGalleryImages(filter = 'all', limit = 8, offset = 0) {
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
            }
        })
        .catch(error => console.error('Error loading gallery images:', error));
}

// Render gallery images
function renderGallery() {
    const galleryContainer = document.getElementById('galleryContainer');

    const filteredItems = currentFilter === 'all' ?
        allGalleryImages :
        allGalleryImages.filter(item => item.category === currentFilter);

    galleryContainer.innerHTML = '';

    // Show only visible items
    const itemsToShow = filteredItems.slice(0, visibleItems);

    itemsToShow.forEach((item, index) => {
        const galleryItem = document.createElement('div');
        galleryItem.className = `gallery-item animate-fade-in-up`;
        galleryItem.style.animationDelay = `${index * 0.1}s`;
        galleryItem.setAttribute('data-src', `${item.image_path}`);

        galleryItem.innerHTML = `
            <img src="${item.image_path}" alt="${item.title || 'Gallery image'}" loading="lazy">
            <div class="gallery-overlay">
                <h3 class="font-bold text-dark mb-1">${item.title || 'Untitled'}</h3>
                <p class="text-gray-700 text-sm">${item.description || ''}</p>
                <div class="mt-3 flex items-center justify-between">
                    <span class="px-2 py-1 bg-accent/20 text-accent text-xs rounded-full">${item.category || 'Uncategorized'}</span>
                    <button class="w-8 h-8 rounded-full bg-black/20 flex items-center justify-center hover:bg-accent transition-colors">
                        <i class="fas fa-expand text-dark text-sm"></i>
                    </button>
                </div>
            </div>
        `;

        galleryContainer.appendChild(galleryItem);
    });

    // Initialize lightGallery
    lightGallery(document.getElementById('galleryContainer'), {
        selector: '.gallery-item',
        download: false,
        counter: true,
        showThumbByDefault: false,
        animateThumb: true,
        actualSize: false,
        thumbWidth: 80,
        thumbHeight: '80px',
        thumbMargin: 5
    });

    // Update load more button visibility
    const loadMoreBtn = document.getElementById('loadMore');
    if (filteredItems.length <= visibleItems) {
        loadMoreBtn.style.display = 'none';
    } else {
        loadMoreBtn.style.display = 'inline-flex';
    }
}

// Category Filtering
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('category-btn') || e.target.closest('.category-btn')) {
        const button = e.target.classList.contains('category-btn') ? e.target : e.target.closest('.category-btn');

        // Remove active class from all buttons
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('active');
        });

        // Add active class to clicked button
        button.classList.add('active');

        // Update filter
        currentFilter = button.getAttribute('data-filter');
        visibleItems = 8;

        // Load filtered images
        loadGalleryImages(currentFilter, visibleItems, 0);
    }
});

// Load More Functionality
document.getElementById('loadMore').addEventListener('click', function() {
    visibleItems += 8;
    loadGalleryImages(currentFilter, visibleItems, 0);
});

// Load videos from database
function loadVideos() {
    fetch('gallery_handler.php?action=get_videos')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.videos.length > 0) {
                renderVideos(data.videos);
            } else {
                // Fallback to default videos if no videos in database
                renderDefaultVideos();
            }
        })
        .catch(error => {
            console.error('Error loading videos:', error);
            renderDefaultVideos();
        });
}

// Render videos
function renderVideos(videos) {
    const videosContainer = document.getElementById('videosContainer');
    videosContainer.innerHTML = '';

    videos.forEach(video => {
        const videoCard = document.createElement('div');
        videoCard.className = 'glass-card rounded-2xl overflow-hidden shine-effect';

        // Convert YouTube URL to embed format
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
                <iframe src="${embedUrl}"
                        title="${video.title}"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        webkitallowfullscreen
                        mozallowfullscreen>
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

// Fallback videos if database is empty
function renderDefaultVideos() {
    const videosContainer = document.getElementById('videosContainer');
    videosContainer.innerHTML = `
        <div class="glass-card rounded-2xl overflow-hidden shine-effect">
            <div class="video-container">
                <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                        title="HMF Impact Story"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
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
    fetch('gallery_handler.php?action=get_albums')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.albums.length > 0) {
                renderAlbums(data.albums);
            } else {
                // Fallback to default albums if no albums in database
                renderDefaultAlbums();
            }
        })
        .catch(error => {
            console.error('Error loading albums:', error);
            renderDefaultAlbums();
        });
}

// Render albums
function renderAlbums(albums) {
    const albumsContainer = document.getElementById('albumsContainer');
    albumsContainer.innerHTML = '';

    albums.forEach(album => {
        const albumCard = document.createElement('div');
        albumCard.className = 'glass-card rounded-2xl overflow-hidden group cursor-pointer transform hover:-translate-y-2 transition-all duration-300';
        albumCard.onclick = () => openAlbumModal(album.id, album.title);

        albumCard.innerHTML = `
            <div class="relative h-64 overflow-hidden">
                <img src="${album.cover_image || 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'}"
                      alt="${album.title}"
                      class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
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
    document.getElementById('albumModalTitle').textContent = albumTitle;
    document.getElementById('albumImagesModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    loadAlbumImages(albumId);
}

// Close album modal
function closeAlbumModal() {
    document.getElementById('albumImagesModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Load album images
function loadAlbumImages(albumId) {
    fetch(`gallery_handler.php?action=get_album_images&album_id=${albumId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const images = data.images || [];
                const grid = document.getElementById('albumImagesGrid');
                grid.innerHTML = '';

                if (images.length === 0) {
                    grid.innerHTML = '<p class="text-gray-500 text-sm col-span-full text-center py-8">No images in this album yet.</p>';
                    return;
                }

                images.forEach(image => {
                    const imageDiv = document.createElement('div');
                    imageDiv.className = 'gallery-item';
                    imageDiv.setAttribute('data-src', `${image.image_path}`);

                    imageDiv.innerHTML = `
                        <img src="${image.image_path}" alt="${image.title || 'Album image'}" class="w-full h-48 object-cover rounded-lg">
                        <div class="gallery-overlay">
                            <h3 class="font-bold text-dark mb-1">${image.title || 'Untitled'}</h3>
                            <p class="text-gray-700 text-sm">${image.description || ''}</p>
                            <div class="mt-3 flex items-center justify-between">
                                <span class="px-2 py-1 bg-accent/20 text-accent text-xs rounded-full">Album Image</span>
                                <button class="w-8 h-8 rounded-full bg-black/20 flex items-center justify-center hover:bg-accent transition-colors">
                                    <i class="fas fa-expand text-dark text-sm"></i>
                                </button>
                            </div>
                        </div>
                    `;

                    grid.appendChild(imageDiv);
                });

                // Initialize lightGallery for the modal
                lightGallery(grid, {
                    selector: '.gallery-item',
                    download: false,
                    counter: true,
                    showThumbByDefault: false,
                    animateThumb: true,
                    actualSize: false,
                    thumbWidth: 80,
                    thumbHeight: '80px',
                    thumbMargin: 5
                });
            }
        })
        .catch(error => console.error('Error loading album images:', error));
}

// Fallback albums if database is empty
function renderDefaultAlbums() {
    const albumsContainer = document.getElementById('albumsContainer');
    albumsContainer.innerHTML = `
        <div class="glass-card rounded-2xl overflow-hidden group cursor-pointer transform hover:-translate-y-2 transition-all duration-300">
            <div class="relative h-64 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                      alt="Youth Album"
                      class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-4 left-4 text-white">
                    <div class="text-sm text-accent font-semibold mb-1">45 Photos</div>
                    <h3 class="text-xl font-bold">Youth Empowerment 2024</h3>
                </div>
            </div>
        </div>
    `;
}

// Load photo of the day from database
function loadPhotoOfDay() {
    fetch('gallery_handler.php?action=get_highlight')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.highlight) {
                renderPhotoOfDay(data.highlight);
            } else {
                // Fallback to default photo if no highlight in database
                renderDefaultPhotoOfDay();
            }
        })
        .catch(error => {
            console.error('Error loading photo of day:', error);
            renderDefaultPhotoOfDay();
        });
}

// Render photo of the day
function renderPhotoOfDay(highlight) {
    const section = document.getElementById('photoOfDaySection');
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
                                
                            </div>
                        </div>
                    </div>
                    <div class="relative min-h-[400px] lg:min-h-full">
                        <img src="${highlight.image_path || 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'}"
                              alt="Photo of the Day"
                              class="absolute inset-0 w-full h-full object-cover">
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

// Fallback photo of the day if database is empty
function renderDefaultPhotoOfDay() {
    const section = document.getElementById('photoOfDaySection');
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
                    <div class="relative min-h-[400px] lg:min-h-full">
                        <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                              alt="Photo of the Day"
                              class="absolute inset-0 w-full h-full object-cover">
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

    // Add hover effect to video containers
    document.querySelectorAll('.shine-effect').forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });

        element.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Close album modal when clicking outside
    document.getElementById('albumImagesModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeAlbumModal();
        }
    });
});
</script>
</body>
</html>