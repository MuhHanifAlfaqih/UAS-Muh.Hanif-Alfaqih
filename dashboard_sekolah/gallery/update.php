<?php
require_once '../check_auth.php';
require_once '../config/database.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = intval($_GET['id']);

// Get current data
$result = mysqli_query($conn, "SELECT * FROM gallery WHERE id = $id LIMIT 1");
$gallery = mysqli_fetch_assoc($result);
if (!$gallery) {
    header('Location: index.php?error=Data tidak ditemukan');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_galeri = trim($_POST['nama_galeri']);
    $deskripsi = trim($_POST['deskripsi']);
    $current_thumbnail = $gallery['thumbnail'];
    
    // Validasi input
    if (empty($nama_galeri) || empty($deskripsi)) {
        header('Location: edit.php?id=' . $id . '&error=Semua field harus diisi');
        exit;
    }
    
    // Handle file upload if new file is uploaded
    $thumbnail = $current_thumbnail;
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
        // Validasi tipe file (lebih fleksibel, tanpa batasan ukuran)
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
        $file_extension = strtolower(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION));
        
        if (!in_array($file_extension, $allowed_extensions)) {
            header('Location: edit.php?id=' . $id . '&error=Format file tidak diizinkan. Gunakan JPG, PNG, GIF, BMP, atau WEBP');
            exit;
        }
        
        // Create uploads directory if not exists
        $upload_dir = '../assets/uploads/';
        if (!is_dir($upload_dir)) {
            if (!mkdir($upload_dir, 0755, true)) {
                header('Location: edit.php?id=' . $id . '&error=Gagal membuat folder upload');
                exit;
            }
        }
        
        // Generate unique filename
        $file_extension = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
        $new_thumbnail = 'gallery_' . time() . '_' . uniqid() . '.' . $file_extension;
        $upload_path = $upload_dir . $new_thumbnail;
        
        if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $upload_path)) {
            // Delete old thumbnail if exists
            if ($current_thumbnail && file_exists($upload_dir . $current_thumbnail)) {
                unlink($upload_dir . $current_thumbnail);
            }
            $thumbnail = $new_thumbnail;
        } else {
            header('Location: edit.php?id=' . $id . '&error=Gagal mengupload file');
            exit;
        }
    }
    
    // Update database
    $stmt = mysqli_prepare($conn, "UPDATE gallery SET nama_galeri=?, deskripsi=?, thumbnail=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'sssi', $nama_galeri, $deskripsi, $thumbnail, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        header('Location: index.php?success=Gallery berhasil diupdate');
    } else {
        header('Location: edit.php?id=' . $id . '&error=Gagal mengupdate gallery');
    }
} else {
    header('Location: edit.php?id=' . $id);
}
exit;
?>
