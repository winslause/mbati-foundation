<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harold Mbati Foundation</title>
    <!-- SEO Meta Tags -->
    <meta name="description" content="Harold Mbati Foundation - Empowering communities through education, sports, and sustainable development in Kenya">
    <meta name="keywords" content="Harold Mbati, Foundation, Kenya, Education, Sports, Community Development, Luanda Constituency">
    <meta name="author" content="Harold Mbati Foundation">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0f172a',    // Dark blue
                        secondary: '#1e40af',   // Royal blue
                        accent: '#f59e0b',      // Amber gold
                        dark: '#0a0f1e',
                        light: '#f8fafc'
                    },
                    fontFamily: {
                        'heading': ['Montserrat', 'sans-serif'],
                        'body': ['Poppins', 'sans-serif'],
                    },
                    animation: {
                        'slide-down': 'slideDown 0.3s ease-out',
                        'fade-in': 'fadeIn 0.5s ease-out',
                        'pulse-slow': 'pulse 3s infinite',
                        'float': 'float 3s ease-in-out infinite',
                        'shine': 'shine 3s ease-in-out infinite',
                    }
                }
            }
        }
    </script>

    <style>
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes shine {
            0% { box-shadow: 0 0 5px rgba(245, 158, 11, 0.3); }
            50% { box-shadow: 0 0 20px rgba(245, 158, 11, 0.6); }
            100% { box-shadow: 0 0 5px rgba(245, 158, 11, 0.3); }
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: -5px;
            left: 0;
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-out;
        }

        .mobile-menu.open {
            max-height: 500px;
        }

        .donate-btn {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
        }

        .donate-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.6);
            animation: shine 2s infinite;
        }

        .header-glow {
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        }

        .logo-container {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            border-radius: 12px;
            padding: 8px;
            transition: all 0.3s ease;
        }

        .logo-container:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(245, 158, 11, 0.4);
        }
    </style>
</head>
<body class="font-body bg-light text-dark">

<?php include 'header.php'; ?>

<!-- Main Content -->
<main class="min-h-screen">
<?php
$page = $_GET['page'] ?? 'home';
$page = basename($page); // Security: prevent directory traversal

$allowed_pages = ['home', 'about', 'work', 'involve', 'connect', 'donate'];
if (in_array($page, $allowed_pages)) {
    $file = $page . '.php';
    if (file_exists($file)) {
        include $file;
    } else {
        include 'home.php'; // Fallback
    }
} else {
    include 'home.php'; // Default
}
?>
</main>

<!-- Connect With Us Section -->
<section class="py-20 bg-light">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 border border-primary/20 mb-4">
                <span class="text-sm font-semibold text-primary tracking-wider">CONNECT WITH US</span>
            </div>
            <h1 class="font-heading text-4xl md:text-5xl font-bold text-primary mb-6">
                Connect With Us
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                We'd love to hear from you. Get in touch to learn more about our work, share your ideas, or find out how you can get involved.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white rounded-2xl p-8 shadow-xl">
                <h2 class="font-heading text-2xl font-bold text-primary mb-6">Send us a Message</h2>
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 mb-2">Full Name *</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Email Address *</label>
                            <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Subject</label>
                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent" placeholder="How can we help you?">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Message *</label>
                        <textarea rows="6" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent resize-vertical" placeholder="Share your thoughts, questions, or ideas..." required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-accent text-white py-4 rounded-lg hover:bg-yellow-600 transition-colors font-semibold flex items-center justify-center">
                        <span>Send Message</span>
                        <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-8">
                <!-- Office Info -->
                <div class="bg-white rounded-2xl p-8 shadow-xl">
                    <div class="flex items-start mb-6">
                        <div class="w-12 h-12 bg-accent/20 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-map-marker-alt text-accent text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-heading text-xl font-bold text-primary mb-2">Our Location</h3>
                            <p class="text-gray-600">Luanda Constituency<br>Kenya</p>
                        </div>
                    </div>

                    <div class="flex items-start mb-6">
                        <div class="w-12 h-12 bg-accent/20 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-clock text-accent text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-heading text-xl font-bold text-primary mb-2">Office Hours</h3>
                            <p class="text-gray-600">Monday - Friday: 8:00 AM - 5:00 PM<br>East Africa Time (EAT)</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-accent/20 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-phone text-accent text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-heading text-xl font-bold text-primary mb-2">Phone</h3>
                            <p class="text-gray-600">+254 768 927895</p>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-white rounded-2xl p-8 shadow-xl">
                    <h3 class="font-heading text-xl font-bold text-primary mb-6">Follow Our Journey</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="#" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                            <i class="fab fa-facebook-f text-blue-600 text-2xl mr-3"></i>
                            <span class="font-semibold text-blue-700">Facebook</span>
                        </a>
                        <a href="#" class="flex items-center p-4 bg-pink-50 rounded-lg hover:bg-pink-100 transition-colors">
                            <i class="fab fa-instagram text-pink-600 text-2xl mr-3"></i>
                            <span class="font-semibold text-pink-700">Instagram</span>
                        </a>
                        <a href="#" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                            <i class="fab fa-twitter text-blue-400 text-2xl mr-3"></i>
                            <span class="font-semibold text-blue-500">Twitter</span>
                        </a>
                        <a href="#" class="flex items-center p-4 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                            <i class="fab fa-youtube text-red-600 text-2xl mr-3"></i>
                            <span class="font-semibold text-red-700">YouTube</span>
                        </a>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="bg-gradient-to-r from-accent to-yellow-500 rounded-2xl p-8 text-white">
                    <h3 class="font-heading text-xl font-bold mb-4">Stay Updated</h3>
                    <p class="mb-6 opacity-90">Subscribe to our newsletter for the latest updates on our programs and impact.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email address" class="flex-grow px-4 py-3 rounded-l-lg text-dark focus:outline-none focus:ring-2 focus:ring-white/50" required>
                        <button type="submit" class="bg-primary px-6 py-3 rounded-r-lg hover:bg-primary/90 transition-colors">
                            <i class="fas fa-envelope"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="mt-20">
            <h2 class="font-heading text-3xl font-bold text-primary text-center mb-12">Frequently Asked Questions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <h3 class="font-semibold text-primary mb-3">How can I volunteer with HMF?</h3>
                    <p class="text-gray-600">Contact us through the form above or call our office. We'll discuss opportunities that match your skills and availability.</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <h3 class="font-semibold text-primary mb-3">What programs do you currently run?</h3>
                    <p class="text-gray-600">We focus on education, sports development, health & wellness, and community outreach programs in Luanda Constituency.</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <h3 class="font-semibold text-primary mb-3">How are donations used?</h3>
                    <p class="text-gray-600">100% of donations go directly to our programs. We maintain full transparency in our financial reporting.</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <h3 class="font-semibold text-primary mb-3">Can I partner with HMF?</h3>
                    <p class="text-gray-600">We welcome partnerships with organizations that share our vision. Contact us to explore collaboration opportunities.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<!-- JavaScript for Interactivity -->
<script>
    // Mobile menu toggle
    document.getElementById('mobileMenuButton').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('open');
        this.innerHTML = mobileMenu.classList.contains('open')
            ? '<i class="fas fa-times"></i>'
            : '<i class="fas fa-bars"></i>';
    });

    // Scroll progress bar
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollPercent = (scrollTop / docHeight) * 100;
        document.getElementById('scrollProgress').style.width = scrollPercent + '%';
    });

    // Set current year in footer
    document.getElementById('currentYear').textContent = new Date().getFullYear();

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if(targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if(targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 100,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Newsletter form submission (frontend only)
    document.getElementById('newsletterForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = this.querySelector('input[type="email"]').value;
        alert(`Thank you for subscribing with: ${email}\n(This is a frontend demo - backend integration will be added later)`);
        this.reset();
    });

    // Add active class to current page link
    const urlParams = new URLSearchParams(window.location.search);
    const currentPage = urlParams.get('page') || 'home';
    const navLinks = document.querySelectorAll('.nav-link, .mobile-menu a');
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if(href && href.includes('page=' + currentPage)) {
            link.classList.add('text-accent', 'font-bold');
            link.classList.remove('text-gray-200');

            // Add gold border for active link
            if(link.classList.contains('nav-link')) {
                link.style.setProperty('--after-width', '100%');
            }
        }
    });

    // Logo hover effect
    const logoContainer = document.querySelector('.logo-container');
    if(logoContainer) {
        logoContainer.addEventListener('mouseenter', function() {
            this.style.animation = 'shine 1.5s ease-in-out';
        });

        logoContainer.addEventListener('mouseleave', function() {
            this.style.animation = 'float 3s ease-in-out infinite';
        });
    }

    // Animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if(entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
                entry.target.style.opacity = '1';
            }
        });
    }, observerOptions);

    // Observe all footer sections
    document.querySelectorAll('footer > div > div > div').forEach(section => {
        section.style.opacity = '0';
        observer.observe(section);
    });
</script>
</body>
</html>