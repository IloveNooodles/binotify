<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Binotify - Albums</title>
  <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
  <?php include_once 'src/view/component/navbar.php' ?>
  <h2>Albums</h2>
  <div class="album-menu">
    <form>
      <input id="album-search" class="search-bar" type="text" name="search" placeholder="Search for albums...">
      <input type="submit" hidden value="Search">
    </form>
    <button id="album-order-btn">
      Sort By
      <i class="arrow down"></i>
    </button>
  </div>
  <div class="sort-menu">
    <a href="#">Album Title</a>
    <a href="#">Release Year</a>
  </div>
  <?php include_once 'src/view/component/albumList.php' ?>
  <script>
    document.getElementById("album-order-btn").addEventListener("click", function() {
      document.querySelector(".sort-menu").classList.toggle("show");
      document.querySelector("#album-order-btn .arrow").classList.toggle("down");
      document.querySelector("#album-order-btn .arrow").classList.toggle("up");
    });
  </script>
</body>
</html>
