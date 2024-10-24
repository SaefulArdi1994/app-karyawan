<?php 
require '../function.php';
$karyawan = cari($_GET['keyword']);

?>

<table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>#</th>
                <th>Gambar</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>

            <?php if (empty($karyawan)) : ?>

                <tr>
                    <td colspan="5" align="center">
                        <p>Data karyawan tidak ditemukan!</p>
                    </td>
                </tr>
            
            <?php endif ; ?>

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