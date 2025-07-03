<?php
require_once '../check_auth.php';
require_once '../config/database.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kelas = trim($_POST['nama_kelas']);
    $tingkat = trim($_POST['tingkat']);
    $jumlah_siswa = intval($_POST['jumlah_siswa']);
    $wali_kelas = trim($_POST['wali_kelas']);
    $ruangan = trim($_POST['ruangan']);

    if ($nama_kelas && $tingkat) {
        $stmt = mysqli_prepare($conn, "UPDATE kelas SET nama_kelas=?, tingkat=?, jumlah_siswa=?, wali_kelas=?, ruangan=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'ssissi', $nama_kelas, $tingkat, $jumlah_siswa, $wali_kelas, $ruangan, $id);
        mysqli_stmt_execute($stmt);
        $_SESSION['success'] = 'Kelas berhasil diupdate!';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Nama kelas dan tingkat wajib diisi!';
    }
}

$result = mysqli_query($conn, "SELECT * FROM kelas WHERE id=$id");
$kelas = mysqli_fetch_assoc($result);
if (!$kelas) {
    header('Location: index.php');
    exit;
}

$title = 'Edit Kelas';
include '../template/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../template/sidebar.php'; ?>

        <main class="col-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h4 fw-bold">Edit Kelas</h1>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="nama_kelas" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="<?= htmlspecialchars($kelas['nama_kelas']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="tingkat" class="form-label">Tingkat</label>
                            <input type="text" class="form-control" id="tingkat" name="tingkat" value="<?= htmlspecialchars($kelas['tingkat']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_siswa" class="form-label">Jumlah Siswa</label>
                            <input type="number" class="form-control" id="jumlah_siswa" name="jumlah_siswa" min="0" value="<?= htmlspecialchars($kelas['jumlah_siswa']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="wali_kelas" class="form-label">Wali Kelas</label>
                            <input type="text" class="form-control" id="wali_kelas" name="wali_kelas" value="<?= htmlspecialchars($kelas['wali_kelas']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="ruangan" class="form-label">Ruangan</label>
                            <input type="text" class="form-control" id="ruangan" name="ruangan" value="<?= htmlspecialchars($kelas['ruangan']) ?>">
                        </div>
                        <div class="d-flex justify-content-start gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="index.php" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../template/footer.php'; ?>