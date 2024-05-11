const more = document.getElementById("more");
var modal = document.getElementById("ventanaModal");
var cerrar = document.getElementsByClassName("cerrar")[0];

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

