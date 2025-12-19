<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities & Projects | Harold Mbati Foundation</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary: #0f172a;
            --secondary: #1e293b;
            --accent: #f59e0b;
            --light: #f8fafc;
            --dark: #0a0f1e;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #1e293b;
            overflow-x: hidden;
        }

        /* Custom Font Classes */
        .font-display {
            font-family: 'Playfair Display', serif;
        }

        .font-heading {
            font-family: 'Space Grotesk', sans-serif;
        }

        .font-body {
            font-family: 'Inter', sans-serif;
        }

        /* Hero Background */
        .hero-bg {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(15, 23, 42, 0.85) 100%),
                        url('https://images.unsplash.com/photo-1542744095-fcf48d80b0fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }

        .activities-bg {
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
        }

        .impact-bg {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(30, 64, 175, 0.85) 100%),
                        url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }

        /* Activity Cards */
        .activity-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .activity-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.7s;
        }

        .activity-card:hover::before {
            left: 100%;
        }

        .activity-card:hover {
            transform: translateY(-8px);
            border-color: var(--accent);
            box-shadow: 0 20px 40px rgba(245, 158, 11, 0.1);
        }

        /* Status Badges */
        .status-completed {
            background: linear-gradient(135deg, #10b981, #34d399);
            color: white;
        }

        .status-ongoing {
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
            color: white;
        }

        .status-upcoming {
            background: linear-gradient(135deg, #f59e0b, #fbbf24);
            color: white;
        }

        .status-planning {
            background: linear-gradient(135deg, #8b5cf6, #a78bfa);
            color: white;
        }

        /* Glass Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .modal-content {
            background: white;
            border-radius: 1.5rem;
            max-width: 800px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalSlideIn 0.4s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Success Stories Carousel */
        .carousel-container {
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem;
        }

        .carousel-slide {
            display: none;
            animation: fadeIn 0.8s ease-out;
        }

        .carousel-slide.active {
            display: block;
        }

        .carousel-dots {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }

        .carousel-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-dot.active {
            background: var(--accent);
            transform: scale(1.2);
        }

        /* Filter Buttons */
        .filter-btn {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .filter-btn::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: var(--accent);
            transition: width 0.3s ease;
        }

        .filter-btn.active::after {
            width: 100%;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #f59e0b, #1e40af);
            border-radius: 4px;
        }

        /* Text Gradient */
        .text-gradient {
            background: linear-gradient(135deg, #f59e0b, #1e40af);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Pulse Animation */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .pulse {
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body class="font-body">

    <!-- Activities & Projects Page Content -->
    <div class="min-h-screen">

        <!-- Hero Section -->
        <section class="hero-bg min-h-[60vh] flex items-center relative overflow-hidden pt-24">
            <div class="container mx-auto px-4 relative z-10">
                <div class="max-w-4xl">
                    <div class="inline-flex items-center gap-2 px-4 py-2 glass-card rounded-full mb-6">
                        <div class="w-2 h-2 bg-accent rounded-full"></div>
                        <span class="text-white/90 font-heading text-sm tracking-wider">OUR WORK IN ACTION</span>
                    </div>

                    <h1 class="font-display text-5xl md:text-6xl font-bold text-white mb-6 leading-tight">
                        Activities & <span class="text-accent">Projects</span>
                    </h1>

                    <p class="text-xl text-white/80 mb-10 max-w-3xl leading-relaxed">
                        Explore our completed initiatives, ongoing projects, and planned activities. Each represents our commitment to sustainable community development across Luanda Constituency.
                    </p>

                    <div class="flex flex-wrap gap-4 mb-8">
                        <a href="#completed" class="px-6 py-3 bg-accent text-white font-heading font-medium rounded-full hover:bg-yellow-600 transition-all duration-300 transform hover:-translate-y-1 flex items-center gap-2">
                            <i class="fas fa-check-circle"></i>
                            <span>Completed</span>
                        </a>
                        <a href="#ongoing" class="px-6 py-3 glass-card text-white font-heading font-medium rounded-full hover:bg-white/10 transition-all duration-300 border border-white/20">
                            <i class="fas fa-spinner"></i>
                            <span>Ongoing</span>
                        </a>
                        <a href="#upcoming" class="px-6 py-3 glass-card text-white font-heading font-medium rounded-full hover:bg-white/10 transition-all duration-300 border border-white/20">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Upcoming</span>
                        </a>
                        <a href="#impact" class="px-6 py-3 glass-card text-white font-heading font-medium rounded-full hover:bg-white/10 transition-all duration-300 border border-white/20">
                            <i class="fas fa-chart-line"></i>
                            <span>Impact</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Activity Filter & Stats -->
        <section class="activities-bg py-12">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-6 mb-8">
                        <div>
                            <h2 class="font-heading text-2xl font-bold text-primary">Filter Activities</h2>
                            <p class="text-gray-600">Browse by program or status</p>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <button class="filter-btn px-4 py-2 bg-white text-gray-700 font-medium rounded-full border border-gray-300 hover:border-accent hover:text-accent active" data-filter="all">
                                All Activities
                            </button>
                            <button class="filter-btn px-4 py-2 bg-white text-gray-700 font-medium rounded-full border border-gray-300 hover:border-blue-500 hover:text-blue-600" data-filter="youth">
                                Youth Empowerment
                            </button>
                            <button class="filter-btn px-4 py-2 bg-white text-gray-700 font-medium rounded-full border border-gray-300 hover:border-pink-500 hover:text-pink-600" data-filter="mother">
                                Mother & Child
                            </button>
                            <button class="filter-btn px-4 py-2 bg-white text-gray-700 font-medium rounded-full border border-gray-300 hover:border-emerald-500 hover:text-emerald-600" data-filter="school">
                                School Development
                            </button>
                            <button class="filter-btn px-4 py-2 bg-white text-gray-700 font-medium rounded-full border border-gray-300 hover:border-amber-500 hover:text-amber-600" data-filter="sports">
                                Sports Development
                            </button>
                        </div>
                    </div>

                    <!-- Activity Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">
                        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
                            <div class="text-2xl font-bold text-primary mb-1" id="completed-count">0</div>
                            <div class="text-gray-600 text-sm">Completed Projects</div>
                        </div>
                        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
                            <div class="text-2xl font-bold text-blue-600 mb-1" id="ongoing-count">0</div>
                            <div class="text-gray-600 text-sm">Ongoing Activities</div>
                        </div>
                        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
                            <div class="text-2xl font-bold text-amber-600 mb-1" id="upcoming-count">0</div>
                            <div class="text-gray-600 text-sm">Upcoming Projects</div>
                        </div>
                        <div class="bg-white rounded-xl p-4 text-center shadow-sm">
                            <div class="text-2xl font-bold text-emerald-600 mb-1" id="total-beneficiaries">0</div>
                            <div class="text-gray-600 text-sm">Direct Beneficiaries</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Completed Projects -->
        <section id="completed" class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="flex items-center justify-between mb-10">
                        <div>
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-100 rounded-full mb-4">
                                <span class="font-heading text-emerald-700 font-medium text-sm tracking-wider">ACCOMPLISHMENTS</span>
                            </div>
                            <h2 class="font-display text-3xl md:text-4xl font-bold text-primary">
                                Completed <span class="text-gradient">Projects</span>
                            </h2>
                            <p class="text-gray-600 mt-2">Successfully implemented initiatives that have created lasting impact</p>
                        </div>
                        <div class="status-completed px-4 py-2 rounded-full text-sm font-medium">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span id="completed-badge-count">0</span> Projects
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="completed-activities">
                        <!-- Activity cards will be loaded here -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Ongoing Activities -->
        <section id="ongoing" class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="flex items-center justify-between mb-10">
                        <div>
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 rounded-full mb-4">
                                <span class="font-heading text-blue-700 font-medium text-sm tracking-wider">CURRENT WORK</span>
                            </div>
                            <h2 class="font-display text-3xl md:text-4xl font-bold text-primary">
                                Ongoing <span class="text-gradient">Activities</span>
                            </h2>
                            <p class="text-gray-600 mt-2">Projects currently being implemented across our focus areas</p>
                        </div>
                        <div class="status-ongoing px-4 py-2 rounded-full text-sm font-medium">
                            <i class="fas fa-spinner mr-2"></i>
                            <span id="ongoing-badge-count">0</span> Active Projects
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="ongoing-activities">
                        <!-- Activity cards will be loaded here -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Upcoming & Planned Activities -->
        <section id="upcoming" class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="flex items-center justify-between mb-10">
                        <div>
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-amber-100 rounded-full mb-4">
                                <span class="font-heading text-amber-700 font-medium text-sm tracking-wider">FUTURE PLANS</span>
                            </div>
                            <h2 class="font-display text-3xl md:text-4xl font-bold text-primary">
                                Upcoming & <span class="text-gradient">Planned</span>
                            </h2>
                            <p class="text-gray-600 mt-2">Activities scheduled for implementation in the coming months</p>
                        </div>
                        <div class="status-upcoming px-4 py-2 rounded-full text-sm font-medium">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span id="upcoming-badge-count">0</span> Planned Projects
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="upcoming-activities">
                        <!-- Activity cards will be loaded here -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Impact & Success Stories Carousel -->
        <section id="impact" class="impact-bg py-20">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-12">
                        <div class="inline-flex items-center gap-2 px-4 py-2 glass-card rounded-full mb-6">
                            <span class="text-white/90 font-heading text-sm tracking-wider">SUCCESS STORIES</span>
                        </div>
                        <h2 class="font-display text-4xl md:text-5xl font-bold text-white mb-6">
                            Impact <span class="text-accent">Stories</span>
                        </h2>
                        <p class="text-xl text-white/80 max-w-3xl mx-auto">
                            Real stories of transformation from beneficiaries of our programs
                        </p>
                    </div>

                    <!-- Success Stories Carousel -->
                    <div class="carousel-container" data-aos="fade-up">
                        <div class="carousel-slide active">
                            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 md:p-12">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                                    <div>
                                        <div class="w-24 h-24 rounded-full overflow-hidden mb-6 border-4 border-white/30">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsUM5GhwyaXQtkyWGbH3qyJpU4sUj0Ry1jsg&s"
                                                 alt="Kevin Bahati"
                                                 class="w-full h-full object-cover">
                                        </div>
                                        <h3 class="font-heading text-2xl font-bold text-white mb-4">From Trainee to Employer</h3>
                                        <p class="text-white/90 mb-6 leading-relaxed">
                                            "After completing the Youth Entrepreneurship Program, I started my own agribusiness. With the seed funding and mentorship from HMF, I now employ 5 other youth from my community. The foundation didn't just give me skills; they gave me hope and a sustainable livelihood."
                                        </p>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="font-heading font-bold text-white">Kevin Bahati</div>
                                                <div class="text-white/70 text-sm">Youth Entrepreneurship Program Graduate</div>
                                            </div>
                                            <span class="px-3 py-1 bg-accent/20 text-accent text-xs font-medium rounded-full">Youth Empowerment</span>
                                        </div>
                                    </div>
                                    <div class="bg-white/10 rounded-xl p-6">
                                        <h4 class="font-heading text-xl font-bold text-white mb-4">Impact Metrics</h4>
                                        <div class="space-y-4">
                                            <div>
                                                <div class="flex justify-between text-white mb-1">
                                                    <span>Business Growth</span>
                                                    <span>300%</span>
                                                </div>
                                                <div class="h-2 bg-white/20 rounded-full overflow-hidden">
                                                    <div class="h-full bg-accent rounded-full" style="width: 80%"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="flex justify-between text-white mb-1">
                                                    <span>Jobs Created</span>
                                                    <span>5</span>
                                                </div>
                                                <div class="h-2 bg-white/20 rounded-full overflow-hidden">
                                                    <div class="h-full bg-accent rounded-full" style="width: 100%"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="flex justify-between text-white mb-1">
                                                    <span>Community Impact</span>
                                                    <span>High</span>
                                                </div>
                                                <div class="h-2 bg-white/20 rounded-full overflow-hidden">
                                                    <div class="h-full bg-accent rounded-full" style="width: 90%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-slide">
                            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 md:p-12">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                                    <div>
                                        <div class="w-24 h-24 rounded-full overflow-hidden mb-6 border-4 border-white/30">
                                            <img src="https://www.shutterstock.com/image-photo/silhouette-mother-daughter-happy-love-260nw-1510762241.jpg"
                                                 alt="Grace Wanjiku"
                                                 class="w-full h-full object-cover">
                                        </div>
                                        <h3 class="font-heading text-2xl font-bold text-white mb-4">Healthy Mother, Healthy Child</h3>
                                        <p class="text-white/90 mb-6 leading-relaxed">
                                            "The maternal health workshops saved my life and my baby's. I learned about nutrition, prenatal care, and postnatal support. Today, my child is healthy and thriving, and I'm sharing what I learned with other mothers in my village. The mobile clinic visits have been a lifesaver for our remote community."
                                        </p>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="font-heading font-bold text-white">Grace Wanjiku</div>
                                                <div class="text-white/70 text-sm">Mother & Child Care Program Beneficiary</div>
                                            </div>
                                            <span class="px-3 py-1 bg-pink-500/30 text-pink-300 text-xs font-medium rounded-full">Mother & Child Care</span>
                                        </div>
                                    </div>
                                    <div class="bg-white/10 rounded-xl p-6">
                                        <h4 class="font-heading text-xl font-bold text-white mb-4">Health Outcomes</h4>
                                        <div class="space-y-4">
                                            <div>
                                                <div class="flex justify-between text-white mb-1">
                                                    <span>Prenatal Care Access</span>
                                                    <span>95%</span>
                                                </div>
                                                <div class="h-2 bg-white/20 rounded-full overflow-hidden">
                                                    <div class="h-full bg-pink-500 rounded-full" style="width: 95%"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="flex justify-between text-white mb-1">
                                                    <span>Child Vaccination Rate</span>
                                                    <span>88%</span>
                                                </div>
                                                <div class="h-2 bg-white/20 rounded-full overflow-hidden">
                                                    <div class="h-full bg-pink-500 rounded-full" style="width: 88%"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="flex justify-between text-white mb-1">
                                                    <span>Maternal Knowledge</span>
                                                    <span>92%</span>
                                                </div>
                                                <div class="h-2 bg-white/20 rounded-full overflow-hidden">
                                                    <div class="h-full bg-pink-500 rounded-full" style="width: 92%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-slide">
                            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 md:p-12">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                                    <div>
                                        <div class="w-24 h-24 rounded-full overflow-hidden mb-6 border-4 border-white/30">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHSktJwxQfPo4BHwPyBlRiDipRmF8nulqSCg&s"
                                                 alt="Samuel Wako"
                                                 class="w-full h-full object-cover">
                                        </div>
                                        <h3 class="font-heading text-2xl font-bold text-white mb-4">From Football Pitch to Academy</h3>
                                        <p class="text-white/90 mb-6 leading-relaxed">
                                            "Through the Harold Mbati Champions Cup, I was scouted by a regional football academy. The foundation provided not just a platform to showcase my talent, but also mentorship and support. Today, I'm pursuing my dream of becoming a professional footballer while continuing my education. Sports changed my life trajectory."
                                        </p>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="font-heading font-bold text-white">Samuel Wako</div>
                                                <div class="text-white/70 text-sm">Champions Cup Talent Scouted</div>
                                            </div>
                                            <span class="px-3 py-1 bg-amber-500/30 text-amber-300 text-xs font-medium rounded-full">Sports Development</span>
                                        </div>
                                    </div>
                                    <div class="bg-white/10 rounded-xl p-6">
                                        <h4 class="font-heading text-xl font-bold text-white mb-4">Sports Impact</h4>
                                        <div class="space-y-4">
                                            <div>
                                                <div class="flex justify-between text-white mb-1">
                                                    <span>Talent Identification</span>
                                                    <span>15 players</span>
                                                </div>
                                                <div class="h-2 bg-white/20 rounded-full overflow-hidden">
                                                    <div class="h-full bg-amber-500 rounded-full" style="width: 75%"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="flex justify-between text-white mb-1">
                                                    <span>Youth Participation</span>
                                                    <span>500+</span>
                                                </div>
                                                <div class="h-2 bg-white/20 rounded-full overflow-hidden">
                                                    <div class="h-full bg-amber-500 rounded-full" style="width: 100%"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="flex justify-between text-white mb-1">
                                                    <span>Academic Continuity</span>
                                                    <span>85%</span>
                                                </div>
                                                <div class="h-2 bg-white/20 rounded-full overflow-hidden">
                                                    <div class="h-full bg-amber-500 rounded-full" style="width: 85%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Carousel Navigation -->
                    <div class="carousel-dots mt-8">
                        <div class="carousel-dot active" data-slide="0"></div>
                        <div class="carousel-dot" data-slide="1"></div>
                        <div class="carousel-dot" data-slide="2"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <div class="bg-gradient-to-r from-accent/10 to-yellow-500/10 rounded-2xl p-8 md:p-12">
                        <h2 class="font-display text-3xl md:text-4xl font-bold text-primary mb-6">
                            Support Our <span class="text-gradient">Activities</span>
                        </h2>
                        <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                            Your contribution helps us implement more projects, reach more communities, and create sustainable impact. Join us in transforming lives.
                        </p>
                        <div class="flex flex-wrap gap-4 justify-center">
                            <button class="px-8 py-4 bg-accent text-white font-heading font-semibold rounded-full hover:bg-yellow-600 transition-all duration-300 transform hover:-translate-y-1 flex items-center gap-3 group">
                                <i class="fas fa-donate"></i>
                                <span>Donate to a Project</span>
                            </button>
                            <button class="px-8 py-4 bg-primary text-white font-heading font-semibold rounded-full hover:bg-slate-800 transition-all duration-300 border border-primary">
                                <i class="fas fa-handshake mr-2"></i>
                                Partner With Us
                            </button>
                            <button class="px-8 py-4 bg-white text-primary font-heading font-semibold rounded-full hover:bg-gray-50 transition-all duration-300 border border-gray-300">
                                <i class="fas fa-user-plus mr-2"></i>
                                Volunteer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- Activity Details Modal -->
    <div id="activityModal" class="modal-overlay">
        <div class="modal-content">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="font-heading text-3xl font-bold text-primary" id="modal-activity-title">Activity Details</h3>
                    <button onclick="closeActivityModal('activityModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-3xl"></i>
                    </button>
                </div>

                <div id="modal-activity-content">
                    <!-- Activity details will be loaded here -->
                    <div class="animate-pulse">
                        <div class="h-64 bg-gray-200 rounded-2xl mb-6"></div>
                        <div class="space-y-4">
                            <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                            <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                            <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS animations
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Activity filtering and loading
        document.addEventListener('DOMContentLoaded', function() {
            loadActivities();

            const filterButtons = document.querySelectorAll('.filter-btn');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');

                    const filterValue = this.getAttribute('data-filter');
                    filterActivities(filterValue);
                });
            });

            // Success Stories Carousel
            const slides = document.querySelectorAll('.carousel-slide');
            const dots = document.querySelectorAll('.carousel-dot');
            let currentSlide = 0;

            function showSlide(index) {
                // Hide all slides
                slides.forEach(slide => {
                    slide.classList.remove('active');
                });

                // Remove active class from all dots
                dots.forEach(dot => {
                    dot.classList.remove('active');
                });

                // Show selected slide and activate corresponding dot
                slides[index].classList.add('active');
                dots[index].classList.add('active');
                currentSlide = index;
            }

            // Add click events to dots
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    showSlide(index);
                });
            });

            // Auto-advance carousel every 5 seconds
            setInterval(() => {
                let nextSlide = currentSlide + 1;
                if (nextSlide >= slides.length) {
                    nextSlide = 0;
                }
                showSlide(nextSlide);
            }, 5000);

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
        });

        // Load activities from database
        function loadActivities() {
            fetch('gallery_handler.php?action=get_activities')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        renderActivities(data.activities);
                        updateStats(data.stats);
                    }
                })
                .catch(error => console.error('Error loading activities:', error));
        }

        // Render activities
        function renderActivities(activities) {
            const completedContainer = document.getElementById('completed-activities');
            const ongoingContainer = document.getElementById('ongoing-activities');
            const upcomingContainer = document.getElementById('upcoming-activities');

            completedContainer.innerHTML = '';
            ongoingContainer.innerHTML = '';
            upcomingContainer.innerHTML = '';

            activities.forEach(activity => {
                const card = createActivityCard(activity);
                const status = activity.status.toLowerCase();

                if (status === 'completed') {
                    completedContainer.appendChild(card);
                } else if (status === 'active' || status === 'ongoing') {
                    ongoingContainer.appendChild(card);
                } else if (status === 'upcoming' || status === 'draft') {
                    upcomingContainer.appendChild(card);
                }
            });
        }

        // Create activity card
        function createActivityCard(activity) {
            const card = document.createElement('div');
            card.className = 'activity-card bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100';
            card.setAttribute('data-aos', 'fade-up');
            card.setAttribute('data-category', getCategorySlug(activity.category_name));
            card.setAttribute('data-status', activity.status.toLowerCase());

            const statusClass = getStatusClass(activity.status);
            const categoryBadge = getCategoryBadge(activity.category_name);

            card.innerHTML = `
                <div class="h-36 overflow-hidden">
                    <img src="${activity.image || 'https://images.unsplash.com/photo-1542744095-fcf48d80b0fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'}"
                         alt="${activity.title}"
                         class="w-full h-full object-cover hover:scale-110 transition-transform duration-700">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <span class="status-${activity.status.toLowerCase()} px-3 py-1 rounded-full text-xs font-medium">${activity.status}</span>
                        <span class="text-gray-500 text-sm">${formatDate(activity.start_date)}</span>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-primary mb-3">${activity.title}</h3>
                    <p class="text-gray-600 text-sm mb-6 line-clamp-3">
                        ${activity.description || 'No description available'}
                    </p>
                    <div class="flex items-center justify-between">
                        ${categoryBadge}
                        <button onclick="openActivityModal('${activity.id}')" class="text-accent font-medium text-sm flex items-center gap-1 group">
                            <span>View Details</span>
                            <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </div>
            `;

            return card;
        }

        // Update stats
        function updateStats(stats) {
            document.getElementById('completed-count').textContent = stats.completed || 0;
            document.getElementById('ongoing-count').textContent = stats.ongoing || 0;
            document.getElementById('upcoming-count').textContent = stats.upcoming || 0;
            document.getElementById('total-beneficiaries').textContent = stats.beneficiaries || 0;

            document.getElementById('completed-badge-count').textContent = stats.completed || 0;
            document.getElementById('ongoing-badge-count').textContent = stats.ongoing || 0;
            document.getElementById('upcoming-badge-count').textContent = stats.upcoming || 0;
        }

        // Filter activities
        function filterActivities(filter) {
            const cards = document.querySelectorAll('.activity-card');

            cards.forEach(card => {
                if (filter === 'all') {
                    card.style.display = 'block';
                } else {
                    const category = card.getAttribute('data-category');
                    if (category === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        }

        // Helper functions
        function getStatusClass(status) {
            const statusMap = {
                'completed': 'completed',
                'active': 'ongoing',
                'ongoing': 'ongoing',
                'upcoming': 'upcoming',
                'draft': 'planning'
            };
            return statusMap[status.toLowerCase()] || 'planning';
        }

        function getCategorySlug(categoryName) {
            const slugMap = {
                'Youth Empowerment': 'youth',
                'Mother & Child Care': 'mother',
                'School Development': 'school',
                'Sports Development': 'sports'
            };
            return slugMap[categoryName] || 'youth';
        }

        function getCategoryBadge(categoryName) {
            const badgeMap = {
                'Youth Empowerment': '<span class="px-3 py-1 bg-blue-100 text-blue-600 text-xs font-medium rounded-full">Youth Empowerment</span>',
                'Mother & Child Care': '<span class="px-3 py-1 bg-pink-100 text-pink-600 text-xs font-medium rounded-full">Mother & Child Care</span>',
                'School Development': '<span class="px-3 py-1 bg-emerald-100 text-emerald-600 text-xs font-medium rounded-full">School Development</span>',
                'Sports Development': '<span class="px-3 py-1 bg-amber-100 text-amber-600 text-xs font-medium rounded-full">Sports Development</span>'
            };
            return badgeMap[categoryName] || '<span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">General</span>';
        }

        function formatDate(dateString) {
            if (!dateString) return 'TBD';
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { month: 'short', year: 'numeric' });
        }

        // Activity Modal Functions
        function openActivityModal(activityId) {
            const modal = document.getElementById('activityModal');
            const content = document.getElementById('modal-activity-content');
            const title = document.getElementById('modal-activity-title');

            // Show loading state
            content.innerHTML = `
                <div class="animate-pulse">
                    <div class="h-64 bg-gray-200 rounded-2xl mb-6"></div>
                    <div class="space-y-4">
                        <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                        <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                        <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                    </div>
                </div>
            `;

            // Show modal
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';

            // Fetch activity details
            fetch(`gallery_handler.php?action=get_activity&id=${activityId}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    const statusClass = getStatusClass(data.status);
                    const categoryBadge = getCategoryBadge(data.category_name);

                    content.innerHTML = `
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div>
                                <div class="h-64 lg:h-80 rounded-2xl overflow-hidden mb-6">
                                    <img src="${data.image || 'https://images.unsplash.com/photo-1542744095-fcf48d80b0fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'}"
                                         alt="${data.title}"
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="flex items-center gap-4 mb-6">
                                    <span class="status-${data.status.toLowerCase()} px-4 py-2 rounded-full text-sm font-medium">${data.status}</span>
                                    ${categoryBadge}
                                </div>
                            </div>
                            <div>
                                <div class="mb-6">
                                    <h4 class="font-heading text-xl font-bold text-primary mb-2">Activity Details</h4>
                                    <div class="space-y-3 text-gray-600">
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-calendar-alt text-accent w-5"></i>
                                            <span><strong>Start Date:</strong> ${data.start_date ? new Date(data.start_date).toLocaleDateString() : 'Not specified'}</span>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-calendar-check text-accent w-5"></i>
                                            <span><strong>End Date:</strong> ${data.end_date ? new Date(data.end_date).toLocaleDateString() : 'Not specified'}</span>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-map-marker-alt text-accent w-5"></i>
                                            <span><strong>Location:</strong> ${data.location || 'Not specified'}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8">
                            <h4 class="font-heading text-xl font-bold text-primary mb-4">Description</h4>
                            <p class="text-gray-700 leading-relaxed">${data.description || 'No description available.'}</p>
                        </div>
                    `;

                    title.textContent = data.title;
                } else {
                    content.innerHTML = `
                        <div class="text-center py-12">
                            <i class="fas fa-exclamation-triangle text-6xl text-gray-300 mb-4"></i>
                            <h3 class="font-heading text-2xl font-bold text-gray-600 mb-2">Activity Not Found</h3>
                            <p class="text-gray-500">The requested activity could not be found.</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error loading activity:', error);
                content.innerHTML = `
                    <div class="text-center py-12">
                        <i class="fas fa-exclamation-triangle text-6xl text-red-300 mb-4"></i>
                        <h3 class="font-heading text-2xl font-bold text-red-600 mb-2">Error Loading Activity</h3>
                        <p class="text-red-500">There was an error loading the activity details. Please try again.</p>
                    </div>
                `;
            });
        }

        function closeActivityModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        }

        // Close modal when clicking outside
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
        });

        // Close modal with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal-overlay').forEach(modal => {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                });
            }
        });

        // Add hover effect to activity cards
        document.addEventListener('mouseover', function(e) {
            if (e.target.classList.contains('activity-card')) {
                e.target.style.transform = 'translateY(-8px)';
            }
        });

        document.addEventListener('mouseout', function(e) {
            if (e.target.classList.contains('activity-card')) {
                e.target.style.transform = 'translateY(0)';
            }
        });
    </script>
</body>
</html>