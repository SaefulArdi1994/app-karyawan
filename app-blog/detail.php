<?php 

require 'function.php';

// mengambil id dari url
$id = $_GET['id'];

// query blog berdasarkan id
$blog = query("SELECT * FROM blog WHERE id = $id" );
// var_dump($blog);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Blog - Detail</title>
</head>
<body>
    <header>
        <h1>Welcome to Our Website</h1>
        <p>Everything you need, is here !</p>
    </header>

    <nav>
        <a href="index.php">Home</a>
        <a href="#">Blogs</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
        <a href="#">Login</a>  
    </nav>

    <main>

        <form action="">
            <input type="text">
            <button>Search</button>
        </form>

        <section>
            <img src="img/<?= $blog['gambar']?>" width="200" alt="">
            <h2><?= $blog['judul'] ?></h2>
            <span><h4><?= $blog['waktu'] ?></h4></span>
            <td>
                <a href="edit.php?id=<?= $blog['id'];?>">Edit</a> | 
                <a href="delete.php?id=<?= $blog['id'];?>">Hapus</a></td>

            <p> <?= $blog['konten'] ?></p>
            <p><?= $blog['kategori'] ?></p>
        </section>


    </main>

    <footer>
        <p>
            <p>&copy; 2024 Semantic HTML Landing Page. All rights reserved.</p>    
        </p>
    </footer>
</body>
</html>