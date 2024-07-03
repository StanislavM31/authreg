<?php


require_once __DIR__ . '/../classes/CookieHandler.php';

$cookieHandler = new CookieHandler();
$username = $cookieHandler->getUsername();
?>



<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>Виды кошек</title>

</head>

<body>
    <div class="container_info">
        <div class="cookie_display">
            <?php $cookieHandler->displayCookies(); ?>

        </div>
    </div>

    <div class="container">
        <?php if ($username) { ?>
            <div>
                <p>Вы зашли как, <?= $cookieHandler->getUsername() ?></p>
            </div>
            <h1>Виды кошек</h1>
            <ul>
                <li>Мейн-кун</li>
                <li>Персидская кошка</li>
                <li>Сиамская кошка</li>
                <li>Бенгальская кошка</li>
                <li>Сфинкс</li>
                <li>Рэгдолл</li>
                <li>Шотландская вислоухая</li>
            </ul>
        <?php } else {
            echo "Извините, вы неавторизованный пользователь.";
            echo "<br>";
        } ?>
        <a href='/'>На главную</a>
    </div>
</body>

</html>