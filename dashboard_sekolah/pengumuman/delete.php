<?php
require_once '../check_auth.php';
require_once '../config/database.php';

// Periksa apakah ID ada
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);

// Periksa apakah data ada
$check_query = "SELECT id FROM pengumuman WHERE id = $id LIMIT 1";
$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) == 0) {
    header('Location: index.php?error=Data tidak ditemukan');
    exit;
}

// Hapus data
$delete_query = "DELETE FROM pengumuman WHERE id = $id";

if (mysqli_query($conn, $delete_query)) {
    header('Location: index.php?success=Pengumuman berhasil dihapus');
} else {
    header('Location: index.php?error=Gagal menghapus pengumuman: ' . mysqli_error($conn));
}
exit;
?>