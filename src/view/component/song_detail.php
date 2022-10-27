<?php
function song_limit(){
  $middleware = new Middleware();
  $_SESSION['limit_song'] = $middleware->limit_song();
}

function show_song_detail(){
  $play_song = <<<"EOT"
  <div class="modal">
    <div class="song-detail-content">
        <span class="close">&times;</span>
        <p class="song-detail-album"></p>
        <img class="player-cover" src="" alt="cover">
        <h3 class="music-name"></h3>
        <h4 class="artist-name"></h4>
        <div class="song-slider">
            <input type="range" value="0" class="seek-bar">
            <span class="current-time">00 : 00</span>
            <span class="song-duration">00 : 00</span>
        </div>
        <button class="play-btn pause">
            <span></span>
            <span></span>
        </button>
        <p class="song-detail-date-genre"></p>
        <audio src="" id="audio"></audio>
        <script src="/public/js/song-detail.js"></script>
      </div>
  </div>
EOT;
  $limit_song = <<<"EOT"
  <div class="modal">
    <div class="song-detail-content">
        <span class="close">&times;</span>
        <p class="song-detail-album"></p>
        <img class="player-cover" src="" alt="cover">
        <h3 class="music-name"></h3>
        <h4 class="artist-name"></h4>
        <div class="song-slider">
            <input type="range" value="0" class="seek-bar">
            <span class="current-time">00 : 00</span>
            <span class="song-duration">00 : 00</span>
        </div>
        <button class="play-btn pause" hidden disabled>
            <span></span>
            <span></span>
        </button>
        <p>Guest user can only listen 3 music per day.</p>
        <p>To experience full feature please log in</p>
        <p class="song-detail-date-genre"></p>
        <audio src="" id="audio"></audio>
        <script src="/public/js/song-detail.js"></script>
      </div>
  </div>
EOT;
  if($_SESSION['limit_song']){
    echo $limit_song;
    return;
  }
  echo $play_song;
}

show_song_detail();