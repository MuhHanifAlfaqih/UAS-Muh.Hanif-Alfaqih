<style>
.sidebar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    box-shadow: 4px 0 15px rgba(0,0,0,0.1);
}

.sidebar .nav-link {
    color: rgba(255, 255, 255, 0.9);
    padding: 15px 20px;
    margin: 5px 15px;
    border-radius: 12px;
    transition: all 0.3s ease;
    font-weight: 500;
    border: 1px solid transparent;
}

.sidebar .nav-link:hover {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    transform: translateX(5px);
    border-color: rgba(255, 255, 255, 0.3);
}

.sidebar .nav-link.active {
    background: rgba(255, 255, 255, 0.25);
    color: white;
    border-color: rgba(255, 255, 255, 0.4);
}

.sidebar-title {
    color: white;
    font-weight: 700;
    font-size: 1.2rem;
    margin-bottom: 2rem;
    text-align: center;
    padding: 0 20px;
}
</style>

<nav class="col-md-2 d-none d-md-block sidebar pt-4" style="min-height:100vh;">
  <div class="position-sticky">
    <div class="sidebar-title">
        <i class="fas fa-school me-2"></i>
        Menu Admin
    </div>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link" href="/dashboard_sekolah/dashboard.php">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/dashboard_sekolah/guru/index.php">
            <i class="fas fa-chalkboard-teacher me-2"></i>Data Guru
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/dashboard_sekolah/siswa/index.php">
            <i class="fas fa-user-graduate me-2"></i>Data Siswa
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/dashboard_sekolah/nilai/index.php">
            <i class="fas fa-chart-line me-2"></i>Data Nilai
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/dashboard_sekolah/kelas/index.php">
            <i class="fas fa-door-open me-2"></i>Data Kelas
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/dashboard_sekolah/mata_pelajaran/index.php">
            <i class="fas fa-book me-2"></i>Mapel
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/dashboard_sekolah/ekstrakurikuler/index.php">
            <i class="fas fa-trophy me-2"></i>Ekskul
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/dashboard_sekolah/artikel/index.php">
            <i class="fas fa-newspaper me-2"></i>Artikel
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/dashboard_sekolah/gallery/index.php">
            <i class="fas fa-images me-2"></i>Gallery
        </a>
      </li>      
      <li class="nav-item">
        <a class="nav-link" href="/dashboard_sekolah/pengumuman/index.php">
            <i class="fas fa-bullhorn me-2"></i>Pengumuman
        </a>
      </li>
    </ul>
  </div>
</nav>
<div class="col-md-10 ms-sm-auto px-md-4 pt-4">

