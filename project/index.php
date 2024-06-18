<?php

require_once __DIR__ . '/classes/CookieHandler.php';
require_once __DIR__ . '/classes/Login.php';


$cookieHandler = new CookieHandler();

?>

<html>

<head>
    <title>Авторизация</title>
    <link rel="stylesheet" href="./style.css">
    <meta charset="UTF-8">
</head>

<body>
    <div class="container_info">
        <div class="cookie_dump_container">
            <?php
            var_dump($_COOKIE);
            ?>
        </div>
        <div class="cookie_display">
            <?php $cookieHandler->displayCookies(); ?>
        </div>
    </div>

    <?php if ($cookieHandler->getUsername() !== null) : ?>
        <div class="autorized_form">
            <form id="logoutForm" method="post">
                <div class="autorized_user">
                    Добро пожаловать, <?= $cookieHandler->getUsername() ?>
                </div>

                <ul>
                    <li><a href="./pages/harrypotter.php">Книги о Гарри Поттере</a></li>
                    <li><a href="./pages/cats.php">Виды кошек</a></li>
                </ul>

                <button type="submit">Разлогиниться</button>
            </form>
        </div>
    <?php else : ?>
        <div class="container">
            <h3>Авторизуйтесь</h3>
            <form id="authForm" method="post">
                <label for="login">Логин</label>
                <input type="text" id="login" name="login" placeholder="Логин" required><br>

                <label for="password">Пароль</label>
                <input type="text" id="password" name="password" placeholder="Пароль" required><br>

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