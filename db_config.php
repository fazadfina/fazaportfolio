<?php
// Konfigurasi database
$host = "127.0.0.1";
$user = "root";
$password = ""; // Sesuaikan dengan password MySQL
$database = "portofolio";

// Koneksi ke database
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
<?php
// Konfigurasi database
$host = "127.0.0.1";
$user = "root";
$password = ""; // Sesuaikan dengan password MySQL
$database = "portofolio";

// Koneksi ke database
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
