<?php

require_once BASE_URL . '/src/infrastructure/database/mysql.php';


class SubscriptionModel {
  private $db;

  public function __construct()
  {
    $this->db = new MySQL(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  }

  public function get_all_subscription(){
    $query = "SELECT * From Subscription";
    $this->db->query($query);
    $res = $this->db->result_set();
    return $res;
  }

  public function get_all_subscription_by_subscriber_id($id){
    $query = "SELECT * From Subscription WHERE subscriber_id = :id";

    $this->db->query($query);
    $this->db->bind("id", $id);

    $result = $this->db->result_set();
    return $result;
  }

  public function get_subscription_by_id($creator_id, $subscriber_id){
    $query = "SELECT * FROM Subscription WHERE creator_id = :creator_id AND subscriber_id = :subscriber_id";

    $this->db->query($query);
    $this->db->bind("creator_id", $creator_id);
    $this->db->bind("subscriber_id", $subscriber_id);

    $result = $this->db->single();
    return $result;
  }

  public function insert_subscription($creator_id, $subscriber_id){
    $query = "INSERT INTO subscription (creator_id, subscriber_id) VALUES (:creator_id, :subscriber_id)";

    $this->db->query($query);
    $this->db->bind("creator_id", $creator_id);
    $this->db->bind("subscriber_id", $subscriber_id);

    $this->db->execute();
  }

  public function update_subscription($creator_id, $subscriber_id, $status = "PENDING"){
    $query = "UPDATE subscription SET status = :stat WHERE creator_id = :creator_id AND subscriber_id = :subscriber_id";
    
    $this->db->query($query);
    $this->db->bind("stat", $status);
    $this->db->bind("creator_id", $creator_id);
    $this->db->bind("subscriber_id", $subscriber_id);

    $this->db->execute();
  }
}