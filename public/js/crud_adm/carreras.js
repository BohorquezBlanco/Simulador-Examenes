//VARIABLE GLOBAL DONDE AGARRAMOS EL ID SELECT CADA VEZ QUE CARGUE 
var globalUniData=1; // Definir la variable global

    //###################################################-CARRERA-#########################################################  
        //---------------------------------SELECT CARRERA-------------------------------------------------
        function selecCarrera() {
          desvincularDragover()
          $('#selectCarrAjax').empty();//BORRA TODO EL CONTENEDOR 
          $('.carreraSelect').empty();//BORRA TODO EL CONTENEDOR 

          var uniData = {
            idU: globalUniData, // Crear un objeto con lo necesario
          }; 
          $.ajax({
            type: 'POST',
            data: uniData,
            url: baseUrl + 'carreraAjax',
            dataType: 'json',
            success: function(response) {
            //encabezado del select       
    
            $('.carreraSelect').append( `<option value="1">Carrera:</option>`);
        
            // Iterar sobre cada universidad y agregarlo al contenedor
            $.each(response, function(index, carrera) {
              //crear un objeto para pasarlo por data-universidad la cual será utilizada mas adelante.
              var carreraData = {
              idU: carrera.idU,
              idCarrera: carrera.idCarrera,
              nombreCarrera: carrera.nombreCarrera,
              descripcionCarrera: carrera.descripcionCarrera, 
              imagenCarrera: carrera.imagenCarrera
              };
              var carreraHTML = 
                `
                <div class="card draggable" id="carrera-${carrera.idCarrera}" draggable="true" data-carrera='${JSON.stringify(carreraData)}'>
                  <img src="${carrera.imagenCarrera}" alt="By AnisSoft" title="${carrera.nombreCarrera}" draggable="false" />
                  <div class="card-body">
                    <h3 class="card-title">${carrera.nombreCarrera}</h3>
                  </div>
                </div>
                `;
              $('#selectCarrAjax').append(carreraHTML);
              
            //llenar el filtro
            var filtroCarrera =               
            `<option value="${carrera.idCarrera}">${carrera.nombreCarrera}</option>`;
            $('.carreraSelect').append(filtroCarrera);
            });
            //agregar el boton de crear universidad 


            // Después de agregar las tarjetas de universidad, agregar el botón al contenedor Esto para evitar que el boton se repita
            $('#selectCarrAjax').append(`
              <button id="insertCarrera" class="abrirModal" type="button" data-target="modalBase">
                <ion-icon name="add-circle-outline"></ion-icon>
              </button>  
            `);
      
            // Agregar funcionalidad de arrastrar y soltar
            $('.draggable').on('dragstart', function(event) {
              var idCarrera = $(this).attr('id');
              event.originalEvent.dataTransfer.setData('text/plain', idCarrera);
            });
            //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--AQUI SE REALIZA EL EVENTO A LA HORA DE ARRASTRAR A MODIFICAR--!!!!!!!!!!!!!!!!!!!!!!!!
            $('#modificarC').on('dragover', function(event) {
              event.preventDefault();
            });
            $('#modificarC').on('drop', function(event) {
              event.preventDefault();
        
              var idCarrera = event.originalEvent.dataTransfer.getData('text/plain');
      
              // Obtener el objeto de datos de la universidad asociado a la tarjeta con el id almacenado en idUniversidad
              var carreraData = $('#' + idCarrera).data('carrera');
      
              $('#contenidoModal').empty();
      
              //--ESCRIBIR MODAL :D
              var contenidoModal = 
                  `
                  <div class="head">
                  <h3>Editar Carrera</h3>
                  <button class="cerrar">
                    <ion-icon name="close-circle-outline"></ion-icon>
                  </button>
                </div>
                  <form id="modificar" data-carrera='${JSON.stringify(carreraData)}'>
                    <div class="celda">
                      <label class="form-label">Nombre de la carrera</label>
                      <input name="idCarrera" id="idCarrera" type="hidden" class="form-control" placeholder="Nombre de la carrera/instituto" value="${carreraData.idCarrera}">
                      <input name="nombreCarrera" id="nombreCarrera" type="text" class="form-control" placeholder="Nombre de la carrera/instituto" value="${carreraData.nombreCarrera}">
                    </div>
                    <div class="celda">
                      <label class="form-label">Descripción de la carrera</label>
                      <textarea class="form-control" rows="3" name="descripcionCarrera" id="descripcionCarrera" placeholder="Descripción de la carrera/instituto">${carreraData.descripcionCarrera}</textarea>
                    </div>
                    <div class="celda">
                      <label class="form-label">Imagen de la carrera</label>
                      <textarea class="form-control" rows="3" name="imagenCarrera" id="imagenCarrera" placeholder="Imagen de la carrera">${carreraData.imagenCarrera}</textarea>
                    </div>
                    <div class="añadir">
                      <button id="editarCarrera" type="button" class="btn-modificar">Modificar</button>
                    </div>
                  </form>
                  `;
                $('#contenidoModal').append(contenidoModal);
                                  // Agregar un controlador de eventos al botón de cerrar
                                  $('.cerrar').on('click', function() {
                                    // Ocultar el modal al hacer clic en el botón de cerrar
                                    $('#modalBase').hide();
                                });
              
                $('#modalBase').show(); // Mostrar el modal
      
            });
            //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--AQUI SE REALIZA EL EVENTO A LA HORA DE ARRASTRAR A ELIMINAR--!!!!!!!!!!!!!!!!!!!!!!!!
            $('#eliminarC').on('dragover', function(event) {
              event.preventDefault();
            });
      
            $('#eliminarC').on('drop', function(event) {
              event.preventDefault();
              var idCarrera = event.originalEvent.dataTransfer.getData('text/plain');
      
              // Obtener el objeto de datos de la carrera asociado a la tarjeta con el id almacenado en idCarrera
              var carreraData = $('#' + idCarrera).data('carrera');
      
              $('#contenidoModal').empty();
      
              //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--ESCRIBIR MODAL :D--!!!!!!!!!!!!!!!!!!!!!!!!
              var contenidoModal = 
                  `
                  <div class="head">
                  <h3>Eliminar Carrera</h3>
                  <button class="cerrar">
                    <ion-icon name="close-circle-outline"></ion-icon>
                  </button>
                </div>
                  <form id="eliminar">
                      <div class="celda">
                          <label class="form-label">¿Está seguro que desea eliminar ${carreraData.nombreCarrera}?</label>
                      </div>
                      <div class="botones" data-carrera='${JSON.stringify(carreraData)}'>
                          <input type="hidden" name="idCarrera" value="${idCarrera}">
                          <img src="${carreraData.imagenCarrera}" alt="By AnisSoft" style="width: 100px; height: auto; display: block; margin: 0 auto;" />
                          <button id="eliminarCarrera" type="button" class="btn-eliminar">Eliminar</button>
                      </div>
                  </form>
                  `;
                $('#contenidoModal').append(contenidoModal);
                                  // Agregar un controlador de eventos al botón de cerrar
                                  $('.cerrar').on('click', function() {
                                    // Ocultar el modal al hacer clic en el botón de cerrar
                                    $('#modalBase').hide();
                                });
              
                $('#modalBase').show(); // Mostrar el modal
      
            });
          },
          error: function(xhr, status, error) {
            console.error('Error al cargar las carreras:', error);
          }   
           
        });
      }
      
        //---------------------------------UPDATE CARRERA-------------------------------------------------
        $('#contenidoModal').on('click', '#editarCarrera', function() {
            event.preventDefault(); // Evitar el envío del formulario por defecto
      
            // Serializar todos los campos del formulario en un arreglo de objetos
            var formDataArray = $('#modificar').serializeArray();
      
            // Convertir el arreglo en un objeto JavaScript
            var carreraData = {};
            formDataArray.forEach(function(item) {
                carreraData[item.name] = item.value;
            });
      
            console.log(carreraData);
      
            // Realizar la solicitud AJAX para editar la universidad
            $.ajax({
                url: baseUrl + 'editarCarrera2',
                type: 'POST',
                data: carreraData, // Serializar el objeto a JSON
                success: function(response) {
                    console.log('Carrera editada con éxito:', response);
                    // Realizar alguna acción adicional si es necesario
                    selecCarrera();
                    $('#modalBase').hide(); // Ocultar el modal
                },
                error: function(error) {
                    console.error('Error al editar la carrera:', error);
                }
            });
        });
      
      
        //---------------------------------INSERT CARRERA-------------------------------------------------
        $('#selectCarrAjax').on('click', '#insertCarrera', function() {
        
          $('#contenidoModal').empty();
          var carreraHTML = 
                `
                <div class="head">
                <h3>Agregar Carrera</h3>
                <button class="cerrar">
                  <ion-icon name="close-circle-outline"></ion-icon>
                </button>
              </div>
                  <form  id="crear">
                    <div class="celda">
                      <label class="form-label">Carrera</label>
                      <input name="nombreCarrera" id="nombreCarrera" type="text" class="form-control" placeholder="Nombre de la Carrera">
                    </div>
                    <div class="celda">
                      <label class="form-label">Descripción de la carrera</label>
                      <textarea class="form-control" rows="3" name="descripcionCarrera" id="descripcionCarrera" placeholder="Descripción de la Carrera"></textarea>
                    </div>
                    <div class="celda">
                      <label class="form-label">Imagen de la carrera</label>
                      <textarea class="form-control" rows="3" name="imagenCarrera" id="imagenCarrera" placeholder="Imagen de la carrera"></textarea>
                    </div>
                    <div class="añadir">
                      <button id="agregarCarrera" type="button" class="btn-modificar">Añadir nueva Carrera</button>
                    </div>
                  </form>
                `;
              $('#contenidoModal').append(carreraHTML);
                                // Agregar un controlador de eventos al botón de cerrar
                                $('.cerrar').on('click', function() {
                                  // Ocultar el modal al hacer clic en el botón de cerrar
                                  $('#modalBase').hide();
                              });
            
              $('#modalBase').show(); // Mostrar el modal
      
      });
      
      
      $('#contenidoModal').on('click', '#agregarCarrera', function() {
          event.preventDefault(); // Evitar el envío del formulario por defecto
      
            // Serializar el formulario para obtener todos los valores de los inputs
            var idU = globalUniData;
            var formData = $('#crear').serialize();
            // Agregar idU como un parámetro adicional a los datos serializados
            formData += '&idU=' + encodeURIComponent(idU);
      
          // Realizar la solicitud AJAX para agregar la nueva universidad
          $.ajax({
              url: baseUrl + 'crearCarrera2',
              type: 'POST',
              data: formData,
              success: function(response) {
                  console.log('Carrera agregada con éxito:', response);
                  // Realizar alguna acción adicional si es necesario
                  selecCarrera();
                  $('#modalBase').hide(); // Ocultar el modal
              },
              error: function(error) {
                  console.error('Error al agregar la carrera:', error);
              }
          });
      });
      
        //---------------------------------DELETE CARRERA-------------------------------------------------
      $('#contenidoModal').on('click', '#eliminarCarrera', function() {
        event.preventDefault(); // Evitar el envío del formulario por defecto
        var carreraData = $(this).closest('.botones').data('carrera');
        console.log(carreraData);
      
                  // Realizar la solicitud AJAX para eliminar la universidad
                  $.ajax({
                      url: baseUrl + 'eliminarCarrera2',
                      type: 'POST',
                      data: carreraData, // Serializar el objeto a JSON
                      success: function(response) {
                          console.log('Carrera eliminada con éxito:', response);
                          // Realizar alguna acción adicional si es necesario
                          selecCarrera();
                          $('#modalBase').hide(); // Ocultar el modal
                      },
                      error: function(error) {
                          console.error('Error al eliminar la Carrera:', error);
                      }
                  });
      });
      
//###################################################-CARRERA FILTRO-#########################################################

$('.universidadSelect').change(function() {
  var idU = $(this).val();
  globalUniData = idU; // Asignar uniData a la variable global
  console.log(globalUniData);
  selecCarrera()
});
