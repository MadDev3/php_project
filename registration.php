<?php
$message = "";
if(count($_POST)){
    if (!$_POST['login'] or !$_POST['password']) {
        $message = 'Заполните поля';
    } else {
        $db = include ("db.php");
        $configs = include('config.php');
        $domain = $configs['domain'];
        if(!$db){
            die(('failed ' . mysqli_connect_error()));
        }

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

        $login = trim($login);
        $password = trim($password);

        $result = mysqli_query($db, "SELECT id FROM users WHERE login='$login'");

        $myrow = mysqli_fetch_array($result);

        if(!empty($myrow['id'])){
            $message = "Логин занят";
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $result2 = mysqli_query($db,"INSERT INTO users (login, password) VALUES ('$login', '$password')");

            if($result2 == 'TRUE'){
                setcookie("login", $login, time() + 2592000);
                setcookie("password", $password, time() + 2592000);
                header("Location: http://$domain/index.php");
                exit();
            } else {
                echo "Ошибка hash!";
            }
        }


    }
}

?>
<html>
<head>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="cont">
        <form class="form" method="post">
            <span class="title">Регистрация</span>
            <input name="login" placeholder="Введите логин" type="text" />
            <input name="password" placeholder="Введите пароль" type="password">
            <span class="message"><?php echo $message; ?></span>
            <input value="Зарегистрироваться" class="submit" type="submit">
            <span>
                Уже зарегистрированы? <a href="auth.php">Войдите</a>
            </span>
        </form>
    </div>
</body>
</html>