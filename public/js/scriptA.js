var toggleBtn = document.querySelector('.toggle-btn');
var menuResponsive = document.querySelector('.menu-responsive');
var menuItems = document.querySelectorAll('.btnM')

document.addEventListener("DOMContentLoaded", function() {
  var cerrar = document.getElementsByClassName("cerrar")[0];
  const modal = document.querySelector('.modal');

  if (cerrar) {
      cerrar.addEventListener("click", function() {
          modal.style.display = "none";
      });
  }
});

function toggleMenu() {
  var menuResponsive = document.querySelector('.menu-responsive');
  menuResponsive.style.display = "block";
}

function ocultarMenuR() {
  var menuResponsive = document.querySelector('.menu-responsive');
  menuResponsive.style.display = "none";
}


function mostrarOpciones() {
  var opciones = document.getElementById("opcionesUsuario");
  if (opciones.style.display === "block") {
    opciones.style.display = "none";
  } else {
    opciones.style.display = "block";
  }
}
function ocultarMenu() {
  var opciones = document.getElementById("opcionesUsuario");
  opciones.style.display = "none";
}
