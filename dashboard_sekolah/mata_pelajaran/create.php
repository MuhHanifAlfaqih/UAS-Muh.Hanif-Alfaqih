<?php
require_once '../check_auth.php';
require_once '../config/database.php';

$title = 'Tambah Mata Pelajaran';
include '../template/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../template/sidebar.php'; ?>

        <main class="col-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h4 fw-bold">Tambah Mata Pelajaran</h1>
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
                            <label for="kode_mapel" class="form-label">Kode Mapel</label>
                            <input type="text" class="form-control" id="kode_mapel" name="kode_mapel" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_mapel" class="form-label">Nama Mapel</label>
                            <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" required>
                        </div>
                        <div class="mb-3">
                            <label for="guru_pengampu" class="form-label">Guru Pengampu</label>
                            <input type="text" class="form-control" id="guru_pengampu" name="guru_pengampu" required>
                        </div>
                        <div class="mb-3">
                            <label for="jam_pelajaran" class="form-label">Jam Pelajaran</label>
                            <input type="number" class="form-control" id="jam_pelajaran" name="jam_pelajaran" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-select" id="semester" name="semester" required>
                                <option value="">Pilih Semester</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tingkat" class="form-label">Tingkat</label>
                            <select class="form-select" id="tingkat" name="tingkat" required>
                                <option value="">Pilih Tingkat</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kkm" class="form-label">KKM</label>
                            <input type="number" class="form-control" id="kkm" name="kkm" min="0" value="75" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="2"></textarea>
                        </div>
                        <div class="d-flex justify-content-start gap-2">
                            <button type="submit" class="btn btn-primary">Simpan Mapel</button>
                            <a href="index.php" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../template/footer.php'; ?>
