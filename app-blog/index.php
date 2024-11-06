<?php 

require 'function.php';

$blogs = query("SELECT * FROM blog" );

// Ketika tombol cari di klik
if (isset($_POST['search'])) {
    $blogs = search($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Blog</title>
</head>
<body>
    <header>
        <h1>Welcome to Our Website</h1>
        <p>Everything you need, is here !</p>
    </header>

    <nav>
        <a href="#">Home</a>
        <a href="#">Blogs</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
        <a href="#">Login</a>  
    </nav>

    <main>

        

        <a href="add.php">Artikel Baru</a>

        <form action="" method="POST">
            <input type="text" name="keyword" size="30" placeholder="Masukan keyword pencarian" autocomplete="off" autofocus>
            <button type="submit" name="search">Search</button>
        </form>

        <?php if (empty($blogs)) : ?>

            <tr>
                <td colspan="5" align="center">
                    <p>Artikel tidak ditemukan!</p>
                </td>
            </tr>

        <?php endif ; ?>

        <?php $i = 1; foreach($blogs as $blog) : ?>

        <section>
            <a href="detail.php?id=<?= $blog['id']?>">
                <h2><?= $blog['judul'] ?></h2>
            </a>
            <span>
                <h4><?= $blog['waktu'] ?></h4>
                

            </span>
            <div>
                <p> <?= $blog['konten'] ?></p>
            </div>
            <?= $blog['kategori'] ?>
        </section>

        <?php endforeach ; ?>

    </main>

    <footer>
        <p>
            <p>&copy; 2024 Semantic HTML Landing Page. All rights reserved.</p>    
        </p>
    </footer>
</body>
</html>