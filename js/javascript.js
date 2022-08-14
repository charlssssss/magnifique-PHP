//Get the button
var gotopbutton = document.getElementById("goTopBtn");
var catwrap = document.getElementById("categoriesWrapper");


// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    gotopbutton.style.display = "block";
    categoriesWrapper.style.top = "20px";
    categoriesWrapper.style.position = "fixed";
  } else {
    gotopbutton.style.display = "none";
    categoriesWrapper.style.position = "static";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

//
var img = document.getElementById("main-img");

function img1(imagePath){
  img.src = imagePath;
  document.getElementById("image1").style.border = "2px solid #36393f";
  document.getElementById("image2").style.border = "";
  document.getElementById("image3").style.border = "";
  document.getElementById("image4").style.border = "";
}
function img2(imagePath){
  img.src = imagePath;
  document.getElementById("image1").style.border = "";
  document.getElementById("image2").style.border = "2px solid #36393f";
  document.getElementById("image3").style.border = "";
  document.getElementById("image4").style.border = "";
}
function img3(imagePath){
  img.src = imagePath;
  document.getElementById("image1").style.border = "";
  document.getElementById("image2").style.border = "";
  document.getElementById("image3").style.border = "2px solid #36393f";
  document.getElementById("image4").style.border = "";
  
}
function img4(imagePath){
  img.src = imagePath;
  document.getElementById("image1").style.border = "";
  document.getElementById("image2").style.border = "";
  document.getElementById("image3").style.border = "";
  document.getElementById("image4").style.border = "2px solid #36393f";
  
}

// Get the modal
var modal = document.getElementById("review-modal");

// Get the button that opens the modal
var btn = document.getElementById("review-btn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// open and close modal for updating item quantity
function editQty(editId){
  document.getElementById(editId).style.display = "block";
}

function closeQty(editId){
  document.getElementById(editId).style.display = "none";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function payMethodChangeBorder() {
  // Get the checkbox
  var payMethod1 = document.getElementById("pay_Method1");
  var payMethod1 = document.getElementById("pay_Method1");
  // Get the payment method box
  var cod = document.getElementById("cod1");
  var card = document.getElementById("card2");

// If the checkbox is checked, change boreder
  if (payMethod1.checked == true){
    cod.style.border = "1px solid #202225";
    card.style.border = "1px solid #bcbec1";
  } else {
    cod.style.border = "1px solid #bcbec1";
    card.style.border = "1px solid #202225";
  }
}