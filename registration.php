<!doctype html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<div class="cont">
    <form class="form" action="save_user.php" method="post">
        <span class="title">Регистрация</span>
        <input name="login" placeholder="Введите логин" type="text" />
        <input name="password" placeholder="Введите пароль" type="password">
        <input value="Зарегистрироваться" class="submit" type="submit">
        <span>
            Уже зарегистрированы? <a href="auth.php">Войдите</a>
        </span>
    </form>
</div>
</body>
</html>