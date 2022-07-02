<?php
    session_start();
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

    $servername = "localhost";
    $database = "qwe";
    $username = "root";
    $db = mysqli_connect($servername, $username, "", $database);

    $result = mysqli_query($db, "SELECT * FROM users WHERE login='$login'");


    $myrow = mysqli_fetch_array($result);

    if(empty($myrow['password']))
    {
        exit ("Извините, введеный вами логин или пароль неверный");
    }
    else{
        if($myrow['password'] == $password){
            $_SESSION['login'] = $myrow['login'];
            $_SESSION['id'] = $myrow['id'];
            setcookie("login", $login, time() + 2592000);
            setcookie("password", $password, time() + 2592000);
            header("Location: http://qwerty/index.php");
            echo "Вы успешно вошли на сайт!";
        }
        else{
            exit("Извините введеный вами пароль уже занят");
        }
    }







