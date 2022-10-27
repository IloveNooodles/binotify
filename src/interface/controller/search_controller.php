<?php

class Search extends Controller {
  public function index(){
    switch($_SERVER["REQUEST_METHOD"]){
      case "GET":
          $this->view("search/index");
          break;
      default:
          response_json(["status_message" => METHOD_NOT_ALLOWED], 405);
          break;
    }
  }
}