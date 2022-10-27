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
  default:
    break;
}