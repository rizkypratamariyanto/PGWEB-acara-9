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

    // Query update data
    $sql = "UPDATE data_geoportal SET
            kemantren = ?,
            kelurahan = ?,
            longitude = ?,
            latitude = ?,
            alamat = ?
            WHERE ogc_fid = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssddsi",
        $kemantren,
        $kelurahan,
        $longitude,
        $latitude,
        $alamat,
        $ogc_fid
    );

    if ($stmt->execute()) {

        $stmt->close();
        $conn->close();

        header("Location: ../index.php");
        exit();

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: ../index.php");
    exit();
}

?>
```