<?php
    session_start();
    setcookie("login", null, time() - 2592000);
    setcookie("password", null, time() - 2592000);
    $message = "";
    if(count($_POST)){
    if(!$_POST['login'] or !$_POST['password']){
        $message = "Заполните все поля";
    }
    else{
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
?>
<html>
    <head>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
    <div class="cont">
        <form class="form" method="post">
            <h2>Авторизация</h2>
            <input placeholder="login" name="login" type="text" maxlength="15" size="15"/>
            <input placeholder="password" name="password" type="password" maxlength="15" size="15"/>
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
