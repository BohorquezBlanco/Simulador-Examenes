var globalTemaData = null; // Definir la variable global

//###################################################-PREGUNTAS-#########################################################
//preguntas de la materia
function selecTema(globalTemarioData) {
  $('#cabezaTemasTemario').empty();//BORRA TODO EL CONTENEDOR

  $("#cabezaTemasTemario").append(
  `
  <tr>
    <th>nombreTema</th>
    <th>descripcionTema</th>
    <th>videoTema</th>
    <th>Modificar</th>
    <th>Eliminar</th>
  </tr>
  `
  );

  $("#temasTemario").empty(); //BORRA TODO EL CONTENEDOR
  var uniData = {
    idTemario: globalTemarioData, // Crear un objeto con lo necesario
  };
  $.ajax({
    type: "POST",
    url: baseUrl + "temaTemario",
    data: uniData,
    dataType: "json",
    success: function (response) {
      $.each(response, function (index, tema) {
        //crear un objeto para pasarlo por data-universidad la cual será utilizada mas adelante.
        var temaData = {
          idTema: tema.idTema,
          nombreTema: tema.nombreTema,
          descripcionTema: tema.descripcionTema,
          videoTema: tema.videoTema,
          idTemario: globalTemarioData,
        };
        var temaHTML = `
            <tr>
              <td>${tema.nombreTema}</td>
              <td>${tema.descripcionTema}</td>
              <td>${tema.videoTema}</td>
              <td><button class="modificar" data-temasData='${JSON.stringify(
                temaData
              )}'><i class="fa-solid fa-pen-to-square"></i></button></td>
              <td><button class="eliminar" data-temasData='${JSON.stringify(
                temaData
              )}'><i class="fa-solid fa-eraser"></i></button></td>
              </tr>
            `;
        $("#temasTemario").append(temaHTML);
      });
    },
    error: function (xhr, status, error) {
      console.error("Error al insertar el tema:", error);
    },
  });
}

//ELIMINAR
$("#temasTemario").on("click", ".eliminar", function () {
  var temarioDataString = $(this).attr("data-temasData");
  var temarioData = JSON.parse(temarioDataString);
  $("#contenidoModal").empty();

  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--ESCRIBIR MODAL :D--!!!!!!!!!!!!!!!!!!!!!!!!
  var contenidoModal = `
      <div class="head">
        <div class="left-section">
        <p>Eliminar Tema</p>
        </div>
        <div class="right-section">
            <button class="cerrar">
                <ion-icon name="close-circle-outline"></ion-icon>
            </button>
        </div>
      </div>
      <form id="eliminar">
      <input type="text" name="idTema" id="idTema" value="${temarioData.idTema}">
      <input type="text" name="idTemario" id="idTemario" value="${globalTemarioData}">
        <div class="celda">
            <label class="form-label">¿Está seguro que desea eliminar el temario: " ${
              temarioData.nombreTema
            }"?</label>
        </div>
      <br>
      </form>
      <div class="añadir">
        <button id="eliminarTema" type="button" class="btn">Eliminar</button>
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

$("#contenidoModal").on("click", "#eliminarTema", function (event) {
  event.preventDefault(); // Evitar el envío del formulario por defecto
  var formData = $("#eliminar").serialize();

  // Realizar la solicitud AJAX para eliminar la universidad
  $.ajax({
    url: baseUrl + "eliminarTema",
    type: "POST",
    data: formData, // Serializar el objeto a JSON
    success: function (response) {
      console.log("Tema eliminado con éxito:", response);
      // Realizar alguna acción adicional si es necesario
      selecMateria(globalCarrData);
      $("#modalBase").hide(); // Ocultar el modal
    },
    error: function (error) {
      console.error("Error al eliminar el Tema:", error);
    },
  });
});


//obtener boton para la creacion de temas
// Obtener el botón por su id
var botonCrearMateria = document.getElementById("crearTema");
// Agregar un evento de clic al botón
botonCrearMateria.addEventListener("click", function () {
  // accion a realizar una vez que se apreto :D

  $("#contenidoModal").empty();

  //--ESCRIBIR MODAL :D
  var contenidoModal = `
  <div class="head">
    <div class="left-section">
    <p>Agregar Tema</p>
    </div>
    <div class="right-section">
        <button class="cerrar">
            <ion-icon name="close-circle-outline"></ion-icon>
        </button>
    </div>
  </div>
  <form id="agregarTema">
  <input name="idTemario" type="hidden" class="form-control" placeholder="Nombre del tema" value="${globalTemarioData}">

  <div class="celda">
    <label class="form-label">nombreTema</label>
    <input name="nombreTema" id="nombreTema" type="text" class="form-control" placeholder="Nombre del tema">
  </div>
  <div class="celda">
    <label class="form-label">DescripcionTema</label>
    <textarea  rows="3"  name="descripcionTema" id="descripcionTema" placeholder="DescripcionTema" ></textarea>
  </div>
  <div class="celda">
    <label class="form-label">Video Tema</label>
    <input name="videoTema" id="videoTema" type="text" class="form-control" placeholder="Nombre del tema">
  </div>
  <div class="añadir">
    <button id="insertarTema" type="button" class="btn">Agregar</button>
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

//insertar
$("#contenidoModal").on("click", "#insertarTema", function (event) {
  event.preventDefault(); // Evitar el envío del formulario por defecto
  // Serializar el formulario para obtener todos los valores de los inputs
  var formData = $("#agregarTema").serialize();

  // Realizar la solicitud AJAX para agregar la nueva universidad
  $.ajax({
    url: baseUrl + "crearTema",
    type: "POST",
    data: formData,
    success: function (response) {
      console.log("Tema agregado al temario:", response);
      // Realizar alguna accióaln adicional si es necesario
      selecTema(globalTemarioData);
      $("#modalBase").hide(); // Ocultar el modal
    },
    error: function (error) {
      console.error("Error al agregar al temario", error);
    },
  });
});



//MODIFICAR
$("#temasTemario").on("click", ".modificar", function () {
  var temarioDataString = $(this).attr("data-temasData");
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
    <label class="form-label">Nombre del Tema</label>
    <input type="text" class="form-control" name="nombreTema" id="nombreTema" value="${temarioData.nombreTema}">
    <input type="hidden" class="form-control" name="idTema" id="idTema" value="${temarioData.idTema}">
  </div>
  <div class="celda">
    <label class="form-label">Contenido del Temario</label>
    <input type="text" class="form-control" name="descripcionTema" id="descripcionTema" value="${temarioData.descripcionTema}" >
  </div>
  <div class="celda">
    <label class="form-label">Libro del Temario</label>
    <input type="text" class="form-control" name="videoTema"  id="videoTema" value="${temarioData.videoTema}" >
  </div>
  <div class="añadir">
    <button id="modificarTemaForm" type="submit" class="btn">Modificar</button>
  </div>
  </form>
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
$("#contenidoModal").on("click", "#modificarTemaForm", function (event) {
  // Evitar el envío del formulario por defecto
  event.preventDefault();

  // Serializar el formulario para obtener todos los valores de los inputs
  var formData = $("#modificarT").serialize();

  console.log(formData);
  $.ajax({
    url: baseUrl + "modificarTema",
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



$(".mostrar-modal").on("click", function () {
  $("#modalBase").show();
});

//filtro temas mediante si eliges temario 
$(".temarioSelect").change(function () {

  var idTemario = $(this).val();
  var nombreTema = $(this).find("option:selected").text();
  globalTemarioData = idTemario; // Asignar uniData a la variable global
  globalTemarioNombre = nombreTemario; // Asignar uniData a la variable global
  tituloTemarios();
  selecTema(globalTemarioData);

});



//obtener boton para ver temas existentes para poder añadir
// Obtener el botón por su id
var agregarTemasExistentes = document.getElementById("agregarTemasExistentes");
// Agregar un evento de clic al botón
agregarTemasExistentes.addEventListener("click", function () {
  preguntaCarreras2() ;
  $('#temasTemario').empty();//BORRA TODO EL CONTENEDOR
  $('#cabezaTemasTemario').empty();//BORRA TODO EL CONTENEDOR

  $("#cabezaTemasTemario").append(
  `
  <tr>
    <th>nombreTema</th>
    <th>descripcionTema</th>
    <th>videoTema</th>
    <th>Agregar</th>
  </tr>
  `
  );


  $('#segundoFiltro').empty();//BORRA TODO EL CONTENEDOR

  $("#segundoFiltro").append(
    `
    <div class="celda">
    <label for="">Carrera:</label>
    <select class="carreraSelect2" name="carreraSelect2" >
      <option value="1">Carrera:</option>
    </select>
  </div><br>
  <div class="celda">
    <label for="">Materia:</label>
    <select class="materiaSelect2" name="materiaSelect2">
      <option value="1">Materia:</option>
    </select>
  </div><br>
    `
    );
  });








  //FUNCION PARA REUTILIZAR AJAX 
function preguntaCarreras2() {
  $.ajax({
    type: 'POST',
    url: baseUrl+'allCarreras',
    dataType: 'json',
    success: function(response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, carrera) {
      //llenar el filtro
      var filtroCarrera = ` <option value="${carrera.idCarrera}">${carrera.nombreCarrera}</option>`;
      $(".carreraSelect2").append(filtroCarrera);
    });
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}

function preguntaMaterias2(idCarrera) {
  $('.materiaSelect2').empty();//BORRA TODO EL CONTENEDOR
  $(".materiaSelect2").append('<option value="0">Materia:</option>');
 
  var uniData = {
    idCarrera: idCarrera, // Crear un objeto con lo necesario
  }; 
  $.ajax({
    type: 'POST',
    data: uniData,
    url: baseUrl+'materiaAjax',
    dataType: 'json',
    success: function(response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, materia) {
      //llenar el filtro
      var filtroMateria = ` <option value="${materia.idMateria}">${materia.nombreMateria}</option>`;
      $(".materiaSelect2").append(filtroMateria);
    });
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}


function preguntaTemas2(idMateria) {
  $('#temasTemario').empty();//BORRA TODO EL CONTENEDOR

 
  var uniData = {
    idMateria: idMateria, // Crear un objeto con lo necesario
  }; 
  $.ajax({
    type: 'POST',
    data: uniData,
    url: baseUrl+'temaCarrera',
    dataType: 'json',
    success: function(response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, tema) {
        var temaData = {
          idTema: tema.idTema,
          nombreTema: tema.nombreTema,
          descripcionTema: tema.descripcionTema,
          videoTema: tema.videoTema,
          idTemario: globalTemarioData,
        };
        var temaHTML = `
            <tr>
              <td>${tema.nombreTema}</td>
              <td>${tema.descripcionTema}</td>
              <td>${tema.videoTema}</td>
              <td><button class="Agregar" data-temasData='${JSON.stringify(
                temaData
              )}'>Agregar</button></td>
              </tr>
            `;
        $("#temasTemario").append(temaHTML);
      
    });
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}

//dsjflkdsajfjasdklfjsdlfjsdkljdlsfjlsakjflksadjflds
//ELIMINAR
$("#temasTemario").on("click", ".Agregar", function () {
  var temarioDataString = $(this).attr("data-temasData");
  var temarioData = JSON.parse(temarioDataString);
  $("#contenidoModal").empty();

  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--ESCRIBIR MODAL :D--!!!!!!!!!!!!!!!!!!!!!!!!
  var contenidoModal = `
      <div class="head">
        <div class="left-section">
        <p>Agregar Tema</p>
        </div>
        <div class="right-section">
            <button class="cerrar">
                <ion-icon name="close-circle-outline"></ion-icon>
            </button>
        </div>
      </div>
      <form id="Agregar">
      <input type="text" name="idTema" id="idTema" value="${temarioData.idTema}">
      <input type="text" name="idTemario" id="idTemario" value="${globalTemarioData}">
        <div class="celda">
            <label class="form-label">¿Está seguro que desea eliminar el temario: " ${
              temarioData.nombreTema
            }"?</label>
        </div>
      <br>
      </form>
      <div class="añadir">
        <button id="agregarTema" type="button" class="btn">Agrega sr</button>
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

$("#contenidoModal").on("click", "#agregarTema", function (event) {
  event.preventDefault(); // Evitar el envío del formulario por defecto
  var formData = $("#Agregar").serialize();

  // Realizar la solicitud AJAX para eliminar la universidad
  $.ajax({
    url: baseUrl + "agregarTema",
    type: "POST",
    data: formData, // Serializar el objeto a JSON
    success: function (response) {
      console.log("Tema eliminado con éxito:", response);
      // Realizar alguna acción adicional si es necesario
      selecMateria(globalCarrData);
      $("#modalBase").hide(); // Ocultar el modal
      $('#segundoFiltro').empty();//BORRA TODO EL CONTENEDOR

    },
    error: function (error) {
      console.error("Error al eliminar el Tema:", error);
    },
  });
});




// Filtros select
$("#segundoFiltro").on("change", ".carreraSelect2", function(event) {

  var idCarrera = $(this).val();
  preguntaMaterias2(idCarrera);
  console.log(idCarrera);
});

$("#segundoFiltro").on("change", ".materiaSelect2", function(event) {

  var idMateria = $(this).val();
  preguntaTemas2(idMateria);
});
