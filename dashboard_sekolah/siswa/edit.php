<?php
require_once '../check_auth.php';
require_once '../config/database.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM siswa WHERE id=$id");
$siswa = mysqli_fetch_assoc($result);
if (!$siswa) {
    header('Location: index.php');
    exit;
}

$result_kelas = mysqli_query($conn, "SELECT * FROM kelas ORDER BY nama_kelas");
$kelas_list = [];
while ($row = mysqli_fetch_assoc($result_kelas)) {
    $kelas_list[] = $row;
}

$title = 'Edit Siswa';
include '../template/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../template/sidebar.php'; ?>

        <main class="col-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h4 fw-bold">Edit Siswa</h1>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="update.php" method="POST">
                        <input type="hidden" name="id" value="<?= $siswa['id'] ?>">

                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis" value="<?= htmlspecialchars($siswa['nis']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= htmlspecialchars($siswa['nama_lengkap']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="kelas_id" class="form-label">Kelas</label>
                            <select class="form-select" id="kelas_id" name="kelas_id" required>
                                <option value="">Pilih Kelas</option>
                                <?php foreach ($kelas_list as $kelas): ?>
                                    <option value="<?= $kelas['id'] ?>" <?= $kelas['id'] == $siswa['kelas_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($kelas['nama_kelas']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="Laki-laki" <?= $siswa['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="Perempuan" <?= $siswa['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= htmlspecialchars($siswa['tanggal_lahir']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2" required><?= htmlspecialchars($siswa['alamat']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= htmlspecialchars($siswa['no_hp']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($siswa['email']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="nama_wali" class="form-label">Nama Wali</label>
                            <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="<?= htmlspecialchars($siswa['nama_wali']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Aktif" <?= $siswa['status'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                                <option value="Tidak Aktif" <?= $siswa['status'] == 'Tidak Aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                                <option value="Lulus" <?= $siswa['status'] == 'Lulus' ? 'selected' : '' ?>>Lulus</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?= htmlspecialchars($siswa['tanggal_masuk']) ?>" required>
                        </div>

                        <div class="d-flex justify-content-start gap-2">
                            <button type="submit" class="btn btn-primary">Update Siswa</button>
                            <a href="index.php" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../template/footer.php'; ?>