<?php
    session_start();
    $configs = include('config.php');
    $domain = $configs['domain'];
    $login = $_COOKIE['login'];
    $password = $_COOKIE['password'];

    if(!$login){
        header("Location: http://$domain/registration.php");
        exit();
    }

    $db = include ("db.php");
    $result = mysqli_query($db, "SELECT * FROM users WHERE login='$login'");
    $myrow = mysqli_fetch_array($result);

    $isAuth = $password == $myrow['password'] and $login == $myrow['login'];

    $username = htmlentities($login);

    if (!$isAuth){
        header("Location: http://$domain/registration.php");
        exit();
    }
?>
<!doctype html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<div class="cont">
    <h2>Привет, <?=$username?>
    </h2>
    <br/>
    <div>
    <a href="auth.php">Выйти</a>
    </div>
</div>
<?php

?>
</body>
</html>

