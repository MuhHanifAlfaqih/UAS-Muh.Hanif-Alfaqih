<?php
require_once '../check_auth.php';
include '../template/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../template/sidebar.php'; ?>

        <main class="col-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h4 fw-bold">Tambah Ekstrakurikuler</h1>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_GET['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="store.php" method="post">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Ekstrakurikuler</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="pembina" class="form-label">Pembina</label>
                            <input type="text" class="form-control" id="pembina" name="pembina" required>
                        </div>

                        <div class="mb-3">
                            <label for="ketua" class="form-label">Ketua</label>
                            <input type="text" class="form-control" id="ketua" name="ketua" required>
                        </div>

                        <div class="mb-3">
                            <label for="jadwal" class="form-label">Jadwal</label>
                            <input type="text" class="form-control" id="jadwal" name="jadwal" placeholder="Contoh: Senin, 15.00-17.00" required>
                        </div>

                        <div class="d-flex justify-content-start gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="index.php" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../template/footer.php'; ?>