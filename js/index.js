var openModal = document.getElementById("openModal");
var modal = document.getElementById("modal");

var cancelBtn = document.querySelector(".cancel-btn");

openModal.addEventListener("click", function () {
  modal.style.display = "block";
});

cancelBtn.addEventListener("click", function () {
  modal.style.display = "none";
});