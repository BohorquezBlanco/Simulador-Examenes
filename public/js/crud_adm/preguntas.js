var idCarreraPregunta = null;
var idMateriaPregunta = null;
var idTemaPregunta = null;
var nombreCarreraPregunta = '';
var nombreMateriaPregunta = '';
var nombreTemaPregunta = '';
//####################################################-BOTONES DE LOS FILTROS-################################################################

  var btnFiltrarPreguntaTemario = document.getElementById("btnFiltrarPreguntaTemario");
  btnFiltrarPreguntaTemario.addEventListener("click", function() {
  // accion a realizar una vez que se apreto :D
  $('#divFiltrosPreguntas').empty();//BORRA TODO EL CONTENEDOR

  //FILTRO EN BASE A TEMARIOS EXISTENTES  
  var filtroPregunta = 
  ` 
  <p class="center">Filtrar Pregunta Por Temarios <span id="cerrarPe" class="close-button"><i class="fas fa-times"></i></span></p>
  <div class="contSelect2">
    <!--Filtro donde aparecen todas las carreras-->
    <div class="" >
      <select class="selectCarreraP" name="selectCarreraP" >
        <option value="0">Carrera:</option>
      </select>
    </div>
    <!--Filtro donde aparecen todas las materias en base a carrera-->
    <div class="">
      <select class="selectMateriaP" name="selectMateriaP" >
        <option value="0">Materia:</option>
        <option value="huerfano">Temas huerfanos</option>
      </select>
    </div>
    <!--Filtro donde aparecen todas las materias en base a carrera-->
    <div class="">
      <select class="selectTemaP" name="selectTemaP" >
        <option value="0">Tema:</option>
      </select>
    </div> 
    
  </div>
  `;
  $("#divFiltrosPreguntas").append(filtroPregunta);

  AllCarreras();

  });





  //boton para crear el select al crear una pregunta en el toggler 
  var toggleOffcanvas = document.getElementById("toggleOffcanvas");
  toggleOffcanvas.addEventListener("click", function() {

  $("#staticBackdropLabel").empty();
  var filtroCarrera = `AGREGAR PREGUNTA`;
  $("#staticBackdropLabel").append(filtroCarrera);

  $("#offcanvas-body").empty();
  var filtroCarrera = `
  <div>
  <form id="agregarPregunta">
      <div class="contSelect2 col-12">
          <div class="form-group">
              <select class="selectCarreraP" name="selectCarreraP">
                  <option value="0">Carrera:</option>
              </select>
          </div>
          <div class="form-group">
              <select class="selectMateriaP" name="selectMateriaP">
                  <option value="0">Materia:</option>
                  <option value="huerfano">Temas huerfanos</option>
              </select>
          </div>
          <div class="form-group">
              <select class="selectTemaP" name="selectTemaP">
                  <option value="0">Tema:</option>
              </select>
          </div>
      </div>
      <div class="row">
        <div class="col-6 form-group">
            <label class="textcolor" for="enunciado">Enunciado:</label>
            <textarea class="col-12" rows="1" name="enunciado" id="enunciado" placeholder="enunciado"></textarea>
        </div>
        <div class="col-6 form-group">
            <label class="textcolor" for="grafico">Gráfico:</label>
            <textarea class="col-12" rows="1" name="grafico" id="grafico" placeholder="grafico"></textarea>
        </div>
      </div>

      <div class="row">
          <div class="col-6 form-group">
              <label class="textcolor" for="a">a:</label>
              <input name="a" id="a" type="text" class="form-control" placeholder="a)">
          </div>
          <div class="col-6 form-group">
              <label class="textcolor" for="b">b:</label>
              <input name="b" id="b" type="text" class="form-control" placeholder="b)">
          </div>
      </div>
      <div class="row">
          <div class="col-6 form-group">
              <label class="textcolor" for="c">c:</label>
              <input name="c" id="c" type="text" class="form-control" placeholder="c)">
          </div>
          <div class="col-6 form-group">
              <label class="textcolor" for="d">d:</label>
              <input name="d" id="d" type="text" class="form-control" placeholder="d)">
          </div>
      </div>
      <div class="row">
          <div class="col-6 form-group">
              <label class="textcolor" for="e">e:</label>
              <input name="e" id="e" type="text" class="form-control" placeholder="e)">
          </div>
          <div class="col-6 form-group">
              <label class="textcolor" for="respuesta">Respuesta:</label>
              <input name="respuesta" id="respuesta" type="text" class="form-control" placeholder="respuesta">
          </div>
      </div>
      <div class="row">
        <div class="col-6 form-group">
          <label class="textcolor " for="dificultad">Dificultad:</label>
          <select class="dificultad" name="dificultad">
              <option value="Facil">Facil:</option>
              <option value="Moderada">Moderada:</option>
              <option value="Dificil">Dificil:</option>
          </select>
        </div>

          <div class="col-6 form-group">
            <label class="textcolor" for="resolucionPDF">Resolución PDF:</label>
            <input name="resolucionPdf" id="resolucionPdf" type="text" class="form-control" placeholder="resolucion">
          </div>
      </div>

      <button id="insertarPregunta" type="button" class="btn-modificar">Agregar Pregunta</button>
  </form>
</div>
  `;
  $("#offcanvas-body").append(filtroCarrera);


  AllCarreras();
  });

  var insertarPregunta = document.getElementById("insertarPregunta");
  insertarPregunta.addEventListener("click", function() {

  var formData = $('#agregarPregunta').serialize();

  var form = document.getElementById('agregarPregunta');
  form.reset();

  // Realizar la solicitud AJAX para agregar la nueva universidad
  $.ajax({
      url: baseUrl + 'crearPregunta',
      type: 'POST',
      data: formData,
      success: function(response) {
          console.log('Pregunta agregada con éxito:', response);
          // Realizar alguna acción adicional si es necesario
          preguntas(idTemaPregunta);
      $('#modalBase').hide(); // Ocultar el modal
      },
      error: function(error) {
          console.error('Error al agregar la pregunta:', error);
      }
  });
  });


//AGREGAR PREGUNTA
$('#offcanvas-body').on('click', '#insertarPregunta', function(event) {
  event.preventDefault(); // Evitar el envío del formulario por defecto
  // Serializar el formulario para obtener todos los valores de los inputs

  var formData = $('#agregarPregunta').serialize();


  var form = document.getElementById('agregarPregunta');
  form.reset();

  // Realizar la solicitud AJAX para agregar la nueva universidad
  $.ajax({
      url: baseUrl + 'crearPregunta',
      type: 'POST',
      data: formData,
      success: function(response) {
          console.log('Pregunta agregada con éxito:', response);
          // Realizar alguna acción adicional si es necesario
          preguntas(idTemaPregunta);
      $('#modalBase').hide(); // Ocultar el modal
      },
      error: function(error) {
          console.error('Error al agregar la pregunta:', error);
      }
  });
});

  
  // SPAN donde se cierra el filtro :D XXXX
  $('#divFiltrosPreguntas').on('click', '#cerrarPe', function() {
    $('#divFiltrosPreguntas').empty();//BORRA TODO EL CONTENEDOR
  });



    $(document).on("click", ".accordion-header", function(event) {
      // Verificar si el evento fue generado por el elemento objetivo
      if (event.target.classList.contains("accordion-header")) {
        const accordionItem = this.parentElement;
        const accordionContent = accordionItem.querySelector(".accordion-content");
    
        accordionItem.classList.toggle("active");
    
        if (accordionItem.classList.contains("active")) {
          accordionContent.style.maxHeight = accordionContent.scrollHeight + "px";
        } else {
          accordionContent.style.maxHeight = 0;
        }
      }
    });
    

//##############################################################-SOLICITUDES AJAX-#################################################################
//Muestra todas las carreras existentes
function AllCarreras() {
  $('.selectCarreraP').empty();//BORRA TODO EL CONTENEDOR
  $('.selectCarreraP').append('<option value="0">Carrera:</option>');
  $.ajax({
    type: 'POST',
    url: baseUrl+'allCarreras',
    dataType: 'json',
    success: function(response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, carrera) {
      //llenar el filtro
      var filtroCarrera = ` <option value="${carrera.idCarrera}">Carrera:${carrera.nombreCarrera}</option>`;
      $(".selectCarreraP").append(filtroCarrera);
    });

    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}

//Muestras todas las materias dependiendo al idCarrera 
function CarrerasMateria(idCarrera) {
  $('.selectMateriaP').empty();//BORRA TODO EL CONTENEDOR
  $(".selectMateriaP").append('<option value="0">Materia:</option>');
 
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
      $(".selectMateriaP").append(filtroMateria);
    });
    $(".selectMateriaP").append('<option value="huerfano" class="text-blue">Temas huerfanos</option>');

    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}
//Muestras todos los temas dependiendo al idMateria
function MateriaTemas(idMateria) {
  $('.selectTemaP').empty();//BORRA TODO EL CONTENEDOR
  $(".selectTemaP").append('<option value="0">Tema:</option>');

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
      //llenar el filtro
      var filtroTema = ` <option value="${tema.idTema}">Tema:${tema.nombreTema}</option>`;
      $(".selectTemaP").append(filtroTema);
      
    });
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}
//Muestras todos los temas huerfanos
function MateriaTemasHuerfanos() {
  $('.selectTemaP').empty();//BORRA TODO EL CONTENEDOR
  $(".selectTemaP").append('<option value="0">Tema:</option>');
  $.ajax({
    type: 'POST',
    url: baseUrl+'temaCarreraHuerfanos',
    dataType: 'json',
    success: function(response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, tema) {
      //llenar el filtro
      var filtroTema = ` <option value="${tema.idTema}">Tema:${tema.nombreTema}</option>`;
      $(".selectTemaP").append(filtroTema);
      
    });
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}




//##############################################################-MANIPULACION DE SELECTS-#################################################################

//SELECT CARRERA
$(document).on("change", ".selectCarreraP", function(event) {
  idCarreraPregunta = $(this).val();

  nombreCarreraPregunta = $('.selectCarreraP option:selected').text(); // Obtiene el texto de la opción seleccionada

  nombreCarreraPregunta = nombreCarreraPregunta.substring(8); // Recorta las primeras 5 letras
  $("#tituloPreguntas").empty();
  $("#tituloPreguntas").append(nombreCarreraPregunta);

  CarrerasMateria(idCarreraPregunta);
    console.log(idCarreraPregunta);
});

//SELECT MATERIA
$(document).on("change", ".selectMateriaP", function(event) {
  idMateriaPregunta = $(this).val();
  nombreMateriaPregunta= $('.selectMateriaP option:selected').text(); // Obtiene el texto de la opción seleccionada
  nombreMateriaPregunta = nombreMateriaPregunta.substring(8); // Recorta las primeras 5 letras

  $("#tituloPreguntas").empty();
  $("#tituloPreguntas").append(nombreMateriaPregunta);

    if (idMateriaPregunta=="huerfano") {
      //si marcamos en huerfanito entonces cargaremos la funcion para ver solo temas huerfanos
      MateriaTemasHuerfanos() 
    }
    else {
      MateriaTemas(idMateriaPregunta) 
    }

});
//SELECT TEMA
$(document).on("change", ".selectTemaP", function(event) {
 idTemaPregunta = $(this).val();

 nombreTemaPregunta= $('.selectTemaP option:selected').text(); // Obtiene el texto de la opción seleccionada
 nombreTemaPregunta = nombreTemaPregunta.substring(5); // Recorta las primeras 5 letras

 $("#tituloPreguntas").empty();
 $("#tituloPreguntas").append(nombreTemaPregunta);

 preguntas(idTemaPregunta);
});





//##############################################################-CRUDS-#################################################################

//SELECT 
function preguntas(idTema) {
  $('#divContenido').empty();//BORRA TODO EL CONTENEDOR
  var uniData = {
    idTema: idTema, // Crear un objeto con lo necesario
  }; 
  $.ajax({
    type: 'POST',
    data: uniData,
    url: baseUrl+'preguntasAjax',
    dataType: 'json',
    success: function(response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, pregunta) {
        var preguntaData = {
          idPregunta: pregunta.idPregunta,
          enunciado: pregunta.enunciado,
          grafico: pregunta.grafico,
          a: pregunta.a, 
          b: pregunta.b,
          c: pregunta.c,
          d: pregunta.d,
          e: pregunta.e,
          respuesta: pregunta.respuesta,
          dificultad: pregunta.dificultad,
          resolucionPdf: pregunta.resolucionPdf,
          idTema:idTemaPregunta
          };
      //llenar el filtro
          var body= 
          `
          <div class="">
          <div class="accordion" >
            <div class="accordion-item">
              <div class="accordion-header">${pregunta.enunciado}</div>
                <div class="accordion-content">
                 <!---CREACION DE TABLA --->
                 <div class="contTable">
                  <table >
                    <thead>
                    <tr>
                    <th>Grafico</th>
                    <th>a</th>
                    <th>b</th>
                    <th>c</th>
                    <th>d</th>
                    <th>e</th>
                    <th>respuestas</th>
                    <th>dificultad</th>
                    <th>resolucion PDF</th>
                    <th>Tema</th>
                    <th>Eliminar/Modificar</th>
                  </tr>
                    </thead>
                    <tbody id="SDF">
                      <!-- AQUI APARECERAN LAS PREGUNTAS -->
                     
          <tr>
 
          <td>${pregunta.grafico}</td>
          <td>${pregunta.a}</td>
          <td>${pregunta.b}</td>
          <td>${pregunta.c}</td>
          <td>${pregunta.d}</td>
          <td>${pregunta.e}</td>
          <td>${pregunta.respuesta}</td>
          <td>${pregunta.dificultad}</td>
          <td><a href="${pregunta.resolucionPdf}">PDF</a></td>
          <td>${nombreTemaPregunta}</td>

          <td><button class="modificar"  data-preguntaData='${JSON.stringify(preguntaData)}'>MODIFICA</button></td>
          <td><button class="eliminar"  data-preguntaData='${JSON.stringify(preguntaData)}'>ELIMINAR</button></td>
        </tr>
                    </tbody>
                  </table>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          `;
      $("#divContenido").append(body);
    });
    if (window.MathJax) {
      MathJax.typeset();
    }
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}


//MODIFICAR
$('#divContenido').on('click', '.modificar', function() {
  var preguntaDataString = $(this).attr('data-preguntaData');
  var pregunta = JSON.parse(preguntaDataString);

  $('#staticBackdropLabel').empty();
  $('#staticBackdropLabel').append("MODIFICAR PREGUNTA");

  $('#offcanvas-body').empty();
  var contenidoOffcanvas = 
  `
  <div>
  <form id="modificarP">
  <input name="idPregunta" id="idPregunta" type="hidden" class="form-control" value="${pregunta.idPregunta}">
      <div class="contSelect2 col-12">
          <div class="form-group">
              <select class="selectCarreraP" name="selectCarreraP">
                  <option value="0">Carrera:</option>
              </select>
          </div>
          <div class="form-group">
              <select class="selectMateriaP" name="selectMateriaP">
                  <option value="0">Materia:</option>
                  <option value="huerfano">Temas huerfanos</option>
              </select>
          </div>
          <div class="form-group">
              <select class="selectTemaP" name="selectTemaP">
                  <option value=${pregunta.idTema}">NO CAMBIAR TEMA</option>
              </select>
          </div>
      </div>
      <div class="row">
        <div class="col-6 form-group">
            <label class="textcolor" for="enunciado">Enunciado:</label>
            <textarea class="col-12" rows="1" name="enunciado" id="enunciado" placeholder="enunciado">${pregunta.enunciado}</textarea>
        </div>
        <div class="col-6 form-group">
            <label class="textcolor" for="grafico">Gráfico:</label>
            <textarea class="col-12" rows="1" name="grafico" id="grafico" placeholder="grafico">${pregunta.grafico}</textarea>
        </div>
      </div>

      <div class="row">
          <div class="col-6 form-group">
              <label class="textcolor" for="a">a:</label>
              <input name="a" id="a" type="text" class="form-control" placeholder="a)" value="${pregunta.a}">
          </div>
          <div class="col-6 form-group">
              <label class="textcolor" for="b">b:</label>
              <input name="b" id="b" type="text" class="form-control" placeholder="b)" value="${pregunta.b}">
          </div>
      </div>
      <div class="row">
          <div class="col-6 form-group">
              <label class="textcolor" for="c">c:</label>
              <input name="c" id="c" type="text" class="form-control" placeholder="c)" value="${pregunta.c}">
          </div>
          <div class="col-6 form-group">
              <label class="textcolor" for="d">d:</label>
              <input name="d" id="d" type="text" class="form-control" placeholder="d)" value="${pregunta.d}">
          </div>
      </div>
      <div class="row">
          <div class="col-6 form-group">
              <label class="textcolor" for="e">e:</label>
              <input name="e" id="e" type="text" class="form-control" placeholder="e)" value="${pregunta.e}">
          </div>
          <div class="col-6 form-group">
              <label class="textcolor" for="respuesta">Respuesta:</label>
              <input name="respuesta" id="respuesta" type="text" class="form-control" placeholder="respuesta" value="${pregunta.respuesta}">
          </div>
      </div>
      <div class="row">
        <div class="col-6 form-group">
          <label class="textcolor " for="dificultad">Dificultad:</label>
          <select class="dificultad" name="dificultad">
              <option selected value="${pregunta.dificultad}">${pregunta.dificultad}</option>
              <option value="Facil">Facil:</option>
              <option value="Moderada">Moderada</option>
              <option value="Dificil">Dificil</option>
          </select>
        </div>

          <div class="col-6 form-group">
            <label class="textcolor" for="resolucionPDF">Resolución PDF:</label>
            <input name="resolucionPdf" id="resolucionPdf" type="text" class="form-control" placeholder="resolucion" value="${pregunta.resolucionPdf}">
          </div>
      </div>

      <button id="modificarPregunta" type="button" class="btn-modificar">Modificar Pregunta</button>
  </form>
</div>
  `;
  $('#offcanvas-body').append(contenidoOffcanvas);
  var offcanvas = document.getElementById('staticBackdrop');
  offcanvas.classList.add('show');
  AllCarreras()
});

$('#offcanvas-body').on('click', '#modificarPregunta', function(event) {
  // Evitar el envío del formulario por defecto
  event.preventDefault();

  // Serializar el formulario para obtener todos los valores de los inputs
  var formData = $('#modificarP').serialize();

  console.log(formData);
    // Realizar la solicitud AJAX para agregar la nueva universidad
    $.ajax({
        url: baseUrl + 'modificarPregunta',
        type: 'POST',
        data: formData,
        success: function(response) {
            console.log('Temario modificado con éxito:', response);
            // Realizar alguna acción adicional si es necesario
            preguntas(idTemaPregunta);
            var offcanvas = document.getElementById('staticBackdrop');
            offcanvas.classList.remove('show');
         },
        error: function(error) {
            console.error('Error al modificar el temario:', error);
        }
    });
  });

  



//ELIMINAR
$('#divContenido').on('click', '.eliminar', function() {
  var preguntaDataString = $(this).attr('data-preguntaData');
  var pregunta = JSON.parse(preguntaDataString);
  $('#contenidoModal').empty();
      
  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--ESCRIBIR MODAL :D--!!!!!!!!!!!!!!!!!!!!!!!!
  var contenidoModal = 
      `
      <div class="head">
      <h3>Eliminar Temario</h3>
      <button class="cerrar">
        <ion-icon name="close-circle-outline"></ion-icon>
      </button>
    </div>
      <form id="eliminarP">
          <div class="celda">
              <label class="form-label">¿Está seguro que desea eliminar el temario: " ${pregunta.nombrePregunta}"?</label>
          </div>
              <input type="hidden" name="idPregunta" id="idPregunta" value="${pregunta.idPregunta}">
              <button id="eliminarPregunta" type="button" class="btn-eliminar">Eliminar</button>
      </form>
      `;
    $('#contenidoModal').append(contenidoModal);

    // Agregar un controlador de eventos al botón de cerrar
    $('.cerrar').on('click', function() {
      // Ocultar el modal al hacer clic en el botón de cerrar
      $('#modalBase').hide();
  });
      // Mostrar el modal después de que se haya construido completamente
      $('#modalBase').fadeIn();  
});

$('#contenidoModal').on('click', '#eliminarPregunta', function(event) {
  // Evitar el envío del formulario por defecto
  event.preventDefault();

  // Serializar el formulario para obtener todos los valores de los inputs
  var formData = $('#eliminarP').serialize();
            // Realizar la solicitud AJAX para eliminar la universidad
            $.ajax({
                url: baseUrl + 'eliminarPregunta',
                type: 'POST',
                data: formData, // Serializar el objeto a JSON
                success: function(response) {
                    console.log('Temario eliminado con éxito:', response);
                    // Realizar alguna acción adicional si es necesario
                    preguntas(idTemaPregunta);
                    $('#modalBase').hide(); // Ocultar el modal
                },
                error: function(error) {
                    console.error('Error al eliminar el Temario:', error);
                }
            });
});


  //boton para crear el select al crear una pregunta en el toggler 
  var btnFiltrarPreguntaArea = document.getElementById("btnFiltrarPreguntaArea");
  btnFiltrarPreguntaArea.addEventListener("click", function() {

// accion a realizar una vez que se apreto :D
$('#divFiltrosPreguntas').empty();//BORRA TODO EL CONTENEDOR

//FILTRO EN BASE A TEMARIOS EXISTENTES  
var filtroPregunta = 
` 
<div class="">
<select class="selectAreaP" name="selectAreaP" >
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
$("#divFiltrosPreguntas").append(filtroPregunta);

});
//SELECT AREAS
$(document).on("change", ".selectAreaP", function(event) {
  nombreArea = $(this).val();
  temasAreaP(nombreArea);
});
//Muestras todos los temas que contiene el temario elegido
function temasAreaP(nombreArea){
  $('#temasTemario').empty();//BORRA TODO EL CONTENEDOR 
  var uniData = {
    nombreArea: nombreArea, // Crear un objeto con lo necesario
  }; 
  $.ajax({
    type: 'POST',
    data: uniData,
    url: baseUrl+'areaTemaP',
    dataType: 'json',
    success: function(response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, pregunta) {
        var preguntaData = {
          idPregunta: pregunta.idPregunta,
          enunciado: pregunta.enunciado,
          grafico: pregunta.grafico,
          a: pregunta.a, 
          b: pregunta.b,
          c: pregunta.c,
          d: pregunta.d,
          e: pregunta.e,
          respuesta: pregunta.respuesta,
          dificultad: pregunta.dificultad,
          resolucionPdf: pregunta.resolucionPdf,
          idTema:idTemaPregunta
          };
      //llenar el filtro
          var body= 
          `
          <div class="">
          <div class="accordion" >
            <div class="accordion-item">
              <div class="accordion-header">${pregunta.enunciado}</div>
                <div class="accordion-content">
                 <!---CREACION DE TABLA --->
                 <div class="contTable">
                  <table >
                    <thead>
                    <tr>
                    <th>Grafico</th>
                    <th>a</th>
                    <th>b</th>
                    <th>c</th>
                    <th>d</th>
                    <th>e</th>
                    <th>respuestas</th>
                    <th>dificultad</th>
                    <th>resolucion PDF</th>
                    <th>Tema</th>
                    <th>Eliminar/Modificar</th>
                  </tr>
                    </thead>
                    <tbody id="SDF">
                      <!-- AQUI APARECERAN LAS PREGUNTAS -->
                     
          <tr>
 
          <td>${pregunta.grafico}</td>
          <td>${pregunta.a}</td>
          <td>${pregunta.b}</td>
          <td>${pregunta.c}</td>
          <td>${pregunta.d}</td>
          <td>${pregunta.e}</td>
          <td>${pregunta.respuesta}</td>
          <td>${pregunta.dificultad}</td>
          <td><a href="${pregunta.resolucionPdf}">PDF</a></td>
          <td>${nombreTemaPregunta}</td>

          <td><button class="modificar"  data-preguntaData='${JSON.stringify(preguntaData)}'>MODIFICA</button></td>
          <td><button class="eliminar"  data-preguntaData='${JSON.stringify(preguntaData)}'>ELIMINAR</button></td>
        </tr>
                    </tbody>
                  </table>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          `;
      $("#divContenido").append(body);
    });
    if (window.MathJax) {
      MathJax.typeset();
    }
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}