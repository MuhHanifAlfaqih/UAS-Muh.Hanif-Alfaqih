<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<style>
.navbar-modern {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    backdrop-filter: blur(20px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    border: none;
}

.navbar-brand {
    font-weight: 700;
    font-size: 1.3rem;
    color: white !important;
}

.user-info {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 25px;
    padding: 8px 15px;
    margin-right: 10px;
    color: white;
    font-weight: 500;
}

.btn-logout {
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: white;
    border-radius: 20px;
    padding: 8px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-logout:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    color: white;
    transform: translateY(-1px);
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark navbar-modern">
    <div class="container-fluid">
        <a class="navbar-brand" href="/dashboard_sekolah/dashboard.php">
            <i class="fas fa-graduation-cap me-2"></i>
            Dashboard Sekolah
        </a>
        <div class="d-flex align-items-center">
            <div class="user-info">
                <i class="fas fa-user-circle me-2"></i>
                <?php echo isset($_SESSION['admin_nama']) ? htmlspecialchars($_SESSION['admin_nama']) : 'Admin'; ?>
            </div>
            <a href="/dashboard_sekolah/logout.php" class="btn btn-logout">
                <i class="fas fa-sign-out-alt me-2"></i>Keluar
            </a>
        </div>
    </div>
</nav>
<div class="container-fluid">
  <div class="row">

</body>
</html>
