<?php
require_once '../check_auth.php';
require_once '../config/database.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = intval($_GET['id']);

$result = mysqli_query($conn, "SELECT * FROM nilai WHERE id=$id");
$nilai = mysqli_fetch_assoc($result);
if (!$nilai) {
    header('Location: index.php');
    exit;
}

$result_siswa = mysqli_query($conn, "SELECT s.*, k.nama_kelas FROM siswa s LEFT JOIN kelas k ON s.kelas_id = k.id ORDER BY s.nama_lengkap");
$siswa_list = [];
while ($row = mysqli_fetch_assoc($result_siswa)) {
    $siswa_list[] = $row;
}

$result_mapel = mysqli_query($conn, "SELECT * FROM mata_pelajaran ORDER BY nama_mapel");
$mapel_list = [];
while ($row = mysqli_fetch_assoc($result_mapel)) {
    $mapel_list[] = $row;
}

$title = 'Edit Nilai';
include '../template/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../template/sidebar.php'; ?>

        <main class="col-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h4 fw-bold">Edit Nilai</h1>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="update.php" method="POST">
                        <input type="hidden" name="id" value="<?= $nilai['id'] ?>">

                        <div class="mb-3">
                            <label for="siswa_id" class="form-label">Siswa</label>
                            <select class="form-select" id="siswa_id" name="siswa_id" required>
                                <option value="">Pilih Siswa</option>
                                <?php foreach ($siswa_list as $siswa): ?>
                                    <option value="<?= $siswa['id'] ?>" <?= $siswa['id'] == $nilai['siswa_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($siswa['nama_lengkap']) ?> - <?= htmlspecialchars($siswa['nis']) ?> (<?= htmlspecialchars($siswa['nama_kelas'] ?? '-') ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="mata_pelajaran_id" class="form-label">Mata Pelajaran</label>
                            <select class="form-select" id="mata_pelajaran_id" name="mata_pelajaran_id" required>
                                <option value="">Pilih Mapel</option>
                                <?php foreach ($mapel_list as $mapel): ?>
                                    <option value="<?= $mapel['id'] ?>" <?= $mapel['id'] == $nilai['mata_pelajaran_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($mapel['nama_mapel']) ?> (<?= htmlspecialchars($mapel['kode_mapel']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jenis_nilai" class="form-label">Jenis Nilai</label>
                            <select class="form-select" id="jenis_nilai" name="jenis_nilai" required>
                                <option value="Tugas" <?= $nilai['jenis_nilai'] == 'Tugas' ? 'selected' : '' ?>>Tugas</option>
                                <option value="UTS" <?= $nilai['jenis_nilai'] == 'UTS' ? 'selected' : '' ?>>UTS</option>
                                <option value="UAS" <?= $nilai['jenis_nilai'] == 'UAS' ? 'selected' : '' ?>>UAS</option>
                                <option value="Harian" <?= $nilai['jenis_nilai'] == 'Harian' ? 'selected' : '' ?>>Harian</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nilai" class="form-label">Nilai</label>
                            <input type="number" step="0.01" class="form-control" id="nilai" name="nilai" min="0" max="100" value="<?= htmlspecialchars($nilai['nilai']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="nilai_huruf" class="form-label">Nilai Huruf</label>
                            <input type="text" class="form-control" id="nilai_huruf" name="nilai_huruf" maxlength="2" value="<?= htmlspecialchars($nilai['nilai_huruf']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2"><?= htmlspecialchars($nilai['keterangan']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_nilai" class="form-label">Tanggal Nilai</label>
                            <input type="date" class="form-control" id="tanggal_nilai" name="tanggal_nilai" value="<?= htmlspecialchars($nilai['tanggal_nilai']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-select" id="semester" name="semester" required>
                                <option value="1" <?= $nilai['semester'] == '1' ? 'selected' : '' ?>>1</option>
                                <option value="2" <?= $nilai['semester'] == '2' ? 'selected' : '' ?>>2</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                            <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" value="<?= htmlspecialchars($nilai['tahun_ajaran']) ?>" required>
                        </div>

                        <div class="d-flex justify-content-start gap-2">
                            <button type="submit" class="btn btn-primary">Update Nilai</button>
                            <a href="index.php" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../template/footer.php'; ?>