<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Binotify - Search</title>
    <link rel="stylesheet" href="/public/css/styles.css">
    <link rel="stylesheet" href="/public/css/navbar.css">
    <link rel="stylesheet" href="/public/css/songList.css">
    <link rel="stylesheet" href="/public/css/search.css">
    <link rel="shortcut icon" href="/public/img/favicon.png" type="image/x-icon">
</head>
<body>
    <?php include_once 'src/view/component/navbar.php' ?>
    <h2 class="title">Search</h2>
    <div class="top-menu">
        <form class="form-search" action="/song" method="GET">
            <div class="search-by">
              <label for="search-page">Judul / Penyanyi / Tahun Terbit</label>
              <input id="search-page" type="text" name="res" class="search-bar" placeholder="Search">
            </div>
            <div class="search-by">
              <label for="Genre">Genre</label>
              <select class="search-bar" name="genre" id="genre">
                <option value="a" selected>a</option>
                <option value="a">b</option>
                <option value="a">c</option>
                <option value="a">d</option>
              </select>
            </div>
            <div class="search-by">
              <label for="sort">Sort</label>
              <select class="search-bar" name="sort" id="sort">
                Sort By
                <option value="ASC" selected>Menaik berdasarkan abjad (A - Z) </option>
                <option value="DESC">Menurun berdasarkan abjad (A - Z) </option>
              </select>
            </div>
        </form>
    </div>
    <?php include_once 'src/view/component/song_list.php' ?>
    <script defer src="/public/js/search.js"></script>
</body>
</html>
