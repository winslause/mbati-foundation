<section class="py-20 bg-light">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 border border-primary/20 mb-4">
                <span class="text-sm font-semibold text-primary tracking-wider">GET IN TOUCH</span>
            </div>
            <h1 class="font-heading text-4xl md:text-5xl font-bold text-primary mb-6">
                Contact Information
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                For detailed inquiries, partnerships, or specific questions about our programs, please use the contact form below or reach out directly.
            </p>
        </div>

        <div class="max-w-4xl mx-auto">
            <!-- Contact Information Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Office Info -->
                <div class="bg-white rounded-2xl p-8 shadow-xl text-center">
                    <div class="w-16 h-16 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marker-alt text-accent text-2xl"></i>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-primary mb-2">Our Location</h3>
                    <p class="text-gray-600">Luanda Constituency<br>Kenya</p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-xl text-center">
                    <div class="w-16 h-16 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-accent text-2xl"></i>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-primary mb-2">Office Hours</h3>
                    <p class="text-gray-600">Monday - Friday<br>8:00 AM - 5:00 PM<br>East Africa Time (EAT)</p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-xl text-center">
                    <div class="w-16 h-16 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone text-accent text-2xl"></i>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-primary mb-2">Phone</h3>
                    <p class="text-gray-600">+254 768 927895</p>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white rounded-2xl p-8 md:p-12 shadow-xl">
                <h2 class="font-heading text-2xl font-bold text-primary mb-8 text-center">Send us a Detailed Message</h2>
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 mb-2">Full Name *</label>
                            <input type="text" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Email Address *</label>
                            <input type="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" name="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Subject *</label>
                            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent" required>
                                <option value="">Select a topic</option>
                                <option value="partnership">Partnership Inquiry</option>
                                <option value="volunteer">Volunteer Opportunities</option>
                                <option value="donation">Donation Questions</option>
                                <option value="program">Program Information</option>
                                <option value="media">Media Inquiry</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Message *</label>
                        <textarea rows="8" name="message" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent resize-vertical" placeholder="Please provide detailed information about your inquiry..." required></textarea>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="newsletter" class="mr-3">
                        <label for="newsletter" class="text-gray-600">Subscribe to our newsletter for updates</label>
                    </div>
                    <button type="submit" class="w-full bg-accent text-white py-4 rounded-lg hover:bg-yellow-600 transition-colors font-semibold flex items-center justify-center">
                        <span>Send Message</span>
                        <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </form>
            </div>

            <!-- Additional Contact Methods -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8">
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
    </div>
</section>

<script>
// Contact form submission
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.querySelector('#connect form');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Sending...</span>';
            submitBtn.disabled = true;

            // Add action to form data
            const data = new FormData(this);
            data.append('action', 'add_contact');

            fetch('admin.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    // Show success message
                    showNotification('Your message has been sent successfully! We will get back to you within 24 hours.', 'success');

                    // Reset form
                    this.reset();
                } else {
                    showNotification('Sorry, there was an error sending your message. Please try again.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Sorry, there was an error sending your message. Please try again.', 'error');
            })
            .finally(() => {
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }
});

// Notification function
function showNotification(message, type = 'success') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-2xl border-l-4 transform translate-x-full transition-all duration-300 ${
        type === 'success' ? 'bg-green-500 text-white border-green-300' : 'bg-red-500 text-white border-red-300'
    }`;
    notification.innerHTML = `
        <div class="flex items-center gap-3">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} text-xl"></i>
            <div class="flex-1">
                <p class="font-semibold">${type === 'success' ? 'Success!' : 'Error!'}</p>
                <p class="text-sm opacity-90">${message}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-white/70 hover:text-white ml-2">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;

    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 10);

    // Auto remove after 6 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => notification.remove(), 300);
    }, 6000);
}
</script>