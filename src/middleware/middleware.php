<?php

class Middleware {  

  public function can_access_admin_page(){
    if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){
      return true;
    }

    return false;
  }

  public function limit_song(){
    
    if(isset($_SESSION['role']) || isset($_SESSION['username'])){
      return true;
    }

    $num_song_played = $_SESSION['num_song_played'];
    if($num_song_played >= 3){
      return false;
    }

    $_SESSION['num_song_played'] += 1;
    return true;
  }
}