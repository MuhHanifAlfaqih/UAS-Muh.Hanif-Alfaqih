<?php
require_once '../check_auth.php';
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_galeri = trim($_POST['nama_galeri']);
    $deskripsi = trim($_POST['deskripsi']);
    
    // Validasi input
    if (empty($nama_galeri) || empty($deskripsi)) {
        header('Location: create.php?error=Semua field harus diisi');
        exit;
    }
    
    // Handle file upload
    $thumbnail = '';
    if (isset($_FILES['thumbnail'])) {
        // Debug upload error
        if ($_FILES['thumbnail']['error'] != 0) {
            $error_messages = [
                1 => 'File terlalu besar (server limit)',
                2 => 'File terlalu besar (form limit)', 
                3 => 'File hanya sebagian terupload',
                4 => 'Tidak ada file yang diupload',
                6 => 'Folder temporary tidak ditemukan',
                7 => 'Gagal menulis file ke disk',
                8 => 'Upload dihentikan oleh ekstensi'
            ];
            $error_msg = isset($error_messages[$_FILES['thumbnail']['error']]) 
                        ? $error_messages[$_FILES['thumbnail']['error']] 
                        : 'Error upload tidak dikenal: ' . $_FILES['thumbnail']['error'];
            header('Location: create.php?error=' . urlencode($error_msg));
            exit;
        }
        
        // Validasi tipe file (lebih fleksibel)
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
        $file_extension = strtolower(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION));
        
        if (!in_array($file_extension, $allowed_extensions)) {
            header('Location: create.php?error=Format file tidak diizinkan. Gunakan JPG, PNG, GIF, BMP, atau WEBP');
            exit;
        }
        
        // Create uploads directory if not exists
        $upload_dir = '../assets/uploads/';
        if (!is_dir($upload_dir)) {
            if (!mkdir($upload_dir, 0755, true)) {
                header('Location: create.php?error=Gagal membuat folder upload');
                exit;
            }
        }
        
        // Generate unique filename
        $thumbnail = 'gallery_' . time() . '_' . uniqid() . '.' . $file_extension;
        $upload_path = $upload_dir . $thumbnail;
        
        if (!move_uploaded_file($_FILES['thumbnail']['tmp_name'], $upload_path)) {
            header('Location: create.php?error=Gagal memindahkan file ke folder upload');
            exit;
        }
    } else {
        header('Location: create.php?error=File thumbnail harus diupload');
        exit;
    }
    
    // Insert to database
    $stmt = mysqli_prepare($conn, "INSERT INTO gallery (nama_galeri, deskripsi, thumbnail) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'sss', $nama_galeri, $deskripsi, $thumbnail);
    
    if (mysqli_stmt_execute($stmt)) {
        header('Location: index.php?success=Gallery berhasil ditambahkan');
    } else {
        // Delete uploaded file if database insert fails
        if ($thumbnail && file_exists($upload_dir . $thumbnail)) {
            unlink($upload_dir . $thumbnail);
        }
        header('Location: create.php?error=Gagal menambahkan gallery');
    }
} else {
    header('Location: create.php');
}
exit;
?>
