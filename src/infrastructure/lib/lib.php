<?php

function hash_user_password($password) {
  $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
  return $hashedPassword;
}

function check_password($password, $hashedPassword) {
  $isPasswordCorrect = password_verify($password, $hashedPassword);
  return $isPasswordCorrect;
}
?>