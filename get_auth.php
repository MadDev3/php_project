<?php
    session_start();
    $configs = include('config.php');
    $domain = $configs['domain'];

    if(isset($_POST['login'])){
        $login = $_POST['login'];
        if ($login == ''){
            unset($login);
        }
    }

    if(isset($_POST['password'])){
        $password = $_POST['password'];
        if($password == ''){
            unset($password);
        }
    }

    if(empty($login) or empty($password))
    {
        exit("Вы ввели не всю инфу");
    }

    $login = stripcslashes($login);
    $login = htmlspecialchars($login);
    $login = trim($login);

    $password = stripcslashes($password);
    $password = htmlspecialchars($password);
    $password = trim($password);

    $db = include ("db.php");

    $result = mysqli_query($db, "SELECT * FROM users WHERE login='$login'");


    $myrow = mysqli_fetch_array($result);

    if(empty($myrow['password']))
    {
        exit ("Извините, введеный вами логин или пароль неверный");
    }
    else{
        if(password_verify($password, $myrow['password'])){
            setcookie("login", $login, time() + 2592000);
            setcookie("password", $myrow['password'], time() + 2592000);
            header("Location: http://$domain/index.php");
            echo "Вы успешно вошли на сайт!";
        }
        else{
            exit("Извините введеный вами пароль уже занят");
        }
    }







