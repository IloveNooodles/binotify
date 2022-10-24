<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <?php
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        echo('    
        <div class="navbar">
            <a class="active" href="/">Home</a>
            <a>Albums</a>
            <a>Insert Song</a>
            <a>Insert Album</a>
            <div class="navbar-right">
                <form class="inline-child" action="/action_page.php">
                    <input type="text" placeholder="Search song..." name="search">
                    <button type="submit" hidden>Search</button>
                </form>
                <a class="inline-child" id="dropdown-btn">
                    Welcome, ' . $_SESSION['user'] . '
                    <i class="arrow down"></i>
                </a>
            </div>
        </div>
        <div class="dropdown-content">
            <a href="#">Log Out</a>
        </div>
    ');
    }
    else {
        echo('    
        <div class="navbar">
            <a class="active" href="/">Home</a>
            <a>Albums</a>
            <div class="navbar-right">
                <form class="inline-child" action="/action_page.php">
                    <input type="text" placeholder="Search song..." name="search">
                    <button type="submit" hidden>Search</button>
                </form>
                <a class="inline-child" id="dropdown-btn">
                    Welcome, ' . ((isset($_SESSION['user']) ? $_SESSION['user'] : 'Guest')) . '
                    <i class="arrow down"></i>
                </a>
            </div>
        </div>
        <div class="dropdown-content">' .
            ((isset($_SESSION['user']) ? '<a href="#">Log Out</a>' : '<a href="#">Log In</a>')) . '
        </div>
    ');
    }
    ?>
</body>
</html>
<script>
    document.getElementById("dropdown-btn").addEventListener("click", function() {
        document.querySelector(".dropdown-content").classList.toggle("show");
    });
</script>
