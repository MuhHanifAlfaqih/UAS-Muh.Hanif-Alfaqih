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
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f2027 0%, #2c5364 100%);
            font-family: 'Inter', Arial, sans-serif;
        }
        .login-card {
            background: rgba(255,255,255,0.10);
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
            backdrop-filter: blur(8px);
        }
        .login-card .form-control {
            background: rgba(255,255,255,0.25);
            border: none;
            border-radius: 0.75rem;
            color: #222;
            font-size: 1.1rem;
            transition: box-shadow 0.2s;
        }
        .login-card .form-control:focus {
            box-shadow: 0 0 0 2px #2c5364;
            background: rgba(255,255,255,0.5);
        }
        .login-btn {
            border-radius: 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 1px;
            box-shadow: 0 4px 16px rgba(44,83,100,0.12);
        }
        .logo {
            width: 64px;
            height: 64px;
            margin-bottom: 1rem;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(44,83,100,0.10);
        }
        .logo svg {
            width: 40px;
            height: 40px;
            color: #2c5364;
        }
        .login-title {
            font-weight: 700;
            letter-spacing: 1px;
        }
        .alert {
            border-radius: 0.75rem;
        }
    </style>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center" style="min-height:100vh;">
        <div class="col-12 col-sm-10 col-md-6 col-lg-4">
            <div class="card login-card p-4 shadow-lg">
                <div class="text-center">
                    <div class="logo mx-auto mb-2">
                        <!-- Simple school icon SVG -->
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 10l9-7 9 7-9 7-9-7z"/><path d="M9 21V14h6v7"/></svg>
                    </div>
                    <h2 class="login-title mb-3">Login Admin</h2>
                </div>
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger text-center"><?php echo htmlspecialchars($_GET['error']); ?></div>
                <?php endif; ?>
                <form action="auth.php" method="post" autocomplete="off">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 login-btn mt-2">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 