const logo = document.getElementById("logo");
const menu = document.querySelector(".menu");
const spans = document.querySelectorAll("span");
const otoño = document.getElementById("otoño");
const menuA = document.querySelector(".menuA");
const main = document.querySelector("main");
const seccion = document.querySelector("seccion");
const more = document.getElementById("more");
var modal = document.getElementById("ventanaModal");
var cerrar = document.getElementsByClassName("cerrar")[0];
const imagen = document.getElementById('botar');
const basurero = document.getElementById('basurero');
const basureroB = document.getElementById('basureroB');


menuA.addEventListener("click",()=>{
    menu.classList.toggle("max-menu");
    if(menu.classList.contains("max-menu")){
        menuA.children[0].computedStyleMap.display = "none";
        menuA.children[1].computedStyleMap.display = "block";
    }else{
        menuA.children[0].computedStyleMap.display = "block";
        menuA.children[1].computedStyleMap.display = "none";
    }
    if(window.innerWidth<=320){
        menu.classList.add("menu-peque");
        main.classList.add("min-main")
        spans.forEach((span)=>{
            span.classList.add("oculto");
        })
    }
});

otoño.addEventListener("click",()=>{
    let body = document.body;
    body.classList.toggle("modo-autumn");
});

logo.addEventListener("click",()=>{
    menu.classList.toggle("menu-peque");
    main.classList.toggle("min-main");
    spans.forEach((span)=>{
        span.classList.toggle("oculto");
    });
});

function cambiarTexto() {
    var spanElement = document.getElementById("TextoC");
    if (spanElement.textContent === "Otoño") {
        spanElement.textContent = "Verano";
      } else {
        spanElement.textContent = "Otoño";
        var imagen = basurero;
      }
  }
  
// Si el usuario hace clic en la x, la ventana se cierra
cerrar.addEventListener("click",function() {
  modal.style.display = "none";
});
  
  // Si el usuario hace clic fuera de la ventana, se cierra.
  window.addEventListener("click",function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });

