<?php
    session_start();
    $login = $_COOKIE['login'];
    if ($login == ""){
        header("Location: http://qwerty/registration.php");
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
    <h2>Привет, <?php
    echo $login;
    ?>
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

