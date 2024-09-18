<?php 
// <!-- Koneksi Database -->
$conn = mysqli_connect('localhost','root','','db_karyawan');

// <!-- Query isi table karyawan -->
$result = mysqli_query($conn, "SELECT * FROM karyawan");

// <!-- Ubahdata ke dalam array -->
// $row = mysqli_fetch_row($result); // array numerik
// $row = mysqli_fetch_assoc($result) // array associative
// $row = mysqli_fetch_all($result) // keduanya
$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}
// <!-- Tampung ke variable karyawan -->

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
</head>
<body>
    <h3>Daftar Karyawan</h3>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>#</th>
            <th>Gambar</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Bagian</th>
            <th>Departemen</th>
            <th>Aksi</th>
        </tr>
        <tr>
            <td>1</td>
            <td><img src="../app-karyawan/img/epl.png" alt=""></td>
            <td>123456</td>
            <td>Saeful Ardi</td>
            <td>saeful.ardi@test.com</td>
            <td>Produksi</td>
            <td>Produksi</td>
            <td><a href="">Edit</a> | <a href="">Hapus</a></td>
        </tr>
    </table>
</body>
</html>