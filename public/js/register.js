document.querySelectorAll(".register-form input").forEach((item) => {
  item.addEventListener("blur", function () {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "register/validate", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      if (xhr.status === 200) {
        var valid = true;
        var response = JSON.parse(xhr.responseText);
        if (response.data.username != "true") {
          document.getElementById("username").classList.add("invalid");
          document.getElementById("username-error").innerHTML =
            response.data.username;
          valid = false;
        } else {
          document.getElementById("username").classList.remove("invalid");
          document.getElementById("username-error").innerHTML = "";
        }
        if (response.data.email != "true") {
          document.getElementById("email").classList.add("invalid");
          document.getElementById("email-error").innerHTML =
            response.data.email;
          valid = false;
        } else {
          document.getElementById("email").classList.remove("invalid");
          document.getElementById("email-error").innerHTML = "";
        }
        if (response.data.password != "true") {
          document.getElementById("password").classList.add("invalid");
          document.getElementById("confirm-password").classList.add("invalid");
          document.getElementById("confirm-password-error").innerHTML =
            response.data.password;
          valid = false;
        } else {
          document.getElementById("password").classList.remove("invalid");
          document
            .getElementById("confirm-password")
            .classList.remove("invalid");
          document.getElementById("password-error").innerHTML = "";
        }
        document.querySelector(
          "#register-form button[type='submit']"
        ).disabled = !valid;
      }
    };

    xhr.send(
      "email=" +
        document.getElementById("email").value +
        "&username=" +
        document.getElementById("username").value +
        "&password=" +
        document.getElementById("password").value +
        "&confirm-password=" +
        document.getElementById("confirm-password").value
    );
  });
});
