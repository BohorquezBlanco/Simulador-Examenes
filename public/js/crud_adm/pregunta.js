//###################################################-PREGUNTAS-#########################################################     
    //preguntas de la materia
   function selecPreguntaE(globalMateriaData)
   {
    $('#preguntasExistentes').empty();//BORRA TODO EL CONTENEDOR 
    var uniData = {
      idMateria: globalMateriaData, // Crear un objeto con lo necesario
    }; 
    $.ajax({
      type: 'POST',
      url: baseUrl + 'bancoPreguntas',
      data: uniData, 
      dataType: 'json',
      success: function(response) {
        $.each(response, function(index, pregunta) {
          //crear un objeto para pasarlo por data-universidad la cual será utilizada mas adelante.
          var preguntaData = {
          idPregunta: pregunta.idPregunta,
          enunciado: pregunta.enunciado,
          grafico: pregunta.grafico,
          a: pregunta.a, 
          b: pregunta.b,
          c: pregunta.a, 
          d: pregunta.b,
          e: pregunta.a, 
          respuesta: pregunta.respuesta,
          idTema: pregunta.idTema, 
          dificultad: pregunta.dificultad,
          resolucionPdf: pregunta.resolucionPdf,
          idMateria: globalMateriaData
          };
          var carreraHTML = 
            `
            <tr>
              <td >${pregunta.idPregunta}</td>
              <td >${pregunta.enunciado}</td>
              <td class="full-size"><button class="full-size quitar" id="EliminarE" data-preguntaData='${JSON.stringify(preguntaData)}'>Quitar</button></td>
              <td class="full-size"><button class="full-size" id="Editar">Editar</button></td>
            </tr>
            `;
          $('#preguntasExistentes').append(carreraHTML);
          

        });
      },
      error: function(xhr, status, error) {
          console.error('Error al insertar el tema:', error);
      }
    });
   }

//preguntas existentes listas para poder ser agregadas 
    function selecPreguntaA(globalMateriaData)
    {
     $('#preguntasParaAgregar').empty();//BORRA TODO EL CONTENEDOR 
     var uniData = {
       idMateria: globalMateriaData, // Crear un objeto con lo necesario
     }; 
     $.ajax({
       type: 'POST',
       url: baseUrl + 'cargarPreguntas',
       data: uniData, 
       dataType: 'json',
       success: function(response) {
         $.each(response, function(index, pregunta) {
           //crear un objeto para pasarlo por data-universidad la cual será utilizada mas adelante.
           var preguntaData = {
           idPregunta: pregunta.idPregunta,
           enunciado: pregunta.enunciado,
           grafico: pregunta.grafico,
           a: pregunta.a, 
           b: pregunta.b,
           c: pregunta.a, 
           d: pregunta.b,
           e: pregunta.a, 
           respuesta: pregunta.respuesta,
           idTema: pregunta.idTema, 
           dificultad: pregunta.dificultad,
           resolucionPdf: pregunta.resolucionPdf,
           idMateria: globalMateriaData
           };
           var carreraHTML = 
             `
             <tr class="filtro">
              <td >${pregunta.idPregunta}</td>
               <td>${pregunta.enunciado}</td>
               <td class="full-size"><button type="button" class="full-size  agregar" data-preguntaData='${JSON.stringify(preguntaData)}' >Agregar</button></td>
               <td class="full-size"><button class="full-size" id="editar">Editar</button></td>
             </tr>
             `;
           $('#preguntasParaAgregar').append(carreraHTML);
           
         });
       },
       error: function(xhr, status, error) {
           console.error('Error al insertar el tema:', error);
       }
     });
    }
 
   $('.materiaSelect').change(function() {
    var idMateria = $(this).val();
    globalMateriaData = idMateria; // Asignar uniData a la variable global
    console.log(globalMateriaData);
  
    selecPreguntaA(globalMateriaData);
    selecPreguntaE(globalMateriaData);
  });

  //filtro base donde oculta los resultados existentes
  $('#searchPreguntas').on('input', function() {
    var searchText = $(this).val().trim().toLowerCase();
    $('#preguntasParaAgregar .filtro').each(function() {
      var rowText = $(this).text().trim().toLowerCase();
      if (rowText.includes(searchText)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });

  //filtro base donde oculta los resultados existentes

// Delegar el evento click de "EDITAR" UNA PREGUNTA
    $('#preguntasParaAgregar').on('click', '.agregar', function() {
        var preguntaData = $(this).data('preguntadata');
        
        //Idea de agregar temas a un div para usar solo 1 modal
        $('#contenidoModal').empty();

        var preguntaHTML = `                
        <div class="head">
          <h3>AGREGAR PREGUNTA</h3>
          <button class="cerrar">
            <ion-icon name="close-circle-outline"></ion-icon>
          </button>
        </div>
        <form id="modificar" data-universidad=''>
          <div class="añadir abrirModal">
            <label class="celda">${preguntaData.enunciado}</label>
            <button id="agregarBancoPregunta" type="button" class="btn-modificar agregar" data-preguntaData='${JSON.stringify(preguntaData)}' >Agregar</button>
          </div>
        </form>
                      
        `;
        $('#contenidoModal').append(preguntaHTML);
        // Agregar un controlador de eventos al botón de cerrar
        $('.cerrar').on('click', function() {
          // Ocultar el modal al hacer clic en el botón de cerrar
        $('#modalBase').hide();
        });
        
        $('#modalBase').fadeIn();    
    });

// Agregar pregunta al banco de preguntas  
$('#contenidoModal').on('click', '.agregar', function() {
  var preguntaData = $(this).data('preguntadata');

  console.log(preguntaData); 

  // Realizar la solicitud AJAX para agregar la nueva pregunta
  $.ajax({
      url: baseUrl + 'insertBancoPregunta',
      type: 'POST',
      data: preguntaData, // Aquí enviamos directamente el objeto preguntaData
      error: function(error) {
          console.error('Error al agregar pregunta:', error);
      },
      success: function(response) {
          console.log('Pregunta agregada con éxito:', response);
          // Realizar alguna acción adicional si es necesario
          $('#modalBase').hide(); // Ocultar el modal
          selecPreguntaA(globalMateriaData)
          selecPreguntaE(globalMateriaData)
      }
  });
});



// Delegar el evento click de "Eliminar" UNA PREGUNTA
    $('#preguntasExistentes').on('click', '.quitar', function() {
      var preguntaData = $(this).data('preguntadata');
      
      //Idea de agregar temas a un div para usar solo 1 modal
      $('#contenidoModal').empty();

      var preguntaHTML = `                
      <div class="head">
        <h3>QUITAR PREGUNTA</h3>
        <button class="cerrar">
          <ion-icon name="close-circle-outline"></ion-icon>
        </button>
      </div>
      <form id="modificar" data-universidad=''>
        <div class="añadir abrirModal">
          <label class="celda">${preguntaData.enunciado}</label>
          <button id="quitarBancoPregunta" type="button" class="btn-modificar quitar" data-preguntaData='${JSON.stringify(preguntaData)}' >QUITAR</button>
        </div>
      </form>
                    
      `;
      $('#contenidoModal').append(preguntaHTML);
      // Agregar un controlador de eventos al botón de cerrar
      $('.cerrar').on('click', function() {
        // Ocultar el modal al hacer clic en el botón de cerrar
      $('#modalBase').hide();
      });
      
      $('#modalBase').fadeIn();    
  });

// QUITAR pregunta del banco de preguntas  
$('#contenidoModal').on('click', '.quitar', function() {
var preguntaData = $(this).data('preguntadata');

console.log(preguntaData); 

// Realizar la solicitud AJAX para agregar la nueva pregunta
$.ajax({
    url: baseUrl + 'deleteBancoPregunta',
    type: 'POST',
    data: preguntaData, // Aquí enviamos directamente el objeto preguntaData
    error: function(error) {
        console.error('Error al agregar pregunta:', error);
    },
    success: function(response) {
        console.log('Pregunta eliminada con éxito:', response);
        // Realizar alguna acción adicional si es necesario
        $('#modalBase').hide(); // Ocultar el modal
        selecPreguntaE(globalMateriaData)
        selecPreguntaA(globalMateriaData)
    }
});
});

