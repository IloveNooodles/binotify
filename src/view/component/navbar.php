<?php
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        echo '
        <head>
            <link rel="stylesheet" href="/public/css/navbar.css">
            <link rel="stylesheet" href="/public/css/styles.css">
        </head>
        <body>
        <div class="navbar">
            <a class="active" href="/">Home</a>
            <a href="/album">Albums</a>
            <a href="/song/new">Insert Song</a>
            <a href="/album/new">Insert Album</a>
            <div class="navbar-right">
                <form class="inline-child" action="/action_page.php">
                    <input class="search-bar" type="text" placeholder="What do you want to listen to?" name="search">
                    <button type="submit" hidden>Search</button>
                </form>
                <button id="dropdown-btn">
                    <img class="profile-img" src="/public/img/avatar-template.jpeg" alt="user">
                    <p>' . $_SESSION['username'] . '</p>
                    <i class="arrow down"></i>
                </button>
            </div>
        </div>
        <div class="dropdown-content">
        <form action="/user" method="post">
            <button type="submit" class="btn-submit">Log Out</button>
        </form>
        </div>
        <script>
            document.getElementById("dropdown-btn").addEventListener("click", function() {
                document.querySelector(".dropdown-content").classList.toggle("show");
            });
        </script>
        <body>';
    }
    else {
        echo '
        <head>
            <link rel="stylesheet" href="/public/css/navbar.css">
            <link rel="stylesheet" href="/public/css/styles.css">
        </head>
        <body>
        <div class="navbar">
            <a class="active" href="/">Home</a>
            <a href="/album">Albums</a>
            <div class="navbar-right">
                <form class="inline-child" action="/action_page.php">
                    <input class="search-bar" type="text" placeholder="What do you want to listen to?" name="search">
                    <button type="submit" hidden>Search</button>
                </form>
                <button id="dropdown-btn">
                    <img class="profile-img" src="/public/img/avatar-template.jpeg" alt="user">
                    <p>' . (isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest') . '</p>
                    <i class="arrow down"></i>
                </button>
            </div>
        </div>
        <div class="dropdown-content"> 
        <form action="/user" method="post">' .
        (isset($_SESSION['username']) ? '<button type="submit" class="btn-submit">Log Out</button>' : '<a href="/login">Log In</a>') . '
        </form>
        </div>
        <script>
            document.getElementById("dropdown-btn").addEventListener("click", function() {
                document.querySelector(".dropdown-content").classList.toggle("show");
                document.querySelector(".arrow").classList.toggle("down");
                document.querySelector(".arrow").classList.toggle("up");
            });
        </script>
        </body>';
    }
?>