var idCarreraTema = null;
var idMateriaTema = null;

var nombreCarreraTema = '';
var nombreMateriaTema = '';

var globalTemaData = null; // Definir la variable global
var idTemario; // Variable global para almacenar el id del temario seleccionado

//###################################################-PREGUNTAS-#########################################################

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

$("#contenidoModal").on("click", "#eliminarTema", function (event) {
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
      
      tiposTemas();
    



      $("#modalBase").hide(); // Ocultar el modal
      $('#segundoFiltro').empty();//BORRA TODO EL CONTENEDOR

    },
    error: function (error) {
      console.error("Error al eliminar el Tema:", error);
    },
  });
});






//##############################################################-MANIPULACION DE SELECTS-#################################################################

//SELECT CARRERA
$(document).on("change", ".selectCarreraT", function(event) {
  idCarreraTema = $(this).val();

  nombreCarreraTema = $('.selectCarreraT option:selected').text(); // Obtiene el texto de la opción seleccionada

  nombreCarreraTema = nombreCarreraTema.substring(8); // Recorta las primeras 5 letras
  $("#tituloPreguntas").empty();
  $("#tituloPreguntas").append(nombreCarreraTema);

  CarrerasMateriaT(idCarreraTema);
console.log(idCarreraTema);
});

//SELECT MATERIA
$(document).on("change", ".selectMateriaT", function(event) {
  idMateriaTema = $(this).val();
  nombreMateriaTema= $('.selectMateriaP option:selected').text(); // Obtiene el texto de la opción seleccionada
  nombreMateriaTema = nombreMateriaTema.substring(8); // Recorta las primeras 5 letras
console.log(idMateriaTema);
  $("#tituloPreguntas").empty();
  $("#tituloPreguntas").append(nombreMateriaTema);
  tiposTemas();


});

function tiposTemas()
{
  if (idMateriaTema=="huerfano") {
    //si marcamos en huerfanito entonces cargaremos la funcion para ver solo temas huerfanos
    MateriaTemasHuerfanosT();
  }
  else {
      MateriaTemasT(idMateriaTema) ;
  }
  if (idMateriaTema=="allTemas") {
    AllTemas2();
    }
    else {
      temasArea2(nombreArea);
    }
  
}

//##############################################################-BOTONES-#################################################################


var btnFiltrarTema = document.getElementById("btnFiltrarTema");
btnFiltrarTema.addEventListener("click", function() {
  console.log("HOLA MAMI");
// accion a realizar una vez que se apreto :D
$('#divFiltrosTema').empty();//BORRA TODO EL CONTENEDOR

//FILTRO EN BASE A TEMARIOS EXISTENTES  
var filtroTema = 
` 
<p class="center">Filtrar Pregunta Por Temarios </p>
<div class="contSelect2">
  <!--Filtro donde aparecen todas las carreras-->
  <div class="" >
    <select class="selectCarreraT" name="selectCarreraT" >
      <option value="0">Carrera:</option>
    </select>
  </div>
  <!--Filtro donde aparecen todas las materias en base a carrera-->
  <div class="">
    <select class="selectMateriaT" name="selectMateriaT" >
      <option value="0">Materia:</option>
      <option value="huerfano">Temas huerfanos</option>
      <option value="allTemas">Todos los temas</option>
    </select>
  </div>
</div> <br>
<div class="centrarSearch">
  <input class="center" type="search">
  <label class="center" for="">Buscar</label>
</div>
`;
$("#divFiltrosTema").append(filtroTema);
AllCarrerasTema();
});


//##############################################################-SOLICITUDES AJAX-#################################################################
function AllCarrerasTema() {
  $('.selectCarreraT').empty();//BORRA TODO EL CONTENEDOR
  $('.selectCarreraT').append('<option value="0">Carrera:</option>');
  $.ajax({
    type: 'POST',
    url: baseUrl+'allCarreras',
    dataType: 'json',
    success: function(response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, carrera) {
      //llenar el filtro
      var filtroCarrera = ` <option value="${carrera.idCarrera}">Carrera:${carrera.nombreCarrera}</option>`;
      $(".selectCarreraT").append(filtroCarrera);
    });

    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}

//Muestras todas las materias dependiendo al idCarrera 
function CarrerasMateriaT(idCarrera) {
  $('.selectMateriaT').empty();//BORRA TODO EL CONTENEDOR
  $(".selectMateriaT").append('<option value="0">Materia:</option>');
 
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
      var filtroMateria = ` <option value="${materia.idMateria}">Materia:${materia.nombreMateria}</option>`;
      $(".selectMateriaT").append(filtroMateria);
    });
    $(".selectMateriaT").append('<option value="huerfano" class="text-blue">Temas huerfanos</option>');
    $(".selectMateriaT").append('<option value="allTemas" class="text-blue">Todos los temas</option>');

    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}
//Muestras todos los temas dependiendo al idMateria
function MateriaTemasT(idMateria) {
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
      //llenar el filtro
      var filtroTema = `
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
      </tr>`;
      $("#temasTemario").append(filtroTema);
      
    });
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}
//Muestras todos los temas huerfanos
function MateriaTemasHuerfanosT() {
  $('#temasTemario').empty();//BORRA TODO EL CONTENEDOR

  $.ajax({
    type: 'POST',
    url: baseUrl+'temaCarreraHuerfanos',
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
      //llenar el filtro
      var filtroTema = `
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
      </tr>`;
      $("#temasTemario").append(filtroTema);
      
    });
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}
//Muestras todos los temas huerfanos
function AllTemas2() {
  console.log("estoy en all temas");
  $('#temasTemario').empty();//BORRA TODO EL CONTENEDOR

  $.ajax({
    type: 'POST',
    url: baseUrl+'allTemas',
    dataType: 'json',
    success: function(response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, tema) {
        var temaData = {
          idTema: tema.idTema,
          nombreTema: tema.nombreTema,
          descripcionTema: tema.descripcionTema,
          videoTema: tema.videoTema,
        };
      //llenar el filtro
      var filtroTema = `
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
      </tr>`;
      $("#temasTemario").append(filtroTema);
      
    });
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}


//##############################################################-CRUDS-###################################################
//------------------------ AGREGAR TEMAS----------------------------------------------------------------
var botonCrearMateria = document.getElementById("btnAgregarTema");
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
      MateriaTemasHuerfanosT();
      $("#modalBase").hide(); // Ocultar el modal
    },
    error: function (error) {
      console.error("Error al agregar al temario", error);
    },
  });
});

//------------------------ MODIFICAR TEMAS ----------------------------------------------------------------

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
      tiposTemas();

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













var btnAgregarTemaTemario = document.getElementById("btnAgregarTemaTemario");
btnAgregarTemaTemario.addEventListener("click", function() {
// accion a realizar una vez que se apreto :D
$('#divFiltrosTema').empty();//BORRA TODO EL CONTENEDOR

//FILTRO DE PREGUNTAS EN BASE A TEMAS
var filtroPregunta = 
` 
<p class="center">Añadir Temas a un temario</p>
<div class="contSelect2">

</div> <br>

<div  class="row">
    <div class="columna center">
      <div class="contSelect2">
      <!--Filtro donde aparecen todas las carreras-->
      <div class="" >
        <select class="selectCarreraTemario" name="selectCarreraTemario" >
          <option value="0">Carrera:</option>
        </select>
      </div>
      <!--Filtro donde aparecen todas las materias en base a carrera-->
      <div class="">
        <select class="selectMateriaTemario" name="selectMateriaT" >
          <option value="0">Materia:</option>
        </select>
      </div>
      <div class="">
        <select class="selectTemarios" name="selectTemarios" >
          <option value="0">Temario:</option>
        </select>
      </div>
    </div> <br>
    <div class="centrarSearch">
      <input class="center" type="search">
      <label class="center" for="">Buscar</label>
    </div><br>
    <p id="nombreTemario" class="center">Temario:</p>
    <div id="caja1" class="caja">
     <!----------- <a href="#" class="boton">Geometria Plana</a>---->
    </div>
  </div>
  <div class="columna center">
   <br>
    <div class="">
      <select class="selectArea" name="selectArea" >
        <option value="0">Todos Los Temas:</option>
        <option value="Matemáticas">Matemáticas:</option>
        <option value="Química">Química:</option>
        <option value="Física">Física:</option>
        <option value="Economia">Economia:</option>
        <option value="Administración">Administración:</option>
        <option value="Contables">Contables:</option>
        <option value="Ingles">Ingles:</option>
      </select>
    </div>  <br> 
    <div class="centrarSearch">
    <input class="center" type="search">
    <label class="center" for="">Buscar</label>
  </div>
    <br>
    <p class="center">Temas Para filtrar</p>

    <div id="caja2" class="caja">

    </div>
  </div>
</div>
`;
$("#divFiltrosTema").append(filtroPregunta);
$('#temasTemario').empty();//BORRA TODO EL CONTENEDOR
AllCarrerasTemario();

});

function AllCarrerasTemario() {
  $('.selectCarreraTemario').empty();//BORRA TODO EL CONTENEDOR
  $('.selectCarreraTemario').append('<option value="0">Carrera:</option>');
  $.ajax({
    type: 'POST',
    url: baseUrl+'allCarreras',
    dataType: 'json',
    success: function(response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, carrera) {
      //llenar el filtro
      var filtroCarrera = ` <option value="${carrera.idCarrera}">Carrera:${carrera.nombreCarrera}</option>`;
      $(".selectCarreraTemario").append(filtroCarrera);
    });

    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}

//Muestras todas las materias dependiendo al idCarrera 
function CarrerasMateriaTemario(idCarrera) {
  $('.selectMateriaTemario').empty();//BORRA TODO EL CONTENEDOR
  $(".selectMateriaTemario").append('<option value="0">Materia:</option>');
 
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
      var filtroMateria = ` <option value="${materia.idMateria}">Materia:${materia.nombreMateria}</option>`;
      $(".selectMateriaTemario").append(filtroMateria);
    });
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}



//Muestras todos los temarios que tiene la carrera 
function materiaTemarioT(idMateria) {
  $('.selectTemarios').empty();//BORRA TODO EL CONTENEDOR
  $(".selectTemarios").append('<option value="0">Temario:</option>');
 
  var uniData = {
    idMateria: idMateria, // Crear un objeto con lo necesario
  }; 
  $.ajax({
    type: 'POST',
    data: uniData,
    url: baseUrl+'temarioMateria',
    dataType: 'json',
    success: function(response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, materia) {
      //llenar el filtro
      var filtroMateria = ` <option value="${materia.idTemario}">Temario:${materia.nombreTemario}</option>`;
      $(".selectTemarios").append(filtroMateria);
    });
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}
//Muestras todos los temas que contiene el temario elegido
function temasTemarios(idTemario) {
  $('#caja1').empty();//BORRA TODO EL CONTENEDOR 
  var uniData = {
    idTemario: idTemario, // Crear un objeto con lo necesario
  }; 
  $.ajax({
    type: 'POST',
    data: uniData,
    url: baseUrl+'temaTemario',
    dataType: 'json',
    success: function(response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, materia) {
      //llenar el filtro
      var filtroMateria = 
      `
      <a href="#" class="boton">
      ${materia.nombreTema}
      <input type="text" name="idTema" value="${materia.idTema}">
      </a>
       `;
      $("#caja1").append(filtroMateria);
    });
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}

//Muestras todos los temas que contiene el temario elegido
function temasArea(nombreArea){
  console.log("estoy en temasTemarios");
  $('#caja2').empty();//BORRA TODO EL CONTENEDOR 
  var uniData = {
    nombreArea: nombreArea, // Crear un objeto con lo necesario
  }; 
  $.ajax({
    type: 'POST',
    data: uniData,
    url: baseUrl+'areaTema',
    dataType: 'json',
    success: function(response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, materia) {
      //llenar el filtro
      var filtroMateria = 
      `
      <a href="#" class="boton">
      ${materia.nombreTema}
      <input type="hidden" name="idTema" value="${materia.idTema}">
      </a>
       `;
      $("#caja2").append(filtroMateria);
    });
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}



//################################################33
//SELECT CARRERA
$(document).on("change", ".selectCarreraTemario", function(event) {
  idCarreraTema = $(this).val();

  nombreCarreraTema = $('.selectCarreraTemario option:selected').text(); // Obtiene el texto de la opción seleccionada

  nombreCarreraTema = nombreCarreraTema.substring(8); // Recorta las primeras 5 letras
  $("#tituloPreguntas").empty();
  $("#tituloPreguntas").append(nombreCarreraTema);

  CarrerasMateriaTemario(idCarreraTema);
console.log(idCarreraTema);
idTemario =null;
});

//SELECT MATERIA
$(document).on("change", ".selectMateriaTemario", function(event) {
  idMateriaTema = $(this).val();
  nombreMateriaTema= $('.selectMateriaTemario option:selected').text(); // Obtiene el texto de la opción seleccionada
  nombreMateriaTema = nombreMateriaTema.substring(8); // Recorta las primeras 5 letras
  materiaTemarioT(idMateriaTema); 
  idTemario =null;
});

//SELECT TEMARIO
$(document).on("change", ".selectTemarios", function(event) {
  idTemario = $(this).val();
  nombreTemario= $('.selectTemarios option:selected').text(); // Obtiene el texto de la opción seleccionada
  temasTemarios(idTemario);
  $("#nombreTemario").empty(); //;
  $("#nombreTemario").append(nombreTemario);

});

//SELECT AREAS
$(document).on("change", ".selectArea", function(event) {
  nombreArea = $(this).val();
  temasArea(nombreArea);

});

// MOVIMIENTO DE BOTONES ENTRE CAJAS
$(document).on("click", ".boton", function() {
  // Verificar si se ha seleccionado un temario
  if (!idTemario) {
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
          <label class="form-label">Tiene que elegir un temario primero</label>
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
        return; // Salir de la función si no se ha seleccionado un temario
  }
  
  var cajaActual = $(this).parent().attr("id");
  var idTema = $(this).find('input[name="idTema"]').val();
  var formData = {
    idTema: idTema, // Crear un objeto con lo necesario
    idTemario: idTemario, // Crear un objeto con lo necesario
  };
  if (cajaActual === "caja1") {
    $(this).appendTo("#caja2");
//si va de caja 1 a caja 2
    $.ajax({
      url: baseUrl + "eliminarTemaTemario",
      type: "POST",
      data: formData, // Serializar el objeto a JSON
      success: function (response) {
        console.log("Tema eliminado con éxito:", response);
        // Realizar alguna acción adicional si es necesario
        $("#modalBase").hide(); // Ocultar el modal
      
      },
      error: function (error) {
        console.error("Error al eliminar el Tema:", error);
      },
    });
  } else {
    $(this).appendTo("#caja1");
    //si va de caja 2 a caja 1
    $.ajax({
      url: baseUrl + "agregarTemaTemario",
      type: "POST",
      data: formData, // Serializar el objeto a JSON
      success: function (response) {
        console.log("Tema agregado con éxito:", response);
        // Realizar alguna acción adicional si es necesario
        $("#modalBase").hide(); // Ocultar el modal
     
      },
      error: function (error) {
        console.error("Error al agregar el Tema:", error);
      },
    });
  }
});





var btnFiltrarPreguntaTemario = document.getElementById("btnFiltrarArea");
btnFiltrarPreguntaTemario.addEventListener("click", function() {
// accion a realizar una vez que se apreto :D
$('#divFiltrosTema').empty();//BORRA TODO EL CONTENEDOR

//FILTRO EN BASE A TEMARIOS EXISTENTES  
var filtroPregunta = 
` 
<div class="">
<select class="selectArea2" name="selectArea2" >
  <option value="0">Todos Los Temas:</option>
  <option value="Matemáticas">Matemáticas:</option>
  <option value="Química">Química:</option>
  <option value="Física">Física:</option>
  <option value="Economia">Economia:</option>
  <option value="Administración">Administración:</option>
  <option value="Contables">Contables:</option>
  <option value="Ingles">Ingles:</option>
</select>
</div>  <br> 
<div class="centrarSearch">
<input class="center" type="search">
<label class="center" for="">Buscar</label>
</div>
`;
$("#divFiltrosTema").append(filtroPregunta);
});


//SELECT AREAS
$(document).on("change", ".selectArea2", function(event) {
  nombreArea = $(this).val();
  temasArea2(nombreArea);

});



//Muestras todos los temas que contiene el temario elegido
function temasArea2(nombreArea){
  $('#temasTemario').empty();//BORRA TODO EL CONTENEDOR 
  var uniData = {
    nombreArea: nombreArea, // Crear un objeto con lo necesario
  }; 
  $.ajax({
    type: 'POST',
    data: uniData,
    url: baseUrl+'areaTema',
    dataType: 'json',
    success: function(response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, tema) {

        var temaData = {
          idTema: tema.idTema,
          nombreTema: tema.nombreTema,
          descripcionTema: tema.descripcionTema,
          videoTema: tema.videoTema,
        };
      //llenar el filtro
      var filtroTema = `
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
      </tr>`;
      $("#temasTemario").append(filtroTema);
    });
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}
