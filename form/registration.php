<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <link rel="stylesheet" href="style_registration.css">
    <meta charset="UTF-8">
</head>
<body>
<body>
    <div class="container">
        <h3>Регистрация</h3>
        <form id="registrationForm" method="post">
            <label for="login">Логин</label>
            <input type="text" id="login" name="login" placeholder="Логин" required><br>
            
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" placeholder="Пароль" required><br>
            
            <label for="confirm_password">Подтверждение пароля</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Подтверждение пароля" required><br>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" required><br>
            
            <button type="submit">Зарегистрироваться</button>
        </form>
        <p>Уже зарегистрированы?
            <a href="index.php">Войти</a>
        </p>
    </div>
    <script>
        document.getElementById("registrationForm").addEventListener("submit", function(event) {
            event.preventDefault();
            
            let formData = new FormData(this);
            
            fetch("_process.php", {
                method: "POST",
                body: formData
            })
            .then(function(response) {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error("Ошибка при регистрации");
                }
            })
            .then(function(data) {
                if (data.status === "success") {
                    console.log(data.message);
                    window.location.href = "index.php";
                } else {
                    console.error(data.message);
                }
            })
            .catch(function(error) {
                console.error(error);
            });
        });
    </script>
</body>
</html>