<?php
$message = "";
if(count($_POST)){
    if (empty($_POST['login']) or empty($_POST['password'])) {
        $message = 'Заполните поля';
    } else {
        $db = include ("db.php");
        $configs = include('config.php');
        $domain = $configs['domain'];
        if(!$db){
            die(('failed ' . mysqli_connect_error()));
        }
        $loginLength = strlen($_POST['login']);

        if($loginLength > 20 or !(preg_match('/^([0-9a-zA-Z-_.]{3,20})$/', $_POST['login']))){
            $message = "Введите не меньше 3 и не более 20 символов <br/> Используйте латиницу";
        }
        else{
            $login = $_POST['login'];
            $password = $_POST['password'];

            $login = trim($login);
            $password = trim($password);
            $db_login = mysqli_real_escape_string($db, $login);

            $result = mysqli_query($db, "SELECT id FROM users WHERE login=('$db_login')");

            $myrow = mysqli_fetch_array($result);

            if(!empty($myrow['id'])){
                $message = "Логин занят";
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $result2 = mysqli_query($db,"INSERT INTO users (login, password) VALUES ('$db_login', '$password')");

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
            <input name="login" placeholder="Введите логин" type="text" maxlength="20" size="20" />
            <input name="password" placeholder="Введите пароль" type="password" maxlength="20" size="20">
            <span class="message"><?php echo $message; ?></span>
            <input value="Зарегистрироваться" class="submit" type="submit">
            <span>
                Уже зарегистрированы? <a href="auth.php">Войдите</a>
            </span>
        </form>
    </div>
</body>
</html>