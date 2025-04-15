<?php
include 'db.php';

$sql = "SELECT pilihan, COUNT(*) AS jumlah FROM survey GROUP BY pilihan";
$result = $conn->query($sql);

// Buat array dengan header Google Charts
$data = [["Pilihan", "Jumlah"]];

while ($row = $result->fetch_assoc()) {
    $data[] = [$row["pilihan"], (int)$row["jumlah"]];
}

echo json_encode($data);
?>
