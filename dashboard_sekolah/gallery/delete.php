<?php
require_once '../check_auth.php';
require_once '../config/database.php';

// Periksa apakah ID ada
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);

// Get data gallery untuk menghapus file thumbnail
$result = mysqli_query($conn, "SELECT thumbnail FROM gallery WHERE id = $id LIMIT 1");
$gallery = mysqli_fetch_assoc($result);

if (!$gallery) {
    header('Location: index.php?error=Data tidak ditemukan');
    exit;
}

// Hapus data dari database
$delete_query = "DELETE FROM gallery WHERE id = $id";

if (mysqli_query($conn, $delete_query)) {
    // Hapus file thumbnail jika ada
    if ($gallery['thumbnail'] && file_exists('../assets/uploads/' . $gallery['thumbnail'])) {
        unlink('../assets/uploads/' . $gallery['thumbnail']);
    }
    header('Location: index.php?success=Gallery berhasil dihapus');
} else {
    header('Location: index.php?error=Gagal menghapus gallery: ' . mysqli_error($conn));
}
exit;
?>
