<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $data = file_get_contents('db.json');
    $users = json_decode($data, true);

    $user = null;

    foreach ($users as $userData) {
        if ($userData['login'] === $login && $userData['password'] === $password) {
            $user = $userData;
            break;
        }
    }

    

    if ($user) {
        session_start();

        $_SESSION['login'] = $user['login'];
        setcookie('login', $user['login'], time() + 45);

        header('Location: index.php');
        exit();
    } else {
        echo "Неверный логин или пароль";
        echo '<br>';
        echo '<a href="index.php">Попробовать еще раз</a>';
    }
}
?>