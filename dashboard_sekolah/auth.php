<?php
session_start();
require_once './config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT id, nama, password FROM admins WHERE username = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) === 1) {
        mysqli_stmt_bind_result($stmt, $id, $nama, $hash);
        mysqli_stmt_fetch($stmt);
        if (password_verify($password, $hash)) {
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_nama'] = $nama;
            header('Location: dashboard.php');
            exit;
        }
    }
    // Jika gagal
    header('Location: index.php?error=Username atau password salah');
    exit;
} else {
    header('Location: index.php');
    exit;
}
