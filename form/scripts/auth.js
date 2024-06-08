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
            window.location.reload();
        } else {
            console.error("Ошибка при отправке формы авторизации");
        }
    })
    .catch(function(error) {
        console.error("Ошибка при выполнении запроса", error);
    });
});