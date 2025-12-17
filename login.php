<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $username = $input['username'] ?? '';
    $password = $input['password'] ?? '';

    header('Content-Type: application/json');

    if (empty($username) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Username and password are required']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT id, password FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin['password'])) {
            session_start();
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $username;
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Harold Mbati Foundation</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #0f172a;
            --secondary: #1e293b;
            --accent: #f59e0b;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        .login-container {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            position: relative;
        }
        
        .login-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 2rem;
            text-align: center;
            color: white;
        }
        
        .login-form {
            padding: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
        
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }
        
        .form-input.error {
            border-color: #ef4444;
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }
        
        .show-password {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
        }
        
        .btn-primary {
            width: 100%;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(245, 158, 11, 0.2);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .loading {
            display: none;
        }
        
        .loading.active {
            display: inline-block;
        }
        
        .footer-links {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }
        
        .footer-links a {
            color: #6b7280;
            text-decoration: none;
            font-size: 0.875rem;
        }
        
        .footer-links a:hover {
            color: var(--accent);
        }
        
        .notification {
            position: fixed;
            top: 1rem;
            right: 1rem;
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            background: white;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            transform: translateX(120%);
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            max-width: 400px;
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        .notification.error {
            border-left: 4px solid #ef4444;
        }
        
        .notification.success {
            border-left: 4px solid #10b981;
        }
        
        /* Floating animation */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .floating-logo {
            animation: float 6s ease-in-out infinite;
        }
        
        /* Security indicators */
        .security-info {
            background: #f8fafc;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-top: 1.5rem;
            border-left: 4px solid var(--accent);
        }
        
        .security-info h4 {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        
        .security-info p {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        /* Password strength */
        .password-strength {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            margin-top: 0.5rem;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s ease;
            border-radius: 2px;
        }
        
        .strength-weak {
            background: #ef4444;
        }
        
        .strength-medium {
            background: #f59e0b;
        }
        
        .strength-strong {
            background: #10b981;
        }
        
        /* Responsive */
        @media (max-width: 640px) {
            .login-container {
                max-width: 100%;
            }
            
            .login-header {
                padding: 1.5rem;
            }
            
            .login-form {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Login Container -->
    <div class="login-container">
        <!-- Header -->
        <div class="login-header">
            <div class="floating-logo mb-4">
                <div class="w-16 h-16 rounded-full bg-accent flex items-center justify-center mx-auto">
                    <i class="fas fa-hands-helping text-white text-2xl"></i>
                </div>
            </div>
            <h1 class="text-2xl font-bold mb-2">Harold Mbati Foundation</h1>
            <p class="text-white/80">Admin Portal Login</p>
        </div>
        
        <!-- Login Form -->
        <div class="login-form">
            <form id="loginForm">
                <div class="form-group">
                    <label class="form-label" for="username">
                        <i class="fas fa-user mr-2"></i>Username
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="username" 
                               class="form-input" 
                               placeholder="Enter your username"
                               required>
                        <div class="error-message" id="usernameError">Please enter a valid username</div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="password">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               class="form-input" 
                               placeholder="Enter your password"
                               required>
                        <button type="button" class="show-password" onclick="togglePassword()">
                            <i class="fas fa-eye"></i>
                        </button>
                        <div class="error-message" id="passwordError">Please enter your password</div>
                    </div>
                    
                    <!-- Password Strength Indicator -->
                    <div class="password-strength">
                        <div class="password-strength-bar" id="passwordStrength"></div>
                    </div>
                </div>
                
                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" id="remember" class="mr-2">
                        <span class="text-sm text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-accent hover:underline" onclick="showForgotPassword()" style="display: none!important">
                        Forgot password?
                    </a>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn-primary">
                    <span id="btnText">Login to Dashboard</span>
                    <span class="loading" id="btnLoading">
                        <i class="fas fa-spinner fa-spin mr-2"></i>Authenticating...
                    </span>
                </button>
                
                <!-- Security Information -->
                <div class="security-info">
                    <h4>
                        <i class="fas fa-shield-alt mr-2"></i>Secure Login
                    </h4>
                    <p>This is a secure system. Please ensure you are using your authorized credentials.</p>
                </div>
            </form>
            
            <!-- Footer Links -->
            <div class="footer-links">
                <a href="#" onclick="showHelp()">
                    <i class="fas fa-question-circle mr-1"></i>Need help?
                </a>
            </div>
        </div>
    </div>
    
    <!-- Notification Container -->
    <div id="notificationContainer"></div>
    
    <!-- Forgot Password Modal -->
    <div id="forgotPasswordModal" class="modal-overlay" style="display: none;">
        <div class="modal-content" style="max-width: 500px;">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Reset Password</h3>
                    <button onclick="closeModal('forgotPasswordModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                
                <form id="forgotPasswordForm">
                    <div class="mb-6">
                        <p class="text-gray-600 mb-4">Enter your email address and we'll send you instructions to reset your password.</p>
                        
                        <label class="form-label" for="resetEmail">Email Address</label>
                        <input type="email" 
                               id="resetEmail" 
                               class="form-input" 
                               placeholder="admin@haroldmbatifoundation.org"
                               required>
                        <div class="error-message" id="emailError">Please enter a valid email address</div>
                    </div>
                    
                    <div class="flex justify-end gap-4">
                        <button type="button" onclick="closeModal('forgotPasswordModal')" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-accent text-white rounded-lg hover:bg-yellow-600">
                            Send Reset Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Help Modal -->
    <div id="helpModal" class="modal-overlay" style="display: none;">
        <div class="modal-content" style="max-width: 500px;">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Login Help</h3>
                    <button onclick="closeModal('helpModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-2">
                            <i class="fas fa-key mr-2 text-accent"></i>Default Credentials
                        </h4>
                        <p class="text-gray-600 text-sm">Username: <code class="bg-gray-100 px-2 py-1 rounded">admin</code></p>
                        <p class="text-gray-600 text-sm">Password: <code class="bg-gray-100 px-2 py-1 rounded">HaroldMbati2024!</code></p>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-2">
                            <i class="fas fa-shield-alt mr-2 text-accent"></i>Security Tips
                        </h4>
                        <ul class="text-gray-600 text-sm space-y-2">
                            <li>• Use a strong, unique password</li>
                            <li>• Don't share your credentials</li>
                            <li>• Log out after each session</li>
                            <li>• Contact support if you suspect unauthorized access</li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-2">
                            <i class="fas fa-headset mr-2 text-accent"></i>Support
                        </h4>
                        <p class="text-gray-600 text-sm">Email: <a href="mailto:support@haroldmbatifoundation.org" class="text-accent hover:underline">support@haroldmbatifoundation.org</a></p>
                        <p class="text-gray-600 text-sm">Phone: <a href="tel:+254700000000" class="text-accent hover:underline">+254 700 000 000</a></p>
                    </div>
                </div>
                
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <button onclick="closeModal('helpModal')" class="w-full px-4 py-2 bg-accent text-white rounded-lg hover:bg-yellow-600">
                        Got it, thanks!
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal Styles (inline for this modal)
        const modalStyles = `
            .modal-overlay {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(5px);
                z-index: 9998;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 1rem;
            }
            
            .modal-content {
                background: white;
                border-radius: 1rem;
                animation: modalSlideIn 0.3s ease-out;
            }
            
            @keyframes modalSlideIn {
                from {
                    opacity: 0;
                    transform: translateY(-20px) scale(0.95);
                }
                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }
        `;
        
        // Add modal styles to the page
        const styleSheet = document.createElement('style');
        styleSheet.textContent = modalStyles;
        document.head.appendChild(styleSheet);
        
        // Show Notification
        function showNotification(message, type = 'error') {
            const container = document.getElementById('notificationContainer');
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} text-${type === 'success' ? 'green' : 'red'}-500"></i>
                <div class="flex-1">
                    <p class="font-medium">${message}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            container.appendChild(notification);
            
            // Show notification
            setTimeout(() => {
                notification.classList.add('show');
            }, 10);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.remove();
            }, 5000);
        }
        
        // Toggle Password Visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.querySelector('.show-password i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
        
        // Password Strength Check
        function checkPasswordStrength(password) {
            let strength = 0;
            const strengthBar = document.getElementById('passwordStrength');
            
            if (!password) {
                strengthBar.style.width = '0';
                strengthBar.className = 'password-strength-bar';
                return;
            }
            
            // Length check
            if (password.length >= 8) strength += 25;
            if (password.length >= 12) strength += 25;
            
            // Complexity checks
            if (/[A-Z]/.test(password)) strength += 25;
            if (/[0-9]/.test(password)) strength += 25;
            if (/[^A-Za-z0-9]/.test(password)) strength += 25;
            
            // Cap at 100
            strength = Math.min(strength, 100);
            
            // Update progress bar
            strengthBar.style.width = `${strength}%`;
            
            // Update color based on strength
            if (strength < 50) {
                strengthBar.className = 'password-strength-bar strength-weak';
            } else if (strength < 75) {
                strengthBar.className = 'password-strength-bar strength-medium';
            } else {
                strengthBar.className = 'password-strength-bar strength-strong';
            }
        }
        
        // Modal Functions
        function showForgotPassword() {
            document.getElementById('forgotPasswordModal').style.display = 'flex';
        }
        
        function showHelp() {
            document.getElementById('helpModal').style.display = 'flex';
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
        
        // Handle Login Form Submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            
            // Reset errors
            document.getElementById('usernameError').style.display = 'none';
            document.getElementById('passwordError').style.display = 'none';
            document.getElementById('username').classList.remove('error');
            document.getElementById('password').classList.remove('error');
            
            // Validation
            let isValid = true;
            
            if (!username) {
                document.getElementById('usernameError').style.display = 'block';
                document.getElementById('username').classList.add('error');
                isValid = false;
            }
            
            if (!password) {
                document.getElementById('passwordError').style.display = 'block';
                document.getElementById('password').classList.add('error');
                isValid = false;
            }
            
            if (!isValid) {
                showNotification('Please fill in all required fields', 'error');
                return;
            }
            
            // Show loading state
            const btnText = document.getElementById('btnText');
            const btnLoading = document.getElementById('btnLoading');
            btnText.style.display = 'none';
            btnLoading.classList.add('active');
            
            // Send AJAX request to login.php
            fetch('login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    username: username,
                    password: password
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Login successful! Redirecting to dashboard...', 'success');
                    setTimeout(() => {
                        window.location.href = 'admin.php';
                    }, 1500);
                } else {
                    showNotification(data.message || 'Invalid username or password', 'error');
                    // Shake animation for error
                    const form = document.getElementById('loginForm');
                    form.classList.add('animate-shake');
                    setTimeout(() => {
                        form.classList.remove('animate-shake');
                    }, 500);
                }
                btnText.style.display = 'inline';
                btnLoading.classList.remove('active');
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('An error occurred. Please try again.', 'error');
                btnText.style.display = 'inline';
                btnLoading.classList.remove('active');
            });
        });
        
        // Handle Forgot Password Form
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('resetEmail').value.trim();
            
            if (!email || !email.includes('@')) {
                document.getElementById('emailError').style.display = 'block';
                showNotification('Please enter a valid email address', 'error');
                return;
            }
            
            // Simulate API call
            showNotification('Password reset instructions sent to your email', 'success');
            closeModal('forgotPasswordModal');
        });
        
        // Auto-fill remembered credentials
        document.addEventListener('DOMContentLoaded', function() {
            // Add shake animation style
            const shakeStyle = document.createElement('style');
            shakeStyle.textContent = `
                @keyframes shake {
                    0%, 100% { transform: translateX(0); }
                    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                    20%, 40%, 60%, 80% { transform: translateX(5px); }
                }
                .animate-shake {
                    animation: shake 0.5s ease-in-out;
                }
            `;
            document.head.appendChild(shakeStyle);
            
            // Listen for password input for strength check
            document.getElementById('password').addEventListener('input', function(e) {
                checkPasswordStrength(e.target.value);
            });
            
            // Close modals with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeModal('forgotPasswordModal');
                    closeModal('helpModal');
                }
            });
            
            // Close modal when clicking outside
            document.querySelectorAll('.modal-overlay').forEach(overlay => {
                overlay.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.style.display = 'none';
                    }
                });
            });
            
            // Focus on username field on load
            document.getElementById('username').focus();
        });
        
        // Handle Enter key for login
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.target.type !== 'textarea') {
                if (!e.target.closest('.modal-overlay')) {
                    document.getElementById('loginForm').dispatchEvent(new Event('submit'));
                }
            }
        });
    </script>
</body>
</html>