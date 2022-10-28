<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Binotify - Insert Album</title>
    <link rel="stylesheet" href="/public/css/styles.css">
    <link rel="stylesheet" href="/public/css/insertSongToAlbum.css">
    <link rel="stylesheet" href="/public/css/navbar.css">
</head>
<body>
    <?php include_once 'src/view/component/navbar.php' ?>
    <a class="back-btn" href="/">
        <i class="arrow left"></i>
    </a>

    <form class="insert-album-form" enctype="multipart/form-data">
        <h3>Insert Song to album</h3>
        <select class="option-bar" name="song_id" id="song_to_insert">
            <option value="" selected>Choose Song to Insert</option>
            <option value="a">a</option>
        </select>
        <select class="option-bar" name="album_id" id="album_to_insert">
            <option value="" selected>Choose Album Destination</option>
            <option value="a">a</option>
        </select>
        <label class="sumbit-message"></label>
        <button type="button" id="submit-add-song" class="btn primary submit-album">Add Song to Album</button>
    </form>
    <script defer src="/public/js/insert-song-to-album.js"></script>
</body>
</html>
