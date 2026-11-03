
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

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Mengambil OGC FID dari URL
    $ogc_fid = $_GET['id'] ?? '';

    // Mengambil data berdasarkan COL 1
    // Menggunakan alias agar sesuai dengan nama variabel PHP
    $sql = "SELECT
                `COL 1` AS ogc_fid,
                `COL 2` AS kemantren,
                `COL 3` AS kelurahan,
                `COL 4` AS latitude,
                `COL 5` AS longitude,
                `COL 6` AS alamat
            FROM data_geoportal_fix
            WHERE `COL 1` = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ogc_fid);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        echo "<form action='edit.php' method='post'>";

        echo "<input type='hidden' name='ogc_fid' value='" .
            htmlspecialchars($row['ogc_fid']) . "'>";

        echo "Kemantren:<br>";
        echo "<input type='text' name='kemantren' value='" .
            htmlspecialchars($row['kemantren']) . "' required><br><br>";

        echo "Kelurahan:<br>";
        echo "<input type='text' name='kelurahan' value='" .
            htmlspecialchars($row['kelurahan']) . "' required><br><br>";

        echo "Longitude:<br>";
        echo "<input type='number' step='any' name='longitude' value='" .
            htmlspecialchars($row['longitude']) . "' required><br><br>";

        echo "Latitude:<br>";
        echo "<input type='number' step='any' name='latitude' value='" .
            htmlspecialchars($row['latitude']) . "' required><br><br>";

        echo "Alamat:<br>";
        echo "<input type='text' name='alamat' value='" .
            htmlspecialchars($row['alamat']) . "' required><br><br>";

        echo "<input type='submit' value='Simpan Perubahan'>";

        echo "</form>";

    } else {
        echo "Data tidak ditemukan.";
    }

    // Menutup koneksi
    $stmt->close();
    $conn->close();
    ?>

</body>
</html>
