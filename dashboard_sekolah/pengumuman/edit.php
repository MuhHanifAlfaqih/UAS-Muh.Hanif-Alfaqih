<?php
require_once '../check_auth.php';
require_once '../config/database.php';
include '../template/header.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM pengumuman WHERE id = $id LIMIT 1");
$pengumuman = mysqli_fetch_assoc($result);

if (!$pengumuman) {
    header('Location: index.php?error=Data tidak ditemukan');
    exit;
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../template/sidebar.php'; ?>

        <main class="col-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h4 fw-bold">Edit Pengumuman</h1>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_GET['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="update.php?id=<?= $pengumuman['id']; ?>" method="POST">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Pengumuman</label>
                            <input type="text" class="form-control" id="judul" name="judul" 
                                   value="<?= htmlspecialchars($pengumuman['judul']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="isi" class="form-label">Isi Pengumuman</label>
                            <textarea class="form-control" id="isi" name="isi" rows="6" required><?= htmlspecialchars($pengumuman['isi']); ?></textarea>
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