var globalMateriaData = null; // Definir la variable global
var globalMatNombre = null;

//###################################################-MATERIA-#########################################################
//---------------------------------SELECT MATERIA-------------------------------------------------
function selecMateria(globalCarrData) {
  $("#selectMatAjax").empty(); //BORRA TODO EL CONTENEDOR
  $(".materiaSelect").empty(); //BORRA TODO EL CONTENEDOR
  $("#temarioMateria").empty(); //BORRA TODO EL CONTENEDOR

  var uniData = {
    idCarrera: globalCarrData, // Crear un objeto con lo necesario
  };
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
                    <p class="card-title">${materia.nombreMateria}</p>
                  </div>
                </div>
                `;
        $("#selectMatAjax").append(MateriaHTML);

        //llenar el filtro
        var filtroMateria = `<option value="${materia.idMateria}">${materia.nombreMateria}</option>`;
        $(".materiaSelect").append(filtroMateria);
      });

      var datosCarrera = obtenerPrimerIdYNombre(
        response,
        "idMateria",
        "nombreMateria"
      );
      globalMateriaData = datosCarrera.primerId;
      globalMatNombre = datosCarrera.primerNombre;
      selecTemario(globalMateriaData);


      //agregar el boton de crear universidad
      // Después de agregar las tarjetas de universidad, agregar el botón al contenedor Esto para evitar que el boton se repita
      $("#selectMatAjax").append(`
              <button id="insertMateria" class="abrirModal" type="button" data-target="modalBase">
                <ion-icon name="add-circle-outline"></ion-icon>
              </button>  
            `);

      // Agregar funcionalidad de arrastrar y soltar
      $(".draggable").on("dragstart", function (event) {
        var idMateria = $(this).attr("id");
        event.originalEvent.dataTransfer.setData("text/plain", idMateria);
      });
      //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--AQUI SE REALIZA EL EVENTO A LA HORA DE ARRASTRAR A MODIFICAR--!!!!!!!!!!!!!!!!!!!!!!!!
      $("#modificarM").on("dragover", function (event) {
        event.preventDefault();
      });
      $("#modificarM").on("drop", function (event) {
        event.preventDefault();

        var idMateria = event.originalEvent.dataTransfer.getData("text/plain");

        // Obtener el objeto de datos de la universidad asociado a la tarjeta con el id almacenado en idUniversidad
        var materiaData = $("#" + idMateria).data("materia");

        $("#contenidoModal").empty();

        //--ESCRIBIR MODAL :D
        var contenidoModal = 
        `
        <div class="head">
          <div class="left-section">
          <p>Editar Materia</p>
          </div>
          <div class="right-section">
              <button class="cerrar">
                  <ion-icon name="close-circle-outline"></ion-icon>
              </button>
          </div>
        </div>
        <form id="modificar" data-materia='${JSON.stringify(materiaData)}'>
          <div class="celda">
            <label class="form-label">Nombre de la materia</label>
            <input name="idMateria" id="idMateria" type="hidden" class="form-control" placeholder="Nombre de la materia" value="${
              materiaData.idMateria
            }">
            <input name="nombreMateria" id="nombreMateria" type="text" class="form-control" placeholder="Nombre de la materia" value="${
              materiaData.nombreMateria
            }">
          </div>
          <div class="celda">
            <label class="form-label">Descripción de la materia</label>
            <textarea class="form-control" rows="3" name="descripcionMateria" id="descripcionMateria" placeholder="Descripción de la materia">${
              materiaData.descripcionMateria
            }</textarea>
          </div>
          <div class="celda">
            <label class="form-label">Imagen de la materia</label>
            <textarea class="form-control" rows="3" name="imagenMateria" id="imagenMateria" placeholder="Imagen de la materia">${
              materiaData.imagenMateria
            }</textarea>
          </div>
          <div class="añadir">
            <button id="editarMateria" type="button" class="btn">Modificar</button>
          </div>
        </form>
        `;
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

      $("#eliminarM").on("dragover", function (event) {
        event.preventDefault();
      });

      $("#eliminarM").on("drop", function (event) {
        event.preventDefault();
        var idMateria = event.originalEvent.dataTransfer.getData("text/plain");

        // Obtener el objeto de datos de la materia asociado a la tarjeta con el id almacenado en idMateria
        var materiaData = $("#" + idMateria).data("materia");

        $("#contenidoModal").empty();

        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--ESCRIBIR MODAL :D--!!!!!!!!!!!!!!!!!!!!!!!!
        var contenidoModal = `
        <div class="head">
          <div class="left-section">
            <p>Eliminar Materia</p>
          </div>
          <div class="right-section">
            <button class="cerrar">
              <ion-icon name="close-circle-outline"></ion-icon>
            </button>
          </div>
        </div>
        <form id="eliminar" data-materia='${JSON.stringify(
          materiaData
        )}'>
        <input type="hidden" class="form-control"  name="idMateria" id="idMateria" value="${
          materiaData.idMateria
        }">
        <div class="celda">
            <label class="form-label">¿Está seguro que desea eliminar ${
              materiaData.nombreMateria
            }?</label>
        </div>
        </form>
        </br>
        <div class="añadir">
          <button id="eliminarMateria" type="button" class="btn">Eliminar</button>
        </div>
        `;
        $("#contenidoModal").append(contenidoModal);

        // Agregar un controlador de eventos al botón de cerrar
        $(".cerrar").on("click", function () {
          // Ocultar el modal al hacer clic en el botón de cerrar
          $("#modalBase").hide();
        });
        // Mostrar el modal después de que se haya construido completamente
        $("#modalBase").fadeIn();
      });
    },
    error: function (xhr, status, error) {
      console.error("Error al cargar las materias:", error);
    },
  });
}

//---------------------------------UPDATE MATERIA-------------------------------------------------
$("#contenidoModal").on("click", "#editarMateria", function (event) {
  event.preventDefault(); // Evitar el envío del formulario por defecto

  // Serializar todos los campos del formulario en un arreglo de objetos
  var formDataArray = $("#modificar").serializeArray();

  // Convertir el arreglo en un objeto JavaScript
  var materiaData = {};
  formDataArray.forEach(function (item) {
    materiaData[item.name] = item.value;
  });

  // Realizar la solicitud AJAX para editar la universidad
  $.ajax({
    url: baseUrl + "editarMateria",
    type: "POST",
    data: materiaData, // Serializar el objeto a JSON
    success: function (response) {
      // Realizar alguna acción adicional si es necesario
      selecMateria(globalCarrData);
      $("#modalBase").hide(); // Ocultar el modal
    },
    error: function (error) {
      console.error("Error al editar la materia:", error);
    },
  });
});

//---------------------------------INSERT MATERIA-------------------------------------------------
$("#selectMatAjax").on("click", "#insertMateria", function () {
  $("#contenidoModal").empty();
  var materiaHTML = `
    <div class="head">
      <div class="left-section">
      <p>Agregar Materia</p>
      </div>
      <div class="right-section">
          <button class="cerrar">
              <ion-icon name="close-circle-outline"></ion-icon>
          </button>
      </div>
    </div>
    <form  id="crear">
      <div class="celda">
        <label class="form-label">Materia</label>
        <input name="nombreMateria" id="nombreMateria" type="text" class="form-control" placeholder="Nombre de la Materia">
      </div>
      <div class="celda">
        <label class="form-label">Descripción de la Materia</label>
        <textarea class="form-control" rows="3" name="descripcionMateria" id="descripcionMateria" placeholder="Descripción de la Materia"></textarea>
      </div>
      <div class="celda">
        <label class="form-label">Imagen de la materia</label>
        <textarea class="form-control" rows="3" name="imagenMateria" id="imagenMateria" placeholder="Imagen de la materia"></textarea>
      </div>
    </form>
    <div class="añadir">
      <button id="agregarMateria" type="button" class="btn">Añadir</button>
    </div>
    `;
  $("#contenidoModal").append(materiaHTML);
  // Agregar un controlador de eventos al botón de cerrar
  $(".cerrar").on("click", function () {
    // Ocultar el modal al hacer clic en el botón de cerrar
    $("#modalBase").hide();
  });
  // Mostrar el modal después de que se haya construido completamente
  $("#modalBase").fadeIn();
});

$("#contenidoModal").on("click", "#agregarMateria", function (event) {
  event.preventDefault(); // Evitar el envío del formulario por defecto

  // Serializar el formulario para obtener todos los valores de los inputs

  // Serializar el formulario para obtener todos los valores de los inputs
  var idCarrera = globalCarrData;
  var formData = $("#crear").serialize();
  // Agregar idU como un parámetro adicional a los datos serializados
  formData += "&idCarrera=" + encodeURIComponent(idCarrera);

  // Realizar la solicitud AJAX para agregar la nueva universidad
  $.ajax({
    url: baseUrl + "crearMateria",
    type: "POST",
    data: formData,
    success: function (response) {
      // Realizar alguna acción adicional si es necesario
      selecMateria(globalCarrData);
      $("#modalBase").hide(); // Ocultar el modal
    },
    error: function (error) {
      console.error("Error al agregar la materia:", error);
    },
  });
});

//---------------------------------DELETE UNIVERSITY-------------------------------------------------
$("#contenidoModal").on("click", "#eliminarMateria", function (event) {
  event.preventDefault(); // Evitar el envío del formulario por defecto
  var formDataArray = $("#eliminar").serializeArray();

  // Convertir el arreglo en un objeto JavaScript
  var materiaData = {};
  formDataArray.forEach(function (item) {
    materiaData[item.name] = item.value;
  });

  console.log(materiaData);

  // Realizar la solicitud AJAX para eliminar la universidad
  $.ajax({
    url: baseUrl + "eliminarMateria",
    type: "POST",
    data: materiaData, // Serializar el objeto a JSON
    success: function (response) {
      // Realizar alguna acción adicional si es necesario
      selecMateria(globalCarrData);
      $("#modalBase").hide(); // Ocultar el modal
    },
    error: function (error) {
      console.error("Error al eliminar la Materia:", error);
    },
  });
});
//###################################################-MATERIA FILTRO-#########################################################

$(".carreraSelect").change(function () {
  var idCarrera = $(this).val();
  globalCarrData = idCarrera; // Asignar uniData a la variable global
  console.log(globalCarrData);

  selecMateria(globalCarrData);
});
