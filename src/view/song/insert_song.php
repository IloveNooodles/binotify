<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Binotify - Insert new Song</title>
    <link rel="stylesheet" href="/public/css/styles.css">
    <link rel="stylesheet" href="/public/css/insertSong.css">
    <link rel="stylesheet" href="/public/css/navbar.css">
</head>
<body class="insert-album-page">
    <?php include_once 'src/view/component/navbar.php' ?>
    <a class="back-btn" href="/">
        <i class="arrow left"></i>
    </a>

    <form class="insert-song-form" action="/login" method="POST">
        <h3>Insert New Song</h3>
        <input type="text" placeholder="Judul" id="judul" name="judul">
        <input type="text" placeholder="Penyanyi" id="penyanyi" name="penyanyi">
        <input type="date" placeholder="Tanggal Terbit" id="tanggal" name="tanggal">
        <input type="text" placeholder="Genre" id="genre" name="genre">
        
        <select id="standard-select">
            <option value="Option 1">Select Album</option>
            <option value="Option 2">Option 2</option>
            <option value="Option 3">Option 3</option>
            <option value="Option 4">Option 4</option>
            <option value="Option 5">Option 5</option>
        </select>

        <h4>Song Cover</h4>
        <input type="file" id="cover" name="cover">
        <h4>Song Audio</h4>
        <input type="file" id="audio" name="audio">
        
        <button type="submit" class="btn primary submit-song">Submit Song</button>
    </form>

</body>
</html>
