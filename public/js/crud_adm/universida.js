var globalUniData = null; // Definir la variable global

//---------------------------------SELECT UNIVERSITY-------------------------------------------------
function selecUniversidad() {
  $("#selectUniAjax").empty(); //BORRA TODO EL CONTENEDOR
  $(".universidadSelect").empty(); //BORRA TODO EL CONTENEDOR

  $.ajax({
    type: "POST",
    url: baseUrl + "uniAjax",
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
      preguntaCarreras();

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
      //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--AQUI SE REALIZA EL EVENTO A LA HORA DE ARRASTRAR A MODIFICAR--!!!!!!!!!!!!!!!!!!!!!!!!
      $("#modificarU").on("dragover", function (event) {
        event.preventDefault();
      });
      $("#modificarU").on("drop", function (event) {
        event.preventDefault();

        var idUniversidad =
          event.originalEvent.dataTransfer.getData("text/plain");

        // Obtener el objeto de datos de la universidad asociado a la tarjeta con el id almacenado en idUniversidad
        var universidadData = $("#" + idUniversidad).data("universidad");

        $("#contenidoModal").empty();

        //--ESCRIBIR MODAL :D
        var contenidoModal = `
        <div class="head">
        <div class="left-section">
            <p>Modificar Universidad o instituto</p>
        </div>
        <div class="right-section">
            <button class="cerrar">
                <ion-icon name="close-circle-outline"></ion-icon>
            </button>
        </div>
    </div>
    
    <form id="modificar" data-universidad='${JSON.stringify(universidadData)}'>
      <div class="celda">
        <label class="form-label">Nombre de la universidad/instituto</label>
        <input name="idU" id="idU" type="hidden" class="form-control" placeholder="Nombre de la universidad/instituto" value="${
          universidadData.idU
        }">
        <input name="nombreU" id="nombreU" type="text" class="form-control" placeholder="Nombre de la universidad/instituto" value="${
          universidadData.nombreU
        }">
      </div>
      <div class="celda">
        <label class="form-label">Descripción de la universidad/instituto</label>
        <textarea class="form-control" rows="3" name="descripcionU" id="descripcionU" placeholder="Descripción de la universidad/instituto">${
          universidadData.descripcionU
        }</textarea>
      </div>
      <div class="celda">
        <label class="form-label">Imagen de la universidad/instituto</label>
        <textarea class="form-control" rows="3" name="imagenU" id="imagenU" placeholder="Imagen de la universidad/instituto">${
          universidadData.imagenU
        }</textarea>
      </div>
    </form>
    <div class="añadir">
      <button id="editarUni" type="button" class="btn">Modificar</button>
    </div>
    `;
        // Agregar el contenido modal al elemento correspondiente en el DOM
        $("#contenidoModal").append(contenidoModal);

        // Agregar un controlador de eventos al botón de cerrar
        $(".cerrar").on("click", function () {
          // Ocultar el modal al hacer clic en el botón de cerrar
          $("#modalBase").hide();
        });

        // Mostrar el modal después de que se haya construido completamente
        $("#modalBase").fadeIn();
      });
      //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--AQUI SE REALIZA EL EVENTO A LA HORA DE ARRASTRAR A ELIMINAR--!!!!!!!!!!!!!!!!!!!!!!!!
      $("#eliminarU").on("dragover", function (event) {
        event.preventDefault();
      });

      $("#eliminarU").on("drop", function (event) {
        event.preventDefault();
        var idUniversidad =
          event.originalEvent.dataTransfer.getData("text/plain");

        // Obtener el objeto de datos de la universidad asociado a la tarjeta con el id almacenado en idUniversidad
        var universidadData = $("#" + idUniversidad).data("universidad");

        $("#contenidoModal").empty();

        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--ESCRIBIR MODAL :D--!!!!!!!!!!!!!!!!!!!!!!!!
        var contenidoModal = `
        <div class="head">
    <div class="left-section">
    <p>Eliminar Universidad o instituto</p>
    </div>
    <div class="right-section">
        <button class="cerrar">
            <ion-icon name="close-circle-outline"></ion-icon>
        </button>
    </div>
</div>
        <form id="eliminar" data-universidad='${JSON.stringify(universidadData)}'>
        <input name="idU" id="idU" type="hidden" class="form-control" placeholder="Nombre de la universidad/instituto" value="${
          universidadData.idU
        }">
            <div class="celda">
                <label class="form-label">¿Está seguro que desea eliminar "${
                  universidadData.nombreU
                }"?</label>
            </div>
        </form>
        <br>
        <div class="añadir">
        <button id="eliminarUniversidad" type="button" class="btn">Eliminar</button>
        </div>
        `;
        $("#contenidoModal").append(contenidoModal);

        // Agregar un controlador de eventos al botón de cerrar
        $(".cerrar").on("click", function () {
          // Ocultar el modal al hacer clic en el botón de cerrar
          $("#modalBase").hide();
        });

        $("#modalBase").fadeIn();
      });
    },
    error: function (error) {
      console.error("Error al cargar las universidades:", error);
    },
  });
}

//---------------------------------UPDATE UNIVERSITY-------------------------------------------------
$("#contenidoModal").on("click", "#editarUni", function (event) {
  event.preventDefault(); // Evitar el envío del formulario por defecto

  // Serializar todos los campos del formulario en un arreglo de objetos
  var formDataArray = $("#modificar").serializeArray();

  // Convertir el arreglo en un objeto JavaScript
  var universidadData = {};
  formDataArray.forEach(function (item) {
    universidadData[item.name] = item.value;
  });

  console.log(universidadData);

  // Realizar la solicitud AJAX para editar la universidad
  $.ajax({
    url: baseUrl + "editarUni",
    type: "POST",
    data: universidadData, // Serializar el objeto a JSON
    success: function (response) {
      console.log("Universidad editada con éxito:", response);
      // Realizar alguna acción adicional si es necesario
      selecUniversidad();
      $("#modalBase").hide(); // Ocultar el modal
    },
    error: function (error) {
      console.error("Error al editar la universidad:", error);
    },
  });
});

//---------------------------------INSERT UNIVERSITY-------------------------------------------------
$("#selectUniAjax").on("click", "#insertUni", function () {
  $("#contenidoModal").empty();
  var universidadHTML = `
  <div class="head">
    <div class="left-section">
      <p>Añadir Universidad o instituto</p>
    </div>
    <div class="right-section">
        <button class="cerrar">
            <ion-icon name="close-circle-outline"></ion-icon>
        </button>
    </div>
</div>
      <form  id="crear">
        <div class="celda">
          <label class="form-label">Nombre de la universidad/instituto</label>
          <input name="nombreU" id="nombreU" type="text" class="form-control" placeholder="Nombre de la universidad/instituto">
        </div>
        <div class="celda">
          <label class="form-label">Descripción de la universidad/instituto</label>
          <textarea class="form-control" rows="3" name="descripcionU" id="descripcionU" placeholder="Descripción de la universidad/instituto"></textarea>
        </div>
        <div class="celda">
          <label class="form-label">Imagen de la universidad/instituto</label>
          <textarea class="form-control" rows="3" name="imagenU" id="imagenU" placeholder="Imagen de la universidad/instituto"></textarea>
        </div>
      </form>
      <div class="añadir">
        <button id="agregarUni" type="button" class="btn">Añadir</button>
      </div>
    `;
  $("#contenidoModal").append(universidadHTML);
  // Agregar un controlador de eventos al botón de cerrar
  $(".cerrar").on("click", function () {
    // Ocultar el modal al hacer clic en el botón de cerrar
    $("#modalBase").hide();
  });
  $("#modalBase").fadeIn();
});

$("#contenidoModal").on("click", "#agregarUni", function (event) {
  event.preventDefault(); // Evitar el envío del formulario por defecto

  // Serializar el formulario para obtener todos los valores de los inputs
  var formData = $("#crear").serialize();

  // Realizar la solicitud AJAX para agregar la nueva universidad
  $.ajax({
    url: baseUrl + "crearUni",
    type: "POST",
    data: formData,
    success: function (response) {
      console.log("Universidad agregada con éxito:", response);
      // Realizar alguna acción adicional si es necesario
      selecUniversidad();
      $("#modalBase").hide(); // Ocultar el modal
    },
    error: function (error) {
      console.error("Error al agregar la universidad:", error);
    },
  });
});

//---------------------------------DELETE UNIVERSITY-------------------------------------------------
$("#contenidoModal").on("click", "#eliminarUniversidad", function (event) {
  event.preventDefault(); // Evitar el envío del formulario por defecto
  var formDataArray = $("#eliminar").serializeArray();

  // Convertir el arreglo en un objeto JavaScript
  var universidadData = {};
  formDataArray.forEach(function (item) {
    universidadData[item.name] = item.value;
  });
  
  console.log(universidadData);

  // Realizar la solicitud AJAX para eliminar la universidad
  $.ajax({
    url: baseUrl + "eliminarUni",
    type: "POST",
    data: universidadData, // Serializar el objeto a JSON
    success: function (response) {
      console.log("Universidad eliminada con éxito:", response);
      // Realizar alguna acción adicional si es necesario
      selecUniversidad();
      $("#modalBase").hide(); // Ocultar el modal
    },
    error: function (error) {
      console.error("Error al eliminar la universidad:", error);
    },
  });
});