<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Edit Data Penduduk</title>
</head>
<body>

    <h2>Form Edit Data Penduduk</h2>

    <?php
    // Koneksi database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "studi_kasus";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Mengambil OGC FID dari URL
    $ogc_fid = $_GET['id'];

    // Mengambil data berdasarkan OGC FID
    $sql = "SELECT * FROM data_geoportal WHERE ogc_fid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ogc_fid);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        echo "<form action='edit.php' method='post' onsubmit='return validateForm()'>";

        echo "<input type='hidden' name='ogc_fid' value='" . $row['ogc_fid'] . "'>";

        echo "Kemantren:<br>";
        echo "<input type='text' name='kemantren' value='" . htmlspecialchars($row['kemantren']) . "' required><br><br>";

        echo "Kelurahan:<br>";
        echo "<input type='text' name='kelurahan' value='" . htmlspecialchars($row['kelurahan']) . "' required><br><br>";

        echo "Longitude:<br>";
        echo "<input type='number' step='any' name='longitude' value='" . $row['longitude'] . "' required><br><br>";

        echo "Latitude:<br>";
        echo "<input type='number' step='any' name='latitude' value='" . $row['latitude'] . "' required><br><br>";

        echo "Alamat:<br>";
        echo "<input type='text' name='alamat' value='" . htmlspecialchars($row['alamat']) . "' required><br><br>";

        echo "<p id='informasi'></p>";

        echo "<input type='submit' value='Simpan Perubahan'>";

        echo "</form>";

    } else {
        echo "Data tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
    ?>

</body>
</html>