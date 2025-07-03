<?php
require_once '../check_auth.php';
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $nip = trim($_POST['nip']);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $nomor_hp = trim($_POST['nomor_hp']);

    // Validasi sederhana
    if ($nama && $nip && $jenis_kelamin && $tanggal_lahir && $nomor_hp) {
        $stmt = mysqli_prepare($conn, "INSERT INTO guru (nama, nip, jenis_kelamin, tanggal_lahir, nomor_hp) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'sssss', $nama, $nip, $jenis_kelamin, $tanggal_lahir, $nomor_hp);
        
        if (mysqli_stmt_execute($stmt)) {
            header('Location: index.php?success=Data guru berhasil ditambahkan');
        } else {
            header('Location: create.php?error=Gagal menambahkan data guru');
        }
    } else {
        header('Location: create.php?error=Semua field harus diisi');
    }
} else {
    header('Location: create.php');
}
exit;
?>
