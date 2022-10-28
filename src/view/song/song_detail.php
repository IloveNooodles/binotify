<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Binotify - Song Detail</title>
    <link rel="stylesheet" href="/public/css/styles.css">
    <link rel="stylesheet" href="/public/css/navbar.css">
    <link rel="stylesheet" href="/public/css/songList.css">
    <link rel="stylesheet" href="/public/css/songdetail.css">
    <link rel="stylesheet" href="/public/css/albumDetail.css">
    <link rel="stylesheet" href="/public/css/deleteConfirmation.css">
    <link rel="shortcut icon" href="/public/img/favicon.png" type="image/x-icon">
</head>
<body>
    <?php include_once BASE_URL . '/src/view/component/navbar.php'; ?>
    <div class="vw">
        <img class="song-detail-image" src="<?=str_replace(BASE_URL,'',$data['song']['image_path'])?>" alt="song1">
        <?php
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            echo '<a class="edit-btn" href="/song/edit/' . $data['song']['song_id'] . '">Edit</a>';
            echo '<a class="delete-btn" id="song-delete-btn">Delete</a>';
        }
        ?>
    </div>
    <div class="song-detail-content">
        <p class="song-detail-album">From Album: <?php
            echo ($data['album']['album']) ? 
                "<a href='/album/detail/" . $data['album']['album']['album_id'] . "'>" . $data['album']['album']['judul'] . "</a>"
                : "-";
        ?></p>
        <img class="player-cover" src="<?=str_replace(BASE_URL,'',$data['song']['image_path'])?>" alt="cover">
        <h3 class="music-name"><?=$data['song']['judul']?></h3>
        <h4 class="artist-name"><?=$data['song']['penyanyi']?></h4>
        <div class="song-slider">
            <input type="range" value="0" class="seek-bar" max="<?=$data['song']['duration']?>">
            <span class="current-time">00 : 00</span>
            <span class="song-duration">
                <?php
                    $duration = $data['song']['duration'];
                    $minutes = floor($duration / 60);
                    $seconds = $duration % 60;
                    echo $minutes . " : " . $seconds;
                ?>
            </span>
        </div>
        <button class="play-btn pause">
            <span></span>
            <span></span>
        </button>
        <p class="song-detail-date-genre">
            <?=$data['song']['genre'] ? $data['song']['genre'] : ''?>
        </p>
        <p class="song-detail-date-genre">
            <?=$data['song']['tanggal_terbit']?>
        </p>
        <audio src="<?=str_replace(BASE_URL,'',$data['song']['audio_path'])?>" id="audio"></audio>
    </div>
    <?php 
        include_once 'src/view/component/delete_confirmation.php';
        delete_confirmation_song($data['song']['song_id']);
    ?>
</body>
<script src="/public/js/song-detail.js"></script>
</html>