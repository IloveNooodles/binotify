<?php

class Search extends Controller {
  public function index(){
    switch($_SERVER["REQUEST_METHOD"]){
      case "GET":
          $this->view("search/index");
          break;
      default:
          response_not_allowed_method();
          break;
    }
  }
}