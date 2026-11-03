
<?php
// Pengaturan koneksi MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studi_kasus";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data dari tabel data_geoportal_fix
// Mengubah nama COL 1 sampai COL 6 menggunakan alias
$sql = "SELECT
            `COL 1` AS ogc_fid,
            `COL 2` AS kemantren,
            `COL 3` AS kelurahan,
            `COL 4` AS latitude,
            `COL 5` AS longitude,
            `COL 6` AS alamat
        FROM data_geoportal_fix";

$result = $conn->query($sql);

// Menampilkan link input data
echo "<a href='input/index.html'>Input Data</a>";

// Memeriksa apakah query berhasil
if (!$result) {
    die("Query gagal: " . $conn->error);
}

// Memeriksa apakah terdapat data
if ($result->num_rows > 0) {

    echo "<table border='1' cellpadding='5'>
        <tr>
            <th>ogc_fid</th>
            <th>Kemantren</th>
            <th>Kelurahan</th>
            <th>Longitude</th>
            <th>Latitude</th>
            <th>Alamat</th>
            <th colspan='2'>Aksi</th>
        </tr>";

    // Menampilkan setiap baris data
    while ($row = $result->fetch_assoc()) {

        echo "<tr>
            <td>" . htmlspecialchars($row["ogc_fid"]) . "</td>
            <td>" . htmlspecialchars($row["kemantren"]) . "</td>
            <td>" . htmlspecialchars($row["kelurahan"]) . "</td>
            <td align='right'>" . htmlspecialchars($row["longitude"]) . "</td>
            <td align='right'>" . htmlspecialchars($row["latitude"]) . "</td>
            <td>" . htmlspecialchars($row["alamat"]) . "</td>
            <td>
                <a href='delete.php?id=" . urlencode($row["ogc_fid"]) . "'>Hapus</a>
            </td>
            <td>
                <a href='edit/index.php?id=" . urlencode($row["ogc_fid"]) . "'>Edit</a>
            </td>
        </tr>";
    }

    echo "</table>";

} else {
    echo "0 results";
}

// Menutup koneksi
$conn->close();
?>
