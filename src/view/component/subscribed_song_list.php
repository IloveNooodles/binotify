<?php
function return_html($data = []){
  $all_song = songs_in_html($data);
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

function songs_in_html($data){
//   $str = "";
//   $cnt = 1;
//   if (!empty($data)){
//     foreach($data as $song){
//         $id = $song['song_id'];
//         $judul = $song['judul'];
//         $penyanyi = $song['penyanyi'];
//         $html = <<<"EOT"
//             <tr class="content" name="$id">
//                 <td>$cnt</td>
//                 <td class="songlist-title">
//                     <i class="arrow right"></i>
//                     <div class="title-artist">
//                         <p class="song-title">$judul</p>
//                         <p class="song-artist">$penyanyi</p>
//                     </div>
//                 </td>
//             </tr>
//         EOT;
//         $str = $str . $html;
//         $cnt += 1;
//     }
// }
//     return $str;
    $html = <<<"EOT"
        <tr class="content-premium" name="1">
            <td>1</td>
            <td class="songlist-title">
                <button id="song-1" class="play-btn-premium pause">
                    <span></span>
                </button>
                <div class="title-artist-premium">
                    <p class="song-title">Roman Irama</p>
                    <p class="song-artist">Dewi 20</p>
                </div>
            </td>
        </tr>
        <tr class="content-premium" name="2">
            <td>2</td>
            <td class="songlist-title">
                <button id="song-2" class="play-btn-premium pause">
                    <span></span>
                </button>
                <div class="title-artist-premium">
                    <p class="song-title">Roman Irama</p>
                    <p class="song-artist">Dewi 20</p>
                </div>
            </td>
        </tr>
        <tr class="content-premium" name="3">
        <td>3</td>
        <td class="songlist-title">
            <button id="song-3" class="play-btn-premium pause">
                <span></span>
            </button>
            <div class="title-artist-premium">
                <p class="song-title">Roman Irama</p>
                <p class="song-artist">Dewi 20</p>
            </div>
        </td>
    </tr>
    EOT;
    return $html;
}