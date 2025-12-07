<?php
require_once 'config.php';

echo "Testing koneksi database...<br>";
echo "Host: " . DB_HOST . "<br>";
echo "Database: " . DB_NAME . "<br>";
echo "User: " . DB_USER . "<br>";

if ($conn) {
    echo "<strong style='color: green;'>✓ Koneksi berhasil!</strong>";
} else {
    echo "<strong style='color: red;'>✗ Koneksi gagal!</strong>";
}
?>