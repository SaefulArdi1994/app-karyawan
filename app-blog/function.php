<?php 

function koneksi()
{
    return mysqli_connect('localhost', 'root', '', 'db_blog');
}

function query($query) 
{
    $conn = koneksi();
    $result = mysqli_query($conn, $query);

    // memanggil 1 data
    if(mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    }

    // memanggil semua data
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
    }

    return $rows;
}

function upload()
{
    //var_dump($_FILES) or die;
    $nama_file      = $_FILES['gambar']['name'];
    $tipe_file      = $_FILES['gambar']['type'];
    $ukuran_file    = $_FILES['gambar']['size'];
    $error          = $_FILES['gambar']['tmp_name'];
    $tmp_file       = $_FILES['gambar']['tmp_name'];

    if(!$error == 4) {
        return 'profile.png';
    }

     // cek ekstensi file
     $daftar_gambar = ['jpg', 'jpeg', 'png'];
     $ekstensi_file = explode('.', $nama_file);
     $ekstensi_file = strtolower(end($ekstensi_file));

     if (!in_array($ekstensi_file, $daftar_gambar)) {
        echo "<script>
                alert('yang anda pilih bukan gambar!');
            </script>";
    return false;
    }

    // cek type file
    if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
        echo "<script>
                alert('file yang anda pilih bukanlah gambar!');
            </script>";
        return false;
    }

     // cek ukuran file 
    // maksimal 5mb = 50000000
    if  ($ukuran_file > 5000000)
    {
        echo "<script>
                alert('Ukuran terlalu besar!');
            </script>";
        return false;
    }

    // Lolos pengecekan
    // siap upload
    // generate nama file gambar baru
    $nama_file_baru = uniqid();
    $nama_file_baru .= '.';
    $nama_file_baru .= $ekstensi_file;
    move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);

    return $nama_file_baru;
}

function tambah ($data)
{
    $conn = koneksi();

    $judul = htmlspecialchars($data['judul']);
    $kategori = htmlspecialchars($data['kategori']);
    $konten = htmlspecialchars($data['konten']);
    //$gambar = htmlspecialchars($data['gambar']);

    $gambar = upload();
    if(!$gambar) {
        return false;
    }

    $query = "INSERT INTO blog VALUES (null,'$judul','$kategori','$konten','$gambar', CURRENT_TIMESTAMP)";

    mysqli_query($conn, $query);
    echo mysqli_error($conn);
    return mysqli_affected_rows($conn);
}

function edit($data)
{
    $conn = koneksi();

    $id = $data['id'];
    $judul = htmlspecialchars($data['judul']);
    $kategori = htmlspecialchars($data['kategori']);
    $konten = htmlspecialchars($data['konten']);
    $gambar = htmlspecialchars($data['gambar']);

    $query = "UPDATE blog SET 
                judul = '$judul',
                kategori = '$kategori',
                konten = '$konten',
                gambar = '$gambar'
                WHERE id = $id
            ";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function delete($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM blog WHERE id = $id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function search($keyword)
{
    $conn = koneksi();

    $query = " SELECT * FROM blog 
                WHERE
                judul LIKE '%$keyword%'
    ";

    $result = mysqli_query($conn, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

?>