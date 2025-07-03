<?php
require_once '../check_auth.php';
require_once '../config/database.php';

// Periksa apakah ID ada
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    
    // Validasi input
    if (empty($judul) || empty($isi)) {
        header('Location: edit.php?id=' . $id . '&error=Semua field harus diisi');
        exit;
    }
    
    $query = "UPDATE pengumuman SET judul = '$judul', isi = '$isi' WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        header('Location: index.php?success=Pengumuman berhasil diupdate');
    } else {
        header('Location: edit.php?id=' . $id . '&error=Gagal mengupdate pengumuman: ' . mysqli_error($conn));
    }
} else {
    header('Location: edit.php?id=' . $id);
}
exit;
?>