<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'sekolah_db';

// MySQLi connection
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

// PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Koneksi PDO gagal: ' . $e->getMessage());
}
?>
