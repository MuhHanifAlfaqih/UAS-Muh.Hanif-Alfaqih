<?php

require_once '../check_auth.php';
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = $_POST['id'];
$nama_kelas = $_POST['nama_kelas'];
$tingkat = $_POST['tingkat'];
$jurusan = $_POST['jurusan'];
$kapasitas = $_POST['kapasitas'];
$keterangan = $_POST['keterangan'];

try {
    $stmt = $pdo->prepare("UPDATE kelas SET nama_kelas = ?, tingkat = ?, jurusan = ?, kapasitas = ?, keterangan = ? WHERE id = ?");
    $stmt->execute([$nama_kelas, $tingkat, $jurusan, $kapasitas, $keterangan, $id]);
    
    $_SESSION['success'] = "Data kelas berhasil diupdate!";
    header('Location: index.php');
    exit;
} catch (PDOException $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
    header('Location: edit.php?id=' . $id);
    exit;
}
?>
