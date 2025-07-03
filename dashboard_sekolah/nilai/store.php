<?php
session_start();
require_once '../check_auth.php';
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$siswa_id = intval($_POST['siswa_id']);
$mata_pelajaran_id = intval($_POST['mata_pelajaran_id']);
$jenis_nilai = $_POST['jenis_nilai'];
$nilai = floatval($_POST['nilai']);
$nilai_huruf = trim($_POST['nilai_huruf']);
$keterangan = trim($_POST['keterangan']);
$tanggal_nilai = $_POST['tanggal_nilai'];
$semester = $_POST['semester'];
$tahun_ajaran = trim($_POST['tahun_ajaran']);

if (!$siswa_id || !$mata_pelajaran_id || !$jenis_nilai || !$nilai || !$tanggal_nilai || !$semester || !$tahun_ajaran) {
    $_SESSION['error'] = 'Field bertanda * wajib diisi!';
    header('Location: create.php');
    exit;
}

$stmt = mysqli_prepare($conn, "INSERT INTO nilai (siswa_id, mata_pelajaran_id, jenis_nilai, nilai, nilai_huruf, keterangan, tanggal_nilai, semester, tahun_ajaran) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'iisdsssss', $siswa_id, $mata_pelajaran_id, $jenis_nilai, $nilai, $nilai_huruf, $keterangan, $tanggal_nilai, $semester, $tahun_ajaran);
mysqli_stmt_execute($stmt);

$_SESSION['success'] = 'Nilai berhasil ditambahkan!';
header('Location: index.php');
exit;
?>
