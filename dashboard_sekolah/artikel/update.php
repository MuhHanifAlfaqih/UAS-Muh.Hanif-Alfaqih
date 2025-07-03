<?php
require_once '../check_auth.php';
require_once '../config/database.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul']);
    $kategori = trim($_POST['kategori']);
    $penulis = trim($_POST['penulis']);
    $status = trim($_POST['status']);
    $konten = trim($_POST['konten']);

    // Validasi input
    if (empty($judul) || empty($kategori) || empty($penulis) || empty($status) || empty($konten)) {
        header('Location: edit.php?id=' . $id . '&error=Semua field harus diisi');
        exit;
    }
    
    // Validasi status
    if (!in_array($status, ['draft', 'published'])) {
        header('Location: edit.php?id=' . $id . '&error=Status tidak valid');
        exit;
    }
    
    // Update database
    $stmt = mysqli_prepare($conn, "UPDATE artikel SET judul=?, kategori=?, penulis=?, status=?, konten=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'sssssi', $judul, $kategori, $penulis, $status, $konten, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        header('Location: index.php?success=Artikel berhasil diupdate');
    } else {
        header('Location: edit.php?id=' . $id . '&error=Gagal mengupdate artikel');
    }
} else {
    header('Location: edit.php?id=' . $id);
}
exit;
?>
