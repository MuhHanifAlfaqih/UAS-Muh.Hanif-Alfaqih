<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Dashboard Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow-soft: 0 8px 32px rgba(31, 38, 135, 0.37);
            --shadow-hover: 0 15px 35px rgba(31, 38, 135, 0.5);
        }
        
        body {
            background: var(--primary-gradient);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
        }
        
        /* Animated Background */
        .bg-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        
        .bg-animation::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: float 20s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        /* Glass Morphism Card */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: var(--shadow-soft);
            transition: all 0.3s ease;
        }
        
        .glass-card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-5px);
        }
        
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-card {
            max-width: 400px;
            width: 100%;
            padding: 3rem;
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .logo-icon {
            background: var(--secondary-gradient);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            box-shadow: 0 10px 30px rgba(245, 87, 108, 0.3);
        }
        
        .logo-icon i {
            font-size: 2rem;
            color: white;
        }
        
        .login-title {
            color: white;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .login-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }
        
        /* Modern Form Styling */
        .form-floating {
            margin-bottom: 1.5rem;
        }
        
        .form-floating > .form-control {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 15px;
            color: white;
            padding: 1rem 1rem;
            height: auto;
            transition: all 0.3s ease;
        }
        
        .form-floating > .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.2);
            color: white;
        }
        
        .form-floating > .form-control::placeholder {
            color: transparent;
        }
        
        .form-floating > label {
            color: rgba(255, 255, 255, 0.9);
            padding: 1rem 1rem;
            font-weight: 500;
            background: transparent !important;
            background-color: transparent !important;
        }
        
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: rgba(255, 255, 255, 0.95);
            transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
            background: transparent !important;
            background-color: transparent !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
        }
        
        /* Force remove any Bootstrap background styling on labels */
        .form-floating label::before,
        .form-floating label::after {
            content: none !important;
            background: none !important;
        }
        
        /* Modern Button */
        .btn-modern {
            background: var(--secondary-gradient);
            border: none;
            /* border-radius: 15px; */
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            color: white;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(245, 87, 108, 0.4);
            color: white;
        }
        
        .btn-modern:active {
            transform: translateY(0);
        }
        
        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-modern:hover::before {
            left: 100%;
        }
        
        /* Alert Styling */
        .alert-modern {
            background: rgba(220, 53, 69, 0.1);
            border: 1px solid rgba(220, 53, 69, 0.3);
            color: #ff6b7d;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }
        
        /* Input Icons */
        .input-group-modern {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.8);
            z-index: 5;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .login-card {
                padding: 2rem;
                margin: 1rem;
            }
            
            .login-title {
                font-size: 1.5rem;
            }
        }
        
        /* Loading Animation */
        .btn-loading {
            position: relative;
        }
        
        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Force remove any remaining background on labels */
        .form-floating > label,
        .form-floating > label:before,
        .form-floating > label:after {
            background: transparent !important;
            background-color: transparent !important;
            background-image: none !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
        }
        
        /* Additional override for floating labels */
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            background: transparent !important;
            background-color: transparent !important;
            background-image: none !important;
        }
    </style>
</head>
<body>
    <div class="bg-animation"></div>
    
    <div class="login-container">
        <div class="glass-card login-card">
            <div class="logo-container">
                <div class="logo-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h1 class="login-title">Dashboard Sekolah</h1>
                <p class="login-subtitle">Silakan masuk untuk mengakses panel admin</p>
            </div>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-modern mb-4" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>
            
            <form action="auth.php" method="post" id="loginForm">
                <div class="form-floating input-group-modern">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required autofocus>
                    <label for="username">Username</label>
                    <i class="fas fa-user input-icon"></i>
                </div>
                
                <div class="form-floating input-group-modern">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password">Password</label>
                    <i class="fas fa-lock input-icon"></i>
                </div>
                
                <button type="submit" class="btn btn-modern w-100" id="loginBtn">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    Masuk ke Dashboard
                </button>
            </form>
            
            <div class="text-center mt-4">
                <small class="text-white-50">
                    <i class="fas fa-shield-alt me-1"></i>
                    Sistem Manajemen Sekolah Digital
                </small>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Modern form interactions
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('loginBtn');
            btn.classList.add('btn-loading');
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
        });
        
        // Input focus effects
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
        
        // Parallax effect for background
        document.addEventListener('mousemove', function(e) {
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            const bgAnimation = document.querySelector('.bg-animation::before');
            if (bgAnimation) {
                bgAnimation.style.transform = `translate(${x * 20}px, ${y * 20}px)`;
            }
        });
    </script>
</body>
</html>