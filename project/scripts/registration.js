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
            console.log("response of registration:", response);
            return response.json();
        } else {
            // когда не ok
            return response.json().then(data => {
                throw new Error(` ${data.message}`);
            });
        }
    })
    .then(function(data) {
        console.log("Регистрация успешна", data.message);
        window.location.href = "/";
    })
    .catch(function(error) {
        console.log("error: ", error);
        alert( error);
    });
});