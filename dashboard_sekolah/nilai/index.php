<?php
require_once '../check_auth.php';
require_once '../config/database.php';

// Get grade data with joins to student, class, and subject tables
$query = "SELECT n.*, s.nis, s.nama_lengkap, k.nama_kelas, mp.nama_mapel
          FROM nilai n
          JOIN siswa s ON n.siswa_id = s.id
          LEFT JOIN kelas k ON s.kelas_id = k.id
          JOIN mata_pelajaran mp ON n.mata_pelajaran_id = mp.id
          ORDER BY n.tanggal_dibuat DESC";
$result = mysqli_query($conn, $query);
$nilai_list = [];
while ($row = mysqli_fetch_assoc($result)) {
    $nilai_list[] = $row;
}

$title = 'Data Nilai';
include '../template/header.php';
?>
<div class="container-fluid">
    <div class="row">
        <?php include '../template/sidebar.php'; ?>
        <main class="col-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h4 fw-bold">Data Nilai</h1>
                <a href="create.php" class="btn btn-primary btn-sm">+ Input Nilai</a>
            </div>
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
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
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Jenis</th>
                                    <th>Nilai</th>
                                    <th>Huruf</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                    <th>Semester</th>
                                    <th>Tahun Ajaran</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($nilai_list) > 0): $no=1; ?>
                                    <?php foreach($nilai_list as $nilai): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= htmlspecialchars($nilai['nis']) ?></td>
                                            <td><?= htmlspecialchars($nilai['nama_lengkap']) ?></td>
                                            <td><?= htmlspecialchars($nilai['nama_kelas'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($nilai['nama_mapel']) ?></td>
                                            <td><?= htmlspecialchars($nilai['jenis_nilai']) ?></td>
                                            <td class="text-center"><?= htmlspecialchars($nilai['nilai']) ?></td>
                                            <td class="text-center"><?= htmlspecialchars($nilai['nilai_huruf']) ?></td>
                                            <td><?= htmlspecialchars($nilai['keterangan']) ?></td>
                                            <td><?= htmlspecialchars($nilai['tanggal_nilai']) ?></td>
                                            <td class="text-center"><?= htmlspecialchars($nilai['semester']) ?></td>
                                            <td><?= htmlspecialchars($nilai['tahun_ajaran']) ?></td>
                                            <td class="text-center">
                                                <div class="d-flex flex-column gap-1">
                                                    <a href="edit.php?id=<?= $nilai['id'] ?>" class="btn btn-warning btn-sm">Ubah</a>
                                                    <a href="delete.php?id=<?= $nilai['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus nilai ini?')">Hapus</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="13" class="text-center py-4">Belum ada data nilai</td>
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