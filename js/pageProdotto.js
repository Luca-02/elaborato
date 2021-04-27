    //apertura chiusura recensioni recenti
var coll = document.getElementsByClassName("collapsible");
var i;
for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    }
  });
}

    //apertura chiusura img prodotto overlay
var modal = document.getElementById('myModal');
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
var span = document.getElementsByClassName("close")[0];
span.onclick = function() {
  modal.style.display = "none";
}

    //apertura chiusura recensisci overlay
function on() {
  document.getElementById("overlay").style.display = "block";
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
var span = document.getElementsByClassName("close2")[0];
span.onclick = function() {
  document.getElementById("overlay").style.display = "none";
}
