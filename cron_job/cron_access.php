<?php

require __DIR__ . '/../config.php';

$password = Admin_Password;

session_start();

if (!isset($_SESSION['loggedIn'])) {
    $_SESSION['loggedIn'] = false;
}
if (isset($_POST['submit']) && isset($_POST['password'])) {
    if (($_POST['password']) == $password) {
        $_SESSION['loggedIn'] = true;
        header('Location: xkcd_comic.php');
        exit();
    }
}

if ($_SESSION['loggedIn'] != true) : ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
    </head>

    <body>
        <p>Admin protected page.</p>
        <form method="post">
            Password: <input type="password" name="password"> <br />
            <input type="submit" name="submit" value="Access">
        </form>
    </body>

    </html>

<?php
    exit;
endif;
?>