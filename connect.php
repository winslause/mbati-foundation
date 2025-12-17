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

        <div class="max-w-6xl mx-auto">
            <!-- Contact Information Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Office Hours -->
                <div class="bg-white rounded-2xl p-6 shadow-xl text-center">
                    <div class="w-12 h-12 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-clock text-accent text-xl"></i>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-primary mb-2">Office Hours</h3>
                    <p class="text-gray-600 text-sm">Mon - Fri: 8:00 AM - 5:00 PM</p>
                </div>

                <!-- Location -->
                <div class="bg-white rounded-2xl p-6 shadow-xl text-center">
                    <div class="w-12 h-12 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-map-marker-alt text-accent text-xl"></i>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-primary mb-2">Location</h3>
                    <p class="text-gray-600 text-sm">Luanda Constituency, Kenya</p>
                </div>

                <!-- Timezone -->
                <div class="bg-white rounded-2xl p-6 shadow-xl text-center">
                    <div class="w-12 h-12 bg-accent/20 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-globe text-accent text-xl"></i>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-primary mb-2">Timezone</h3>
                    <p class="text-gray-600 text-sm">East Africa Time (EAT)</p>
                </div>

                <!-- Quote -->
                <div class="bg-gradient-to-br from-accent to-yellow-500 rounded-2xl p-6 shadow-xl text-center text-white md:col-span-2 lg:col-span-1">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-quote-left text-white text-xl"></i>
                    </div>
                    <p class="text-sm italic opacity-90">"Let's work together to create lasting impact in our communities. Your voice matters to us."</p>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white rounded-2xl p-8 md:p-12 shadow-xl">
                <h2 class="font-heading text-2xl font-bold text-primary mb-8 text-center">Send us a Detailed Message</h2>
                <form id="contact-form" method="post" action="" class="space-y-6">
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
                            <select name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent" required>
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
                    <button type="button" id="submit-btn" class="w-full bg-accent text-white py-4 rounded-lg hover:bg-yellow-600 transition-colors font-semibold flex items-center justify-center">
                        <span>Send Message</span>
                        <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
console.log('Contact form script loaded');

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOMContentLoaded fired');
    const contactForm = document.querySelector('#contact-form');
    const submitBtn = document.querySelector('#submit-btn');
    console.log('Contact form found:', contactForm);
    console.log('Submit button found:', submitBtn);

    if (submitBtn) {
        submitBtn.addEventListener('click', function(e) {
            console.log('Submit button clicked');

            // Validate form
            const requiredFields = contactForm.querySelectorAll('[required]');
            let isValid = true;
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = 'red';
                    isValid = false;
                } else {
                    field.style.borderColor = '';
                }
            });

            if (!isValid) {
                showNotification('Please fill in all required fields.', 'error');
                return;
            }

            const formData = new FormData(contactForm);
            console.log('Form data entries:');
            for (let [key, value] of formData.entries()) {
                console.log(key + ': ' + value);
            }

            // Show loading state
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Sending...</span>';
            submitBtn.disabled = true;

            fetch('contact_handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                return response.text().then(text => {
                    console.log('Response text:', text);
                    try {
                        return JSON.parse(text);
                    } catch (e) {
                        console.error('JSON parse error:', e);
                        throw new Error('Invalid response format');
                    }
                });
            })
            .then(result => {
                console.log('Parsed result:', result);
                if (result.success) {
                    // Show success message
                    showNotification(result.message || 'Your message has been sent successfully! We will get back to you within 24 hours.', 'success');

                    // Reset form
                    contactForm.reset();
                } else {
                    showNotification(result.error || 'Sorry, there was an error sending your message. Please try again.', 'error');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
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
