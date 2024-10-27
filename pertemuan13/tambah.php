<?php 

// Session
session_start();

if (!isset($_SESSION['login'])) {
    header("location: login.php");
    exit;
}

require 'function.php';

// cek apakah tombol tambah sudah di tekan
if(isset($_POST['tambah'])) {
    if(tambah($_POST) > 0) {
        echo "  <script>
                    alert('Data berhasil ditambahkan');
                    document.location.href = 'index.php';
                </script>";
    } else {
        echo "Data gagal ditambahkan";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Data Karyawan</title>
</head>
<body>

<h3>Tambah Karyawan</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="">
                    NIK :
                    <input type="text" name="nik" autofocus required>
                </label>
            </li>
            <li>
                <label for="">
                    Nama : 
                    <input type="text" name="nama" required>
                </label>
            </li>
            <li>
                <label for="">
                    Email :
                    <input type="text" name="email" required>
                </label>
            </li>
            <li>
                <label for="">
                    Bagian :
                    <input type="text" name="bagian" required>
                </label>
            </li>
            <li>
                <label for="">
                    Gambar :
                    <input type="file" name="gambar">
                </label>
            </li>
            <li>
                <button type="submit" name="tambah">
                    Tambah Data
                </button>
            </li>
        </ul>
    </form>
</body>
</html>