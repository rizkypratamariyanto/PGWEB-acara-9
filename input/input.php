```php
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ogc_fid = $_POST['ogc_fid'];
    $kemantren = $_POST['kemantren'];
    $kelurahan = $_POST['kelurahan'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $alamat = $_POST['alamat'];

    // Koneksi database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "studi_kasus";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query INSERT
    $sql = "INSERT INTO data_geoportal
            (ogc_fid, kemantren, kelurahan, longitude, latitude, alamat)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "issdds",
        $ogc_fid,
        $kemantren,
        $kelurahan,
        $longitude,
        $latitude,
        $alamat
    );

    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

} else {
    // Jika dibuka langsung, kembali ke halaman utama
    header("Location: ../index.php");
    exit();
}
?>
```