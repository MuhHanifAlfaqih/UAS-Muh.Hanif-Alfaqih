<?php
// session_start();
require_once '../check_auth.php';
require_once '../config/database.php';

// Ambil data kelas
$result = mysqli_query($conn, "SELECT * FROM kelas ORDER BY tingkat, nama_kelas");
$kelas_list = [];
while ($row = mysqli_fetch_assoc($result)) {
    $kelas_list[] = $row;
}

$title = 'Data Kelas';
include '../template/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../template/sidebar.php'; ?>
        
        <main class="col-12">
            <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h4 fw-bold">Data Kelas</h1>
                <a href="create.php" class="btn btn-primary btn-sm">+ Tambah Kelas</a>
            </div>
            
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light fw-semibold">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelas</th>
                                    <th>Tingkat</th>
                                    <th>Jumlah Siswa</th>
                                    <th>Wali Kelas</th>
                                    <th>Ruangan</th>
                                    <th>Tanggal Dibuat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($kelas_list) > 0): $no=1; ?>
                                    <?php foreach($kelas_list as $kelas): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= htmlspecialchars($kelas['nama_kelas']) ?></td>
                                            <td><?= htmlspecialchars($kelas['tingkat']) ?></td>
                                            <td><?= htmlspecialchars($kelas['jumlah_siswa']) ?></td>
                                            <td><?= htmlspecialchars($kelas['wali_kelas']) ?></td>
                                            <td><?= htmlspecialchars($kelas['ruangan']) ?></td>
                                            <td><?= htmlspecialchars($kelas['tanggal_dibuat']) ?></td>
                                            <td class="text-end">
                                                <a href="edit.php?id=<?= $kelas['id'] ?>" class="btn btn-warning btn-sm">Ubah</a>
                                                <a href="delete.php?id=<?= $kelas['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kelas ini?')">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada data kelas</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../template/footer.php'; ?>
