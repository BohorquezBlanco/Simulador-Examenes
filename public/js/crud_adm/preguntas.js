

//FUNCION PARA REUTILIZAR AJAX 
function preguntaCarreras() {
  $.ajax({
    type: 'POST',
    url: baseUrl+'allCarreras',
    dataType: 'json',
    success: function(response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, carrera) {
      //llenar el filtro
      var filtroCarrera = ` <option value="${carrera.idCarrera}">${carrera.nombreCarrera}</option>`;
      $(".carreraPregunta").append(filtroCarrera);
    });
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}

function preguntaMaterias(idCarrera) {
  $('.materiaPregunta').empty();//BORRA TODO EL CONTENEDOR
  $(".materiaPregunta").append('<option value="0">Materia:</option>');
 
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
      $(".materiaPregunta").append(filtroMateria);
    });
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}


function preguntaTemas(idMateria) {
  $('.preguntaTema').empty();//BORRA TODO EL CONTENEDOR
  $(".preguntaTema").append('<option value="0">Tema:</option>');

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
      var filtroTema = ` <option value="${tema.idTema}">${tema.nombreTema}</option>`;
      $(".preguntaTema").append(filtroTema);
      
    });
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}


//filtros select
$('.carreraPregunta').change(function() {
  var idCarrera = $(this).val();
  preguntaMaterias(idCarrera)  ;

});

$('.materiaPregunta').change(function() {
  var idMateria = $(this).val();
  
  preguntaTemas(idMateria);
});

$('.preguntaTema').change(function() {
  var idTema = $(this).val();
  globalTemaData=idTema;
  preguntas(idTema) 
});

//SELECT 
function preguntas(idTema) {
  $('#thbodypregunta').empty();//BORRA TODO EL CONTENEDOR

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
          idTema:globalTemaData
          };
      //llenar el filtro
      var filtroTema = 
      `
      <tr>
        <td>${pregunta.enunciado}</td>
        <td>${pregunta.grafico}</td>
        <td>${pregunta.a}</td>
        <td>${pregunta.b}</td>
        <td>${pregunta.c}</td>
        <td>${pregunta.d}</td>
        <td>${pregunta.e}</td>
        <td>${pregunta.respuesta}</td>
        <td>${pregunta.dificultad}</td>
        <td><a href="${pregunta.resolucionPdf}">PDF</a></td>
        <td>${globalTemaData}</td>

        <td><button class=" modificar"  data-preguntaData='${JSON.stringify(preguntaData)}'>MODIFICA</button></td>
        <td><button class=" eliminar"  data-preguntaData='${JSON.stringify(preguntaData)}'>ELIMINAR</button></td>

      </tr>
      `;
      $("#thbodypregunta").append(filtroTema);
    });
    },
    error: function(xhr, status, error) {
      // Manejar errores si es necesario
    }
  });
}



//MODIFICAR
$('#thbodypregunta').on('click', '.modificar', function() {
  var preguntaDataString = $(this).attr('data-preguntaData');
  var pregunta = JSON.parse(preguntaDataString);
 console.log("gola:".pregunta);
  $('#contenidoModal').empty();
  var contenidoModal = 
  `
  <div class="head">
  <h3>Modificar Pregunta</h3>
  <button class="cerrar">
    <ion-icon name="close-circle-outline"></ion-icon>
  </button>
</div>
  <form id="modificarP">
    <div class="celda">
      <input name="idPregunta" id="idPregunta" type="hidden" class="form-control" value="${pregunta.idPregunta}">
      <input name="idTema" id="idTema" type="hidden" class="form-control" value="${globalTemaData}">

      <label class="form-label">Imagen de la materia</label>
      <textarea class="form-control" rows="3" name="enunciado" id="enunciado" placeholder="enunciado">${pregunta.enunciado}</textarea>
    </div>
    <div class="celda">
      <label class="form-label">Grafico</label>
      <textarea class="form-control" rows="3" name="grafico" id="grafico" placeholder="Grafico si es que existe">${pregunta.grafico}</textarea>
    </div>
    <div class="celda">
      <label class="form-label">a)</label>
      <input name="a" id="a" type="text" class="form-control" placeholder="a)" value="${pregunta.a}">
    </div>
    <div class="celda">
      <label class="form-label">b)</label>
      <input name="b" id="b" type="text" class="form-control" placeholder="b)" value="${pregunta.b}">
    </div>          
    <div class="celda">
      <label class="form-label">c)</label>
      <input name="c" id="c" type="text" class="form-control" placeholder="c)" value="${pregunta.c}">
    </div>          
    <div class="celda">
      <label class="form-label">d)</label>
      <input name="d" id="d" type="text" class="form-control" placeholder="d)" value="${pregunta.d}">
    </div>
    <div class="celda">
      <label class="form-label">e)</label>
      <input name="e" id="e" type="text" class="form-control" placeholder="e)" value="${pregunta.e}">
    </div>
    <div class="celda">
      <label class="form-label">respuesta</label>
      <input name="respuesta" id="respuesta" type="text" class="form-control" placeholder="respuesta" value="${pregunta.respuesta}">
    </div>
    <div class="celda">
      <select name="dificultad" id="dificultad">
        <option value="facil" selected>${pregunta.dificultad}</option>
        <option value="facil" >facil</option>
        <option value="moderado">Moderado</option>
        <option value="Dificil">Dificil</option>
      </select>
    </div>


    <div class="celda">
      <label class="form-label">resolucionPDF</label>
      <input name="resolucionPDF" id="resolucionPDF" type="text" class="form-control" placeholder="resolucion" value="${pregunta.resolucionPdf}">
    </div>
    <div class="añadir">
      <button id="modificarPregunta" type="button" class="btn-modificar">Modificar Pregunta </button>
    </div>
  </form>
  `;
  $('#contenidoModal').append(contenidoModal);
  // Agregar un controlador de eventos al botón de cerrar
  $('.cerrar').on('click', function() {
    // Ocultar el modal al hacer clic en el botón de cerrar
    $('#modalBase').hide();
});
    // Mostrar el modal después de que se haya construido completamente
    $('#modalBase').fadeIn()

});

$('#contenidoModal').on('click', '#modificarPregunta', function(event) {
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
            preguntas(globalTemaData);

        },
        error: function(error) {
            console.error('Error al modificar el temario:', error);
        }
    });
  });

  



//ELIMINAR
$('#thbodypregunta').on('click', '.eliminar', function() {
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
                    preguntas(globalTemaData);
                    $('#modalBase').hide(); // Ocultar el modal
                },
                error: function(error) {
                    console.error('Error al eliminar el Temario:', error);
                }
            });
});

//INSERT DE PREGUNTA 
  //obtener boton para la creacion de temas 
  // Obtener el botón por su id
  var botonCrearMateria = document.getElementById("crearPregunta");
  // Agregar un evento de clic al botón
  botonCrearMateria.addEventListener("click", function() {
  // accion a realizar una vez que se apreto :D
      
  $('#contenidoModal').empty();       
    //--ESCRIBIR MODAL :D
    var contenidoModal = 
        `
        <div class="head">
        <h3>Agregar Pregunta</h3>
        <button class="cerrar">
          <ion-icon name="close-circle-outline"></ion-icon>
        </button>
      </div>
        <form id="agregarPregunta">
          <div class="celda">
            <input name="idTema" id="idTema" type="hidden" class="form-control" value="${globalTemaData}">
            <label class="form-label">Imagen de la materia</label>
            <textarea class="form-control" rows="3" name="enunciado" id="enunciado" placeholder="enunciado"></textarea>
          </div>
          <div class="celda">
            <label class="form-label">Grafico</label>
            <textarea class="form-control" rows="3" name="grafico" id="grafico" placeholder="Grafico si es que existe"></textarea>
          </div>
          <div class="celda">
            <label class="form-label">a)</label>
            <input name="a" id="a" type="text" class="form-control" placeholder="a)">
          </div>
          <div class="celda">
            <label class="form-label">b)</label>
            <input name="b" id="b" type="text" class="form-control" placeholder="b)">
          </div>          
          <div class="celda">
            <label class="form-label">c)</label>
            <input name="c" id="c" type="text" class="form-control" placeholder="c)">
          </div>          
          <div class="celda">
            <label class="form-label">d)</label>
            <input name="d" id="d" type="text" class="form-control" placeholder="d)">
          </div>
          <div class="celda">
            <label class="form-label">e)</label>
            <input name="e" id="e" type="text" class="form-control" placeholder="e)">
          </div>
          <div class="celda">
            <label class="form-label">respuesta</label>
            <input name="respuesta" id="respuesta" type="text" class="form-control" placeholder="respuesta">
          </div>
          <div class="celda">
            <select name="dificultad" id="dificultad">
              <option value="facil" selected>facil</option>
              <option value="moderado">Moderado</option>
              <option value="Dificil">Dificil</option>
            </select>
          </div>
          <div class="celda">
            <label class="form-label">resolucionPDF</label>
            <input name="resolucionPDF" id="resolucionPDF" type="text" class="form-control" placeholder="resolucion">
          </div>
          <div class="añadir">
            <button id="insertarPregunta" type="button" class="btn-modificar">Agregar Temario</button>
          </div>
        </form>
        `;
      $('#contenidoModal').append(contenidoModal);
      // Agregar un controlador de eventos al botón de cerrar
      $('.cerrar').on('click', function() {
        // Ocultar el modal al hacer clic en el botón de cerrar
        $('#modalBase').hide();
    });
        // Mostrar el modal después de que se haya construido completamente
        $('#modalBase').fadeIn()

  });

//insertar
$('#contenidoModal').on('click', '#insertarPregunta', function(event) {
    event.preventDefault(); // Evitar el envío del formulario por defecto
    // Serializar el formulario para obtener todos los valores de los inputs

    var formData = $('#agregarPregunta').serialize();
      
    // Realizar la solicitud AJAX para agregar la nueva universidad
    $.ajax({
        url: baseUrl + 'crearPregunta',
        type: 'POST',
        data: formData,
        success: function(response) {
            console.log('Pregunta agregada con éxito:', response);
            // Realizar alguna acción adicional si es necesario
            preguntas(globalTemaData);
        $('#modalBase').hide(); // Ocultar el modal
        },
        error: function(error) {
            console.error('Error al agregar la pregunta:', error);
        }
    });
});



