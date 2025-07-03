<?php
require_once '../check_auth.php';
require_once '../config/database.php';

// Ambil data mata pelajaran
$result = mysqli_query($conn, "SELECT * FROM mata_pelajaran ORDER BY tingkat, nama_mapel");
$mapel_list = [];
while ($row = mysqli_fetch_assoc($result)) {
    $mapel_list[] = $row;
}

$title = 'Data Mata Pelajaran';
include '../template/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../template/sidebar.php'; ?>
        
        <main class="col-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h4 fw-bold">Data Mata Pelajaran</h1>
                <a href="create.php" class="btn btn-primary btn-sm">+ Tambah Mapel</a>
            </div>
            
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
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
                                    <th>Kode Mapel</th>
                                    <th>Nama Mapel</th>
                                    <th>Guru Pengampu</th>
                                    <th>Jam Pelajaran</th>
                                    <th>Semester</th>
                                    <th>Tingkat</th>
                                    <th>KKM</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal Dibuat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($mapel_list) > 0): $no=1; ?>
                                    <?php foreach($mapel_list as $mapel): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= htmlspecialchars($mapel['kode_mapel']) ?></td>
                                            <td><?= htmlspecialchars($mapel['nama_mapel']) ?></td>
                                            <td><?= htmlspecialchars($mapel['guru_pengampu']) ?></td>
                                            <td><?= htmlspecialchars($mapel['jam_pelajaran']) ?></td>
                                            <td><?= htmlspecialchars($mapel['semester']) ?></td>
                                            <td><?= htmlspecialchars($mapel['tingkat']) ?></td>
                                            <td><?= htmlspecialchars($mapel['kkm']) ?></td>
                                            <td><?= htmlspecialchars($mapel['deskripsi']) ?></td>
                                            <td><?= htmlspecialchars($mapel['tanggal_dibuat']) ?></td>
                                            <td class="text-center">
                                                <div class="d-flex flex-column gap-1">
                                                    <a href="edit.php?id=<?= $mapel['id'] ?>" class="btn btn-warning btn-sm">Ubah</a>
                                                    <a href="delete.php?id=<?= $mapel['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus mapel ini?')">Hapus</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="11" class="text-center py-4">Belum ada data mata pelajaran</td>
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