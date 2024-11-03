<?php 

require 'function.php';

// cek apakah tombol sudah di tekan
if(isset($_POST['tambah'])) {
    if(tambah($_POST) > 0) {
        echo "  <script>
                    alert('Data berhasil ditambahkan');
                    document.location.href = 'latihan3.php';
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
    <title>App Blog - Tambah Artikel</title>
</head>
<body>
    <h3>Tambah Artikel</h3>

    <form action="" method="POST">
        
        <ul>
            <li>
                <label>
                    Judul 
                    <input type="text" name="judul" require autofocus>
                </label>
            </li>
            <li>
                <label>
                    Kategori 
                    <input type="text" name="kategori" require autofocus>
                </label>
            </li>
            <li>
                <label>
                    Konten 
                    <textarea name="konten" id=""></textarea>
                </label>
            </li>
            <li>
                <label>
                    Gambar 
                    <input type="text" name="gambar">
                </label>
            </li>
            <li>
                <button type="submit" name="tambah">
                    Tambah Artikel
                </button>
            </li>
        </ul>
    </form>
</body>
</html>