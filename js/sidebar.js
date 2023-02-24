var burgerButton = document.getElementById("sidebar__button");
var sidebar = document.getElementById("sidebar__content");

burgerButton.addEventListener("click", function() {
  sidebar.classList.toggle("active");
});