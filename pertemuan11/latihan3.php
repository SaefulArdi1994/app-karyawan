<?php 

require 'function.php';
// <!-- Tampung ke variable karyawan -->
$karyawan = query("SELECT * FROM karyawan");

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
            <th>Aksi</th>
        </tr>

        <?php $i = 1;
        foreach($karyawan as $kry) : ?>
        <tr>
            <td><?= $i++?></td>
            <td><img src="../img/<?= $kry['gambar'] ?>" width="100" ></td>
            <td> <?= $kry['nik'] ?> </td>
            <td> <?= $kry['nama'] ?> </td>
            <td>
                <a href="detail.php?id=<?= $kry['id']?>">Detail</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>