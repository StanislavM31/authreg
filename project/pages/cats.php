<?php
var_dump($_COOKIE);

require_once __DIR__ . '/../classes/CookieHandler.php';

$cookieHandler = new CookieHandler();
$username = $cookieHandler->getUsername();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/form/style.css">
    <title>Виды кошек</title>

</head>

<body>

    <div><a href='/'>На главную</a></div>

    <?php
    if ($username) {
    ?>
        <p>Вы зашли как, <?= $cookieHandler->getUsername() ?></p>
        <h1>Виды кошек</h1>
        <div class="container">
            <ul>
                <li>Maine Coon</li>
                <li>Persian</li>
                <li>Siamese</li>
                <li>Bengal</li>
                <li>Sphynx</li>
                <li>Ragdoll</li>
                <li>Scottish Fold</li>
            </ul>
        </div>
    <?php
    } else {
        echo "Извините, вы неавторизованный пользователь.";
        echo "<br>";
    }
    ?>
</body>

</html>