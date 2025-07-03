<?php
require_once 'check_auth.php';
require_once 'config/database.php';

// Initialize variables
$total_guru = 0;
$total_pengumuman = 0; 
$total_artikel = 0;
$total_gallery = 0;
$total_ekstrakurikuler = 0;
$total_siswa = 0;
$total_kelas = 0;
$total_mata_pelajaran = 0;
$total_nilai = 0;

// Simple queries with error handling
try {
    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM guru");
    if ($result) {
        $row = mysqli_fetch_array($result);
        $total_guru = $row['total'];
    }
    
    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM pengumuman");
    if ($result) {
        $row = mysqli_fetch_array($result);
        $total_pengumuman = $row['total'];
    }
    
    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM artikel");
    if ($result) {
        $row = mysqli_fetch_array($result);
        $total_artikel = $row['total'];
    }
    
    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM gallery");
    if ($result) {
        $row = mysqli_fetch_array($result);
        $total_gallery = $row['total'];
    }
    
    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM ekstrakurikuler");
    if ($result) {
        $row = mysqli_fetch_array($result);
        $total_ekstrakurikuler = $row['total'];
    }
    
    // Query untuk tabel baru
    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM siswa");
    if ($result) {
        $row = mysqli_fetch_array($result);
        $total_siswa = $row['total'];
    }
    
    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM kelas");
    if ($result) {
        $row = mysqli_fetch_array($result);
        $total_kelas = $row['total'];
    }
    
    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM mata_pelajaran");
    if ($result) {
        $row = mysqli_fetch_array($result);
        $total_mata_pelajaran = $row['total'];
    }
    
    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM nilai");
    if ($result) {
        $row = mysqli_fetch_array($result);
        $total_nilai = $row['total'];
    }
} catch (Exception $e) {
    // Handle errors silently for now
}

include 'template/header.php';
include 'template/sidebar.php';
?>

<style>
:root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --warning-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    --info-gradient: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    --glass-bg: rgba(255, 255, 255, 0.1);
    --glass-border: rgba(255, 255, 255, 0.2);
    --shadow-soft: 0 8px 32px rgba(31, 38, 135, 0.37);
    --shadow-hover: 0 15px 35px rgba(31, 38, 135, 0.5);
}

body {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.glass-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 20px;
    box-shadow: var(--shadow-soft);
    transition: all 0.3s ease;
}

.glass-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}

.stats-card {
    background: linear-gradient(135deg, rgba(255,255,255,0.9), rgba(255,255,255,0.7));
    border: none;
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.stats-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--primary-gradient);
    border-radius: 20px 20px 0 0;
}

.stats-card.primary::before { background: var(--primary-gradient); }
.stats-card.secondary::before { background: var(--secondary-gradient); }
.stats-card.success::before { background: var(--success-gradient); }
.stats-card.warning::before { background: var(--warning-gradient); }
.stats-card.info::before { background: var(--info-gradient); }

.stats-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.stats-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 1rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    position: relative;
}

.stats-icon.primary { background: var(--primary-gradient); }
.stats-icon.secondary { background: var(--secondary-gradient); }
.stats-icon.success { background: var(--success-gradient); }
.stats-icon.warning { background: var(--warning-gradient); }
.stats-icon.info { background: var(--info-gradient); }

.stats-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.stats-label {
    font-size: 0.9rem;
    color: #666;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.chart-container {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: var(--shadow-soft);
    backdrop-filter: blur(20px);
    margin-bottom: 2rem;
}

.welcome-card {
    background: var(--primary-gradient);
    color: white;
    border-radius: 20px;
    padding: 3rem 2rem;
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
}

.welcome-card::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
    background-size: 30px 30px;
    animation: float 15s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(180deg); }
}

.welcome-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.welcome-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .stats-card {
        padding: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .welcome-title {
        font-size: 2rem;
    }
    
    .chart-container {
        padding: 1rem;
    }
}
</style>

<div class="container-fluid">
    <!-- Welcome Card -->
    <div class="welcome-card">
        <h1 class="welcome-title">
            <i class="fas fa-graduation-cap me-3"></i>
            Selamat Datang, <?php echo htmlspecialchars($_SESSION['admin_nama']); ?>!
        </h1>
        <p class="welcome-subtitle">
            <i class="fas fa-chart-line me-2"></i>
            Dashboard Manajemen Sekolah Digital - Kelola data sekolah dengan mudah dan efisien
        </p>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-5">
        <!-- Row 1: Data Lama -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card primary">
                <div class="stats-icon primary">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="stats-number"><?php echo $total_guru; ?></div>
                <div class="stats-label">Total Guru</div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card secondary">
                <div class="stats-icon secondary">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <div class="stats-number"><?php echo $total_pengumuman; ?></div>
                <div class="stats-label">Pengumuman</div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card success">
                <div class="stats-icon success">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="stats-number"><?php echo $total_artikel; ?></div>
                <div class="stats-label">Artikel</div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card warning">
                <div class="stats-icon warning">
                    <i class="fas fa-images"></i>
                </div>
                <div class="stats-number"><?php echo $total_gallery; ?></div>
                <div class="stats-label">Gallery</div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card info">
                <div class="stats-icon info">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="stats-number"><?php echo $total_ekstrakurikuler; ?></div>
                <div class="stats-label">Ekstrakurikuler</div>
            </div>
        </div>

    <!-- Row 2: Data Baru -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card primary">
                <div class="stats-icon primary">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="stats-number"><?php echo $total_siswa; ?></div>
                <div class="stats-label">Total Siswa</div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card secondary">
                <div class="stats-icon secondary">
                    <i class="fas fa-door-open"></i>
                </div>
                <div class="stats-number"><?php echo $total_kelas; ?></div>
                <div class="stats-label">Total Kelas</div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card success">
                <div class="stats-icon success">
                    <i class="fas fa-book-open"></i>
                </div>
                <div class="stats-number"><?php echo $total_mata_pelajaran; ?></div>
                <div class="stats-label">Mata Pelajaran</div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card warning">
                <div class="stats-icon warning">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stats-number"><?php echo $total_nilai; ?></div>
                <div class="stats-label">Data Nilai</div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="chart-container">
                <h4 class="mb-3">
                    <i class="fas fa-bolt text-warning me-2"></i>
                    Aksi Cepat
                </h4>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="/dashboard_sekolah/guru/create.php" class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-chalkboard-teacher mb-2 d-block"></i>
                            Tambah Guru
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="/dashboard_sekolah/pengumuman/create.php" class="btn btn-outline-secondary  w-100 py-3">
                            <i class="fas fa-bullhorn mb-2 d-block"></i>
                            Buat Pengumuman
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="/dashboard_sekolah/artikel/create.php" class="btn btn-outline-success w-100 py-3">
                            <i class="fas fa-newspaper mb-2 d-block"></i>
                            Tulis Artikel
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="/dashboard_sekolah/gallery/create.php" class="btn btn-outline-warning w-100 py-3">
                            <i class="fas fa-images mb-2 d-block"></i>
                            Upload Gambar
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="/dashboard_sekolah/ekstrakurikuler/create.php" class="btn btn-outline-info w-100 py-3">
                            <i class="fas fa-trophy mb-2 d-block"></i>
                            Tambah Ekskul
                        </a>
                    </div>
                
                <!-- Row 2: New Actions -->
                
                    <div class="col-md-3 mb-3">
                        <a href="/dashboard_sekolah/siswa/create.php" class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-user-tie mb-2 d-block"></i>
                            Tambah Siswa
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="/dashboard_sekolah/kelas/create.php" class="btn btn-outline-secondary w-100 py-3">
                            <i class="fas fa-door-open mb-2 d-block"></i>
                            Buat Kelas
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="/dashboard_sekolah/mata_pelajaran/create.php" class="btn btn-outline-success w-100 py-3">
                            <i class="fas fa-book-open mb-2 d-block"></i>
                            Tambah Mapel
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="/dashboard_sekolah/nilai/create.php" class="btn btn-outline-warning w-100 py-3">
                            <i class="fas fa-chart-line mb-2 d-block"></i>
                            Input Nilai
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Animasi untuk stats cards
document.addEventListener('DOMContentLoaded', function() {
    const statsCards = document.querySelectorAll('.stats-card');
    
    statsCards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        }, index * 100);
    });
});
</script>

<?php include 'template/footer.php'; ?>
