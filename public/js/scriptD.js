const inicio = document.getElementById("inicio");
let slideIndex = 0;
const contenedores = document.querySelectorAll('.contenedor');


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
