<?php
$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : null;
$password = isset($_COOKIE['password']) ? $_COOKIE['password'] : null;

if ($username !== null || $password !== null) { // &&
    echo 'Cookie username: ' . $username;
    echo 'Cookie password: ' . $password;
} else {
    echo 'Куки username или password отсутствуют.';
}
?>

<html>
<head>
    <title>Главная страница</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
</head>
<body>
    <?php
        if($username !==null ) :
    ?> Добро пожаловать, <?=$username?>
    <form method="post" action="logout_process.php">
        <button type="submit" formaction="logout_process.php">Разлогиниться</button>
    </form>
    <?php else: ?>
        <div class="container">
            <h3>Авторизуйтесь</h3>
            <form method="post" action="login_process.php">
                <label for="login">Логин</label>
                <input type="text" id="login" name="login" placeholder="Логин" required><br>
                
                <label for="password">Пароль</label>
                <input type="text" id="password" name="password" placeholder="Пароль" required><br>
                
                <button type="submit">Войти</button>
            </form>
            <p>Еще не зарегистрированы?
                <a href="registration.html">Зарегистрироваться</a>
            </p>
        </div>
    <?php endif; ?>
    
</body>
</html>

<!-- <html>
<head>
    <title>Форма ввода</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
</head>
<body>
    <div class="container">
        <h3>Aвторизация</h3>
        <form method="post" action="login_process.php">
            <label for="login">Логин</label>
            <input type="text" id="login" name="login" placeholder="Логин" required><br>
            
            <label for="password">Пароль</label>
            <input type="text" id="password" name="password" placeholder="Пароль" required><br>
            
            <button type="submit">Войти</button>
        </form>
        <p>Еще не зарегистрированы?
            <a href="registration.html">Зарегистрироваться</a>
        </p>
    </div>
</body>
</html> -->