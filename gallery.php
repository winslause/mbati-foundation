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

            <div class="flex flex-wrap gap-3 justify-center">
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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Video 1 -->
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

            <!-- Video 2 -->
            <div class="glass-card rounded-2xl overflow-hidden shine-effect">
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/LDU_Txk06tM"
                            title="Champions Cup Highlights"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                    </iframe>
                </div>
                <div class="p-6">
                    <h3 class="font-['Montserrat'] text-xl font-bold text-dark mb-2">Harold Mbati Champions Cup</h3>
                    <p class="text-gray-600 text-sm">Highlights from our annual sports tournament creating opportunities</p>
                </div>
            </div>

            <!-- Video 3 -->
            <div class="glass-card rounded-2xl overflow-hidden shine-effect">
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/9bZkp7q19f0"
                            title="Community Transformation"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                    </iframe>
                </div>
                <div class="p-6">
                    <h3 class="font-['Montserrat'] text-xl font-bold text-dark mb-2">Community Impact Story</h3>
                    <p class="text-gray-600 text-sm">Witness the transformation in communities we serve</p>
                </div>
            </div>
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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Album 1 -->
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

            <!-- Album 2 -->
            <div class="glass-card rounded-2xl overflow-hidden group cursor-pointer transform hover:-translate-y-2 transition-all duration-300">
                <div class="relative h-64 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                         alt="Education Album"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <div class="text-sm text-accent font-semibold mb-1">32 Photos</div>
                        <h3 class="text-xl font-bold">School Development</h3>
                    </div>
                </div>
            </div>

            <!-- Album 3 -->
            <div class="glass-card rounded-2xl overflow-hidden group cursor-pointer transform hover:-translate-y-2 transition-all duration-300">
                <div class="relative h-64 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                         alt="Sports Album"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <div class="text-sm text-accent font-semibold mb-1">28 Photos</div>
                        <h3 class="text-xl font-bold">Champions Cup 2024</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Photo of the Day -->
<section class="py-16 bg-gradient-to-b from-primary/30 to-transparent">
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
</section>

<!-- Lightbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>

<script>
// Gallery Data (Replace with your actual images)
const galleryData = [
    { src: 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', category: 'youth', title: 'Youth Leadership Workshop', desc: 'Young leaders developing skills' },
    { src: 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', category: 'education', title: 'School Materials Distribution', desc: 'Students receiving learning materials' },
    { src: 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', category: 'sports', title: 'Champions Cup Match', desc: 'Youth showcasing their talent' },
    { src: 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', category: 'community', title: 'Community Meeting', desc: 'Engaging with community members' },
    { src: 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', category: 'events', title: 'Annual Gala Dinner', desc: 'Fundraising event success' },
    { src: 'https://images.unsplash.com/photo-1534367507877-0edd93bd013b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', category: 'community', title: 'Maternal Health Program', desc: 'Supporting mothers and children' },
    { src: 'https://images.unsplash.com/photo-1515169067868-5387ec356754?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', category: 'youth', title: 'Entrepreneurship Training', desc: 'Youth business skills development' },
    { src: 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', category: 'education', title: 'Classroom Session', desc: 'Quality education in action' },
    { src: 'https://images.unsplash.com/photo-1517649763962-0c623066013b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', category: 'sports', title: 'Sports Talent Showcase', desc: 'Identifying young athletes' },
    { src: 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', category: 'events', title: 'Volunteer Appreciation', desc: 'Celebrating our volunteers' },
    { src: 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', category: 'community', title: 'Community Clean-up', desc: 'Environmental conservation' },
    { src: 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', category: 'youth', title: 'Tech Skills Training', desc: 'Digital literacy program' }
];

let currentFilter = 'all';
let visibleItems = 8;

// Initialize Gallery
function initGallery() {
    const galleryContainer = document.getElementById('galleryContainer');
    const filteredItems = galleryData.filter(item =>
        currentFilter === 'all' || item.category === currentFilter
    );

    galleryContainer.innerHTML = '';

    // Show only visible items
    const itemsToShow = filteredItems.slice(0, visibleItems);

    itemsToShow.forEach((item, index) => {
        const galleryItem = document.createElement('div');
        galleryItem.className = `gallery-item animate-fade-in-up`;
        galleryItem.style.animationDelay = `${index * 0.1}s`;
        galleryItem.setAttribute('data-src', item.src);
        galleryItem.setAttribute('data-category', item.category);

        galleryItem.innerHTML = `
            <img src="${item.src}" alt="${item.title}" loading="lazy">
            <div class="gallery-overlay">
                <h3 class="font-bold text-dark mb-1">${item.title}</h3>
                <p class="text-gray-700 text-sm">${item.desc}</p>
                <div class="mt-3 flex items-center justify-between">
                    <span class="px-2 py-1 bg-accent/20 text-accent text-xs rounded-full">${item.category}</span>
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
}

// Category Filtering
document.querySelectorAll('.category-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Remove active class from all buttons
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('active');
        });

        // Add active class to clicked button
        this.classList.add('active');

        // Update filter
        currentFilter = this.getAttribute('data-filter');
        visibleItems = 8;

        // Reinitialize gallery with filter
        initGallery();
    });
});

// Load More Functionality
document.getElementById('loadMore').addEventListener('click', function() {
    visibleItems += 8;
    initGallery();

    // Hide button if all items are visible
    const filteredItems = galleryData.filter(item =>
        currentFilter === 'all' || item.category === currentFilter
    );

    if (visibleItems >= filteredItems.length) {
        this.style.display = 'none';
    }
});

// Initialize on load
document.addEventListener('DOMContentLoaded', function() {
    initGallery();

    // Add scroll animation for gallery items
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, observerOptions);

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
});
</script>