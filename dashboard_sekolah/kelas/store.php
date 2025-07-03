<?php
session_start();
require_once '../check_auth.php';
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$nama_kelas = $_POST['nama_kelas'];
$tingkat = $_POST['tingkat'];
$jurusan = $_POST['jurusan'];
$kapasitas = $_POST['kapasitas'];
$keterangan = $_POST['keterangan'] ?: null;

try {
    // Cek apakah nama kelas sudah ada
    $stmt_check = $pdo->prepare("SELECT id FROM kelas WHERE nama_kelas = ?");
    $stmt_check->execute([$nama_kelas]);
    if ($stmt_check->fetch()) {
        $_SESSION['error'] = "Nama kelas sudah digunakan!";
        header('Location: create.php');
        exit;
    }
    
    $stmt = $pdo->prepare("INSERT INTO kelas (nama_kelas, tingkat, jurusan, kapasitas, keterangan) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nama_kelas, $tingkat, $jurusan, $kapasitas, $keterangan]);
    
    $_SESSION['success'] = "Data kelas berhasil ditambahkan!";
    header('Location: index.php');
    exit;
} catch (PDOException $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
    header('Location: create.php');
    exit;
}
?>
