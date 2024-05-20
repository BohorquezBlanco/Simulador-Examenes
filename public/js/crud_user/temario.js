function selecTemario(globalMateriaData) {
  $("#temarioMateria").empty(); // BORRA TODO EL CONTENEDOR
  var uniData = {
    idMateria: globalMateriaData, // Crear un objeto con lo necesario
  };
  $.ajax({
    type: "POST",
    url: baseUrl + "temarioMateriaC",
    data: uniData,
    dataType: "json",
    success: function (response) {
      $.each(response, function (index, temario) {
        // Crear un objeto para pasarlo por data-id-temario la cual será utilizada más adelante.
        var temarioHTML = `
<li onclick="manejarClickT(this)" data-id-temario="${temario.idTemario}">${temario.nombreTemario}</li>
        `;
        $("#temarioList").append(temarioHTML);
      });
      $("#temarioList li:first-child").each(function() {
        manejarClickT(this);
      });
      
      
    },
    error: function (xhr, status, error) {
      console.error("Error al insertar el tema:", error);
    },
  });
}
function manejarClickT(li) {
  // Captura el idTemario del atributo data-id-temario
  const idTemario = li.getAttribute('data-id-temario');
  console.log(idTemario);

  // Realiza la solicitud AJAX para obtener los libros correspondientes al idTemario
  $.ajax({
    type: "POST",
    url: baseUrl + "temarioLibroC",
    data: { idTemario: idTemario },
    dataType: "json",
    success: function (response) {
      $("#lib").empty(); // Limpiar el contenedor del libro

      // Iterar sobre los libros recibidos en la respuesta
      $.each(response, function (index, temario) { // Asegúrate de que la respuesta tiene un formato correcto
        var libroHTML = `
        <p>Libros</p>
        <a href="${temario.libroTemario}" target="_blank">${temario.libroTemario}</a>
        `;
        $("#lib").append(libroHTML);
      });
    },
    error: function (xhr, status, error) {
      console.error("Error al obtener el libro:", error);
      // Opcional: Muestra un mensaje de error en la interfaz de usuario
      $("#lib").empty(); // Limpiar el contenedor del libro
      var errorHTML = `
        <p>Error al obtener los libros. Por favor, intenta de nuevo más tarde.</p>
      `;
      $("#lib").append(errorHTML);
    }
  });
}
