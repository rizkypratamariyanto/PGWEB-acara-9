
<?php

// Mengambil ID dari URL
$ogc_fid = $_GET['id'] ?? '';

// Koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studi_kasus";

$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Menghapus data berdasarkan kolom COL 1
$sql = "DELETE FROM data_geoportal_fix WHERE `COL 1` = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ogc_fid);

if ($stmt->execute()) {
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>
