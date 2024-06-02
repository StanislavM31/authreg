<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input1 = $_POST['login'];
    $input2 = $_POST['password'];

    $data = file_get_contents('db.json');
    $users = json_decode($data, true);

    $user = null;
    foreach ($users as $userData) {
        if ($userData['login'] === $input1 && $userData['password'] === $input2) {
            $user = $userData;
            break;
        }
    }

    if ($user) {

        session_start();

        $_SESSION['username'] = $user['login'];
        setcookie('username', $user['login'], time() + 300);
        setcookie('password', $user['password'], time() + 300);
        header('Location: index.php');
        exit();
    } else {
        echo "Неверный логин или пароль";
        echo '<br>';
        echo '<a href="index.php">Попробовать еще раз</a>';
    }
}
?>