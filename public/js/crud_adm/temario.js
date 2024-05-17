//###################################################-PREGUNTAS-#########################################################
//preguntas de la materia
function selecTemario(globalMateriaData) {
  $("#temarioMateria").empty(); //BORRA TODO EL CONTENEDOR
  var uniData = {
    idMateria: globalMateriaData, // Crear un objeto con lo necesario
  };
  $.ajax({
    type: "POST",
    url: baseUrl + "temarioMateria",
    data: uniData,
    dataType: "json",
    success: function (response) {
      $.each(response, function (index, temario) {
        //crear un objeto para pasarlo por data-universidad la cual será utilizada mas adelante.
        var temarioData = {
          idTemario: temario.idTemario,
          nombreTemario: temario.nombreTemario,
          contenidoTemario: temario.contenidoTemario,
          libroTemario: temario.libroTemario,
          idMateria: globalMateriaData,
          nombreMateria: globalMatNombre,
        };
        var temarioHTML = `
            <tr>
              <td>${temario.nombreTemario}</td>
              <td>${temario.contenidoTemario}</td>
              <td>${temario.libroTemario}</td>
              <td>${temarioData.nombreMateria}</td>
              <td><button class="modificar" data-temarioData='${JSON.stringify(
                temarioData
              )}'><i class="fa-solid fa-pen-to-square"></i></button></td>
              <td><button class="eliminar" data-temarioData='${JSON.stringify(
                temarioData
              )}'><i class="fa-solid fa-eraser"></i></button></td>
              </tr>
            `;
        $("#temarioMateria").append(temarioHTML);
      });
    },
    error: function (xhr, status, error) {
      console.error("Error al insertar el tema:", error);
    },
  });
}

//ELIMINAR
$("#temarioMateria").on("click", ".eliminar", function () {
  var temarioDataString = $(this).attr("data-temarioData");
  var temarioData = JSON.parse(temarioDataString);
  $("#contenidoModal").empty();

  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--ESCRIBIR MODAL :D--!!!!!!!!!!!!!!!!!!!!!!!!
  var contenidoModal = `
      <div class="head">
        <div class="left-section">
        <p>Eliminar Temario</p>
        </div>
        <div class="right-section">
            <button class="cerrar">
                <ion-icon name="close-circle-outline"></ion-icon>
            </button>
        </div>
      </div>
      <form id="eliminar" data-materia='${JSON.stringify(temarioData)}'>
      <input type="hidden" name="idTemario" value="${temarioData.idTemario}">
        <div class="celda">
            <label class="form-label">¿Está seguro que desea eliminar el temario: " ${
              temarioData.nombreTemario
            }"?</label>
        </div>
      <br>
      </form>
      <div class="añadir">
        <button id="eliminarTemario" type="button" class="btn">Eliminar</button>
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

$("#contenidoModal").on("click", "#eliminarTemario", function (event) {
  event.preventDefault(); // Evitar el envío del formulario por defecto
  var formDataArray = $("#eliminar").serializeArray();
  console.log(formDataArray);
  // Convertir el arreglo en un objeto JavaScript
  var temarioData = {};
  formDataArray.forEach(function (item) {
    temarioData[item.name] = item.value;
  });

  console.log(temarioData);
  // Realizar la solicitud AJAX para eliminar la universidad
  $.ajax({
    url: baseUrl + "eliminarTemario",
    type: "POST",
    data: temarioData, // Serializar el objeto a JSON
    success: function (response) {
      console.log("Temario eliminado con éxito:", response);
      // Realizar alguna acción adicional si es necesario
      selecMateria(globalCarrData);
      $("#modalBase").hide(); // Ocultar el modal
    },
    error: function (error) {
      console.error("Error al eliminar el Temario:", error);
    },
  });
});

//MODIFICAR
$("#temarioMateria").on("click", ".modificar", function () {
  var temarioDataString = $(this).attr("data-temarioData");
  var temarioData = JSON.parse(temarioDataString);

  $("#contenidoModal").empty();
  var temarioHTML = `
  <div class="head">
    <div class="left-section">
      <p>Modificar Temario</p>
    </div>
    <div class="right-section">
      <button class="cerrar">
          <ion-icon name="close-circle-outline"></ion-icon>
      </button>
    </div>
  </div>
  <form id="modificarT">
  <div class="celda">
    <label class="form-label">Materia</label>
    <select class="form-select" id="selectMateriaTemario" name="idMateria">
      <option value="${temarioData.idMateria}" selected>${temarioData.nombreMateria}</option>
      <option id="materiaTemarioMod" value="${globalMateriaData}" >${globalMatNombre}</option>
    </select>
  </div>
  <div class="celda">
    <label class="form-label">Nombre del Temario</label>
    <input type="text" class="form-control" name="nombreTemario" id="nombreTemario" value="${temarioData.nombreTemario}">
    <input type="hidden" class="form-control" name="idTemario" id="idTemario" value="${temarioData.idTemario}">
  </div>
  <div class="celda">
    <label class="form-label">Contenido del Temario</label>
    <input type="text" class="form-control" name="contenidoTemario" id="contenidoTemario" value="${temarioData.contenidoTemario}" >
  </div>
  <div class="celda">
    <label class="form-label">Libro del Temario</label>
    <input type="text" class="form-control" name="libroTemario"  id="libroTemario" value="${temarioData.libroTemario}" >
  </div>
  </form>
  <div class="añadir">
    <button id="modificarTemarioForm" type="submit" class="btn">Modificar</button>
  </div>
  
  `;
  $("#contenidoModal").append(temarioHTML);
  $(".cerrar").on("click", function () {
    // Ocultar el modal al hacer clic en el botón de cerrar
    $("#modalBase").hide();
  });
  // Mostrar el modal después de que se haya construido completamente
  $("#modalBase").fadeIn();
});

//MODIFICAR
$("#contenidoModal").on("click", "#modificarTemarioForm", function (event) {
  // Evitar el envío del formulario por defecto
  event.preventDefault();

  // Serializar el formulario para obtener todos los valores de los inputs
  var formData = $("#modificarT").serialize();

  console.log(formData);
  // Realizar la solicitud AJAX para agregar la nueva universidad
  $.ajax({
    url: baseUrl + "modificarTemario",
    type: "POST",
    data: formData,
    success: function (response) {
      console.log("Temario modificado con éxito:", response);
      // Realizar alguna acción adicional si es necesario
      selecTemario(globalMateriaData);
      $("#modalBase").hide(); // Ocultar el modal
    },
    error: function (error) {
      console.error("Error al modificar el temario:", error);
    },
  });
});

//obtener boton para la creacion de temas
// Obtener el botón por su id
var botonCrearMateria = document.getElementById("crearTemario");
// Agregar un evento de clic al botón
botonCrearMateria.addEventListener("click", function () {
  // accion a realizar una vez que se apreto :D

  $("#contenidoModal").empty();

  //--ESCRIBIR MODAL :D
  var contenidoModal = `
  <div class="head">
    <div class="left-section">
    <p>Agregar Temario</p>
    </div>
    <div class="right-section">
        <button class="cerrar">
            <ion-icon name="close-circle-outline"></ion-icon>
        </button>
    </div>
  </div>
  <form id="agregarTemario">
  <div class="celda">
    <label class="form-label">Materia</label>
    <input name="nombreMateria" type="text" class="form-control" placeholder="Nombre del temario" disabled value="${globalMatNombre}">
  </div>
  <div class="celda">
    <input name="idMateria" id="idMateria" type="hidden" class="form-control" value="${globalMateriaData}">
    <label class="form-label">Nombre del temario</label>
    <input name="nombreTemario" id="nombreTemario" type="text" class="form-control" placeholder="Nombre del temario" >
  </div>
  <div class="celda">
    <label class="form-label">Contenido del temario</label>
    <textarea class="form-control" rows="3" name="contenidoTemario" id="contenidoTemario" placeholder="Contenido del temario"></textarea>
  </div>
  <div class="celda">
    <label class="form-label">Libro del temario</label>
    <textarea class="form-control" rows="3" name="libroTemario" id="libroTemario" placeholder="Libro del temario"></textarea>
  </div>
  </form>
  <div class="añadir">
    <button id="insertarTemario" type="button" class="btn">Agregar</button>
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

//insertar
$("#contenidoModal").on("click", "#insertarTemario", function (event) {
  event.preventDefault(); // Evitar el envío del formulario por defecto
  // Serializar el formulario para obtener todos los valores de los inputs
  var idMateria = globalMateriaData;
  var formData = $("#agregarTemario").serialize();
  console.log(formData);
  // Agregar idU como un parámetro adicional a los datos serializados
  formData += "&idMateria=" + encodeURIComponent(idMateria);

  // Realizar la solicitud AJAX para agregar la nueva universidad
  $.ajax({
    url: baseUrl + "crearTemario",
    type: "POST",
    data: formData,
    success: function (response) {
      console.log("Temario agregado con éxito:", response);
      // Realizar alguna acción adicional si es necesario
      selecTemario(globalMateriaData);
      $("#modalBase").hide(); // Ocultar el modal
    },
    error: function (error) {
      console.error("Error al agregar el temario:", error);
    },
  });
});

//FILTRO DE MATERIA
$(".materiaSelect").change(function () {
  var idMateria = $(this).val();
  var nombreMateria = $(this).find("option:selected").text();
  globalMateriaData = idMateria; // Asignar uniData a la variable global
  globalMatNombre = nombreMateria; // Asignar uniData a la variable global

  console.log(globalMateriaData);

  selecTemario(globalMateriaData);

  // Obtener el elemento option por su id
  var optionElement = $("#materiaTemarioMod");
  optionElement.val(idMateria);
  optionElement.text(nombreMateria);
});

$(".mostrar-modal").on("click", function () {
  $("#modalBase").show();
});
