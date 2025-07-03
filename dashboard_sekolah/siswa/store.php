<?php
session_start();
require_once '../check_auth.php';
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$nis = trim($_POST['nis']);
$nama_lengkap = trim($_POST['nama_lengkap']);
$kelas_id = intval($_POST['kelas_id']);
$jenis_kelamin = $_POST['jenis_kelamin'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$alamat = trim($_POST['alamat']);
$no_hp = trim($_POST['no_hp']);
$email = trim($_POST['email']);
$nama_wali = trim($_POST['nama_wali']);
$status = $_POST['status'];
$tanggal_masuk = $_POST['tanggal_masuk'];

// Validasi sederhana
if (!$nis || !$nama_lengkap || !$kelas_id || !$jenis_kelamin || !$tanggal_lahir || !$alamat || !$nama_wali || !$status || !$tanggal_masuk) {
    $_SESSION['error'] = 'Semua field wajib diisi!';
    header('Location: create.php');
    exit;
}

// Cek NIS unik
$cek = mysqli_query($conn, "SELECT id FROM siswa WHERE nis='$nis'");
if (mysqli_num_rows($cek) > 0) {
    $_SESSION['error'] = 'NIS sudah digunakan!';
    header('Location: create.php');
    exit;
}

$stmt = mysqli_prepare($conn, "INSERT INTO siswa (nis, nama_lengkap, kelas_id, jenis_kelamin, tanggal_lahir, alamat, no_hp, email, nama_wali, status, tanggal_masuk) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'ssissssssss', $nis, $nama_lengkap, $kelas_id, $jenis_kelamin, $tanggal_lahir, $alamat, $no_hp, $email, $nama_wali, $status, $tanggal_masuk);
mysqli_stmt_execute($stmt);

$_SESSION['success'] = 'Data siswa berhasil ditambahkan!';
header('Location: index.php');
exit;
?>
