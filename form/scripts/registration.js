document.getElementById("registrationForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch("registration_process.php", {
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
            throw new Error("Ошибка при регистрации");
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
        console.error(error);
    });
});