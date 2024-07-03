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
            console.log("Дебаг:", response);
            return response.json();
        }
    })
    .then(function(data) {
        if (data.status === "success") {
            console.log("Регистрация успешна:", data.message);
            setTimeout(function() {
                window.location.href = "index.php";
              }, 2000); 
            window.location.href = "/";
        } else {
            alert("Ошибка: " + data.message);
        }
    })
    .catch(function(error) {
        console.log("error ВЫВОД", error);
        console.log("Возникла ошибка при записи в бд: " + error.message);
    });
});