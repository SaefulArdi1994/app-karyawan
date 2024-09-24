<?php 

function koneksi()
{
    return mysqli_connect('localhost','root','','db_karyawan');
}

function query($query)
{
    $conn = koneksi();
    $result = mysqli_query($conn, $query);

    // jika hanya 1 data
    if(mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    }
    

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}   

function tambah($data)
{
    // var_dump($data);
    $conn = koneksi();

    $nik = htmlspecialchars($data['nik']);
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $bagian = htmlspecialchars($data['bagian']);
    $gambar = htmlspecialchars($data['gambar']);

    $query = "INSERT INTO 
                karyawan 
                VALUES 
                (null, '$nik', '$nama', '$email', '$bagian', '$gambar');
            ";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM karyawan WHERE id = $id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function edit($data)
{
    // var_dump($data);
    $conn = koneksi();

    $id = $data['id'];
    $nik = htmlspecialchars($data['nik']);
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $bagian = htmlspecialchars($data['bagian']);
    $gambar = htmlspecialchars($data['gambar']);

    $query = "UPDATE karyawan SET 
                nik = '$nik',
                nama = '$nama',
                email = '$email',
                bagian = '$bagian',
                gambar = '$gambar'
                WHERE id = $id
            ";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}


?>