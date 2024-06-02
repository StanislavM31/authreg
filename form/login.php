<?php

require __DIR__ . '/auth.php';

if(!empty($_POST)){
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    if(checkAuth($login, $password)){
        setcookie('username', $login, time() + 40);
        setcookie('password', $password, time() + 40);
        header('Location: index.php');
    } else {
        $error = 'ошибка авторизации';
    }
}

?>


<html>
<head>
    <title>Вход</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
</head>
<body>
    <div class="container"></div>
</body>
</html>