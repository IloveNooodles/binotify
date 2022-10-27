document.getElementById("dropdown-btn").addEventListener("click", function () {
  document.querySelector(".dropdown-content").classList.toggle("show");
  document.querySelector(".arrow").classList.toggle("down");
  document.querySelector(".arrow").classList.toggle("up");
});