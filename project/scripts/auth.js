const authForm = document.getElementById("authForm");
const logoutForm = document.getElementById("logoutForm");

console.log("authForm", authForm, "logoutForm", logoutForm);

if (authForm) {
  authForm.addEventListener("submit", handleAuthForm);
}

if (logoutForm) {
  logoutForm.addEventListener("submit", handleLogoutForm);
}

function handleAuthForm(event) {
  console.log("++++++");
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
      if (response.ok) {
        return response.json();
      } else {
        throw new Error("Ошибка при отправке формы авторизации");
      }
    })
    .then(function (data) {
      console.log(data.message);
      if (data.status === "success") {
        console.log("Вы успешно авторизованы");
/*         setTimeout(function() {
          window.location.href = "index.php";
        }, 5000); */

        window.location.replace("index.php");

      } else {
        console.error(data.message);
      }
    })
    .catch(function (error) {
      console.error("Ошибка при выполнении запроса", error);
    });
}

function handleLogoutForm(event) {
  event.preventDefault();

  document.cookie = "login=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  document.cookie = "password=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  document.cookie = "PHPSESSID=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  document.cookie = "session_id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  
  window.location.replace("index.php");

}
