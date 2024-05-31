$(document).ready(function () {
  var globalCarrData = 1; // Definir la variable global
  var globalUniData = 1; // Definir la variable global para la universidad

  //###################################################-CARRERA-#########################################################
  //---------------------------------SELECT CARRERA-------------------------------------------------
  function selecCarrera(globalUniData) {
    $("#selectCarrAjax").empty(); //BORRA TODO EL CONTENEDOR

    var uniData = {
      idU: globalUniData, // Crear un objeto con lo necesario
    };
    $.ajax({
      type: "POST",
      data: uniData,
      url: baseUrl + "carreraAjax",
      dataType: "json",
      success: function (response) {
        // Iterar sobre cada universidad y agregarlo al contenedor
        $.each(response, function (index, carrera) {
          var carreraHTML = `
          <button class="buttonC" id="carrera-${carrera.idCarrera}" data-carrera-id="${carrera.idCarrera}">${carrera.nombreCarrera}</button>`;
          $("#listaC").append(carreraHTML);
        });

        $(".buttonC").click(function () {
          var carreraId = $(this).data("carrera-id"); // Obtener el id de la carrera
          $("#listaC").empty(); //BORRA TODO EL CONTENEDOR
          $("#overlay-right").empty(); //BORRA TODO EL CONTENEDOR

          var carreraHTML = `
          <button id="examenG" class="buttonC">Examen general</button>
          <button id="examenE" class="buttonC">Examen de una sola materia</button>
          `;
          $("#listaC").append(carreraHTML);

          var mensajeHTML = `
          <h5>Esperamos que estés bien</h5>
          <p>Elige la opción que más te convenga:</p>
          <li>Examen general es de todas las materias de la carrera.</li>
          <li>Examen especifico te sirve para elegir las materias especificas.</li>
          `;
          $("#overlay-right").append(mensajeHTML);

          $("#examenG").data("carrera-id", carreraId);
          $("#examenE").data("carrera-id", carreraId);

          $("#examenG").on("click", function () {
            var selectedCarreraId = $(this).data("carrera-id"); // Obtener el id de la carrera

            var url = baseUrl + "examenGE/" + selectedCarreraId;
            open(url);
            console.log(baseUrl + "examenGE/" + selectedCarreraId);
          });

          $("#examenE").on("click", function () {
            var selectedCarreraId = $(this).data("carrera-id"); // Obtener el id de la carrera
            
            var url = baseUrl + "examenGE/" + selectedCarreraId;
            open(url);
            console.log(baseUrl + "examenGE/" + selectedCarreraId);
          });
        });
      },
    });
  }

  // Inicializa la carga de carreras con la universidad global
  selecCarrera(globalUniData);
});
