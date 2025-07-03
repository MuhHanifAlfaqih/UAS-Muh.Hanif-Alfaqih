<?php
require_once '../check_auth.php';
require_once '../config/database.php';
include '../template/header.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM gallery WHERE id = $id LIMIT 1");
$gallery = mysqli_fetch_assoc($result);
if (!$gallery) {
    header('Location: index.php?error=Data tidak ditemukan');
    exit;
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../template/sidebar.php'; ?>

        <main class="col-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h4 fw-bold">Edit Gallery</h1>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_GET['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="update.php?id=<?= $gallery['id']; ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama_galeri" class="form-label">Nama Gallery</label>
                            <input type="text" class="form-control" id="nama_galeri" name="nama_galeri" value="<?= htmlspecialchars($gallery['nama_galeri']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required><?= htmlspecialchars($gallery['deskripsi']); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail</label>
                            <?php if ($gallery['thumbnail'] && file_exists('../assets/uploads/' . $gallery['thumbnail'])): ?>
                                <div class="mb-2">
                                    <img src="/dashboard_sekolah/assets/uploads/<?= htmlspecialchars($gallery['thumbnail']); ?>" 
                                         alt="Current thumbnail" class="img-thumbnail" style="max-width: 200px;">
                                    <p class="text-muted">Thumbnail saat ini</p>
                                </div>
                            <?php endif; ?>
                            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                            <div class="form-text">
                                Format: JPG, JPEG, PNG, GIF, BMP, WEBP. Kosongkan jika tidak ingin mengubah thumbnail.
                            </div>
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