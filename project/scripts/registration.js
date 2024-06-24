document.getElementById("registrationForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let formData = new FormData(this);
    console.log(formData);

    fetch("registration_process.php", {
        method: "POST",
        body: formData,
        headers: {
            "X-Requested-With": "xmlhttprequest"
        }
    })
    .then(function(response) {
        if (response.ok) {
            console.log("Ответ от сервера RESPONSE:", response);
            return response.json();
        } else {
            throw new Error("Ошибка при регистрации");
        }
    })
    .then(function(data) {
        /* console.log("Дебаг:", data); */

        if (data.status === "success") {
            console.log("Регистрация успешна:", data.message);
            window.location.replace("/");
        } else {
            console.error("Ошибка при регистрации:", data.message);
            /* console.error("Ошибка при регистрации:", data); */
        }
    })
    .catch(function(error) {
        console.error(error);
    });
});