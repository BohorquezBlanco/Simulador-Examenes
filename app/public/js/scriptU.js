const logo = document.getElementById("logo");
const menu = document.querySelector(".menu");
const spans = document.querySelectorAll("span");
const otoño = document.getElementById("otoño");
const menuA = document.querySelector(".menuA");
let slideIndex = 0;
const contenedores = document.querySelectorAll('.contenedor');


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

function mostrarSlide(n) {
  contenedores.forEach(contenedor => {
    contenedor.style.display = 'none';
  });

  if (n >= contenedores.length) {
    slideIndex = 0;
  }
  if (n < 0) {
    slideIndex = contenedores.length - 1;
  }

  contenedores[slideIndex].style.display = 'block';
}

function cambiarSlide(n) {
  slideIndex += n;
  mostrarSlide(slideIndex);
}

mostrarSlide(slideIndex);
