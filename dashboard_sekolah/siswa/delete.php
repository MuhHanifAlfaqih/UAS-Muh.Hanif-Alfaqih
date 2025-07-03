<?php
session_start();
require_once '../check_auth.php';
require_once '../config/database.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = intval($_GET['id']);

// Cek apakah siswa punya nilai
$cek = mysqli_query($conn, "SELECT COUNT(*) as jml FROM nilai WHERE siswa_id=$id");
$data = mysqli_fetch_assoc($cek);
if ($data['jml'] > 0) {
    $_SESSION['error'] = 'Siswa tidak dapat dihapus karena memiliki data nilai!';
    header('Location: index.php');
    exit;
}

mysqli_query($conn, "DELETE FROM siswa WHERE id=$id");
$_SESSION['success'] = 'Data siswa berhasil dihapus!';
header('Location: index.php');
exit;
