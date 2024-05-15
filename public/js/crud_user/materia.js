//###################################################-MATERIA-#########################################################
//---------------------------------SELECT MATERIA-------------------------------------------------
function selecMateria(globalCarrData) {
  $("#selectMatAjax").empty(); //BORRA TODO EL CONTENEDOR
  var uniData = {
    idCarrera: globalCarrData, // Crear un objeto con lo necesario
  };
  console.log("Soy unidata" + uniData);
  $.ajax({
    type: "POST",
    data: uniData,
    url: baseUrl + "materiaAjax",
    dataType: "json",
    success: function (response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, materia) {
        //crear un objeto para pasarlo por data-universidad la cual será utilizada mas adelante.
        var materiaData = {
          idCarrera: materia.idCarrera,
          idMateria: materia.idMateria,
          nombreMateria: materia.nombreMateria,
          descripcionMateria: materia.descripcionMateria,
          imagenMateria: materia.imagenMateria,
        };

        var MateriaHTML = `
                <div class="card draggable" id="materia-${
                  materia.idMateria
                }" draggable="true" data-materia='${JSON.stringify(
          materiaData
        )}'>
                  <img src="${
                    materia.imagenMateria
                  }" alt="By AnisSoft" title="${
          materia.nombreMateria
        }" draggable="false" />
                  <div class="card-body">
                    <h3 class="card-title">${materia.nombreMateria}</h3>
                  </div>
                </div>
                `;
        $("#selectMatAjax").append(MateriaHTML);
      });
      //agregar el boton de crear universidad
      // Después de agregar las tarjetas de universidad, agregar el botón al contenedor Esto para evitar que el boton se repita
      
    }
  });
}
//###################################################-MATERIA FILTRO-#########################################################

$(".carreraSelect").change(function () {
  var idCarrera = $(this).val();
  globalCarrData = idCarrera; // Asignar uniData a la variable global
  console.log(globalCarrData);

  selecMateria(globalCarrData);
});
