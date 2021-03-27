var mySidebar = document.getElementById("mySidebar");

var overlayBg = document.getElementById("myOverlay");
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}
function openDiv(evt, divName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("yashii");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-light-blue", ""); 
  }
  document.getElementById(divName).style.display = "block";
  evt.currentTarget.className += " w3-light-blue";
}