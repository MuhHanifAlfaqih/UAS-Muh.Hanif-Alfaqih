<?php
session_start();
require_once '../check_auth.php';
require_once '../config/database.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = intval($_GET['id']);

mysqli_query($conn, "DELETE FROM nilai WHERE id=$id");
$_SESSION['success'] = 'Nilai berhasil dihapus!';
header('Location: index.php');
exit;
