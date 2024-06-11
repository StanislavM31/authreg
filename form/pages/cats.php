<?php
var_dump($_COOKIE);


require_once __DIR__ . '/../classes/CookieHandler.php';
require_once __DIR__ . '/../classes/Auth.php';


$cookieHandler = new CookieHandler();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/form/style.css">
    <title>Harry Potter Book List</title>

</head>

<body>
    <a href='/'>На главную</a>
    <h1>Виды кошек</h1>

    <?php
    echo "Значение куки session_id: " . $_COOKIE['session_id'] . "<br>";
    echo "значение session_id(): " . (session_id()) . "<br>";
    echo "Проверка : " . (isset($_COOKIE['session_id']) == session_id()) . "<br>";
    ?>

    <?php
    session_start();

    echo "Текущий ID сессии: " . session_id();
    if ($_COOKIE['session_id'] == session_id()) {

    ?>
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