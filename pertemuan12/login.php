<?php 

// menjalankan session
session_start();

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

require 'function.php';

// Ketika tombol login ditekan
if (isset($_POST['login'])) {
    $login = login($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h3>Form Login</h3>

    <?php if (isset($login['error'])) : ?>
        <p><?= $login['pesan']; ?></p>
    <?php endif ; ?>

    <form action="" method="POST">
        <ul>
            <li>
                <label for="">
                    Username :
                    <input type="text" name="username" autofocus autocomplete="off" require>
                </label>
            </li>
            <li>
                <label for="">Password : </label>
                <input type="password" name="password" require>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>

</body>
</html>