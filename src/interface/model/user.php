<?php

require_once $_ENV['PWD'] . '/src/infrastructure/database/mysql.php';

class UserModel {
  private $db;

  public function __construct() {
    $this->db = new MySQL(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  }

  public function find_all_user() {
    $query = "SELECT * FROM User";
    $this->db->query($query);

    $result = $this->db->result_set();

    return $result;
  }

  public function find_user_by_id($user_id) {
    $query = "SELECT * From User WHERE user_id = :user_id";

    $this->db->query($query);
    $this->db->bind("user_id", $user_id);
    $result = $this->db->single();

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

  public function insert_user($username, $email, $hashed_password, $role){
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