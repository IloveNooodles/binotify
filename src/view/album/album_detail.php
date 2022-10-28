<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Binotify - Album Detail</title>
  <link rel="stylesheet" href="/public/css/styles.css">
  <link rel="stylesheet" href="/public/css/navbar.css">
  <link rel="stylesheet" href="/public/css/songList.css">
  <link rel="stylesheet" href="/public/css/albumDetail.css">
  <link rel="stylesheet" href="/public/css/deleteConfirmation.css">
  <link rel="shortcut icon" href="/public/img/favicon.png" type="image/x-icon">
</head>
<body>
  <?php include_once BASE_URL . '/src/view/component/navbar.php' ?>
  <?php
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
      echo '<a class="edit-btn" href="/album/edit/' . $data['album']['album_id'] . '">Edit</a>';
      echo '<a class="delete-btn" id="album-delete-btn">Delete</a>';
    }
  ?>
  <div class="album-details">
    <img class="album-image" src=<?=str_replace(BASE_URL,"",$data["album"]["image_path"])?> alt="album1">
    <div class="title-artist">
      <p class="album-sign">ALBUM</p>
      <p class="album-title"><?=$data["album"]["judul"]?></p>
      <p class="album-artist"><?=$data["album"]["penyanyi"]?></p>
      <p class="album-duration">
        <?=$data["album"]["tahun_terbit"]?>
        •
        <?=$data["total_song"]?>
        •
        <?php
          $min = intdiv($data["album"]["total_duration"],60);
          $sec = fmod($data["album"]["total_duration"],60);
          echo ($min == 1 ? $min . " minute " : $min . " minutes ") . ($sec == 1 ? $sec . " second" : $sec . " seconds");
        ?>
      </p>
    </div>
  </div>
  <?php 
    include_once 'src/view/component/song_list.php';
    return_html($data['songs'], true);
  ?>
  <?php 
    include_once 'src/view/component/delete_confirmation.php';
    delete_confirmation_album($data['album']['album_id']);
    delete_confirmation_song(0);
  ?>
</body>
<script src="/public/js/delete-confirmation.js"></script>
</html>