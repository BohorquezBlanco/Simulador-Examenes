var toggleBtn = document.querySelector('.toggle-btn');
var menuResponsive = document.querySelector('.menu-responsive');

document.addEventListener("DOMContentLoaded", function() {
  var cerrar = document.getElementsByClassName("cerrar")[0];
  const modal = document.querySelector('.modal');

  if (cerrar) {
      cerrar.addEventListener("click", function() {
          modal.style.display = "none";
      });
  }
});

if (toggleBtn) {
  // Agrega un event listener para el evento 'click' en el botón toggleBtn
  toggleBtn.addEventListener("click", function() {
    // Selecciona el menú responsive
    var menuResponsive = document.querySelector('.menu-responsive');

    // Alternar la clase 'menu-open' en el menú responsive
    menuResponsive.classList.toggle('menu-open');
  });
} 

function mostrarOpciones() {
  var opciones = document.getElementById("opcionesUsuario");
  if (opciones.style.display === "block") {
    opciones.style.display = "none";
  } else {
    opciones.style.display = "block";
  }
}