<?php
require_once '../check_auth.php';
require_once '../config/database.php';
include '../template/header.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM artikel WHERE id = $id LIMIT 1");
$artikel = mysqli_fetch_assoc($result);
if (!$artikel) {
    header('Location: index.php?error=Data tidak ditemukan');
    exit;
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../template/sidebar.php'; ?>

        <main class="col-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h4 fw-bold">Edit Artikel</h1>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_GET['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="update.php?id=<?= $artikel['id']; ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Artikel</label>
                                    <input type="text" class="form-control" id="judul" name="judul" 
                                           value="<?= htmlspecialchars($artikel['judul']); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-select" id="kategori" name="kategori" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="Berita" <?= $artikel['kategori'] == 'Berita' ? 'selected' : ''; ?>>Berita</option>
                                        <option value="Pendidikan" <?= $artikel['kategori'] == 'Pendidikan' ? 'selected' : ''; ?>>Pendidikan</option>
                                        <option value="Prestasi" <?= $artikel['kategori'] == 'Prestasi' ? 'selected' : ''; ?>>Prestasi</option>
                                        <option value="Kegiatan" <?= $artikel['kategori'] == 'Kegiatan' ? 'selected' : ''; ?>>Kegiatan</option>
                                        <option value="Informasi" <?= $artikel['kategori'] == 'Informasi' ? 'selected' : ''; ?>>Informasi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="draft" <?= $artikel['status'] == 'draft' ? 'selected' : ''; ?>>Draft</option>
                                        <option value="published" <?= $artikel['status'] == 'published' ? 'selected' : ''; ?>>Published</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" class="form-control" id="penulis" name="penulis" 
                                   value="<?= htmlspecialchars($artikel['penulis']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="konten" class="form-label">Konten Artikel</label>
                            <textarea class="form-control" id="konten" name="konten" rows="10" required><?= htmlspecialchars($artikel['konten']); ?></textarea>
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