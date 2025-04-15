<?php
// Aktifkan error reporting untuk debugging
ini_set('display_errors', 1);  // Tampilkan error di browser
error_reporting(E_ALL);        // Tampilkan semua error

// Menghubungkan ke database
$con = mysqli_connect('localhost', 'root', '', 'pemilu_db');

// Memeriksa koneksi
if (!$con) {
    die('Koneksi gagal: ' . mysqli_connect_error()); // Menampilkan pesan kesalahan jika koneksi gagal
}

$sql = "SELECT nama, suara FROM calon";  // Query untuk mengambil nama calon dan jumlah suara
$result = mysqli_query($con, $sql);  // Menjalankan query

// Menangani jika query gagal
if (!$result) {
    die('Query Error: ' . mysqli_error($con));  // Menampilkan pesan kesalahan jika query gagal
}

// Membuat array untuk menampung data calon dan suara
$labels = [];  // Array untuk menyimpan nama calon
$data = [];    // Array untuk menyimpan jumlah suara

// Mengambil data dari query dan menyimpannya dalam array
while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['nama'];  // Menyimpan nama calon
    $data[] = $row['suara'];   // Menyimpan jumlah suara
}

// Menutup koneksi database
mysqli_close($con);

// Mengirim data dalam format JSON ke frontend
echo json_encode(['labels' => $labels, 'data' => $data]);
?>
