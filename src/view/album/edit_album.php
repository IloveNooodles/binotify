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

    <form class="insert-album-form" action="/album/edit/<?=$data['album']['album_id']?>" method="POST" enctype="multipart/form-data">
        <h3>Edit Album</h3>
        <input type="hidden" id="album_id" name="album_id" value="<?=$data['album']['album_id']?>">
        <input type="text" placeholder="Title" id="judul" name="judul" value="<?=$data['album']['judul']?>">
        <input type="text" disabled placeholder="Artist" id="penyanyi" name="penyanyi" value="<?=$data['album']['penyanyi']?>">
        <input type="text" placeholder="Genre" id="genre" name="genre" value="<?=$data['album']['genre']?>">
        <h4>Release Date</h4>
        <input type="date" placeholder="Release Date" id="tanggal" name="tanggal" value="<?=$data['album']['tanggal_terbit']?>">
        
        <h4>Album Cover</h4>
        <input type="file" id="cover" name="cover" accept="image/*">

        <?php
            if (isset($data['status_message']) && $data['status_message'] == SUCCESSS) {
                echo '<label class="sumbit-success">Update Album Successful</label>';
            }
            else if (isset($data['status_message']) && ($data['status_message'] != SUCCESSS && $data['status_message'] != SUCCESS)) {
                $msg = $data['status_message'];
                if ($data['status_message'] == 'INTERNAL_SERVER_ERROR') {
                    $msg = "Something went wrong";
                } else if ($data['status_message'] == 'DATA_NOT_COMPLETE') {
                    $msg = "Please fill all the fields";
                } else {
                    $msg = "Something went wrong";
                }
                echo '<label class="sumbit-failure">' . $msg . '</label>';
            }
        ?>
        
        <button type="submit" class="btn primary submit-album">Update album</button>
    </form>
</body>
</html>
