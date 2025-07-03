<?php
// session_start();
require_once '../check_auth.php';
require_once '../config/database.php';

// Ambil data siswa dengan join ke tabel kelas
$result = mysqli_query($conn, "SELECT s.*, k.nama_kelas FROM siswa s LEFT JOIN kelas k ON s.kelas_id = k.id ORDER BY s.tanggal_dibuat DESC");
$siswa_list = [];
while ($row = mysqli_fetch_assoc($result)) {
    $siswa_list[] = $row;
}

$title = 'Data Siswa';
include '../template/header.php';
?>
<div class="container-fluid">
    <div class="row">
        <?php include '../template/sidebar.php'; ?>
        <main class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h4 fw-bold">Data Siswa</h1>
                <a href="create.php" class="btn btn-primary btn-sm">+ Tambah Siswa</a>
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
                                    <th>NIS</th>
                                    <th>Nama Lengkap</th>
                                    <th>Kelas</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No HP</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($siswa_list) > 0): $no=1; ?>
                                    <?php foreach($siswa_list as $siswa): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= htmlspecialchars($siswa['nis']) ?></td>
                                            <td><?= htmlspecialchars($siswa['nama_lengkap']) ?></td>
                                            <td><?= htmlspecialchars($siswa['nama_kelas'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($siswa['jenis_kelamin']) ?></td>
                                            <td><?= htmlspecialchars($siswa['no_hp']) ?></td>
                                            <td><?= htmlspecialchars($siswa['status']) ?></td>
                                            <td class="text-center">
                                                <div class="d-flex flex-column gap-1">
                                                    <a href="edit.php?id=<?= $siswa['id'] ?>" class="btn btn-warning btn-sm">Ubah</a>
                                                    <a href="delete.php?id=<?= $siswa['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus siswa ini?')">Hapus</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada data siswa</td>
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