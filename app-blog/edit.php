<?php 

require 'function.php';

// ambil id dari url
$id = $_GET['id'];

$blog = query("SELECT * FROM blog WHERE id = $id");

// cek apakah tombol sudah di tekan
if(isset($_POST['edit'])) {
    if(tambah($_POST) > 0) {
        echo "  <script>
                    alert('Data berhasil diedit');
                    document.location.href = 'index.php';
                </script>";
    } else {
        echo "Data gagal diedit";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Blog - Edit Artikel</title>
</head>
<body>
    <h3>Tambah Artikel</h3>

    <form action="" method="POST">

        <input type="hidden" name="id" value="<?= $blog['id'] ?>">
        <ul>
            <li>
                <label>
                    Judul 
                    <input type="text" name="judul" value="<?= $blog['judul']?>" required autofocus>
                </label>
            </li>
            <li>
                <label>
                    Kategori 
                    <input type="text" name="kategori" value="<?= $blog['kategori']?>" required autofocus>
                </label>
            </li>
            <li>
                <label>
                    Konten 
                    <textarea name="konten" id="konten"><?= $blog['konten']?></textarea>
                </label>
            </li>
            <li>
                <label>
                    Gambar 
                    <input type="text" name="gambar" value="<?= $blog['gambar']?>">
                </label>
            </li>
            <li>
                <button type="submit" name="edit">
                    Edit Artikel
                </button>
            </li>
        </ul>
    </form>
</body>
</html>