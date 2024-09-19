<?php 
// <!-- Koneksi Database -->
$conn = mysqli_connect('localhost','root','','db_karyawan');

// <!-- Query isi table karyawan -->
$result = mysqli_query($conn, "SELECT * FROM karyawan");

// <!-- Ubahdata ke dalam array -->
// $row = mysqli_fetch_row($result); // array numerik
// $row = mysqli_fetch_assoc($result) // array associative
// $row = mysqli_fetch_array($result) // keduanya
$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}
// <!-- Tampung ke variable karyawan -->
$karyawan = $rows;

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
            <th>Aksi</th>
        </tr>

        <?php $i = 1;
        foreach($karyawan as $kry) : ?>
        <tr>
            <td><?= $i++?></td>
            <td><img src="img/<?= $kry['gambar'] ?>" width="100" ></td>
            <td> <?= $kry['nik'] ?> </td>
            <td> <?= $kry['nama'] ?> </td>
            <td> <?= $kry['email'] ?> </td>
            <td> <?= $kry['bagian'] ?> </td>
            <td><a href="">Edit</a> | <a href="">Hapus</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>