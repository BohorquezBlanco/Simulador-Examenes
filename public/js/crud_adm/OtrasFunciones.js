
//PARA ESTO EL ID DEBE LLAMARSE ID Y EL NOMBRE DEBE LLAMARSE NOMBRE, ASI SE PODRA REUTILIZAR LA FUNCION EN OTROS 
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
       console.log("No se encontraron universidades en la respuesta.");
   }
}

