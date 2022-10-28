document.getElementById("dropdown-btn").addEventListener("click", function () {
  document.querySelector(".dropdown-content").classList.toggle("show");
  document.querySelector(".arrow").classList.toggle("down");
  document.querySelector(".arrow").classList.toggle("up");
});

switch (window.location.pathname) {
  case "/":
    document.getElementById("home-navbar").classList.add("active");
    break;
  case "/album":
    document.getElementById("album-navbar").classList.add("active");
    break;
  case "/user":
    document.getElementById("user-navbar").classList.add("active");
    break;
  case "/song/new":
    document.getElementById("insert-song-navbar").classList.add("active");
    break;
  case "/album/new":
    document.getElementById("insert-album-navbar").classList.add("active");
    break;
  case "/album/new_song":
    document.getElementById("insert-album-song-navbar").classList.add("active");
  default:
    break;
}