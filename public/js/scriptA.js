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

document.querySelectorAll('.filterButton').forEach(function(button) {
  button.addEventListener('click', function() {
      var filterOptions = this.parentElement.nextElementSibling;
      if (filterOptions.style.display == 'none' || filterOptions.style.display === '') {
          filterOptions.style.display = 'block';
      } else {
          filterOptions.style.display = 'none';
      }
  });
});

document.addEventListener('DOMContentLoaded', function() {
  var selectElements = document.querySelectorAll('.filter-options select'); 
  selectElements.forEach(function(selectElement) { 
      selectElement.addEventListener('click', function() { 
          var filterOptions = this.parentElement; 
          filterOptions.style.display = 'none'; 
      });
  });
});
