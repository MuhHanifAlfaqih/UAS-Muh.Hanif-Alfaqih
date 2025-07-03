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
    $deskripsi = trim($_POST['deskripsi']);
    $pembina = trim($_POST['pembina']);
    $ketua = trim($_POST['ketua']);
    $jadwal = trim($_POST['jadwal']);

    if ($nama && $deskripsi && $pembina && $ketua && $jadwal) {
        $stmt = mysqli_prepare($conn, "UPDATE ekstrakurikuler SET nama=?, deskripsi=?, pembina=?, ketua=?, jadwal=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'sssssi', $nama, $deskripsi, $pembina, $ketua, $jadwal, $id);
        
        if (mysqli_stmt_execute($stmt)) {
            header('Location: index.php?success=Data ekstrakurikuler berhasil diupdate');
        } else {
            header('Location: edit.php?id=' . $id . '&error=Gagal mengupdate data ekstrakurikuler');
        }
    } else {
        header('Location: edit.php?id=' . $id . '&error=Semua field harus diisi');
    }
} else {
    header('Location: edit.php?id=' . $id);
}
exit;
?>
