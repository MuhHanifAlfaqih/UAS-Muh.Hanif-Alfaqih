<?php

require_once '../check_auth.php';
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = intval($_POST['id']);
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
    header('Location: edit.php?id=' . $id);
    exit;
}

$stmt = mysqli_prepare($conn, "UPDATE mata_pelajaran SET kode_mapel=?, nama_mapel=?, guru_pengampu=?, jam_pelajaran=?, semester=?, tingkat=?, kkm=?, deskripsi=? WHERE id=?");
mysqli_stmt_bind_param($stmt, 'sssissisi', $kode_mapel, $nama_mapel, $guru_pengampu, $jam_pelajaran, $semester, $tingkat, $kkm, $deskripsi, $id);
mysqli_stmt_execute($stmt);

$_SESSION['success'] = 'Mata pelajaran berhasil diupdate!';
header('Location: index.php');
exit;
?>
