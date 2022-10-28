<?php

if(session_status() == 1){
  session_start();
}
class Middleware {  

  public function can_access_admin_page(){
    if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){
      return true;
    }

    return false;
  }

  public function limit_song(){
    
    if(isset($_SESSION['role']) || isset($_SESSION['username'])){
      return false;
    }

    if($_SESSION['num_song_played'] >= 3){
      return true;
    }

    $_SESSION['num_song_played'] += 1;
    return false;
  }

  public function is_query_params_complete($array_of_queryparams){
    foreach($array_of_queryparams as $queryparams){
      if(!isset($_GET[$queryparams])){
        return false;
      }
    }
    return true;
  }
}