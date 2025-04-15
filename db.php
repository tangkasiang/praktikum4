<?php
$conn = new mysqli("localhost", "root", "", "db_survei", 3307); // ganti 3307 sesuai port kamu

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
