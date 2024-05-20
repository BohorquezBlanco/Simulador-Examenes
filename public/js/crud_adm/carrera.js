var globalCarrData=1; // Definir la variable global
var globalCarrNombre=null; //
    //###################################################-CARRERA-#########################################################  
        //---------------------------------SELECT CARRERA-------------------------------------------------
        function selecCarrera(globalUniData) {
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
                    <p class="card-title">${carrera.nombreCarrera}</p>
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


          // Asignar los valores a las variables globales
          var datosUniversidad = obtenerPrimerIdYNombre(response, "idCarrera", "nombreCarrera");
          globalCarrData = datosUniversidad.primerId;
          globalCarrNombre = datosUniversidad.primerNombre;
          selecMateria(globalCarrData);




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
                  `<div class="head">
                  <div class="left-section">
                  <p>Editar Carrera</p>
                  </div>
                  <div class="right-section">
                      <button class="cerrar">
                          <ion-icon name="close-circle-outline"></ion-icon>
                      </button>
                  </div>
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
                    
                  </form>
                  <div class="añadir">
                      <button id="editarCarrera" type="button" class="btn">Modificar</button>
                    </div>
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
                  `<div class="head">
                  <div class="left-section">
                  <p>Eliminar Carrera</p>
                  </div>
                  <div class="right-section">
                      <button class="cerrar">
                          <ion-icon name="close-circle-outline"></ion-icon>
                      </button>
                  </div>
              </div>
                  <form id="eliminar" data-carrera='${JSON.stringify(carreraData)}'>
                    <input type="hidden" class="form-control" name="idCarrera" id="idCarrera" value="${carreraData.idCarrera}">
                      <div class="celda">
                          <label class="form-label">¿Está seguro que desea eliminar ${carreraData.nombreCarrera}?</label>
                      </div>
                  </form>
                  <br>
                  <div class="añadir">
                      <button id="eliminarCarrera" type="button" class="btn">Eliminar</button>
                    </div>
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
                url: baseUrl + 'editarCarrera',
                type: 'POST',
                data: carreraData, // Serializar el objeto a JSON
                success: function(response) {
                    console.log('Carrera editada con éxito:', response);
                    // Realizar alguna acción adicional si es necesario
                    selecCarrera(globalUniData);
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
                `<div class="head">
                <div class="left-section">
                <p>Agregar Carrera</p>
                </div>
                <div class="right-section">
                    <button class="cerrar">
                        <ion-icon name="close-circle-outline"></ion-icon>
                    </button>
                </div>
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
                  </form>
                  <div class="añadir">
                    <button id="agregarCarrera" type="button" class="btn">Añadir</button>
                  </div>
                `;
              $('#contenidoModal').append(carreraHTML);
                                // Agregar un controlador de eventos al botón de cerrar
                                $('.cerrar').on('click', function() {
                                  // Ocultar el modal al hacer clic en el botón de cerrar
                                  $('#modalBase').hide();
                              });
            
                  // Mostrar el modal después de que se haya construido completamente
                  $('#modalBase').fadeIn();      
      });
      
      
      $('#contenidoModal').on('click', '#agregarCarrera', function(event) {
          event.preventDefault(); // Evitar el envío del formulario por defecto
      
            // Serializar el formulario para obtener todos los valores de los inputs
            var idU = globalUniData;
            var formData = $('#crear').serialize();
            // Agregar idU como un parámetro adicional a los datos serializados
            formData += '&idU=' + encodeURIComponent(idU);
      
          // Realizar la solicitud AJAX para agregar la nueva universidad
          $.ajax({
              url: baseUrl + 'crearCarrera',
              type: 'POST',
              data: formData,
              success: function(response) {
                  console.log('Carrera agregada con éxito:', response);
                  // Realizar alguna acción adicional si es necesario
                  selecCarrera(globalUniData);
                  $('#modalBase').hide(); // Ocultar el modal
              },
              error: function(error) {
                  console.error('Error al agregar la carrera:', error);
              }
          });
      });
      
//---------------------------------DELETE CARRERA-------------------------------------------------
      $('#contenidoModal').on('click', '#eliminarCarrera', function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto
  var formDataArray = $("#eliminar").serializeArray();

  console.log(formDataArray);
  // Convertir el arreglo en un objeto JavaScript
  var carreraData  = {};
  formDataArray.forEach(function (item) {
    carreraData [item.name] = item.value;
  });
  
        console.log(carreraData);
      
                  // Realizar la solicitud AJAX para eliminar la universidad
                  $.ajax({
                      url: baseUrl + 'eliminarCarrera',
                      type: 'POST',
                      data: carreraData, // Serializar el objeto a JSON
                      success: function(response) {
                          console.log('Carrera eliminada con éxito:', response);
                          // Realizar alguna acción adicional si es necesario
                          selecCarrera(globalUniData);
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
  selecCarrera(globalUniData);
  // Seleccionar la opción correspondiente en el segundo filtro
  $('.universidadSelect').val(idU);
});
