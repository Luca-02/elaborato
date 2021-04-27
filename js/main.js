    //back to top
var mybutton = document.getElementById("myBtn");
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    mybutton.style.opacity = 1;
    mybutton.style.visibility = "visible";
  } else {
    mybutton.style.visibility = "hidden";
  }
}
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}


    //bottoni tipo oggetto
let click = document.querySelector('.click');
let list = document.querySelector('.list');
  click.addEventListener("click",()=>
  {
    list.classList.toggle('newlist');
  });
let click2 = document.querySelector('.click2');
let list2 = document.querySelector('.list2');
  click2.addEventListener("click",()=>
  {
    list2.classList.toggle('newlist');
  });
let click3 = document.querySelector('.click3');
let list3 = document.querySelector('.list3');
  click3.addEventListener("click",()=>
  {
    list3.classList.toggle('newlist');
  });
let click4 = document.querySelector('.click4');
let list4 = document.querySelector('.list4');
  click4.addEventListener("click",()=>
  {
    list4.classList.toggle('newlist');
  });


    //valore dello slider del prezzo
var slider = document.getElementById("myRange");
var output = document.getElementById("maxP");
  output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
