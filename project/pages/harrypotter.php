<?php


require_once __DIR__ . '/../classes/CookieHandler.php';
require_once __DIR__ . '/../classes/UserDbHandler.php';

$cookieHandler = new CookieHandler();
$loginFromCookie = $cookieHandler->getUsername();
$userDbHandler = new UserDbHandler();
$userName = $userDbHandler->getUserNameByLogin($loginFromCookie);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>Harry Potter Book List</title>

</head>

<body>
    <div class="container_info">
        <div class="cookie_display">
            <?php $cookieHandler->displayCookies(); ?>

        </div>
    </div>
    <div class="container">
        <?php
        if ($loginFromCookie) {
            ?>
            <p>Вы зашли как, <?= $userName ?></p>
            <h1>Harry Potter Books</h1>
            <ul>
                <li>Harry Potter and the Philosopher's Stone</li>
                <li>Harry Potter and the Chamber of Secrets</li>
                <li>Harry Potter and the Prisoner of Azkaban</li>
                <li>Harry Potter and the Goblet of Fire</li>
                <li>Harry Potter and the Order of the Phoenix</li>
                <li>Harry Potter and the Half-Blood Prince</li>
                <li>Harry Potter and the Deathly Hallows</li>
            </ul>
            <?php
        } else {
            echo "Извините, вы неавторизованный пользователь.";
            echo "<br>";
        }
        ?>
        <a href='/'>На главную</a>
    </div>
</body>

</html>