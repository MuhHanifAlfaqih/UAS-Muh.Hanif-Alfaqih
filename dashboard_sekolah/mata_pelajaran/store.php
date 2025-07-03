<?php
session_start();
require_once '../check_auth.php';
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$kode_mapel = trim($_POST['kode_mapel']);
$nama_mapel = trim($_POST['nama_mapel']);
$guru_pengampu = trim($_POST['guru_pengampu']);
$jam_pelajaran = intval($_POST['jam_pelajaran']);
$semester = $_POST['semester'];
$tingkat = $_POST['tingkat'];
$kkm = intval($_POST['kkm']);
$deskripsi = trim($_POST['deskripsi']);

if (!$kode_mapel || !$nama_mapel || !$guru_pengampu || !$jam_pelajaran || !$semester || !$tingkat || !$kkm) {
    $_SESSION['error'] = 'Semua field wajib diisi!';
    header('Location: create.php');
    exit;
}

// Cek kode_mapel unik
$cek = mysqli_query($conn, "SELECT id FROM mata_pelajaran WHERE kode_mapel='$kode_mapel'");
if (mysqli_num_rows($cek) > 0) {
    $_SESSION['error'] = 'Kode Mapel sudah digunakan!';
    header('Location: create.php');
    exit;
}

$stmt = mysqli_prepare($conn, "INSERT INTO mata_pelajaran (kode_mapel, nama_mapel, guru_pengampu, jam_pelajaran, semester, tingkat, kkm, deskripsi) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'sssissis', $kode_mapel, $nama_mapel, $guru_pengampu, $jam_pelajaran, $semester, $tingkat, $kkm, $deskripsi);
mysqli_stmt_execute($stmt);

$_SESSION['success'] = 'Mata pelajaran berhasil ditambahkan!';
header('Location: index.php');
exit;
?>
