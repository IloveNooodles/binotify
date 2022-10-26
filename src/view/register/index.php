<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Binotify - Register</title>
  <link rel="stylesheet" href="/public/css/styles.css">
  <link rel="stylesheet" href="/public/css/login.css">
  <link rel="stylesheet" href="/public/css/register.css">
  <link rel="shortcut icon" href="/public/img/favicon.png" type="image/x-icon">
</head>
<body>
  <a class="back-btn" href="/">
    <i class="arrow left"></i>
  </a>
  <form class="register-form" action="/register" method="POST">
      <h3>Register</h3>
      <input required type="text" placeholder="Email" id="email" name="email">
      <label id="email-error"></label>
      <input required type="text" placeholder="Username" id="username" name="username">
      <label id="username-error"></label>
      <input required type="password" placeholder="Password" id="password" name="password">
      <label id="password-error"></label>
      <input required type="password" placeholder="Confirm Password" id="confirm-password" name="confirm-password">
      <label id="confirm-password-error"></label>
      <?php
        if(isset($data['status_message']) && $data['status_message'] == SUCCESS){
          echo '<label id="registration-success">Registration Successful</label>';
        }
        else if(isset($data['status_message']) && $data['status_message'] == INTERNAL_ERROR){
          echo '<label id="registration-failure">Registration Failed</label>';
        }
        ?>
      <button type="submit" class="btn primary register">Register</button>
      <a href="/login">
        <button type="button" class="btn primary login">Already have an account?</button>
      </a>
  </form>
  <script>
    document.querySelectorAll(".register-form input").forEach(item => {
      item.addEventListener('blur', function(){
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "register/validate", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function () {
          if (xhr.status === 200) {
            var valid = true;
            var response = JSON.parse(xhr.responseText);
            if (response.data.username != 'true') {
              document.getElementById("username").classList.add("invalid");
              document.getElementById("username-error").innerHTML = response.data.username;
              valid = false;
            } else {
              document.getElementById("username").classList.remove("invalid");
              document.getElementById("username-error").innerHTML = "";
            }
            if (response.data.email != 'true') {
              document.getElementById("email").classList.add("invalid");
              document.getElementById("email-error").innerHTML = response.data.email;
              valid = false;
            } else {
              document.getElementById("email").classList.remove("invalid");
              document.getElementById("email-error").innerHTML = "";
            }
            if (response.data.password != 'true') {
              document.getElementById("password").classList.add("invalid");
              document.getElementById("confirm-password").classList.add("invalid");
              document.getElementById("confirm-password-error").innerHTML = response.data.password;
              valid = false;
            } else {
              document.getElementById("password").classList.remove("invalid");
              document.getElementById("confirm-password").classList.remove("invalid");
              document.getElementById("password-error").innerHTML = "";
            }
            document.querySelector("#register-form button[type='submit']").disabled = !valid;
          }
        };

        xhr.send(
          'email=' + document.getElementById("email").value +
          '&username=' + document.getElementById("username").value + 
          '&password=' + document.getElementById("password").value +
          '&confirm-password=' + document.getElementById("confirm-password").value
        );
      });
    });
  </script>
</body>
</html>
