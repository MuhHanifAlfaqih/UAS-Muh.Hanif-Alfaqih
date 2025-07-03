<?php
require_once '../check_auth.php';
require_once '../config/database.php';

// Ambil data siswa
$result_siswa = mysqli_query($conn, "SELECT s.*, k.nama_kelas FROM siswa s LEFT JOIN kelas k ON s.kelas_id = k.id ORDER BY s.nama_lengkap");
$siswa_list = [];
while ($row = mysqli_fetch_assoc($result_siswa)) {
    $siswa_list[] = $row;
}

// Ambil data mata pelajaran
$result_mapel = mysqli_query($conn, "SELECT * FROM mata_pelajaran ORDER BY nama_mapel");
$mapel_list = [];
while ($row = mysqli_fetch_assoc($result_mapel)) {
    $mapel_list[] = $row;
}

$title = 'Input Nilai';
include '../template/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../template/sidebar.php'; ?>

        <main class="col-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h4 fw-bold">Input Nilai</h1>
            </div>

            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="store.php" method="POST">
                        <div class="mb-3">
                            <label for="siswa_id" class="form-label">Siswa *</label>
                            <select class="form-select" id="siswa_id" name="siswa_id" required>
                                <option value="">Pilih Siswa</option>
                                <?php foreach ($siswa_list as $siswa): ?>
                                    <option value="<?= $siswa['id'] ?>">
                                        <?= htmlspecialchars($siswa['nama_lengkap']) ?> - <?= htmlspecialchars($siswa['nis']) ?> (<?= htmlspecialchars($siswa['nama_kelas'] ?? '-') ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="mata_pelajaran_id" class="form-label">Mata Pelajaran *</label>
                            <select class="form-select" id="mata_pelajaran_id" name="mata_pelajaran_id" required>
                                <option value="">Pilih Mapel</option>
                                <?php foreach ($mapel_list as $mapel): ?>
                                    <option value="<?= $mapel['id'] ?>">
                                        <?= htmlspecialchars($mapel['nama_mapel']) ?> (<?= htmlspecialchars($mapel['kode_mapel']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jenis_nilai" class="form-label">Jenis Nilai *</label>
                            <select class="form-select" id="jenis_nilai" name="jenis_nilai" required>
                                <option value="">Pilih Jenis Nilai</option>
                                <option value="Tugas">Tugas</option>
                                <option value="UTS">UTS</option>
                                <option value="UAS">UAS</option>
                                <option value="Harian">Harian</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nilai" class="form-label">Nilai *</label>
                            <input type="number" step="0.01" class="form-control" id="nilai" name="nilai" min="0" max="100" required>
                        </div>

                        <div class="mb-3">
                            <label for="nilai_huruf" class="form-label">Nilai Huruf</label>
                            <input type="text" class="form-control" id="nilai_huruf" name="nilai_huruf" maxlength="2">
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_nilai" class="form-label">Tanggal Nilai *</label>
                            <input type="date" class="form-control" id="tanggal_nilai" name="tanggal_nilai" required>
                        </div>

                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester *</label>
                            <select class="form-select" id="semester" name="semester" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tahun_ajaran" class="form-label">Tahun Ajaran *</label>
                            <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" placeholder="2025/2026" required>
                        </div>

                        <div class="d-flex justify-content-start gap-2">
                            <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                            <a href="index.php" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
document.getElementById('nilai').addEventListener('input', function() {
    const nilai = parseFloat(this.value);
    const huruf = document.getElementById('nilai_huruf');
    if (nilai >= 85) {
        huruf.value = 'A';
    } else if (nilai >= 70) {
        huruf.value = 'B';
    } else if (nilai >= 55) {
        huruf.value = 'C';
    } else if (nilai >= 0) {
        huruf.value = 'D';
    } else {
        huruf.value = '';
    }
});
</script>

<?php include '../template/footer.php'; ?>