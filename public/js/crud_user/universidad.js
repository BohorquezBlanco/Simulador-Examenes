var globalUniData = null; // Definir la variable global

//---------------------------------SELECT UNIVERSITY-------------------------------------------------
function selecUniversidad() {
  $("#selectUniAjax").empty(); //BORRA TODO EL CONTENEDOR
  $(".universidadSelect").empty(); //BORRA TODO EL CONTENEDOR

  $.ajax({
    type: "POST",
    url: baseUrl + "uniAjaxC",
    dataType: "json",
    success: function (response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, unis) {
        //crear un objeto para pasarlo por data-universidad la cual será utilizada mas adelante.
        var universidadData = {
          idU: unis.idU,
          nombreU: unis.nombreU,
          descripcionU: unis.descripcionU,
          imagenU: unis.imagenU,
        };
        var universidadHTML = `
              <div class="card draggable" id="universidad-${
                unis.idU
              }" draggable="true" data-universidad='${JSON.stringify(
          universidadData
        )}'>
                <img src="${unis.imagenU}" alt="By AnisSoft" title="${
          unis.nombreU
        }" draggable="false" />
                <div class="card-body">
                  <p class="card-title">${unis.nombreU}</p>
                </div>
              </div>
              `;
        $("#selectUniAjax").append(universidadHTML);
        //llenar el filtro
        var filtroUniversidad = ` <option value="${unis.idU}">${unis.nombreU}</option>`;
        $(".universidadSelect").append(filtroUniversidad);
      });

      // Asignar los valores a las variables globales
      datosUniversidad = obtenerPrimerIdYNombre(response, "idU", "nombreU");
      globalUniData = datosUniversidad.primerId;
      globalUniNombre = datosUniversidad.primerNombre;

      selecCarrera(globalUniData);
      //agregar el boton de crear universidad

      // Después de agregar las tarjetas de universidad, agregar el botón al contenedor Esto para evitar que el boton se repita
      $("#selectUniAjax").append(`
            <button id="insertUni" class="abrirModal" type="button" data-target="modalBase">
              <ion-icon name="add-circle-outline"></ion-icon>
            </button>  
          `);

      // Agregar funcionalidad de arrastrar y soltar
      $(".draggable").on("dragstart", function (event) {
        var idUniversidad = $(this).attr("id");
        event.originalEvent.dataTransfer.setData("text/plain", idUniversidad);
      });
      }
    }
  )}