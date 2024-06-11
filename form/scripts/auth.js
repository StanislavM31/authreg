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