<!-- Hero Section (Restored to previous state) -->
<section class="relative min-h-screen flex items-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="hero.jpg" alt="Harold Mbati Foundation - Empowering Communities"
             class="w-full h-full object-cover object-center">
        <div class="absolute inset-0 hero-overlay"></div>

        <!-- Gradient overlay -->
        <div class="absolute inset-0 opacity-40"
             style="background: linear-gradient(90deg, #0f172a 0%, transparent 50%, transparent 100%);">
        </div>
    </div>

    <!-- Floating particles -->
    <div class="absolute inset-0 z-1">
        <div class="absolute top-1/4 left-1/3 w-4 h-4 bg-accent rounded-full animate-float opacity-50"
             style="animation-delay: 0s;"></div>
        <div class="absolute top-1/2 right-1/3 w-3 h-3 bg-white rounded-full animate-float opacity-30"
             style="animation-delay: 0.5s;"></div>
        <div class="absolute bottom-1/3 left-1/2 w-2 h-2 bg-accent rounded-full animate-float opacity-40"
             style="animation-delay: 1s;"></div>
    </div>

    <!-- Main Content - Aligned to left -->
    <div class="relative z-10 container mx-auto px-4 py-16 md:py-24">
        <div class="max-w-2xl">

            <!-- Foundation Tag - Left aligned -->
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/50 backdrop-blur-sm border border-accent/30 mb-8 animate-fade-in-left"
                 style="animation-delay: 0.2s;">
                <div class="w-2 h-2 bg-accent rounded-full mr-2 animate-pulse"></div>
                <span class="text-sm font-semibold text-accent tracking-wider">HAROLD MBATI FOUNDATION</span>
            </div>

            <!-- Main Heading - Left aligned with italics -->
            <h1 class="font-heading hero-heading text-3xl md:text-4xl lg:text-5xl mb-6 text-white leading-relaxed animate-fade-in-left"
                style="animation-delay: 0.4s; font-style: italic; font-weight: 400;">
                <span class="block">Empowering</span>
                <span class="block text-accent-italic mt-2">Communities,</span>
                <span class="block mt-2">Transforming Lives</span>
            </h1>

            <!-- Subtitle - Left aligned, italic, smaller -->
            <p class="text-lg md:text-xl hero-subtitle text-gray-200 mb-10 max-w-xl italic animate-fade-in-left"
               style="animation-delay: 0.6s; font-weight: 300; line-height: 1.8;">
                Building a brighter future for Kenya through education, sports, and sustainable development initiatives that create lasting impact.
            </p>

            <!-- CTA Buttons - Left aligned -->
            <div class="flex flex-col sm:flex-row gap-4 mb-16 animate-fade-in-left"
                 style="animation-delay: 0.8s;">
                <a href="index.php?page=activities" class="hero-btn px-8 py-4 rounded-full text-white font-medium text-lg flex items-center justify-center sm:justify-start group w-full sm:w-auto">
                    <span class="italic">Discover Our Activities</span>
                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                </a>
                <a href="index.php?page=gallery"
                   class="px-8 py-4 rounded-full text-white font-medium text-lg flex items-center justify-center sm:justify-start border-2 border-accent hover:bg-accent/20 transition-all duration-300 group w-full sm:w-auto">
                    <i class="fas fa-images mr-3 text-accent group-hover:text-white transition-colors"></i>
                    <span class="italic">View our gallery</span>
                </a>
            </div>

            <!-- Stats Section - Left aligned -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12 max-w-xl hero-stats animate-fade-in"
                 style="animation-delay: 1s;">
                <div class="stats-card p-4 rounded-2xl text-center">
                    <div class="text-2xl md:text-3xl font-medium text-accent mb-2">500+</div>
                    <div class="text-sm text-gray-300 italic">Students Impacted</div>
                </div>
                <div class="stats-card p-4 rounded-2xl text-center">
                    <div class="text-2xl md:text-3xl font-medium text-accent mb-2">20+</div>
                    <div class="text-sm text-gray-300 italic">Communities Reached</div>
                </div>
                <div class="stats-card p-4 rounded-2xl text-center">
                    <div class="text-2xl md:text-3xl font-medium text-accent mb-2">50+</div>
                    <div class="text-sm text-gray-300 italic">Projects Completed</div>
                </div>
                <div class="stats-card p-4 rounded-2xl text-center">
                    <div class="text-2xl md:text-3xl font-medium text-accent mb-2">100+</div>
                    <div class="text-sm text-gray-300 italic">Volunteers Engaged</div>
                </div>
            </div>

            <!-- Scroll Indicator - Left aligned -->
            <div class="mt-12 animate-fade-in-left" style="animation-delay: 1.2s;">
                <div class="flex items-center">
                    <div class="scroll-indicator"></div>
                    <p class="text-sm text-gray-400 ml-4 italic">Scroll to explore our journey</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right side decorative element -->
    <div class="absolute right-0 top-1/2 transform -translate-y-1/2 hidden lg:block z-5 animate-fade-in"
         style="animation-delay: 1.5s;">
        <div class="w-64 h-64 rounded-full border-2 border-accent/30 flex items-center justify-center">
            <div class="w-48 h-48 rounded-full border border-accent/20 flex items-center justify-center">
                <div class="w-32 h-32 rounded-full bg-accent/10 flex items-center justify-center">
                    <i class="fas fa-hands-helping text-4xl text-accent/50 animate-float"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Wave Divider at bottom -->
    <div class="absolute bottom-0 left-0 right-0 z-10">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full">
            <path fill="#f8fafc" fill-opacity="1"
                  d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </div>
</section>

<!-- What We Do Section -->
<section id="what-we-do" class="py-12 md:py-20 bg-light">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-12 md:mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 border border-primary/20 mb-4">
                <span class="text-sm font-semibold text-primary tracking-wider">OUR PROGRAMS</span>
            </div>
            <h2 class="font-heading text-3xl md:text-4xl lg:text-5xl font-bold text-primary mb-4">
                What <span class="text-accent">We Do</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Transforming communities through focused initiatives that create sustainable impact
            </p>
        </div>

        <!-- Slideshow Container -->
        <div class="slideshow-container relative">
            <!-- Navigation Buttons -->
            <button class="nav-button prev" onclick="prevSlide()">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="nav-button next" onclick="nextSlide()">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Slide 1: Youth Empowerment -->
            <div class="slide active">
                <div class="container mx-auto px-4">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        <!-- Image on left for slide 1 -->
                        <div class="order-1 lg:order-1">
                            <img src="youth.jpg"
                                 alt="Youth Empowerment" class="slide-image">
                        </div>
                        <!-- Content on right for slide 1 -->
                        <div class="order-2 lg:order-2 slide-content">
                            <div class="relative mb-6">
                                <div class="quote-mark">"</div>
                                <h3 class="font-heading text-2xl md:text-3xl font-bold text-primary mb-2">
                                    Youth Empowerment
                                </h3>
                                <p class="text-lg text-gray-600 italic mb-4">
                                    "The world's biggest strength lies in the youth."
                                </p>
                            </div>
                            <p class="text-gray-700 text-lg leading-relaxed">
                                Young people are transforming the community through education and entrepreneurship. We provide platforms for learning, collaboration, and leadership.
                            </p>
                            <div class="mt-6 flex items-center text-accent">
                                <i class="fas fa-users text-xl mr-3"></i>
                                <span class="font-semibold">Empowering the next generation of leaders</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2: People Living with Disability -->
            <div class="slide">
                <div class="container mx-auto px-4">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        <!-- Content on top for slide 2 -->
                        <div class="order-1 lg:order-2 slide-content">
                            <div class="relative mb-6">
                                <div class="quote-mark">"</div>
                                <h3 class="font-heading text-2xl md:text-3xl font-bold text-primary mb-2">
                                    People Living with Disability
                                </h3>
                                <p class="text-lg text-gray-600 italic mb-4">
                                    "Inclusion is not a matter of political correctness. It is the key to growth."
                                </p>
                            </div>
                            <p class="text-gray-700 text-lg leading-relaxed">
                                We create an inclusive society with equal opportunities for all. Our programs focus on accessibility, skill development, and advocacy for people with disabilities.
                            </p>
                            <div class="mt-6 flex items-center text-accent">
                                <i class="fas fa-universal-access text-xl mr-3"></i>
                                <span class="font-semibold">Building an inclusive community for all</span>
                            </div>
                        </div>
                        <!-- Image on bottom for slide 2 -->
                        <div class="order-2 lg:order-1">
                            <img src="disability.jpg"
                                 alt="People Living with Disability" class="slide-image">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3: Schools Development -->
            <div class="slide">
                <div class="container mx-auto px-4">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        <!-- Image on left for slide 3 -->
                        <div class="order-1 lg:order-1">
                            <img src="school.jpg"
                                 alt="Schools Development" class="slide-image">
                        </div>
                        <!-- Content on right for slide 3 -->
                        <div class="order-2 lg:order-2 slide-content">
                            <div class="relative mb-6">
                                <div class="quote-mark">"</div>
                                <h3 class="font-heading text-2xl md:text-3xl font-bold text-primary mb-2">
                                    Schools Development
                                </h3>
                                <p class="text-lg text-gray-600 italic mb-4">
                                    "Education is the movement from darkness to light."
                                </p>
                            </div>
                            <p class="text-gray-700 text-lg leading-relaxed">
                                Education is a right for all. We ensure quality education through infrastructure, materials, and teacher support programs.
                            </p>
                            <div class="mt-6 flex items-center text-accent">
                                <i class="fas fa-graduation-cap text-xl mr-3"></i>
                                <span class="font-semibold">Quality education for every child</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 4: Sports Development -->
            <div class="slide">
                <div class="container mx-auto px-4">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        <!-- Content on top for slide 4 -->
                        <div class="order-1 lg:order-2 slide-content">
                            <div class="relative mb-6">
                                <div class="quote-mark">"</div>
                                <h3 class="font-heading text-2xl md:text-3xl font-bold text-primary mb-2">
                                    Sports
                                </h3>
                                <p class="text-lg text-gray-600 italic mb-4">
                                    "Opportunities don't happen, you create them."
                                </p>
                            </div>
                            <p class="text-gray-700 text-lg leading-relaxed">
                                Through the Harold Mbati Champions Cup, we use sports to create social change, foster teamwork, and nurture sporting talent.
                            </p>
                            <div class="mt-6 flex items-center text-accent">
                                <i class="fas fa-futbol text-xl mr-3"></i>
                                <span class="font-semibold">Harold Mbati Champions Cup</span>
                            </div>
                        </div>
                        <!-- Image on bottom for slide 4 -->
                        <div class="order-2 lg:order-1">
                            <img src="sports.jpg"
                                 alt="Sports Development" class="slide-image">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 5: Mother and Child Care -->
            <div class="slide">
                <div class="container mx-auto px-4">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        <!-- Image on left for slide 5 -->
                        <div class="order-1 lg:order-1">
                            <img src="mother.jpg"
                                 alt="Mother and Child Care" class="slide-image">
                        </div>
                        <!-- Content on right for slide 5 -->
                        <div class="order-2 lg:order-2 slide-content">
                            <div class="relative mb-6">
                                <div class="quote-mark">"</div>
                                <h3 class="font-heading text-2xl md:text-3xl font-bold text-primary mb-2">
                                    Mother and Child Care
                                </h3>
                                <p class="text-lg text-gray-600 italic mb-4">
                                    "A healthy mother, a healthy child, a healthy future."
                                </p>
                            </div>
                            <p class="text-gray-700 text-lg leading-relaxed">
                                We focus on maternal health, child nutrition, and family wellness through prenatal care, checkups, immunizations, and nutrition education.
                            </p>
                            <div class="mt-6 flex items-center text-accent">
                                <i class="fas fa-heartbeat text-xl mr-3"></i>
                                <span class="font-semibold">Nurturing healthy families</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide Indicators -->
        <div class="slide-indicators">
            <div class="indicator active" onclick="goToSlide(0)"></div>
            <div class="indicator" onclick="goToSlide(1)"></div>
            <div class="indicator" onclick="goToSlide(2)"></div>
            <div class="indicator" onclick="goToSlide(3)"></div>
            <div class="indicator" onclick="goToSlide(4)"></div>
        </div>

        <!-- Programs Description -->
        <div class="text-center mt-12">
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                Each program is designed to address specific community needs while creating sustainable, long-term impact.
            </p>
        </div>

        <!-- Mission and Vision -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
            <div class="bg-slate-800/10 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/20 text-center">
                <div class="w-16 h-16 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-eye text-2xl text-accent"></i>
                </div>
                <h3 class="font-heading text-xl font-bold text-primary mb-3">Vision</h3>
                <p class="text-gray-700">Promoting an enhanced socio-economic environment where everyone can thrive</p>
            </div>
            <div class="bg-slate-800/10 backdrop-blur-sm rounded-2xl p-6 border border-slate-700/20 text-center">
                <div class="w-16 h-16 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bullseye text-2xl text-accent"></i>
                </div>
                <h3 class="font-heading text-xl font-bold text-primary mb-3">Mission</h3>
                <p class="text-gray-700">To impact the livelihoods of the people of Luanda Constituency towards self-reliance</p>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-12">
            <a href="index.php?page=work"
               class="inline-flex items-center px-8 py-4 rounded-full bg-primary text-white font-medium text-lg hover:bg-primary/90 transition-all duration-300 group">
                <span>Explore All Our Programs</span>
                <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
            </a>
        </div>
    </div>
</section>

<!-- Be Part of the Great Vision Section -->
<section id="be-part-vision" class="hmf-involvement-section">
    <div class="hmf-container">
        <!-- Section Header -->
        <div class="hmf-section-header">
            <div class="hmf-section-badge">
                <span>GET INVOLVED</span>
            </div>
            <h2 class="hmf-section-title">
                Be Part of the <span class="hmf-highlight">Great Vision</span>
            </h2>
            <p class="hmf-section-subtitle">
                There are numerous ways you can help HMF bring change in the society in a meaningful way.
                Financial contribution, volunteering your time and donations are all welcomed.
            </p>
        </div>

        <!-- Cards Grid -->
        <div class="hmf-cards-grid">
            <!-- Card 1: Volunteering -->
            <div class="hmf-card hmf-card-volunteer">
                <div class="hmf-card-icon">
                    <i class="fas fa-hands-helping"></i>
                </div>

                <h3 class="hmf-card-title">Volunteering</h3>

                <p class="hmf-card-description">
                    We are glad to invite you to partner with us through your time and service
                </p>

                <div class="hmf-card-hashtag">
                    <span>#WeValueYourSacrifice</span>
                </div>

                <a href="index.php?page=connect" class="hmf-card-button hmf-btn-volunteer">
                    <span>Reach Us Out</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Card 2: Donations -->
            <div class="hmf-card hmf-card-donation">
                <div class="hmf-card-icon">
                    <i class="fas fa-heart"></i>
                </div>

                <h3 class="hmf-card-title">Donations</h3>

                <p class="hmf-card-description">
                    Through your contributions, you make the programs run swiftly
                </p>

                <div class="hmf-card-hashtag">
                    <span>#FeelGreatlyAppreciated</span>
                </div>

                <a href="index.php?page=donate" class="hmf-card-button hmf-btn-donation">
                    <span>Make a Donation</span>
                    <i class="fas fa-gift"></i>
                </a>
            </div>

            <!-- Card 3: Your Contributions -->
            <div class="hmf-card hmf-card-contribution">
                <div class="hmf-card-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>

                <h3 class="hmf-card-title">Your Contributions</h3>

                <p class="hmf-card-description">
                    HMF is glad and willing to hear from you. Share your insights on how to improve our reach
                </p>

                <div class="hmf-card-hashtag">
                    <span>#YourOpinionIsValued</span>
                </div>

                <a href="index.php?page=connect" class="hmf-card-button hmf-btn-contribution">
                    <span>Share Your Idea</span>
                    <i class="fas fa-comment"></i>
                </a>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="hmf-section-footer">
            <div class="hmf-features-list">
                <div class="hmf-feature">
                    <i class="fas fa-check-circle"></i>
                    <span>Transparent Process</span>
                </div>
                <div class="hmf-feature-divider"></div>
                <div class="hmf-feature">
                    <i class="fas fa-check-circle"></i>
                    <span>Direct Impact</span>
                </div>
                <div class="hmf-feature-divider"></div>
                <div class="hmf-feature">
                    <i class="fas fa-check-circle"></i>
                    <span>Community Focused</span>
                </div>
            </div>

            <p class="hmf-inspiration-quote">
                "Every contribution, no matter how small, helps us move closer to our vision of empowered communities."
            </p>
        </div>
    </div>
</section>

<!-- Contact Modal -->
<div id="hmf-contact-modal" class="hmf-modal">
    <div class="hmf-modal-overlay"></div>
    <div class="hmf-modal-container">
        <div class="hmf-modal-content">
            <div class="hmf-modal-header">
                <div>
                    <h3 class="hmf-modal-title">Get In Touch</h3>
                    <p class="hmf-modal-subtitle">We'd love to hear from you</p>
                </div>
                <button class="hmf-modal-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="hmf-contact-form" class="hmf-modal-form">
                <div class="hmf-form-group">
                    <label for="hmf-contact-name" class="hmf-form-label">Full Name *</label>
                    <input type="text" id="hmf-contact-name" required
                           class="hmf-form-input"
                           placeholder="John Doe">
                </div>

                <div class="hmf-form-group">
                    <label for="hmf-contact-email" class="hmf-form-label">Email Address *</label>
                    <input type="email" id="hmf-contact-email" required
                           class="hmf-form-input"
                           placeholder="john@example.com">
                </div>

                <div class="hmf-form-group">
                    <label for="hmf-contact-message" class="hmf-form-label">Your Message *</label>
                    <textarea id="hmf-contact-message" rows="4" required
                              class="hmf-form-textarea"
                              placeholder="Share your thoughts, ideas, or how you'd like to get involved..."></textarea>
                </div>

                <div class="hmf-form-submit">
                    <button type="submit" class="hmf-submit-button">
                        <span>Send Message</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                    <p class="hmf-form-note">
                        We'll get back to you as soon as possible
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>


<style>
/* Hero animations */
@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
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

@keyframes pulse-glow {
    0%, 100% { box-shadow: 0 0 20px rgba(245, 158, 11, 0.4); }
    50% { box-shadow: 0 0 40px rgba(245, 158, 11, 0.7); }
}

.hero-overlay {
    background: linear-gradient(90deg, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.7) 30%, rgba(15, 23, 42, 0.4) 100%);
}

.hero-btn {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.hero-btn:hover {
    transform: translateY(-3px);
    animation: pulse-glow 1.5s infinite;
}

.hero-btn::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: all 0.6s;
}

.hero-btn:hover::after {
    left: 100%;
}

.text-accent-italic {
    font-style: italic;
    color: #f59e0b;
    font-weight: 500;
}

.animate-fade-in-left {
    animation: fadeInLeft 1s ease-out forwards;
}

.animate-fade-in {
    animation: fadeIn 1.5s ease-out forwards;
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

.stats-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.15);
    border-color: rgba(245, 158, 11, 0.5);
}

.scroll-indicator {
    width: 30px;
    height: 50px;
    border: 2px solid rgba(245, 158, 11, 0.7);
    border-radius: 15px;
    position: relative;
}

.scroll-indicator::before {
    content: '';
    position: absolute;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
    width: 4px;
    height: 12px;
    background: #f59e0b;
    border-radius: 2px;
    animation: scroll 2s infinite;
}

@keyframes scroll {
    0% { transform: translateX(-50%) translateY(0); opacity: 1; }
    100% { transform: translateX(-50%) translateY(20px); opacity: 0; }
}

/* What We Do Slideshow Styles */
.slideshow-container {
    position: relative;
    overflow: hidden;
    height: 500px;
}

.slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    transform: translateX(100%);
    transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
}

.slide.active {
    transform: translateX(0);
}

.slide.next {
    transform: translateX(100%);
}

.slide-image {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    height: 400px;
    width: 100%;
    object-fit: cover;
}

.slide-content {
    padding: 2rem;
}

.quote-mark {
    font-size: 4rem;
    line-height: 1;
    color: rgba(245, 158, 11, 0.3);
    font-family: serif;
    position: absolute;
    top: -30px;
    left: -10px;
}

.slide-indicators {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 2rem;
}

.indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #e5e7eb;
    cursor: pointer;
    transition: all 0.3s ease;
}

.indicator.active {
    background-color: #f59e0b;
    transform: scale(1.2);
}

.nav-button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: transparent;
    border: 2px solid rgba(245, 158, 11, 0.7);
    color: #f59e0b;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 20;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.nav-button:hover {
    background: rgba(245, 158, 11, 0.1);
    transform: translateY(-50%) scale(1.1);
    border-color: #f59e0b;
}

.nav-button.prev {
    left: 20px;
}

.nav-button.next {
    right: 20px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    /* Hero section mobile adjustments */
    .hero-heading {
        font-size: 2rem !important;
        line-height: 1.2 !important;
    }

    .hero-subtitle {
        font-size: 1rem !important;
        line-height: 1.5 !important;
        max-width: 90% !important;
    }

    .hero-stats .text-2xl {
        font-size: 1.5rem !important;
    }

    .hero-stats .text-sm {
        font-size: 0.75rem !important;
    }

    /* Slideshow mobile adjustments */
    .slide {
        align-items: flex-start;
    }

    .slide-image {
        height: 180px;
        margin-bottom: 1rem;
    }

    .slide-content {
        padding: 0.25rem;
    }

    .slide-content h3 {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    .slide-content p {
        font-size: 1rem;
        line-height: 1.5;
    }

    .slide-content .relative {
        margin-bottom: 1rem;
    }

    .slide-content .mb-4 {
        margin-bottom: 0.5rem;
    }

    .slide-content .mt-6 {
        margin-top: 0.5rem;
    }

    .quote-mark {
        display: none;
    }

    .nav-button {
        width: 40px;
        height: 40px;
    }

    .nav-button.prev {
        left: 10px;
    }

    .nav-button.next {
        right: 10px;
    }
}

/* Section spacing fix */
section + section {
    margin-top: 0;
}

.section-header {
    position: relative;
    margin-bottom: 3rem;
}

.section-header::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 0;
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, #f59e0b, #d97706);
    border-radius: 2px;
}

/* Unique CSS for HMF Involvement Section */
.hmf-involvement-section {
    width: 100%;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    padding: 5rem 1rem;
    position: relative;
    overflow: hidden;
}

.hmf-involvement-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, #f59e0b, transparent);
}

.hmf-container {
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

/* Section Header Styles */
.hmf-section-header {
    text-align: center;
    margin-bottom: 4rem;
    animation: hmf-fade-up 0.8s ease-out;
}

.hmf-section-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1.5rem;
    border-radius: 2rem;
    background: rgba(245, 158, 11, 0.1);
    border: 1px solid rgba(245, 158, 11, 0.3);
    margin-bottom: 1.5rem;
}

.hmf-section-badge span {
    font-size: 0.875rem;
    font-weight: 600;
    color: #f59e0b;
    letter-spacing: 0.05em;
}

.hmf-section-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 2.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.hmf-highlight {
    color: #f59e0b;
}

.hmf-section-subtitle {
    font-size: 1.25rem;
    color: #cbd5e1;
    max-width: 48rem;
    margin: 0 auto;
    line-height: 1.6;
    font-style: italic;
}

/* Cards Grid Styles */
.hmf-cards-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 2rem;
    margin-bottom: 3rem;
}

@media (min-width: 768px) {
    .hmf-cards-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

/* Card Styles */
.hmf-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 1.5rem;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    opacity: 0;
    transform: translateY(30px);
}

.hmf-card:hover {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(245, 158, 11, 0.3);
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.hmf-card-icon {
    width: 5rem;
    height: 5rem;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.2), rgba(245, 158, 11, 0.1));
    border-radius: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.hmf-card:hover .hmf-card-icon {
    transform: scale(1.1) rotate(5deg);
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.3), rgba(245, 158, 11, 0.2));
}

.hmf-card-icon i {
    font-size: 2rem;
    color: #f59e0b;
}

.hmf-card-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.5rem;
    font-weight: 600;
    color: white;
    margin-bottom: 1rem;
}

.hmf-card-description {
    color: #cbd5e1;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    font-size: 1rem;
}

.hmf-card-hashtag {
    margin-bottom: 1.5rem;
}

.hmf-card-hashtag span {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
    border-radius: 1rem;
    font-size: 0.875rem;
    font-weight: 600;
}

.hmf-card-button {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 1rem;
    border-radius: 1rem;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    text-decoration: none;
    border: none;
    cursor: pointer;
}

.hmf-btn-volunteer, .hmf-btn-contribution {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
}

.hmf-btn-volunteer:hover, .hmf-btn-contribution:hover {
    background: linear-gradient(135deg, #d97706, #b45309);
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(245, 158, 11, 0.2);
}

.hmf-btn-donation {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.hmf-btn-donation:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: #f59e0b;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.hmf-card-button i {
    margin-left: 0.5rem;
    transition: transform 0.3s ease;
}

.hmf-btn-volunteer:hover i, .hmf-btn-contribution:hover i {
    transform: translateX(3px);
}

.hmf-btn-donation:hover i {
    transform: scale(1.1);
}

/* Section Footer */
.hmf-section-footer {
    text-align: center;
    animation: hmf-fade-up 0.8s ease-out 0.4s forwards;
    opacity: 0;
}

.hmf-features-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
}

.hmf-feature {
    display: flex;
    align-items: center;
    color: #cbd5e1;
    font-size: 0.875rem;
}

.hmf-feature i {
    color: #f59e0b;
    margin-right: 0.5rem;
}

.hmf-feature-divider {
    width: 4px;
    height: 4px;
    background: #475569;
    border-radius: 50%;
}

.hmf-inspiration-quote {
    font-size: 1.125rem;
    color: #cbd5e1;
    font-style: italic;
    max-width: 36rem;
    margin: 0 auto;
    line-height: 1.6;
}

/* Modal Styles */
.hmf-modal {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.hmf-modal.show {
    display: flex;
    animation: hmf-modal-fade-in 0.3s ease-out;
}

.hmf-modal-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(4px);
}

.hmf-modal-container {
    position: relative;
    width: 100%;
    max-width: 32rem;
    max-height: 90vh;
    overflow-y: auto;
    animation: hmf-modal-slide-up 0.3s ease-out;
}

.hmf-modal-content {
    background: white;
    border-radius: 1.5rem;
    padding: 2rem;
    position: relative;
}

.hmf-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 2rem;
}

.hmf-modal-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.5rem;
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 0.25rem;
}

.hmf-modal-subtitle {
    color: #64748b;
    font-size: 0.875rem;
}

.hmf-modal-close {
    background: none;
    border: none;
    color: #94a3b8;
    font-size: 1.25rem;
    cursor: pointer;
    padding: 0.5rem;
    transition: color 0.3s ease;
}

.hmf-modal-close:hover {
    color: #0f172a;
}

/* Form Styles */
.hmf-modal-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.hmf-form-group {
    display: flex;
    flex-direction: column;
}

.hmf-form-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #334155;
    margin-bottom: 0.5rem;
}

.hmf-form-input,
.hmf-form-select,
.hmf-form-textarea {
    padding: 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 0.75rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.hmf-form-input:focus,
.hmf-form-select:focus,
.hmf-form-textarea:focus {
    outline: none;
    border-color: #f59e0b;
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
}

.hmf-form-textarea {
    resize: vertical;
    min-height: 6rem;
}

.hmf-form-checkbox {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
}

.hmf-form-checkbox input[type="checkbox"] {
    margin-top: 0.25rem;
    accent-color: #f59e0b;
}

.hmf-form-checkbox label {
    font-size: 0.875rem;
    color: #64748b;
    line-height: 1.4;
}

.hmf-form-submit {
    padding-top: 1rem;
}

.hmf-submit-button {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
    border: none;
    border-radius: 1rem;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.hmf-submit-button:hover {
    background: linear-gradient(135deg, #d97706, #b45309);
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(245, 158, 11, 0.2);
}

.hmf-submit-button i {
    margin-left: 0.5rem;
    transition: transform 0.3s ease;
}

.hmf-submit-button:hover i {
    transform: translateX(3px);
}

.hmf-form-note {
    font-size: 0.75rem;
    color: #94a3b8;
    text-align: center;
    margin-top: 0.75rem;
}

/* Animations */
@keyframes hmf-fade-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes hmf-modal-fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes hmf-modal-slide-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Card animation delays */
.hmf-card:nth-child(1) { animation-delay: 0.1s; }
.hmf-card:nth-child(2) { animation-delay: 0.2s; }
.hmf-card:nth-child(3) { animation-delay: 0.3s; }

.hmf-card.animated {
    animation: hmf-fade-up 0.8s ease-out forwards;
}

/* Unique CSS for HMF Contact Section */
.hmf-contact-section {
    width: 100%;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    padding: 5rem 1rem;
    position: relative;
    overflow: hidden;
}

.hmf-contact-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, #f59e0b, transparent);
}

.hmf-contact-container {
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

/* Header Styles */
.hmf-contact-header {
    text-align: center;
    margin-bottom: 4rem;
    animation: hmf-contact-fade-up 0.8s ease-out;
}

.hmf-contact-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1.5rem;
    border-radius: 2rem;
    background: rgba(15, 23, 42, 0.1);
    border: 1px solid rgba(15, 23, 42, 0.2);
    margin-bottom: 1.5rem;
}

.hmf-contact-badge span {
    font-size: 0.875rem;
    font-weight: 600;
    color: #0f172a;
    letter-spacing: 0.05em;
}

.hmf-contact-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 3rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.hmf-contact-highlight {
    color: #f59e0b;
    position: relative;
    display: inline-block;
}

.hmf-contact-highlight::after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 0;
    width: 100%;
    height: 8px;
    background: rgba(245, 158, 11, 0.2);
    z-index: -1;
    border-radius: 4px;
}

.hmf-contact-subtitle {
    font-size: 1.25rem;
    color: #475569;
    max-width: 48rem;
    margin: 0 auto;
    line-height: 1.6;
}

/* Content Layout */
.hmf-contact-content {
    display: grid;
    grid-template-columns: 1fr;
    gap: 3rem;
    margin-bottom: 4rem;
}

@media (min-width: 992px) {
    .hmf-contact-content {
        grid-template-columns: 1fr 1fr;
    }
}

/* Contact Cards */
.hmf-contact-left {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.hmf-contact-card {
    background: white;
    border-radius: 1.5rem;
    padding: 2rem;
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    opacity: 0;
    transform: translateX(-30px);
}

.hmf-contact-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.1);
    border-color: #f59e0b;
}

.hmf-card-social:hover {
    background: linear-gradient(135deg, rgba(59, 89, 152, 0.05), white);
}

.hmf-card-phone:hover {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.05), white);
}

.hmf-card-email:hover {
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.05), white);
}

.hmf-contact-card-icon {
    position: absolute;
    top: 2rem;
    right: 2rem;
    width: 3.5rem;
    height: 3.5rem;
    border-radius: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    transition: all 0.3s ease;
}

.hmf-card-social .hmf-contact-card-icon {
    background: rgba(59, 89, 152, 0.1);
    color: #3b5998;
}

.hmf-card-phone .hmf-contact-card-icon {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
}

.hmf-card-email .hmf-contact-card-icon {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.hmf-contact-card:hover .hmf-contact-card-icon {
    transform: scale(1.1) rotate(5deg);
}

.hmf-contact-card-content {
    padding-right: 4rem;
}

.hmf-contact-card-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.5rem;
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 1rem;
}

.hmf-contact-card-description {
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    font-size: 0.95rem;
}

.hmf-contact-card-phone-number,
.hmf-contact-card-email-address {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
    padding: 0.75rem;
    background: #f8fafc;
    border-radius: 0.75rem;
    border: 1px solid #e2e8f0;
}

.hmf-contact-card-phone-number i,
.hmf-contact-card-email-address i {
    color: #f59e0b;
    font-size: 1.1rem;
}

.hmf-contact-card-phone-number span,
.hmf-contact-card-email-address span {
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    color: #0f172a;
    font-size: 1.1rem;
}

.hmf-contact-card-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 1.5rem;
    border-radius: 0.75rem;
    font-weight: 600;
    font-size: 0.95rem;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.hmf-card-social .hmf-contact-card-button {
    background: #3b5998;
    color: white;
}

.hmf-card-phone .hmf-contact-card-button {
    background: #10b981;
    color: white;
}

.hmf-card-email .hmf-contact-card-button {
    background: #f59e0b;
    color: white;
}

.hmf-contact-card-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.hmf-contact-card-button i {
    transition: transform 0.3s ease;
}

.hmf-contact-card-button:hover i {
    transform: translateX(3px);
}

/* Card Decorations */
.hmf-contact-card-decoration {
    position: absolute;
    inset: 0;
    pointer-events: none;
    overflow: hidden;
    border-radius: 1.5rem;
}

.hmf-deco-circle {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(135deg, transparent, rgba(245, 158, 11, 0.1));
    opacity: 0;
    transition: all 0.6s ease;
}

.hmf-contact-card:hover .hmf-deco-circle {
    opacity: 1;
}

.hmf-deco-1 {
    width: 80px;
    height: 80px;
    top: -20px;
    left: -20px;
}

.hmf-deco-2 {
    width: 60px;
    height: 60px;
    bottom: -10px;
    right: 30px;
}

.hmf-deco-3 {
    width: 100px;
    height: 100px;
    top: 50%;
    left: -30px;
}

.hmf-deco-4 {
    width: 70px;
    height: 70px;
    bottom: 20px;
    right: -15px;
}

.hmf-deco-5 {
    width: 90px;
    height: 90px;
    top: -15px;
    right: -15px;
}

.hmf-deco-6 {
    width: 50px;
    height: 50px;
    bottom: -10px;
    left: 20px;
}

/* Image Container */
.hmf-contact-right {
    display: flex;
    align-items: center;
    justify-content: center;
}

.hmf-contact-image-container {
    position: relative;
    width: 100%;
    max-width: 500px;
}

.hmf-contact-image-wrapper {
    position: relative;
    border-radius: 1.5rem;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15);
    transform: perspective(1000px) rotateY(-5deg);
    transition: all 0.5s ease;
}

.hmf-contact-image-wrapper:hover {
    transform: perspective(1000px) rotateY(0deg);
    box-shadow: 0 30px 60px rgba(15, 23, 42, 0.2);
}

.hmf-contact-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.hmf-contact-image-wrapper:hover .hmf-contact-image {
    transform: scale(1.05);
}

.hmf-image-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(15, 23, 42, 0.9) 0%, transparent 50%);
}

.hmf-image-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 2rem;
    color: white;
    z-index: 2;
}

.hmf-image-icon {
    width: 3.5rem;
    height: 3.5rem;
    background: rgba(245, 158, 11, 0.2);
    border-radius: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    font-size: 1.5rem;
    color: #f59e0b;
}

.hmf-image-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.hmf-image-text {
    font-size: 0.95rem;
    color: #cbd5e1;
    line-height: 1.5;
}

/* Floating Elements */
.hmf-floating-element {
    position: absolute;
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    animation: hmf-float 3s ease-in-out infinite;
    z-index: 3;
}

.hmf-float-1 {
    top: -1.5rem;
    left: -1.5rem;
    background: white;
    color: #3b5998;
    box-shadow: 0 10px 20px rgba(59, 89, 152, 0.15);
    animation-delay: 0s;
}

.hmf-float-2 {
    top: 50%;
    right: -1.5rem;
    background: white;
    color: #10b981;
    box-shadow: 0 10px 20px rgba(16, 185, 129, 0.15);
    animation-delay: 0.5s;
}

.hmf-float-3 {
    bottom: -1.5rem;
    left: 30%;
    background: white;
    color: #f59e0b;
    box-shadow: 0 10px 20px rgba(245, 158, 11, 0.15);
    animation-delay: 1s;
}

/* Contact Footer */
.hmf-contact-footer {
    text-align: center;
    animation: hmf-contact-fade-up 0.8s ease-out 0.4s forwards;
    opacity: 0;
}

.hmf-contact-hours {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 1.5rem;
    margin-bottom: 2.5rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

@media (min-width: 640px) {
    .hmf-contact-hours {
        grid-template-columns: repeat(3, 1fr);
    }
}

.hmf-hour-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    background: white;
    border-radius: 1rem;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.hmf-hour-card:hover {
    border-color: #f59e0b;
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
}

.hmf-hour-card i {
    font-size: 1.5rem;
    color: #f59e0b;
}

.hmf-hour-card h4 {
    font-family: 'Montserrat', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 0.25rem;
}

.hmf-hour-card p {
    font-size: 0.875rem;
    color: #64748b;
}

.hmf-contact-cta {
    font-size: 1.125rem;
    color: #475569;
    font-style: italic;
    max-width: 36rem;
    margin: 0 auto;
    line-height: 1.6;
    padding: 1.5rem;
    background: rgba(245, 158, 11, 0.05);
    border-radius: 1rem;
    border-left: 4px solid #f59e0b;
}

/* Animations */
@keyframes hmf-contact-fade-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes hmf-float {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-15px) rotate(5deg);
    }
}

/* Card animation delays */
.hmf-contact-card:nth-child(1) { animation-delay: 0.1s; }
.hmf-contact-card:nth-child(2) { animation-delay: 0.2s; }
.hmf-contact-card:nth-child(3) { animation-delay: 0.3s; }

.hmf-contact-card.animated {
    animation: hmf-contact-fade-left 0.8s ease-out forwards;
}

@keyframes hmf-contact-fade-left {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}
</style>

<script>
// Unique JavaScript for HMF Involvement Section

document.addEventListener('DOMContentLoaded', function() {
    const section = document.getElementById('be-part-vision');
    if (!section) return;

    // Initialize modals first
    initModals();

    // Initialize animations
    initAnimations();

    // Initialize event listeners
    initEventListeners();

    // Initialize forms
    initForms();
});

function initAnimations() {
    // Animate cards on scroll
    const cards = document.querySelectorAll('.hmf-card');
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
            }
        });
    }, observerOptions);

    cards.forEach(card => {
        observer.observe(card);
    });
}

function initEventListeners() {
    // Volunteer button - now links to connect page
    // const volunteerBtn = document.querySelector('.hmf-btn-volunteer');
    // if (volunteerBtn) {
    //     volunteerBtn.addEventListener('click', openContactModal);
    // }

    // Contribution button - now links to connect page
    // const contributionBtn = document.querySelector('.hmf-btn-contribution');
    // if (contributionBtn) {
    //     contributionBtn.addEventListener('click', openContactModal);
    // }

    // Modal close buttons
    document.querySelectorAll('.hmf-modal-close').forEach(btn => {
        btn.addEventListener('click', function() {
            const modal = this.closest('.hmf-modal');
            closeModal(modal);
        });
    });

    // Close modal when clicking overlay
    document.querySelectorAll('.hmf-modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', function() {
            const modal = this.closest('.hmf-modal');
            closeModal(modal);
        });
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const openModal = document.querySelector('.hmf-modal.show');
            if (openModal) {
                closeModal(openModal);
            }
        }
    });
}

function initModals() {
    // Modal open functions
    window.openContactModal = function() {
        const modal = document.getElementById('hmf-contact-modal');
        if (modal) {
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
    };

    window.closeModal = function(modal) {
        if (modal) {
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }
    };
}

function initForms() {
    // Contact form submission
    const contactForm = document.getElementById('hmf-contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form values
            const name = document.getElementById('hmf-contact-name').value;
            const email = document.getElementById('hmf-contact-email').value;

            // Show success message
            alert(`Thank you ${name}! Your message has been sent. We'll contact you at ${email} soon.`);

            // Close modal
            const modal = document.getElementById('hmf-contact-modal');
            if (modal) {
                closeModal(modal);
            }

            // Reset form
            this.reset();
        });
    }
}
</script>

<script>
// Unique JavaScript for HMF Contact Section
(function() {
    'use strict';

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        const section = document.getElementById('hmf-get-in-touch');
        if (!section) return;

        // Initialize animations
        initContactAnimations();

        // Initialize hover effects
        initHoverEffects();
    });

    function initContactAnimations() {
        // Animate cards on scroll
        const cards = document.querySelectorAll('.hmf-contact-card');
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    animateFloatingElements();
                }
            });
        }, observerOptions);

        cards.forEach(card => {
            observer.observe(card);
        });

        // Animate footer on scroll
        const footer = document.querySelector('.hmf-contact-footer');
        if (footer) {
            const footerObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        animateHourCards();
                    }
                });
            }, observerOptions);

            footerObserver.observe(footer);
        }
    }

    function initHoverEffects() {
        // Add hover sound effect simulation
        const cards = document.querySelectorAll('.hmf-contact-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                // Add ripple effect
                const ripple = document.createElement('div');
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(245, 158, 11, 0.1)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                ripple.style.pointerEvents = 'none';

                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = (rect.width / 2 - size / 2) + 'px';
                ripple.style.top = (rect.height / 2 - size / 2) + 'px';

                this.appendChild(ripple);

                // Remove ripple after animation
                setTimeout(() => {
                    if (ripple.parentNode === this) {
                        this.removeChild(ripple);
                    }
                }, 600);
            });
        });
    }

    function animateFloatingElements() {
        const floaters = document.querySelectorAll('.hmf-floating-element');
        floaters.forEach((floater, index) => {
            floater.style.animation = `hmf-float 3s ease-in-out ${index * 0.5}s infinite`;
        });
    }

    function animateHourCards() {
        const hourCards = document.querySelectorAll('.hmf-hour-card');
        hourCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.style.animation = 'hmf-contact-fade-up 0.6s ease-out forwards';
            card.style.opacity = '0';

            setTimeout(() => {
                card.style.opacity = '1';
            }, index * 100);
        });
    }

    // Add ripple animation to CSS
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
})();
</script>

<!-- JavaScript for Slideshow -->
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const indicators = document.querySelectorAll('.indicator');
    const totalSlides = slides.length;

    // Initialize slideshow
    function initSlideshow() {
        // Set initial positions
        slides.forEach((slide, index) => {
            if (index === 0) {
                slide.classList.add('active');
            } else if (index === 1) {
                slide.classList.add('next');
            }
        });

        // Auto slide every 8 seconds
        setInterval(() => {
            nextSlide();
        }, 8000);
    }

    // Go to specific slide
    function goToSlide(n) {
        // Reset all slides
        slides.forEach((slide, index) => {
            slide.classList.remove('active', 'next');

            if (index === n) {
                slide.classList.add('active');
            } else if (index === (n + 1) % totalSlides) {
                slide.classList.add('next');
            }
        });

        // Update indicators
        indicators.forEach((indicator, index) => {
            if (index === n) {
                indicator.classList.add('active');
            } else {
                indicator.classList.remove('active');
            }
        });

        currentSlide = n;
    }

    // Next slide
    function nextSlide() {
        const nextIndex = (currentSlide + 1) % totalSlides;
        goToSlide(nextIndex);
    }

    // Previous slide
    function prevSlide() {
        const prevIndex = (currentSlide - 1 + totalSlides) % totalSlides;
        goToSlide(prevIndex);
    }

    // Initialize on load
    document.addEventListener('DOMContentLoaded', function() {
        initSlideshow();

        // Smooth scroll for "Discover Our Programs" button
        document.querySelector('a[href="#what-we-do"]')?.addEventListener('click', function(e) {
            e.preventDefault();
            const section = document.getElementById('what-we-do');
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script>