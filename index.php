<?php
// Sesuaikan dengan pengaturan MySQL
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

// Mengambil seluruh data dari tabel kependudukan
$sql = "SELECT * FROM data_geoportal";
$result = $conn->query($sql);

// Menampilkan link untuk menambahkan data
echo "<a href='input/index.html'>Input Data</a>";

// Memeriksa apakah terdapat data
if ($result && $result->num_rows > 0) {

    echo "<table border='1'>
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
            <td>" . ($row["ogc_fid"]) . "</td>
            <td>" . ($row["kemantren"]) . "</td>
            <td>" . ($row["kelurahan"]) . "</td>
            <td align='right'>" . ($row["longitude"]) . "</td>
            <td align='right'>" . ($row["latitude"]) . "</td>
            <td align='right'>" . ($row["alamat"]) . "</td>
            <td>
                <a href='delete.php?id=" .($row["ogc_fid"]) . "'>Hapus</a>
            </td>
            <td>
                <a href='edit/index.php?id=" .($row["ogc_fid"]) . "'>Edit</a>
            </td>
        </tr>";
    }

    echo "</table>";

} else {
    echo "0 results";
}

// Menutup koneksi database
$conn->close();
?>
