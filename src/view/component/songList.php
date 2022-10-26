<?php
function return_songlist($data = []){
  $all_song = return_all_song($data);
  $html = <<<"EOT"
    <head>
        <link rel="stylesheet" href="/public/css/songList.css">
    </head>
    <body>
    <table id="songlist">
        <tr>
            <th>#</th>
            <th>TITLE</th>
            <th>RELEASED</th>
            <th>GENRE</th>
        </tr>
        $all_song
    </table>
    </body>
EOT;
echo $html;
}

function return_all_song($data){
  $str = "";
  $cnt = 1;
  foreach($data as $song){
    $image_path = $song['image_path'];
    $judul = $song['judul'];
    $penyanyi = $song['penyanyi'];
    $tanggal_terbit = $song['tanggal_terbit'];
    $genre = $song['genre'];
    $html = <<<"EOT"
    <tr class="content">
        <td>$cnt</td>
        <td class="songlist-title">
            <img class="song-image" src="$image_path" alt="album1">
            <div class="title-artist">
                <p class="song-title">$judul</p>
                <p class="song-artist">$penyanyi</p>
            </div>
        </td>
        <td>$tanggal_terbit</td>
        <td>$genre</td>
    </tr>
EOT;
    $str = $str . $html;
    $cnt += 1;
  }
  return $str;
}