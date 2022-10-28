<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Binotify - Insert Album</title>
    <link rel="stylesheet" href="/public/css/styles.css">
    <link rel="stylesheet" href="/public/css/insertAlbum.css">
    <link rel="stylesheet" href="/public/css/navbar.css">
</head>
<body>
    <?php include_once 'src/view/component/navbar.php' ?>
    <a class="back-btn" href="/">
        <i class="arrow left"></i>
    </a>

    <form class="insert-album-form" action="/album/new" method="POST" enctype="multipart/form-data">
        <h3>Insert Song to album</h3>
        <label for="song_to_insert">Song</label>
        <select class="search-bar" name="song_to_insert" id="song_to_insert">
          <option value="a" selected>a</option>
          <option value="a">a</option>
        </select>
        <label for="album_to_insert">Song</label>
        <select class="search-bar" name="album_to_insert" id="album_to_insert">
          <option value="a" selected>a</option>
          <option value="a">a</option>
        </select>
        <?php
            if (isset($data['status_message']) && $data['status_message'] == SUCCESS) {
                echo '<label class="sumbit-success">Submit Album Successful</label>';
            }
            else if (isset($data['status_message']) && ($data['status_message'] != SUCCESS)) {
                $msg = $data['status_message'];
                if ($data['status_message'] == 'INTERNAL_SERVER_ERROR') {
                    $msg = "Album already exists";
                } else if ($data['status_message'] == 'DATA_NOT_COMPLETE') {
                    $msg = "Please fill all the fields";
                } else {
                    $msg = "Something went wrong";
                }
                echo '<label class="sumbit-failure">' . $msg . '</label>';
            }
        ?>
        <button type="submit" class="btn primary submit-album">Add album</button>
    </form>
    <script src="/public/js/insert-song-to-album.js"></script>
</body>
</html>
