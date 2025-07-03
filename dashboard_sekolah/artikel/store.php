<?php
require_once '../check_auth.php';
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul']);
    $kategori = trim($_POST['kategori']);
    $penulis = trim($_POST['penulis']);
    $status = trim($_POST['status']);
    $konten = trim($_POST['konten']);

    // Validasi input
    if (empty($judul) || empty($kategori) || empty($penulis) || empty($status) || empty($konten)) {
        header('Location: create.php?error=Semua field harus diisi');
        exit;
    }
    
    // Validasi status
    if (!in_array($status, ['draft', 'published'])) {
        header('Location: create.php?error=Status tidak valid');
        exit;
    }
    
    // Insert to database
    $stmt = mysqli_prepare($conn, "INSERT INTO artikel (judul, kategori, penulis, status, konten) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'sssss', $judul, $kategori, $penulis, $status, $konten);
    
    if (mysqli_stmt_execute($stmt)) {
        header('Location: index.php?success=Artikel berhasil ditambahkan');
    } else {
        header('Location: create.php?error=Gagal menambahkan artikel');
    }
} else {
    header('Location: create.php');
}
exit;
?>
