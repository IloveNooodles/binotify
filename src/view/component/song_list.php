<?php
function return_html($data = [], $no_cover = false){
  $all_song = songs_in_html($data, $no_cover);
  $html = <<<"EOT"
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
    <script src="public/js/song-list.js"></script>
EOT;
echo $html;
}

function songs_in_html($data, $no_cover){
  $str = "";
  $cnt = 1;
  if (!empty($data)){
    foreach($data as $song){
        $id = $song['song_id'];
        $image_path = str_replace(BASE_URL,'',$song['image_path']);;
        $judul = $song['judul'];
        $penyanyi = $song['penyanyi'];
        $tanggal_terbit = $song['tanggal_terbit'];
        $genre = $song['genre'];
        if ($no_cover) {
            $html = <<<"EOT"
            <tr class="content" name="$id">
                <td>$cnt</td>
                <td class="songlist-title">
                    <div class="title-artist">
                        <p class="song-title">$judul</p>
                        <p class="song-artist">$penyanyi</p>
                    </div>
                </td>
                <td>$tanggal_terbit</td>
                <td>$genre</td>
            </tr>
            EOT;
        }
        else {
            $html = <<<"EOT"
                <tr class="content" name="$id">
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
        }

        $str = $str . $html;
        $cnt += 1;
    }
}
  return $str;
}