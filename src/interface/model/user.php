<?php

require_once $_ENV['PWD'] . '/infrastructure/database/mysql.php';

class UserModel {
  private $db;

  public function __construct() {
    $this->db = new MySQL(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  }

  public function find_all_user() {
    $query = "SELECT * FROM User";
    $result = $this->db->query($query);

    return $result;
  }

  public function find_user_by_username($username) {
    $query = "SELECT * FROM User WHERE username = :username";

    $this->db->query($query);
    $this->db->bind('username', $username);
    $result = $this->db->single();

    return $result;
  }

  public function find_user_by_email($email) {
    $query = "SELECT * FROM User WHERE email = :email";

    $this->db->query($query);
    $this->db->bind('email', $email);
    $result = $this->db->single();

    return $result;
  }

  public function create_user($username, $email, $hashed_password, $role){
    $query = "INSERT INTO User (email, username, password, isAdmin) VALUES (:email, :username, :password, :isAdmin)";

    $this->db->query($query);
    $this->db->bind('email', $email);
    $this->db->bind('username', $username);
    $this->db->bind('password', $hashed_password);
    $this->db->bind('isAdmin', $role);

    $this->db->execute();
  }
}
?>