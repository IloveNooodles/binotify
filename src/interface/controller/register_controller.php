<?php

class Register extends Controller {
    public function index(){
      switch($_SERVER["REQUEST_METHOD"]){
        case "GET":
          $this->view("register/index");
          break;
        case "POST":
          $this->register();
          break;
      }
    }

    /* Check for req body first return json empty harusnya (harusnya)*/ 
    public function register(){
      if(!(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['isAdmin']))) {

      }
    }
}