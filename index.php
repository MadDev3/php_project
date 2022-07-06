<?php
    session_start();
    $db = include ("db.php");
    $configs = include('config.php');
    $domain = $configs['domain'];
    $username = $_COOKIE['login'];
    $login = mysqli_real_escape_string($db, $username);
    $password = $_COOKIE['password'];

    if(!$login){
        header("Location: http://$domain/registration.php");
        exit();
    }


    $result = mysqli_query($db, "SELECT * FROM users WHERE login='$login'");
    $myrow = mysqli_fetch_array($result);

    $isAuth = $password == $myrow['password'] and $login == $myrow['login'];

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

