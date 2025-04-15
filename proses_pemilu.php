<?php
$conn = new mysqli("localhost", "root", "", "db_pemilu");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$nama = $_POST['nama'];
$calon = $_POST['calon'];

// Cek apakah sudah pernah memilih
$cek = $conn->query("SELECT * FROM pemilih WHERE nama='$nama'");

if ($cek->num_rows > 0) {
    $row = $cek->fetch_assoc();

    if ($row['sudah_memilih']) {
        echo "Anda sudah memilih!";
    } else {
        // Simpan suara dan update status memilih
        $conn->query("INSERT INTO suara (id_pemilih, calon) VALUES ({$row['id']}, '$calon')");
        $conn->query("UPDATE pemilih SET sudah_memilih=1 WHERE id={$row['id']}");
        echo "Terima kasih telah memilih!";
    }

} else {
    // Tambahkan pemilih baru dan simpan suara
    $conn->query("INSERT INTO pemilih (nama, sudah_memilih) VALUES ('$nama', 1)");
    $id = $conn->insert_id;
    $conn->query("INSERT INTO suara (id_pemilih, calon) VALUES ($id, '$calon')");
    echo "Terima kasih telah memilih!";
}
?>
