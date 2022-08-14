var rem = document.getElementById("rem");
var remBtn = document.getElementById("remBtn");

var edit = document.getElementById("edit");
var editBtn = document.getElementById("editBtn");


remBtn.onclick = function() {
  rem.style.display = "none";
  edit.style.display = "block";
}

editBtn.onclick = function() {
  edit.style.display = "none";
  rem.style.display = "block";
}

function editOpen(id1, id2) {
	document.getElementById(id1).style.display = "none";
	document.getElementById(id2).style.display = "block";
}

function remOpen(id1, id2) {
	document.getElementById(id1).style.display = "none";
	document.getElementById(id2).style.display = "block";
}