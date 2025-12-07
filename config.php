<?php
// config.php - Konfigurasi Database dan Session
// File ini berisi koneksi database dan pengaturan session

// Start session untuk menyimpan data login user
session_start();

// ====================================
// KONFIGURASI DATABASE
// ====================================
// Sesuaikan dengan setting MySQL Anda
define('DB_HOST', 'localhost');        // Host database (biasanya localhost)
define('DB_USER', 'root');             // Username MySQL (default: root)
define('DB_PASS', '');                 // Password MySQL (default: kosong)
define('DB_NAME', 'admin_login_system');   // Nama database yang sudah dibuat

// ====================================
// KONEKSI DATABASE
// ====================================
try {
    // Buat koneksi ke MySQL menggunakan mysqli
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Cek apakah koneksi berhasil
    if ($conn->connect_error) {
        die("Koneksi ke database gagal: " . $conn->connect_error);
    }
    
    // Set charset ke utf8mb4 untuk support emoji dan karakter khusus
    $conn->set_charset("utf8mb4");
    
} catch (Exception $e) {
    // Tampilkan error jika terjadi kesalahan
    die("Error koneksi database: " . $e->getMessage());
}

// ====================================
// TIMEZONE (Opsional)
// ====================================
// Set timezone ke Jakarta
date_default_timezone_set('Asia/Jakarta');

// ====================================
// FUNGSI HELPER (Sudah tidak dipakai lagi)
// ====================================
// Fungsi-fungsi ini diganti dengan kode langsung di setiap file
// untuk menghindari error "Undefined function"

/*
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function redirect($url) {
    header("Location: $url");
    exit();
}

function sanitize($data) {
    global $conn;
    return $conn->real_escape_string(trim($data));
}
*/
?>