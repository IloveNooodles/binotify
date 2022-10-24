<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Binotify</title>
  <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
  <top-navbar></top-navbar>
  <h1 class="title">Welcome, Guest</h1>
  <song-list></song-list>
  <script src="/src/view/component/navbar.js"></script>
  <script src="/src/view/component/songList.js"></script>
  <script>
    document.getElementById("dropdown-btn").addEventListener("click", function() {
        document.querySelector(".dropdown-content").classList.toggle("show");
    });
  </script>
</body>
</html>
