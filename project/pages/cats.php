<?php


require_once __DIR__ . '/../classes/CookieHandler.php';
require_once __DIR__ . '/../classes/UserDbHandler.php';

$cookieHandler = new CookieHandler();
$loginFromCookie = $cookieHandler->getUsername();
$userDbHandler = new UserDbHandler();
$userName = $userDbHandler->getUserNameByLogin($loginFromCookie);

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
        <?php if ($loginFromCookie) { ?>
            <div>
                <p>Вы зашли как, <?= $userName ?></p>
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