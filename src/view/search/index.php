<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Binotify - Search</title>
    <link rel="stylesheet" href="/public/css/styles.css">
    <link rel="stylesheet" href="/public/css/navbar.css">
    <link rel="stylesheet" href="/public/css/search.css">
    <link rel="shortcut icon" href="/public/img/favicon.png" type="image/x-icon">
</head>
<body>
    <?php include_once 'src/view/component/navbar.php' ?>
    <h2 class="title">Search</h2>
    <div class="top-menu">
        <form>
            <input type="text" name="search" class="search-bar" placeholder="Search">
        </form>
        <button id="order-btn">
            Sort By
            <i class="arrow down"></i>
        </button>
    </div>

    <?php include_once 'src/view/component/songList.php' ?>
    <script src="/public/js/search.js"></script>
</body>
</html>
