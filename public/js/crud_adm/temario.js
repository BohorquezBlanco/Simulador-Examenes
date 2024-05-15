//###################################################-PREGUNTAS-#########################################################     
    //preguntas de la materia
   function selecTemario(globalMateriaData)
   {
    $('#temarioMateria').empty();//BORRA TODO EL CONTENEDOR 
    var uniData = {
      idMateria: globalMateriaData, // Crear un objeto con lo necesario
    }; 
    $.ajax({
      type: 'POST',
      url: baseUrl + 'temarioMateria',
      data: uniData, 
      dataType: 'json',
      success: function(response) {
        $.each(response, function(index, temario) {
          //crear un objeto para pasarlo por data-universidad la cual será utilizada mas adelante.
          var temarioData = {
          idTemario: temario.idTemario,
          nombreTemario: temario.nombreTemario,
          contenidoTemario: temario.contenidoTemario,
          libroTemario: temario.libroTemario, 
          idMateria: globalMateriaData,
          nombreMateria: globalMatNombre
          };
          var temarioHTML = 
            `
            <tr>
              <td>${temario.nombreTemario}</td>
              <td>${temario.contenidoTemario}</td>
              <td>${temario.libroTemario}</td>
              <td>${temarioData.nombreMateria}</td>
              <td><button class="full-size modificar" data-temarioData='${JSON.stringify(temarioData)}'>MODIFICAR</button></td>
              </tr>
            `;
          $('#temarioMateria').append(temarioHTML);
        });
      },
      error: function(xhr, status, error) {
          console.error('Error al insertar el tema:', error);
      }
    });
   }

//MODIFICAR 
$('#temarioMateria').on('click', '.modificar', function() {
  var temarioDataString = $(this).attr('data-temarioData');
  var temarioData = JSON.parse(temarioDataString);
 
  $('#divModificarTemario').empty();
  var temarioHTML = 
  `
  <form id="modificarTemario">
  <h1>MODIFICAR TEMARIO</h1>
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Nombre Temario</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="${temarioData.nombreTemario}">
  </div>

  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Contenido Temario</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="${temarioData.contenidoTemario}" >
  </div>

  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Libro Temario</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="${temarioData.libroTemario}" >
  </div>
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Materia:</label>
      <select class="form-select " aria-label="Default select example" id="selectMateriaTemario">
      <option value="${temarioData.idMateria}" selected>${temarioData.nombreMateria}</option>
      <option id="materiaTemarioMod" value="${globalMateriaData}" >${globalMatNombre}</option>
    </select>
  </div>
 
    <button class="enviarT" id="modificarTemario">
      MODIFICAR TEMARIO
    </button>
  </form>
  `;
$('#divModificarTemario').append(temarioHTML);
});




  //obtener boton para la creacion de temas 
  // Obtener el botón por su id
  var botonCrearMateria = document.getElementById("crearTemario");
  // Agregar un evento de clic al botón
  botonCrearMateria.addEventListener("click", function() {
  // accion a realizar una vez que se apreto :D
          
    $('#contenidoModal').empty();
        
    //--ESCRIBIR MODAL :D
    var contenidoModal = 
        `
        <div class="head">
        <h3>Agregar Temario</h3>
        <button class="cerrar">
          <ion-icon name="close-circle-outline"></ion-icon>
        </button>
      </div>
        <form id="agregarTemario">
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
            <label class="form-label">Imagen de la materia</label>
            <textarea class="form-control" rows="3" name="libroTemario" id="libroTemario" placeholder="Libro del temario"></textarea>
          </div>
          <div class="celda">
          <label class="form-label">Materia:</label>
          <input name="nombreMateria" id="nombreTemario" type="text" class="form-control" placeholder="Nombre del temario" disabled value="${globalMatNombre}">
          </div>
          <div class="añadir">
            <button id="insertarTemario" type="button" class="btn-modificar">Agregar Temario</button>
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
$('#contenidoModal').on('click', '#insertarTemario', function() {
    event.preventDefault(); // Evitar el envío del formulario por defecto
    // Serializar el formulario para obtener todos los valores de los inputs
    var idMateria = globalMateriaData;
    var formData = $('#agregarTemario').serialize();
    // Agregar idU como un parámetro adicional a los datos serializados
    formData += '&idMateria=' + encodeURIComponent(idMateria);
      
    // Realizar la solicitud AJAX para agregar la nueva universidad
    $.ajax({
        url: baseUrl + 'crearTemario',
        type: 'POST',
        data: formData,
        success: function(response) {
            console.log('Temario agregado con éxito:', response);
            // Realizar alguna acción adicional si es necesario
            selecTemario(globalMateriaData);
            $('#modalBase').hide(); // Ocultar el modal
        },
        error: function(error) {
            console.error('Error al agregar el temario:', error);
        }
    });
});


//MODIFICAR
$('#divModificarTemario').on('click', '#modificarTemario', function() {
  event.preventDefault(); // Evitar el envío del formulario por defecto
  // Serializar el formulario para obtener todos los valores de los inputs
  var formData = $('#modificarTemario').serialize();

  // Realizar la solicitud AJAX para agregar la nueva universidad
  $.ajax({
      url: baseUrl + 'modificarTemario',
      type: 'POST',
      data: formData,
      success: function(response) {
          console.log('Temario modificado con éxito:', response);
          // Realizar alguna acción adicional si es necesario
          selecTemario(globalMateriaData);

      },
      error: function(error) {
          console.error('Error al modificar el temario:', error);
      }
  });
});




    //FILTRO DE MATERIA
   $('.materiaSelect').change(function() {
    var idMateria = $(this).val();
    var nombreMateria = $(this).find("option:selected").text();
    globalMateriaData = idMateria; // Asignar uniData a la variable global
    globalMatNombre = nombreMateria; // Asignar uniData a la variable global

    console.log(globalMateriaData);
  
    selecTemario(globalMateriaData)
    

  // Obtener el elemento option por su id
  var optionElement = $('#materiaTemarioMod');
  optionElement.val(idMateria);
  optionElement.text(nombreMateria);
  });

