<?php

class Song extends Controller {
    public function index(){
      switch($_SERVER['REQUEST_METHOD']){
        case "GET":
          redirect_home();
          break;
        case "POST":
          break;
      }
    }

    public function detail() {
        
    }

    public function new() {

    }

    public function edit() {
        
    }

    public function delete() {
        
    }

    public function search() {
        $this->view("search/index");
    }
}