<?php
session_start();
require_once '../check_auth.php';
require_once '../config/database.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

try {
    // Cek apakah kelas memiliki siswa
    $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM siswa WHERE kelas_id = ?");
    $stmt_check->execute([$id]);
    $count_siswa = $stmt_check->fetchColumn();
    
    if ($count_siswa > 0) {
        $_SESSION['error'] = "Kelas tidak dapat dihapus karena masih memiliki siswa!";
        header('Location: index.php');
        exit;
    }
    
    $stmt = $pdo->prepare("DELETE FROM kelas WHERE id = ?");
    $stmt->execute([$id]);
    
    $_SESSION['success'] = "Data kelas berhasil dihapus!";
    header('Location: index.php');
    exit;
} catch (PDOException $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
    header('Location: index.php');
    exit;
}
?>
