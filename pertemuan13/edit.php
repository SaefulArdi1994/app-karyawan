<?php 

// Session
session_start();

if (!isset($_SESSION['login'])) {
    header("location: login.php");
    exit;
}

require 'function.php';

// jika tidak ada id di url
if(!isset($_GET['id'])) {
    header("location:index.php");
    exit;
}

// ambil id dari url
$id = $_GET['id'];

// query karyawan berdasarkan id
$karyawan = query("SELECT * FROM karyawan WHERE id = $id");
// var_dump($karyawan);

// cek apakah tombol edit sudah di tekan
if(isset($_POST['edit'])) {
    if(edit($_POST) > 0) {
        echo "  <script>
                    alert('Data berhasil di edit');
                    document.location.href = 'index.php';
                </script>";
    } else {
        echo "Data gagal di edit";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit Data Karyawan</title>
</head>
<body>

<h3>Edit Karyawan</h3>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $karyawan['id'];?>">
        <ul>
            <li>
                <label for="">
                    NIK :
                    <input type="text" name="nik" autofocus required  value="<?= $karyawan['nik']?>">
                </label>
            </li>
            <li>
                <label for="">
                    Nama : 
                    <input type="text" name="nama" required value="<?= $karyawan['nama']?>">
                </label>
            </li>
            <li>
                <label for="">
                    Email :
                    <input type="text" name="email" required value="<?= $karyawan['email']?>">
                </label>
            </li>
            <li>
                <label for="">
                    Bagian :
                    <input type="text" name="bagian" required value="<?= $karyawan['bagian']?>">
                </label>
            </li>
            <li>
                <label for="">
                    Gambar :
                    <input type="text" name="gambar" required value="<?= $karyawan['gambar']?>">
                </label>
            </li>
            <li>
                <button type="submit" name="edit">
                    Edit Data
                </button>
            </li>
        </ul>
    </form>
</body>
</html>