const authForm = document.getElementById("authForm");
const logoutForm = document.getElementById("logoutForm");
const forgetMeButton = document.getElementById("forgetMeButton");

/* console.log("authForm", authForm, );
console.log("logoutForm", logoutForm);
console.log("forgetMeButton", forgetMeButton); */

if (authForm) {
  authForm.addEventListener("submit", handleAuthForm);
}

if (logoutForm) {
  logoutForm.addEventListener("submit", handleLogoutForm);
}

if (forgetMeButton) {
  forgetMeButton.addEventListener("click", handleForgetMeButtonClick);
}

function handleAuthForm(event) {

  event.preventDefault();

  let formData = new FormData(event.target);

  fetch("login_process.php", {
    method: "POST",
    body: formData,
    headers: {
      "X-Requested-With": "xmlhttprequest",
    },
  })
    .then(function (response) {
      console.log("response of auth:", response);
      if (response.ok) {
        return response.json();
      }
    })
    .then(function (data) {
      console.log("data", data);
      if (data.status === "success") {
        setTimeout(function () {
          window.location.href = "index.php";
        }, 4000);

        window.location.href = "/";
      } else {
        console.log("data.message:", data.message);
        alert(data.message);
      }
    })
    .catch(function (error) {
      alert("Ошибка: " + error);
    });
}

function handleForgetMeButtonClick(event) {
  event.preventDefault();

  fetch("delete_user_process.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then(function (response) {
      console.log("response", response);
      if (response.ok) {
        console.log("Пользователь и данные о нем удалены из базы данных");
        handleLogoutForm(event); //delete cookie
      }
    })
    .catch(function (error) {
      console.error("Ошибка на сервере", error);
    });
}

function handleLogoutForm(event) {
  event.preventDefault();

  document.cookie = "login=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  document.cookie = "password=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  document.cookie = "PHPSESSID=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  document.cookie = "session_id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

  window.location.replace("/");
}
