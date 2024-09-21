<?php 

require 'function.php';

// ambil id dari url
$id = $_GET['id'];

// query karyawan berdasarkan id
$karyawan = query("SELECT * FROM karyawan WHERE id = $id");
// var_dump($karyawan);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Karyawan</title>
</head>
<body>
    <h3>Detail Karyawan</h3>
    <ul>
        <li><img src="../img/<?= $karyawan['gambar']?>" width="100" alt=""></li>
        <li>Nik : <?= $karyawan['nik']?></li>
        <li>Nama : <?= $karyawan['nama']?></li>
        <li>Email : <?= $karyawan['email']?></li>
        <li>Bagian : <?= $karyawan['bagian']?></li>
        <li>Edit | Hapus</li>
    </ul>
</body>
</html>