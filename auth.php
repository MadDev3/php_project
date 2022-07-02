<?php
    session_start();
    setcookie("login", null, time() - 2592000);
    setcookie("password", null, time() - 2592000);
?>
<html>
    <head>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
    <div class="cont">
        <form class="form" action="get_auth.php" method="post">
            <h2>Авторизация</h2>
            <input placeholder="login" name="login" type="text" maxlength="15" size="15"/>
            <input placeholder="password" name="password" type="password" maxlength="15" size="15"/>
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
