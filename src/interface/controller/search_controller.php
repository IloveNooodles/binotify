<?php

class Search extends Controller {
  public function index($query = null){
      $data = $this->search_song($query);
      switch($_SERVER['REQUEST_METHOD']){
        case "GET":
          $this->view("search/index", $data);
          break;
        default:
          redirect_home();
      }
  }

  public function search_song($query){
    $search_service = new SearchService();
    $data = $search_service->search_all_song();
    if(!isset($query)){
      return $data;
    }
    return $data;
  }
}