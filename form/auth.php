<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input1 = $_POST['login'];
    $input2 = $_POST['email'];

    $user = array(
        'login' => $input1,
        'email' => $input2
    );

    $data = file_get_contents('db.json');
    $users = json_decode($data, true);
    
    $users[] = $user;

    file_put_contents('db.json', json_encode($users, JSON_PRETTY_PRINT));

    $_SESSION['username'] = $user['login'];
    setcookie('username', $user['login'], time() + 30);

    header('Location: profile.php');
    exit();
}
?>