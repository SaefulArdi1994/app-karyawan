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

function cari($keyword)
{
    $conn = koneksi();
    
    $query = "SELECT * FROM karyawan
                where 
                nama LIKE '%$keyword%' OR 
                nik LIKE '%$keyword%'
            ";

    $result = mysqli_query($conn, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function login($data) 
{

    $conn = koneksi();

    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);

    // ($username == 'admin' && $password == '12345')
    if ($user = query("SELECT * FROM user WHERE username = '$username'")) {
        //Cek Password
        if(password_verify($password, $user['password'])) {
            // set session
                $_SESSION['login'] = true;
                
                header("location: index.php");
                exit;
            } else {
                return [
                    'error' => true,
                    'pesan' => 'Username / Password Salah!'
                ];
            }
        }
        
}

function registrasi($data) 
{
    $conn = koneksi();

    $username = htmlspecialchars(strtolower($data['username']));
    $password1 = mysqli_real_escape_string($conn, $data['password1']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    // Jika username/passswor kosong
    if (empty($username) || empty($password1) || empty($password2)) {
        echo    "<script>
                    alert('username / password tidak boleh kosong!');
                    document.location.href = 'registrasi.php';
                </script>";
        return false;
    }

    // Jika username sudah terdaftar
    if(query("SELECT * FROM user WHERE username = '$username'")) {
        echo    "<script>
                    alert('username sudah terdaftar');
                    document.location.href = 'registrasi.php';
                </script>";
        return false;
    }

    if($password1 !== $password2) {
        echo    "<script>
                    alert('Pasword tidak sesuai');
                    document.location.href = 'registrasi.php';
                </script>";
        return false;
    }

    // jika password >5  digit 
    if (strlen($password1) < 5 ) {
        echo    "<script>
                    alert('password terlalu pendek!');
                    document.location.href = 'registrasi.php';
                </script>";
        return false;
    }

    // Jika username dan password sudah sesuai
    // Enkripsi password
    $password_baru = password_hash($password1, PASSWORD_DEFAULT);

    //Insert ke table user
    $query = "INSERT INTO user 
                VALUES
                (null, '$username', '$password_baru')
            ";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

?>