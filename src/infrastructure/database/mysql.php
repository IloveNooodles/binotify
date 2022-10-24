<?php

class MySQL {
    private $user_name;
    private $pass_name;

    private $db;
    private $stmt;

    public function __construct($host, $user, $password, $database) {
        $this->user_name = $user;
        $this->pass_name = $password;

        $dsn = 'mysql:host=' . $host . ';port=' . MYSQL_PORT . ';dbname=' . $database;

        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->db = new PDO($dsn, $this->user_name, $this->pass_name, $option);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query($query) {
        $this->stmt = $this->db->prepare($query);
    }

    public function bind($param, $value, $type = null) {
        if( is_null($type) ) {
            switch( true ) {
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute() {
        $this->stmt->execute();
    }

    public function result_set() {
        $this->execute();
        
        if ($this->stmt->rowCount() > 0) {
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } 

        return [];
    }

    public function single() {
        $this->execute();

        if ($this->stmt->rowCount() > 0) {
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        } 
    
        return [];
    }

    public function row_count() {
        return $this->stmt->rowCount();
    }
}
?>