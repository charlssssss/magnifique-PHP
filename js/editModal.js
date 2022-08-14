var editModal = document.getElementById("edit-review-modal");

var editBtn = document.getElementById("edit-review-btn");

var editSpan = document.getElementsByClassName("edit-close")[0];

editBtn.onclick = function() {
  editModal.style.display = "block";
}

editSpan.onclick = function() {
  editModal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == editModal) {
    editModal.style.display = "none";
  }
}