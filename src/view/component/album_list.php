<?php
function return_html($data = []){
    $all_album = albums_in_html($data);
    $html = <<<"EOT"
    <body>
    <ul class="album-list">
        $all_album
    </ul>
    </body>
EOT;
echo $html;
}

function albums_in_html($data){
    $str = "";
    if (!empty($data)){
        foreach($data as $album){
            $album_id = $album['album_id'];
            $image_path = str_replace(BASE_URL,'',$album['image_path']);
            $judul = $album['judul'];
            $penyanyi = $album['penyanyi'];
            $tanggal_terbit = $album['tanggal_terbit'];
            $genre = $album['genre'];
            $html = <<<"EOT"
            <li class="album-list-item" name="$album_id">
                <a href="/album/detail?id=$album_id">
                    <img class="album-image" src="$image_path" alt="album1">
                    <div class="album-text">
                        <p class="album-song-title">$judul</p>
                        <p class="album-song-artist">$tanggal_terbit | $penyanyi | $genre</p>
                    </div>
                </a>
            </li>
    EOT;
            $str = $str . $html;
        }
    }
    return $str;
}