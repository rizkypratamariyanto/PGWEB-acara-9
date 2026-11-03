<?php

$ogc_fid = $_GET['id'];

// Koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studi_kasus";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Menghapus data berdasarkan OGC FID
$sql = "DELETE FROM data_geoportal WHERE ogc_fid = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ogc_fid);

if ($stmt->execute()) {
    echo "Record with OGC FID = $ogc_fid deleted successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Kembali ke halaman utama
header("Location: index.php");
exit();

?>