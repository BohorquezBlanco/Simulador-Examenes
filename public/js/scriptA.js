const logo = document.getElementById("logo");
const menu = document.querySelector(".menu");
const spans = document.querySelectorAll("span");
const otoño = document.getElementById("otoño");
const main = document.querySelector("main");
const seccion = document.querySelector("seccion");
const more = document.getElementById("more");
var modal = document.getElementById("ventanaModal");
var cerrar = document.getElementsByClassName("cerrar")[0];
const imagen = document.getElementById('botar');
const basurero = document.getElementById('basurero');
const basureroB = document.getElementById('basureroB');

document.addEventListener('DOMContentLoaded', function() {
  const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
  
  if (prefersDarkScheme.matches) {
    // Sistema en modo oscuro
    document.documentElement.classList.add('modo-autumn');
  } else {
    // Sistema en modo claro
    document.documentElement.classList.remove('modo-autumn');
  }
});

otoño.addEventListener("click",()=>{
    let body = document.body;
    body.classList.toggle("modo-autumn");
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

