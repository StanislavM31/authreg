document.getElementById("authForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let formData = new FormData(event.target);

    fetch("login_process.php", {
        method: "POST",
        body: formData,
        headers: {
            "X-Requested-With": "xmlhttprequest"
        }
    })
    .then(function(response) {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error("Ошибка при отправке формы авторизации");
        }
    })
    .then(function(data) {
        console.log(data.message);
        if (data.status === "success") {
            console.log(data.message);
            window.location.replace("index.php");
        } else {
            console.error(data.message);
        }
    })
    .catch(function(error) {
        console.error("Ошибка при выполнении запроса", error);
    });
});

document.getElementById('logoutForm').addEventListener('submit', function(event) {
    event.preventDefault();

    document.cookie = "login=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "password=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "PHPSESSID=; expires=Mon, 01 May 2024 00:00:00 UTC; path=/;";
    document.cookie = "session_id=; expires=Mon, 01 May 2024 00:00:00 UTC; path=/;";


    this.submit();
    window.location.replace("index.php");
    
});