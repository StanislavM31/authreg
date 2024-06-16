<?php
var_dump($_COOKIE);


require_once __DIR__ . '/../classes/CookieHandler.php';



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
    <h1>Harry Potter Book List</h1>

    <?php 
    session_start();
    echo "Значение куки session_id: " . $_COOKIE['session_id'] . "<br>";
    echo "значение session_id(): " . (session_id()) . "<br>";
    echo "Проверка : " . (isset($_COOKIE['session_id']) == session_id()) . "<br>";
    ?>

    <?php
    

    echo "Текущий ID сессии: " . session_id();
    if ($_COOKIE['session_id'] == session_id()) {

    ?>
        <div class="container">
            <ul>
                <li>Harry Potter and the Philosopher's Stone</li>
                <li>Harry Potter and the Chamber of Secrets</li>
                <li>Harry Potter and the Prisoner of Azkaban</li>
                <li>Harry Potter and the Goblet of Fire</li>
                <li>Harry Potter and the Order of the Phoenix</li>
                <li>Harry Potter and the Half-Blood Prince</li>
                <li>Harry Potter and the Deathly Hallows</li>
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