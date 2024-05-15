//Toma el primer y segundo valor de un response
function obtenerPrimerIdYNombre(response,valor1,valor2) {
  if (response.length > 0) {
      // Obtener el primer objeto universidad de la respuesta
      var primerObjeto = response[0];
    
      // Acceder directamente a las propiedades idU y nombreU del primer objeto
      var primerId = primerObjeto[valor1];
      var primerNombre = primerObjeto[valor2];
    
     // Devolver el primer ID
       // Devolver un objeto con ambos valores
       return {
        primerId: primerId,
        primerNombre: primerNombre
    };

  } else {
   return {
     primerId: 0,
     primerNombre: 0
 };
  }
}

//FUNCION PARA DAR EFECTO DE FUNDIDO EN EL MODAL 
function fadeIn(selector, duracion) {
 var opacidad = 0;
 var elemento = document.querySelector(selector);
 if (elemento) {
   elemento.style.display = "block";
   var intervalo = setInterval(function() {
     if (opacidad < 1) {
       opacidad += 0.05;
       elemento.style.opacity = opacidad;
     } else {
       clearInterval(intervalo);
     }
   }, duracion / 20);
 } else {
   console.error("El elemento con el selector '" + selector + "' no fue encontrado.");
  }
}