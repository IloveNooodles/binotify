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

    <form class="insert-album-form" action="/album/new" method="POST" enctype="multipart/form-data">
        <h3>Insert Song to album</h3>
        <select class="option-bar" name="song_to_insert" id="song_to_insert">
            <option value="" selected>Choose Song to Insert</option>
            <option value="a">a</option>
        </select>
        <select class="option-bar" name="album_to_insert" id="album_to_insert">
            <option value="" selected>Choose Album Destination</option>
            <option value="a">a</option>
        </select>
        <?php
            if (isset($data['status_message']) && $data['status_message'] == SUCCESS) {
                echo '<label class="sumbit-success">Insert Song to Album Successful</label>';
            }
            else if (isset($data['status_message']) && ($data['status_message'] != SUCCESS)) {
                $msg = $data['status_message'];
                if ($data['status_message'] == 'ALBUM_SONG_NOT_NULL') {
                    $msg = "Album already exists";
                } else if ($data['status_message'] == 'INCOMPLETE_QUERY_PARAMS') {
                    $msg = "Please fill all the fields";
                } else {
                    $msg = "Something went wrong";
                }
                echo '<label class="sumbit-failure">' . $msg . '</label>';
            }
        ?>
        <button type="submit" id="submit-add-song" class="btn primary submit-album">Add Song to Album</button>
    </form>
    <script defer src="/public/js/insert-song-to-album.js"></script>
</body>
</html>
