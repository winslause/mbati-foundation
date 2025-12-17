<section class="py-20 bg-light">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 border border-primary/20 mb-4">
                <span class="text-sm font-semibold text-primary tracking-wider">MAKE A DIFFERENCE</span>
            </div>
            <h1 class="font-heading text-4xl md:text-5xl font-bold text-primary mb-6">
                Support Our Mission
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Your generosity enables us to continue our work in education, sports, health, and community development across Luanda Constituency.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <!-- Donation Form -->
            <div class="bg-white rounded-2xl p-8 shadow-xl">
                <h2 class="font-heading text-2xl font-bold text-primary mb-6">Make a Donation</h2>

                <!-- Donation Amount Selection -->
                <div class="mb-8">
                    <label class="block text-gray-700 mb-4">Select Amount (KES)</label>
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <button class="amount-btn px-4 py-3 border-2 border-gray-300 rounded-lg hover:border-accent hover:bg-accent/10 transition-colors" data-amount="1000">Ksh 1,000</button>
                        <button class="amount-btn px-4 py-3 border-2 border-gray-300 rounded-lg hover:border-accent hover:bg-accent/10 transition-colors" data-amount="2500">Ksh 2,500</button>
                        <button class="amount-btn px-4 py-3 border-2 border-gray-300 rounded-lg hover:border-accent hover:bg-accent/10 transition-colors" data-amount="5000">Ksh 5,000</button>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <button class="amount-btn px-4 py-3 border-2 border-gray-300 rounded-lg hover:border-accent hover:bg-accent/10 transition-colors" data-amount="10000">Ksh 10,000</button>
                        <input type="number" id="custom-amount" placeholder="Other amount" class="px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent">
                    </div>
                </div>

                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 mb-2">Full Name *</label>
                            <input type="text" id="donor-name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Email Address *</label>
                            <input type="email" id="donor-email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" id="donor-phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Payment Method</label>
                        <div class="space-y-3">
                            <label class="flex items-center">
                                <input type="radio" name="payment" value="mpesa" class="text-accent focus:ring-accent" checked>
                                <span class="ml-3">M-Pesa</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="payment" value="card" class="text-accent focus:ring-accent">
                                <span class="ml-3">Credit/Debit Card</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="payment" value="bank" class="text-accent focus:ring-accent">
                                <span class="ml-3">Bank Transfer</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Message (Optional)</label>
                        <textarea id="donor-message" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent resize-vertical" placeholder="Share why you're supporting our mission..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-accent text-white py-4 rounded-lg hover:bg-yellow-600 transition-colors font-semibold flex items-center justify-center">
                        <span>Complete Donation</span>
                        <i class="fas fa-heart ml-2"></i>
                    </button>
                </form>
            </div>

            <!-- Impact Information -->
            <div class="space-y-8">
                <!-- Impact Stats -->
                <div class="bg-white rounded-2xl p-8 shadow-xl">
                    <h3 class="font-heading text-xl font-bold text-primary mb-6">Your Impact</h3>
                    <div class="space-y-6">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <div class="font-semibold text-primary">Ksh 1,000</div>
                                <div class="text-sm text-gray-600">Provides school supplies for 5 children</div>
                            </div>
                            <i class="fas fa-graduation-cap text-accent text-2xl"></i>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <div class="font-semibold text-primary">Ksh 2,500</div>
                                <div class="text-sm text-gray-600">Supports a child through nutrition program</div>
                            </div>
                            <i class="fas fa-utensils text-accent text-2xl"></i>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <div class="font-semibold text-primary">Ksh 5,000</div>
                                <div class="text-sm text-gray-600">Equips a sports team with training gear</div>
                            </div>
                            <i class="fas fa-futbol text-accent text-2xl"></i>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <div class="font-semibold text-primary">Ksh 10,000</div>
                                <div class="text-sm text-gray-600">Funds maternal healthcare for a family</div>
                            </div>
                            <i class="fas fa-heartbeat text-accent text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Why Donate -->
                <div class="bg-primary rounded-2xl p-8 text-white">
                    <h3 class="font-heading text-xl font-bold mb-6">Why Your Support Matters</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-check text-accent mr-3 mt-1"></i>
                            <span>100% of donations go directly to programs</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-accent mr-3 mt-1"></i>
                            <span>Transparent reporting on impact and usage</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-accent mr-3 mt-1"></i>
                            <span>Direct, measurable impact in communities</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-accent mr-3 mt-1"></i>
                            <span>Sustainable, long-term development focus</span>
                        </li>
                    </ul>
                </div>

                <!-- Monthly Giving -->
                <div class="bg-accent rounded-2xl p-8 text-white">
                    <h3 class="font-heading text-xl font-bold mb-4">Become a Monthly Donor</h3>
                    <p class="mb-6 opacity-90">Consistent support allows us to plan and execute programs more effectively.</p>
                    <button class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary/90 transition-colors font-semibold">
                        Set Up Monthly Giving
                    </button>
                </div>
            </div>
        </div>

        <!-- Other Ways to Help -->
        <div class="bg-white rounded-2xl p-8 md:p-12 shadow-xl">
            <h2 class="font-heading text-3xl font-bold text-primary text-center mb-8">Other Ways to Help</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-hands-helping text-2xl text-accent"></i>
                    </div>
                    <h3 class="font-semibold text-primary mb-3">Volunteer</h3>
                    <p class="text-gray-600 mb-4">Share your time and skills to help implement our programs.</p>
                    <button class="text-accent hover:text-yellow-600 font-semibold">Learn More →</button>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-handshake text-2xl text-accent"></i>
                    </div>
                    <h3 class="font-semibold text-primary mb-3">Partner With Us</h3>
                    <p class="text-gray-600 mb-4">Corporate partnerships and NGO collaborations.</p>
                    <button class="text-accent hover:text-yellow-600 font-semibold">Contact Us →</button>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-share text-2xl text-accent"></i>
                    </div>
                    <h3 class="font-semibold text-primary mb-3">Spread the Word</h3>
                    <p class="text-gray-600 mb-4">Share our mission with your network and friends.</p>
                    <button class="text-accent hover:text-yellow-600 font-semibold">Share Now →</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Donation amount selection
document.addEventListener('DOMContentLoaded', function() {
    const amountButtons = document.querySelectorAll('.amount-btn');
    const customAmount = document.getElementById('custom-amount');

    amountButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            amountButtons.forEach(btn => btn.classList.remove('border-accent', 'bg-accent/10'));
            // Add active class to clicked button
            this.classList.add('border-accent', 'bg-accent/10');
            // Clear custom amount
            customAmount.value = '';
        });
    });

    customAmount.addEventListener('input', function() {
        // Remove active class from buttons when custom amount is entered
        amountButtons.forEach(btn => btn.classList.remove('border-accent', 'bg-accent/10'));
    });
});
</script>