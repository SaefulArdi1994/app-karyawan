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

function upload() 
{

    // var_dump($_FILES);
    $nama_file = $_FILES['gambar']['name'];
    $tipe_file = $_FILES['gambar']['type'];
    $ukuran_file = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmp_file = $_FILES['gambar']['tmp_name'];

    // ketika tidak ada gambar yang dipilih
    if($error == 4) {
        echo "<script>
                alert('Pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    // cek ekstensi file
    $daftar_gambar = ['jpg', 'jpeg', 'png'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file = strtolower(end($ekstensi_file));
    // var_dump($ekstensi_file); die;
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
    move_uploaded_file($tmp_file, 'image/' . $nama_file_baru);

    return $nama_file_baru;

}

function tambah($data)
{
    // var_dump($data);
    $conn = koneksi();

    $nik = htmlspecialchars($data['nik']);
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $bagian = htmlspecialchars($data['bagian']);
    // $gambar = htmlspecialchars($data['gambar']);

    // upload
    $gambar = upload(); 
    if (!$gambar) {
        return false;
    }

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

    // upload
    $gambar = upload(); 
    if (!$gambar) {
        return false;
    }
    
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