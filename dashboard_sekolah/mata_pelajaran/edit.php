<?php
require_once '../check_auth.php';
require_once '../config/database.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = intval($_GET['id']);

$result = mysqli_query($conn, "SELECT * FROM mata_pelajaran WHERE id=$id");
$mapel = mysqli_fetch_assoc($result);
if (!$mapel) {
    header('Location: index.php');
    exit;
}

$title = 'Edit Mata Pelajaran';
include '../template/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../template/sidebar.php'; ?>

        <main class="col-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h4 fw-bold">Edit Mata Pelajaran</h1>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="update.php" method="POST">
                        <input type="hidden" name="id" value="<?= $mapel['id'] ?>">

                        <div class="mb-3">
                            <label for="kode_mapel" class="form-label">Kode Mapel</label>
                            <input type="text" class="form-control" id="kode_mapel" name="kode_mapel" value="<?= htmlspecialchars($mapel['kode_mapel']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama_mapel" class="form-label">Nama Mapel</label>
                            <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" value="<?= htmlspecialchars($mapel['nama_mapel']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="guru_pengampu" class="form-label">Guru Pengampu</label>
                            <input type="text" class="form-control" id="guru_pengampu" name="guru_pengampu" value="<?= htmlspecialchars($mapel['guru_pengampu']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="jam_pelajaran" class="form-label">Jam Pelajaran</label>
                            <input type="number" class="form-control" id="jam_pelajaran" name="jam_pelajaran" min="1" value="<?= htmlspecialchars($mapel['jam_pelajaran']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-select" id="semester" name="semester" required>
                                <option value="1" <?= $mapel['semester'] == '1' ? 'selected' : '' ?>>1</option>
                                <option value="2" <?= $mapel['semester'] == '2' ? 'selected' : '' ?>>2</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tingkat" class="form-label">Tingkat</label>
                            <select class="form-select" id="tingkat" name="tingkat" required>
                                <option value="10" <?= $mapel['tingkat'] == '10' ? 'selected' : '' ?>>10</option>
                                <option value="11" <?= $mapel['tingkat'] == '11' ? 'selected' : '' ?>>11</option>
                                <option value="12" <?= $mapel['tingkat'] == '12' ? 'selected' : '' ?>>12</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="kkm" class="form-label">KKM</label>
                            <input type="number" class="form-control" id="kkm" name="kkm" min="0" value="<?= htmlspecialchars($mapel['kkm']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="2"><?= htmlspecialchars($mapel['deskripsi']) ?></textarea>
                        </div>

                        <div class="d-flex justify-content-start gap-2">
                            <button type="submit" class="btn btn-primary">Update Mapel</button>
                            <a href="index.php" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../template/footer.php'; ?>