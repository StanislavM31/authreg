<?php
var_dump($_COOKIE);
require_once __DIR__ . '/classes/Auth.php';
require_once __DIR__ . '/classes/CookieHandler.php';

$auth = new Auth();
$cookieHandler = new CookieHandler();
?>

<html>

<head>
    <title>Авторизация</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
</head>

<body>
    <?php $cookieHandler->displayCookies(); ?>
    
<?php if ($cookieHandler->getUsername() !== null) : ?>
    Добро пожаловать, <?= $cookieHandler->getUsername() ?>
    <form method="post" action="logout_process.php">
        <button type="submit">Разлогиниться</button>
    </form>
    <?php else : ?>
        <div class="container">
            <h3>Авторизуйтесь</h3>
            <form method="post" action="login_process.php">
                <label for="login">Логин</label>
                <input type="text" id="login" name="login" placeholder="Логин" required><br>

                <label for="password">Пароль</label>
                <input type="text" id="password" name="password" placeholder="Пароль" required><br>

                <button type="submit">Войти</button>
            </form>
            <p>Еще не зарегистрированы?
                <a href="registration.php">Зарегистрироваться</a>
            </p>
        </div>
    <?php endif; ?>

</body>

</html>