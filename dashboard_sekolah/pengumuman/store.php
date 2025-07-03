<?php
require_once '../check_auth.php';
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    
    // Validasi input
    if (empty($judul) || empty($isi)) {
        header('Location: create.php?error=Semua field harus diisi');
        exit;
    }
    
    $query = "INSERT INTO pengumuman (judul, isi) VALUES ('$judul', '$isi')";
    
    if (mysqli_query($conn, $query)) {
        header('Location: index.php?success=Pengumuman berhasil ditambahkan');
    } else {
        header('Location: create.php?error=Gagal menambahkan pengumuman: ' . mysqli_error($conn));
    }
} else {
    header('Location: create.php');
}
exit;
?>
