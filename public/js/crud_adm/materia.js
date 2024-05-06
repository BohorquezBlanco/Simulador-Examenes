   //VARIABLE GLOBAL DONDE AGARRAMOS EL ID SELECT CADA VEZ QUE CARGUE 
var globalCarrData=1; // Definir la variable global

    //###################################################-MATERIA-#########################################################  
        //---------------------------------SELECT MATERIA-------------------------------------------------
        function selecMateria() {
          $('#selectMatAjax').empty();//BORRA TODO EL CONTENEDOR 

          var uniData = {
            idCarrera: globalCarrData, // Crear un objeto con lo necesario
          }; 
          console.log("Soy unidata"+uniData);
          $.ajax({
            type: 'POST',
            data: uniData,
            url: baseUrl + 'materiaAjax',
            dataType: 'json',
            success: function(response) {
            // Iterar sobre cada universidad y agregarlo al contenedor
            $.each(response, function(index, materia) {
              //crear un objeto para pasarlo por data-universidad la cual será utilizada mas adelante.
              var materiaData = {
              idMateria: materia.idMateria,
              nombreMateria: materia.nombreMateria,
              descripcionMateria: materia.descripcionMateria, 
              imagenMateria: materia.imagenMateria
              };
      
              var MateriaHTML = 
                `
                <div class="card draggable" id="materia-${materia.idMateria}" draggable="true" data-materia='${JSON.stringify(materiaData)}'>
                  <img src="${materia.imagenMateria}" alt="By AnisSoft" title="${materia.nombreMateria}" draggable="false" />
                  <div class="card-body">
                    <h3 class="card-title">${materia.nombreMateria}</h3>
                  </div>
                </div>
                `;
              $('#selectMatAjax').append(MateriaHTML);
            });
            //agregar el boton de crear universidad 
            // Después de agregar las tarjetas de universidad, agregar el botón al contenedor Esto para evitar que el boton se repita
            $('#selectMatAjax').append(`
              <button id="insertMateria" class="abrirModal" type="button" data-target="modalBase">
                <ion-icon name="add-circle-outline"></ion-icon>
              </button>  
            `);
      
            // Agregar funcionalidad de arrastrar y soltar
            $('.draggable').on('dragstart', function(event) {
              var idMateria = $(this).attr('id');
              event.originalEvent.dataTransfer.setData('text/plain', idMateria);
            });
            //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--AQUI SE REALIZA EL EVENTO A LA HORA DE ARRASTRAR A MODIFICAR--!!!!!!!!!!!!!!!!!!!!!!!!
            $('#modificarM').on('dragover', function(event) {
              event.preventDefault();
            });
            $('#modificarM').on('drop', function(event) {
              event.preventDefault();
        
              var idMateria = event.originalEvent.dataTransfer.getData('text/plain');
      
              // Obtener el objeto de datos de la universidad asociado a la tarjeta con el id almacenado en idUniversidad
              var materiaData = $('#' + idMateria).data('materia');
      
              $('#contenidoModal').empty();
      
              //--ESCRIBIR MODAL :D
              var contenidoModal = 
                  `
                  <form id="modificar" data-materia='${JSON.stringify(materiaData)}'>
                    <div class="celda">
                      <label class="form-label">Nombre de la materia</label>
                      <input name="idMateria" id="idMateria" type="hidden" class="form-control" placeholder="Nombre de la materia" value="${materiaData.idMateria}">
                      <input name="nombreMateria" id="nombreMateria" type="text" class="form-control" placeholder="Nombre de la materia" value="${materiaData.nombreMateria}">
                    </div>
                    <div class="celda">
                      <label class="form-label">Descripción de la materia</label>
                      <textarea class="form-control" rows="3" name="descripcionMateria" id="descripcionMateria" placeholder="Descripción de la materia">${materiaData.descripcionMateria}</textarea>
                    </div>
                    <div class="celda">
                      <label class="form-label">Imagen de la materia</label>
                      <textarea class="form-control" rows="3" name="imagenMateria" id="imagenMateria" placeholder="Imagen de la materia">${materiaData.imagenMateria}</textarea>
                    </div>
                    <div class="añadir">
                      <button id="editarMateria" type="button" class="btn-modificar">Modificar</button>
                    </div>
                  </form>
                  `;
                $('#contenidoModal').append(contenidoModal);
                $('#modalBase').show(); // Mostrar el modal
      
            });
            //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--AQUI SE REALIZA EL EVENTO A LA HORA DE ARRASTRAR A ELIMINAR--!!!!!!!!!!!!!!!!!!!!!!!!
            $('#eliminarM').on('dragover', function(event) {
              event.preventDefault();
            });
      
            $('#eliminarM').on('drop', function(event) {
              event.preventDefault();
              var idMateria = event.originalEvent.dataTransfer.getData('text/plain');
      
              // Obtener el objeto de datos de la materia asociado a la tarjeta con el id almacenado en idMateria
              var materiaData = $('#' + idMateria).data('materia');
      
              $('#contenidoModal').empty();
      
              //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--ESCRIBIR MODAL :D--!!!!!!!!!!!!!!!!!!!!!!!!
              var contenidoModal = 
                  `
                  <form id="eliminar">
                      <div class="celda">
                          <label class="form-label">¿Está seguro que desea eliminar ${materiaData.nombreMateria}?</label>
                      </div>
                      <div class="botones" data-materia='${JSON.stringify(materiaData)}'>
                          <input type="hidden" name="idMateria" value="${idMateria}">
                          <img src="${materiaData.imagenMateria}" alt="By AnisSoft" style="width: 100px; height: auto; display: block; margin: 0 auto;" />
                          <button id="eliminarMateria" type="button" class="btn-eliminar">Eliminar</button>
                      </div>
                  </form>
                  `;
                $('#contenidoModal').append(contenidoModal);
                $('#modalBase').show(); // Mostrar el modal
      
            });
          },
          error: function(xhr, status, error) {
            console.error('Error al cargar las materias:', error);
          }   
           
        });
      }
      
        //---------------------------------UPDATE MATERIA-------------------------------------------------
        $('#contenidoModal').on('click', '#editarMateria', function() {
            event.preventDefault(); // Evitar el envío del formulario por defecto
      
            // Serializar todos los campos del formulario en un arreglo de objetos
            var formDataArray = $('#modificar').serializeArray();
      
            // Convertir el arreglo en un objeto JavaScript
            var materiaData = {};
            formDataArray.forEach(function(item) {
                materiaData[item.name] = item.value;
            });
      
            console.log(materiaData);
      
            // Realizar la solicitud AJAX para editar la universidad
            $.ajax({
                url: baseUrl + 'editarMateria2',
                type: 'POST',
                data: materiaData, // Serializar el objeto a JSON
                success: function(response) {
                    console.log('Materia editada con éxito:', response);
                    // Realizar alguna acción adicional si es necesario
                    selecMateria();
                    $('#modalBase').hide(); // Ocultar el modal
                },
                error: function(error) {
                    console.error('Error al editar la materia:', error);
                }
            });
        });
      
      
        //---------------------------------INSERT MATERIA-------------------------------------------------
        $('#selectMatAjax').on('click', '#insertMateria', function() {
        
          $('#contenidoModal').empty();
          var materiaHTML = 
                `
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
                    <div class="añadir">
                      <button id="agregarMateria" type="button" class="btn-modificar">Añadir nueva Materia</button>
                    </div>
                  </form>
                `;
              $('#contenidoModal').append(materiaHTML);
              $('#modalBase').show(); // Mostrar el modal
      
      });
      
      
      $('#contenidoModal').on('click', '#agregarMateria', function() {
          event.preventDefault(); // Evitar el envío del formulario por defecto
      
          // Serializar el formulario para obtener todos los valores de los inputs
          var formData = $('#crear').serialize();
      
          // Realizar la solicitud AJAX para agregar la nueva universidad
          $.ajax({
              url: baseUrl + 'crearMateria2',
              type: 'POST',
              data: formData,
              success: function(response) {
                  console.log('Materia agregada con éxito:', response);
                  // Realizar alguna acción adicional si es necesario
                  selecMateria();
                  $('#modalBase').hide(); // Ocultar el modal
              },
              error: function(error) {
                  console.error('Error al agregar la materia:', error);
              }
          });
      });
      
        //---------------------------------DELETE UNIVERCITY-------------------------------------------------
      $('#contenidoModal').on('click', '#eliminarMateria', function() {
        event.preventDefault(); // Evitar el envío del formulario por defecto
        var materiaData = $(this).closest('.botones').data('materia');
        console.log(materiaData);
      
                  // Realizar la solicitud AJAX para eliminar la universidad
                  $.ajax({
                      url: baseUrl + 'eliminarMateria2',
                      type: 'POST',
                      data: materiaData, // Serializar el objeto a JSON
                      success: function(response) {
                          console.log('Materia eliminada con éxito:', response);
                          // Realizar alguna acción adicional si es necesario
                          selecMateria();
                          $('#modalBase').hide(); // Ocultar el modal
                      },
                      error: function(error) {
                          console.error('Error al eliminar la Materia:', error);
                      }
                  });
      });
  //###################################################-MATERIA FILTRO-#########################################################

$('.carreraSelect').change(function() {
  var idCarrera = $(this).val();
  globalCarrData = idCarrera; // Asignar uniData a la variable global
  console.log("Hola"+globalCarrData);

  selecMateria()
});