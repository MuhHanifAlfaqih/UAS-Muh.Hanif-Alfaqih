<?php
require_once '../check_auth.php';
require_once '../config/database.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $nip = trim($_POST['nip']);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $nomor_hp = trim($_POST['nomor_hp']);

    if ($nama && $nip && $jenis_kelamin && $tanggal_lahir && $nomor_hp) {
        $stmt = mysqli_prepare($conn, "UPDATE guru SET nama=?, nip=?, jenis_kelamin=?, tanggal_lahir=?, nomor_hp=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'sssssi', $nama, $nip, $jenis_kelamin, $tanggal_lahir, $nomor_hp, $id);
        
        if (mysqli_stmt_execute($stmt)) {
            header('Location: index.php?success=Data guru berhasil diupdate');
        } else {
            header('Location: edit.php?id=' . $id . '&error=Gagal mengupdate data guru');
        }
    } else {
        header('Location: edit.php?id=' . $id . '&error=Semua field harus diisi');
    }
} else {
    header('Location: edit.php?id=' . $id);
}
exit;
?>

