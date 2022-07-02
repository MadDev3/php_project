<?php
    $servername = "localhost";
    $database = "qwe";
    $username = "root";
    $password = "";
    $db = mysqli_connect("localhost", "root", "", $database);

    if(!$db){
        die(('failed ' . mysqli_connect_error()));
    }

    echo "Connected success";

    if(isset($_POST['login'])) {
        $login = $_POST['login'];
        if($login == ''){
            unset($login);
        }
    }

    if(isset($_POST['password'])){
        $password = $_POST['password'];
        if($password == ''){
            unset($password);
        }
    }

    if(empty($login) or empty($password)){
        exit("Вы ввели не всю инфу, вернитесь!");
    }

    $login = stripcslashes($login);
    $login = htmlspecialchars($login);
    $password = stripcslashes($password);
    $password = htmlspecialchars($password);
    $login = trim($login);
    $password = trim($password);

    $result = mysqli_query($db, "SELECT id FROM users WHERE login='$login'");

    $myrow = mysqli_fetch_array($result);

    if(!empty($myrow['id'])){
        exit("Логин занят");
    }

    $result2 = mysqli_query($db,"INSERT INTO users (login, password) VALUES ('$login', '$password')");

    if($result2 == 'TRUE'){
        setcookie("login", $login, time() + 2592000);
        setcookie("password", $password, time() + 2592000);
        header("Location: http://qwerty/index.php");
        exit();
    }
    else{
        echo "Ошибка!";
    }