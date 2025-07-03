<?php

require_once '../check_auth.php';
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = intval($_POST['id']);
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
    header('Location: edit.php?id=' . $id);
    exit;
}

$stmt = mysqli_prepare($conn, "UPDATE nilai SET siswa_id=?, mata_pelajaran_id=?, jenis_nilai=?, nilai=?, nilai_huruf=?, keterangan=?, tanggal_nilai=?, semester=?, tahun_ajaran=? WHERE id=?");
mysqli_stmt_bind_param($stmt, 'iisdsssssi', $siswa_id, $mata_pelajaran_id, $jenis_nilai, $nilai, $nilai_huruf, $keterangan, $tanggal_nilai, $semester, $tahun_ajaran, $id);
mysqli_stmt_execute($stmt);

$_SESSION['success'] = 'Nilai berhasil diupdate!';
header('Location: index.php');
exit;
?>
