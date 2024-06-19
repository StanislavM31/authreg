<?php
session_start();
var_dump($_SESSION);
var_dump(session_id());

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
    <title>Harry Potter Book List</title>

</head>

<body>
    <div><a href='/'>На главную</a></div>
    <br>
    <?php
    if ($username) {
    ?>
        <p>Вы зашли как, <?= $cookieHandler->getUsername() ?></p>
        <h1>Harry Potter Book List</h1>
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