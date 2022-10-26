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
  <link rel="stylesheet" href="/public/css/navbar.css">
  <link rel="shortcut icon" href="/public/img/favicon.png" type="image/x-icon">
</head>
<body>
  <a class="back-btn" href="/">
    <i class="arrow left"></i>
  </a>
  <form class="register-form" action="/register" method="POST">
      <h3>Register</h3>
      <input required type="email" placeholder="Email" id="email" name="email">
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
  <script defer src="/public/js/register.js"></script>
</body>
</html>