<?php
include 'db.php';

$nama = $_POST['nama'];
$usia = $_POST['usia'];
$pilihan = $_POST['pilihan'];

$stmt = $conn->prepare("INSERT INTO survey (nama, usia, pilihan) VALUES (?, ?, ?)");
$stmt->bind_param("sis", $nama, $usia, $pilihan);
$stmt->execute();

echo "Survei berhasil disimpan! <br><a href='index.html'>Kembali</a>";
?>
