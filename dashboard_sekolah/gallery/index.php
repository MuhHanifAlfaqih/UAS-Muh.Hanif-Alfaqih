<?php
require_once '../check_auth.php';
require_once '../config/database.php';
include '../template/header.php';
include '../template/sidebar.php';

$result = mysqli_query($conn, "SELECT * FROM gallery ORDER BY dibuat_pada DESC");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Data Gallery</h3>
                <a href="create.php" class="btn btn-primary">+ Buat Gallery</a>
            </div>
            
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_GET['success']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_GET['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Thumbnail</th>
                                <th>Nama Gallery</th>
                                <th>Deskripsi</th>
                                <th>Dibuat Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <?php if($row['thumbnail'] && file_exists('../assets/uploads/' . $row['thumbnail'])): ?>
                                        <img src="/dashboard_sekolah/assets/uploads/<?= htmlspecialchars($row['thumbnail']); ?>" 
                                             alt="Thumbnail" class="img-thumbnail" style="max-width: 80px; max-height: 60px;">
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Tidak ada gambar</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($row['nama_galeri']); ?></td>
                                <td><?= nl2br(htmlspecialchars(substr($row['deskripsi'],0,60))) . (strlen($row['deskripsi'])>60?'...':''); ?></td>
                                <td><?= htmlspecialchars($row['dibuat_pada']); ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Ubah</a>
                                    <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../template/footer.php'; ?>
