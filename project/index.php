<?php

require_once __DIR__ . '/classes/CookieHandler.php';
require_once __DIR__ . '/classes/Login.php';
require_once __DIR__ . '/classes/UserDbHandler.php';

$cookieHandler = new CookieHandler();
$loginFromCookie = $cookieHandler->getUsername();
$userDbHandler = new UserDbHandler();
$userName = $userDbHandler->getUserNameByLogin($loginFromCookie);
?>

<html>

<head>
    <title>Авторизация</title>
    <link rel="stylesheet" href="./style.css">
    <meta charset="UTF-8">
</head>

<body>
    <div class="container_info">
        <div class="cookie_display">
            <?php $cookieHandler->displayCookies(); ?>
        </div>
    </div>

    <?php if ($loginFromCookie !== null): ?>
        <div class="autorized_form">
            <form id="logoutForm" method="post">
                <div class="autorized_user">
                    Добро пожаловать, <?= $userName ?>
                </div>

                <ul>
                    <li><a href="./pages/harrypotter.php">Книги о Гарри Поттере</a></li>
                    <li><a href="./pages/cats.php">Виды кошек</a></li>
                </ul>

                <button type="submit">Разлогиниться</button>
                <button id="forgetMeButton" type="submit">Забыть меня</button>
            </form>
        </div>
    <?php else: ?>
        <div class="container">
            <h3>Авторизуйтесь</h3>
            <form id="authForm" method="post">
                <label for="login">Логин</label>
                <input type="text" id="login" name="login" placeholder="Логин" required><br>

                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" placeholder="Пароль" required><br>

                <button type="submit">Войти</button>
            </form>
            <p>Еще не зарегистрированы?
                <a href="registration_form.php">Зарегистрироваться</a>
            </p>
        </div>
    <?php endif; ?>
    <script src="./scripts/auth.js"></script>
</body>

</html>