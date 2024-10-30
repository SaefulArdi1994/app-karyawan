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

?>