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

$nama = $_POST['nama'];
$email = $_POST['email'];
$calon_id = $_POST['calon_id'];

// Cek apakah pemilih sudah memilih sebelumnya
$sql = "SELECT * FROM pemilih WHERE email = '$email' AND sudah_memilih = 1";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "Anda sudah memilih sebelumnya.";
    mysqli_close($con);
    exit();
}

// Menyimpan data pemilih dan mencatat suara
$sql = "INSERT INTO pemilih (nama, email, sudah_memilih) VALUES ('$nama', '$email', 1)";
if (mysqli_query($con, $sql)) {
    // Menambah suara untuk calon yang dipilih
    $sql = "UPDATE calon SET suara = suara + 1 WHERE id = '$calon_id'";
    if (mysqli_query($con, $sql)) {
        echo "Terima kasih, suara Anda telah tercatat!";
    } else {
        echo "Terjadi kesalahan dalam penghitungan suara.";
    }
} else {
    echo "Gagal menyimpan data pemilih.";
}

mysqli_close($con);
?>
