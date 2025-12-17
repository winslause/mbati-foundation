<!-- Header Section -->
<header id="header" class="sticky top-0 z-50 bg-primary text-white header-glow animate-slide-down">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo with Image and Text -->
            <a href="index.php" class="flex items-center space-x-3 lg:space-x-4">
                <div class="logo-container animate-float">
                    <!-- Replace with your actual logo.png -->
                    <img src="logo.png" alt="Harold Mbati Foundation Logo" class="h-10 lg:h-12 w-auto">
                </div>
                <!-- Text that shows next to logo on ALL devices -->
                <div class="flex flex-col">
                    <span class="font-heading text-lg lg:text-2xl font-bold tracking-tight">Harold Mbati</span>
                    <span class="font-heading text-xs lg:text-sm font-semibold text-accent tracking-wider">FOUNDATION</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center space-x-2">
                <a href="index.php?page=home" class="nav-link px-5 py-3 font-medium text-gray-200 hover:text-white transition-colors">
                    <i class="fas fa-home mr-2"></i>Home
                </a>
                <a href="index.php?page=about" class="nav-link px-5 py-3 font-medium text-gray-200 hover:text-white transition-colors">
                    <i class="fas fa-book-open mr-2"></i>Our Story
                </a>
                <a href="index.php?page=work" class="nav-link px-5 py-3 font-medium text-gray-200 hover:text-white transition-colors">
                    <i class="fas fa-hands-helping mr-2"></i>Our Work
                </a>
                <a href="index.php?page=involve" class="nav-link px-5 py-3 font-medium text-gray-200 hover:text-white transition-colors">
                    <i class="fas fa-users mr-2"></i>Get Involved
                </a>
                <a href="index.php?page=connect" class="nav-link px-5 py-3 font-medium text-gray-200 hover:text-white transition-colors">
                    <i class="fas fa-envelope mr-2"></i>Connect
                </a>

                <!-- Donate Button -->
                <a href="index.php?page=donate" class="donate-btn ml-4 px-8 py-3 rounded-full text-white font-bold text-lg flex items-center">
                    <i class="fas fa-heart mr-3"></i>DONATE
                </a>
            </nav>

            <!-- Mobile Menu Button -->
            <div class="flex items-center lg:hidden">
                <button id="mobileMenuButton" class="text-2xl text-accent hover:text-yellow-300 transition-colors">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobileMenu" class="mobile-menu lg:hidden bg-secondary rounded-lg shadow-xl mt-2">
            <div class="py-4 space-y-1">
                <a href="index.php?page=home" class="block px-6 py-4 font-medium text-white hover:bg-accent/20 hover:text-accent transition-colors border-l-4 border-transparent hover:border-accent">
                    <i class="fas fa-home mr-3"></i>Home
                </a>
                <a href="index.php?page=about" class="block px-6 py-4 font-medium text-white hover:bg-accent/20 hover:text-accent transition-colors border-l-4 border-transparent hover:border-accent">
                    <i class="fas fa-book-open mr-3"></i>Our Story
                </a>
                <a href="index.php?page=work" class="block px-6 py-4 font-medium text-white hover:bg-accent/20 hover:text-accent transition-colors border-l-4 border-transparent hover:border-accent">
                    <i class="fas fa-hands-helping mr-3"></i>Our Work
                </a>
                <a href="index.php?page=involve" class="block px-6 py-4 font-medium text-white hover:bg-accent/20 hover:text-accent transition-colors border-l-4 border-transparent hover:border-accent">
                    <i class="fas fa-users mr-3"></i>Get Involved
                </a>
                <a href="index.php?page=connect" class="block px-6 py-4 font-medium text-white hover:bg-accent/20 hover:text-accent transition-colors border-l-4 border-transparent hover:border-accent">
                    <i class="fas fa-envelope mr-3"></i>Connect
                </a>
                <div class="px-6 py-4">
                    <a href="index.php?page=donate" class="donate-btn block text-center px-6 py-4 rounded-full text-white font-bold text-lg">
                        <i class="fas fa-heart mr-2"></i>DONATE NOW
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Progress Bar -->
    <div class="h-1.5 w-full bg-gray-800">
        <div id="scrollProgress" class="h-full bg-gradient-to-r from-accent to-yellow-300" style="width: 0%"></div>
    </div>
</header>