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

function tambah ($data)
{
    $conn = koneksi();

    $judul = htmlspecialchars($data['judul']);
    $kategori = htmlspecialchars($data['kategori']);
    $konten = htmlspecialchars($data['konten']);
    $gambar = htmlspecialchars($data['gambar']);

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

?>