document.addEventListener("DOMContentLoaded", function() {
  var cerrar = document.getElementsByClassName("cerrar")[0];
  const modal = document.querySelector('.modal');

  if (cerrar) {
      cerrar.addEventListener("click", function() {
          modal.style.display = "none";
      });
  }
});
