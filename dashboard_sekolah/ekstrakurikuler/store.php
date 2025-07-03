<?php
require_once '../check_auth.php';
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $deskripsi = trim($_POST['deskripsi']);
    $pembina = trim($_POST['pembina']);
    $ketua = trim($_POST['ketua']);
    $jadwal = trim($_POST['jadwal']);

    // Validasi input
    if ($nama && $deskripsi && $pembina && $ketua && $jadwal) {
        $stmt = mysqli_prepare($conn, "INSERT INTO ekstrakurikuler (nama, deskripsi, pembina, ketua, jadwal) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'sssss', $nama, $deskripsi, $pembina, $ketua, $jadwal);
        
        if (mysqli_stmt_execute($stmt)) {
            header('Location: index.php?success=Data ekstrakurikuler berhasil ditambahkan');
        } else {
            header('Location: create.php?error=Gagal menambahkan data ekstrakurikuler');
        }
    } else {
        header('Location: create.php?error=Semua field harus diisi');
    }
} else {
    header('Location: create.php');
}
exit;
?>
