<?php
    session_start();
    setcookie("login", null, time() - 2592000);
    setcookie("password", null, time() - 2592000);
    $message = "";
    if(count($_POST)){
    if(empty($_POST['login']) or empty($_POST['password'])){
        $message = "Заполните все поля";
    }
    else{
        $configs = include('config.php');
        $domain = $configs['domain'];

        $loginLength = strlen($_POST['login']);

        if($loginLength > 20 or !(preg_match('/^([0-9a-zA-Z-_.]{3,20})$/', $_POST['login']))){
            $message = "Введите не меньше 3 и не более 20 символов <br/> Используйте латиницу";
        }
        else{
            $login = $_POST['login'];

            $password = $_POST['password'];

            $login = trim($login);
            $password = trim($password);

            $db = include ("db.php");

            $db_login = mysqli_real_escape_string($db, $login);

            $result = mysqli_query($db, "SELECT * FROM users WHERE login=('$db_login')");


            $myrow = mysqli_fetch_array($result);

            if(empty($myrow['password']))
            {
                $message = ("Извините, введеный вами логин или пароль неверный");
            }
            else{
                if(password_verify($password, $myrow['password'])){
                    setcookie("login", $login, time() + 2592000);
                    setcookie("password", $myrow['password'], time() + 2592000);
                    header("Location: http://$domain/index.php");
                    exit();
                }
                else{
                    $message = "Извините введеный вами пароль неверный";
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
            <h2>Авторизация</h2>
            <input placeholder="login" name="login" type="text" maxlength="20" size="20"/>
            <input placeholder="password" name="password" type="password" maxlength="20" size="20"/>
            <span class="message">
                <?php echo $message; ?>
            </span>
            <input type="submit" value="Войти">
            <span>
            Ещё не зарегистрированы? <a href="registration.php">Зарегистрируйтесь</a>
            </span>
        </form>
    </div>
    <a href="index.php">Регистрация</a>
    <br/>
    </body>
</html>
