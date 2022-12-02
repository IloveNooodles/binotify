<?php
function return_html($data = []){
  $new_data = $data['result']; 
  $new_data = get_object_vars(json_decode($new_data));
  $real_data = get_object_vars($new_data['data']);
  $premium_song = $real_data['premium_song'];
  $singer = get_object_vars($real_data['singer']);
  $all_song = songs_in_html($premium_song, $singer);
  if (isset($_SESSION['role'])) {
    $html = <<<"EOT"
    <body>
    <table id="songlist">
        <tr>
            <th>#</th>
            <th>PREMIUM SONG TITLE</th>
        </tr>
        $all_song
    </table>
    </body>
    EOT;
  }
  else {
    $html = <<<"EOT"
    <div>
    </div>
    EOT;
  }
echo $html;
}

function songs_in_html($data, $singer){
  $str = "";
  $cnt = 1;
  $singer_name = $singer['name'];
  if (!empty($data)){
    foreach($data as $song){
        $song = get_object_vars($song);
        $id = $song['id'];
        $judul = $song['title'];
        $url = $song['audio_path'];
        $html = <<<"EOT"
            <tr class="content-premium" name="$id">
            <td>$cnt</td>
            <td class="songlist-title">
                <button id="$id" class="play-btn-premium pause">
                    <span></span>
                </button>
                <div class="title-artist-premium">
                    <p class="song-title">$judul</p>
                    <p class="song-artist">$singer_name</p>
                    <audio src="$url" id="audio-$id"></audio>
                </div>
            </td>
        </tr>
        EOT;
        $str = $str . $html;
        $cnt += 1;
    }
  }
  return $str;
    // $html = <<<"EOT"
    //     <tr class="content-premium" name="1">
    //         <td>1</td>
    //         <td class="songlist-title">
    //             <button id="1" class="play-btn-premium pause">
    //                 <span></span>
    //             </button>
    //             <div class="title-artist-premium">
    //                 <p class="song-title">Roman Irama</p>
    //                 <p class="song-artist">Dewi 20</p>
    //                 <audio src="/public/audio/Sunset.mp3" id="audio-1"></audio>
    //             </div>
    //         </td>
    //     </tr>
    //     <tr class="content-premium" name="2">
    //         <td>2</td>
    //         <td class="songlist-title">
    //             <button id="2" class="play-btn-premium pause">
    //                 <span></span>
    //             </button>
    //             <div class="title-artist-premium">
    //                 <p class="song-title">Roman Irama</p>
    //                 <p class="song-artist">Dewi 20</p>
    //                 <audio src="/public/audio/Sunset.mp3" id="audio-2"></audio>
    //             </div>
    //         </td>
    //     </tr>
    //     <tr class="content-premium" name="3">
    //         <td>3</td>
    //         <td class="songlist-title">
    //             <button id="3" class="play-btn-premium pause">
    //                 <span></span>
    //             </button>
    //             <div class="title-artist-premium">
    //                 <p class="song-title">Roman Irama</p>
    //                 <p class="song-artist">Dewi 20</p>
    //                 <audio src="/public/audio/Sunset.mp3" id="audio-3"></audio>
    //             </div>
    //         </td>
    //     </tr>
    // EOT;
    // return $html;
}