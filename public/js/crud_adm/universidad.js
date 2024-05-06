
//#######################################-UNIVERSIDAD-###################################################  
    //---------------------------------SELECT UNIVERCITY-------------------------------------------------
    function selecUniversidad() {
        $('#selectUniAjax').empty();//BORRA TODO EL CONTENEDOR 
        $('.universidadSelect').empty();//BORRA TODO EL CONTENEDOR 
        $.ajax({
          type: 'GET',
          url: baseUrl + 'univercidadAjax',
          dataType: 'json',
          success: function(response) {
          // Iterar sobre cada universidad y agregarlo al contenedor
          $.each(response, function(index, unis) {
            //crear un objeto para pasarlo por data-universidad la cual será utilizada mas adelante.
            var universidadData = {
            idU: unis.idU,
            nombreU: unis.nombreU,
            descripcionU: unis.descripcionU,
            imagenU: unis.imagenU
            };
            var universidadHTML = 
              `
              <div class="card draggable" id="universidad-${unis.idU}" draggable="true" data-universidad='${JSON.stringify(universidadData)}'>
                <img src="${unis.imagenU}" alt="By AnisSoft" title="${unis.nombreU}" draggable="false" />
                <div class="card-body">
                  <h3 class="card-title">${unis.nombreU}</h3>
                </div>
              </div>
              `;
            $('#selectUniAjax').append(universidadHTML);

            //llenar el filtro
            var filtroUniversidad =               
            ` <option value="${unis.idU}">${unis.nombreU}</option>`;
            $('.universidadSelect').append(filtroUniversidad);
          });

            
          //agregar el boton de crear universidad 
          // Después de agregar las tarjetas de universidad, agregar el botón al contenedor Esto para evitar que el boton se repita
          $('#selectUniAjax').append(`
            <button id="insertUni" class="abrirModal" type="button" data-target="modalBase">
              <ion-icon name="add-circle-outline"></ion-icon>
            </button>  
          `);
    
          // Agregar funcionalidad de arrastrar y soltar
          $('.draggable').on('dragstart', function(event) {
            var idUniversidad = $(this).attr('id');
            event.originalEvent.dataTransfer.setData('text/plain', idUniversidad);
          });
          //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--AQUI SE REALIZA EL EVENTO A LA HORA DE ARRASTRAR A MODIFICAR--!!!!!!!!!!!!!!!!!!!!!!!!
          $('#modificar').on('dragover', function(event) {
            event.preventDefault();
          });
          $('#modificar').on('drop', function(event) {
            event.preventDefault();
      
            var idUniversidad = event.originalEvent.dataTransfer.getData('text/plain');
    
            // Obtener el objeto de datos de la universidad asociado a la tarjeta con el id almacenado en idUniversidad
            var universidadData = $('#' + idUniversidad).data('universidad');
    
            $('#contenidoModal').empty();
    
            //--ESCRIBIR MODAL :D
            var contenidoModal = 
                `
                <form id="modificar" data-universidad='${JSON.stringify(universidadData)}'>
                  <div class="celda">
                    <label class="form-label">Nombre de la universidad/instituto</label>
                    <input name="idU" id="idU" type="hidden" class="form-control" placeholder="Nombre de la universidad/instituto" value="${universidadData.idU}">
                    <input name="nombreU" id="nombreU" type="text" class="form-control" placeholder="Nombre de la universidad/instituto" value="${universidadData.nombreU}">
                  </div>
                  <div class="celda">
                    <label class="form-label">Descripción de la universidad/instituto</label>
                    <textarea class="form-control" rows="3" name="descripcionU" id="descripcionU" placeholder="Descripción de la universidad/instituto">${universidadData.descripcionU}</textarea>
                  </div>
                  <div class="celda">
                    <label class="form-label">Imagen de la universidad/instituto</label>
                    <textarea class="form-control" rows="3" name="imagenU" id="imagenU" placeholder="Imagen de la universidad/instituto">${universidadData.imagenU}</textarea>
                  </div>
                  <div class="añadir">
                    <button id="editarUni" type="button" class="btn-modificar">Modificar</button>
                  </div>
                </form>
                `;
              $('#contenidoModal').append(contenidoModal);
              $('#modalBase').show(); // Mostrar el modal
    
          });
          //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--AQUI SE REALIZA EL EVENTO A LA HORA DE ARRASTRAR A ELIMINAR--!!!!!!!!!!!!!!!!!!!!!!!!
          $('#eliminar').on('dragover', function(event) {
            event.preventDefault();
          });
    
          $('#eliminar').on('drop', function(event) {
            event.preventDefault();
            var idUniversidad = event.originalEvent.dataTransfer.getData('text/plain');
    
            // Obtener el objeto de datos de la universidad asociado a la tarjeta con el id almacenado en idUniversidad
            var universidadData = $('#' + idUniversidad).data('universidad');
    
            $('#contenidoModal').empty();
    
            //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--ESCRIBIR MODAL :D--!!!!!!!!!!!!!!!!!!!!!!!!
            var contenidoModal = 
                `
                <form id="eliminar">
                    <div class="celda">
                        <label class="form-label">¿Está seguro que desea eliminar ${universidadData.nombreU}?</label>
                    </div>
                    <div class="botones" data-universidad='${JSON.stringify(universidadData)}'>
                        <input type="hidden" name="idUniversidad2" value="1">
                        <input type="hidden" name="idUniversidad" value="${idUniversidad}">
                        <img src="${universidadData.imagenU}" alt="By AnisSoft" style="width: 100px; height: auto; display: block; margin: 0 auto;" />
                        <button id="eliminarUniversidad" type="button" class="btn-eliminar">Eliminar</button>
                    </div>
                </form>
                `;
              $('#contenidoModal').append(contenidoModal);
              $('#modalBase').show(); // Mostrar el modal
    
          });
        },
        error: function(xhr, status, error) {
          console.error('Error al cargar las universidades:', error);
        }   
         
      });
    }
    
      //---------------------------------UPDATE UNIVERCITY-------------------------------------------------
      $('#contenidoModal').on('click', '#editarUni', function() {
          event.preventDefault(); // Evitar el envío del formulario por defecto
    
          // Serializar todos los campos del formulario en un arreglo de objetos
          var formDataArray = $('#modificar').serializeArray();
    
          // Convertir el arreglo en un objeto JavaScript
          var universidadData = {};
          formDataArray.forEach(function(item) {
              universidadData[item.name] = item.value;
          });
    
          console.log(universidadData);
    
          // Realizar la solicitud AJAX para editar la universidad
          $.ajax({
              url: baseUrl + 'editarUni2',
              type: 'POST',
              data: universidadData, // Serializar el objeto a JSON
              success: function(response) {
                  console.log('Universidad editada con éxito:', response);
                  // Realizar alguna acción adicional si es necesario
                  selecUniversidad();
                  $('#modalBase').hide(); // Ocultar el modal
              },
              error: function(error) {
                  console.error('Error al editar la universidad:', error);
              }
          });
      });
    
    
      //---------------------------------INSERT UNIVERCITY-------------------------------------------------
      $('#selectUniAjax').on('click', '#insertUni', function() {
      
        $('#contenidoModal').empty();
        var universidadHTML = 
              `
                <form  id="crear">
                  <div class="celda">
                    <label class="form-label">Nombre de la universidad/instituto</label>
                    <input name="nombreU" id="nombreU" type="text" class="form-control" placeholder="Nombre de la universidad/instituto">
                  </div>
                  <div class="celda">
                    <label class="form-label">Descripción de la universidad/instituto</label>
                    <textarea class="form-control" rows="3" name="descripcionU" id="descripcionU" placeholder="Descripción de la universidad/instituto"></textarea>
                  </div>
                  <div class="celda">
                    <label class="form-label">Imagen de la universidad/instituto</label>
                    <textarea class="form-control" rows="3" name="imagenU" id="imagenU" placeholder="Imagen de la universidad/instituto"></textarea>
                  </div>
                  <div class="añadir">
                    <button id="agregarUni" type="button" class="btn-modificar">Añadir nueva</button>
                  </div>
                </form>
              `;
            $('#contenidoModal').append(universidadHTML);
            $('#modalBase').show(); // Mostrar el modal
    
    });
    
    
    $('#contenidoModal').on('click', '#agregarUni', function() {
        event.preventDefault(); // Evitar el envío del formulario por defecto
    
        // Serializar el formulario para obtener todos los valores de los inputs
        var formData = $('#crear').serialize();
    
        // Realizar la solicitud AJAX para agregar la nueva universidad
        $.ajax({
            url: baseUrl + 'crearUni2',
            type: 'POST',
            data: formData,
            success: function(response) {
                console.log('Universidad agregada con éxito:', response);
                // Realizar alguna acción adicional si es necesario
                selecUniversidad();
                $('#modalBase').hide(); // Ocultar el modal
            },
            error: function(error) {
                console.error('Error al agregar la universidad:', error);
            }
        });
    });
    
      //---------------------------------DELETE UNIVERCITY-------------------------------------------------
    $('#contenidoModal').on('click', '#eliminarUniversidad', function() {
      event.preventDefault(); // Evitar el envío del formulario por defecto
      var universidadData = $(this).closest('.botones').data('universidad');
      console.log(universidadData);
    
                // Realizar la solicitud AJAX para eliminar la universidad
                $.ajax({
                    url: baseUrl + 'eliminarUni2',
                    type: 'POST',
                    data: universidadData, // Serializar el objeto a JSON
                    success: function(response) {
                        console.log('Universidad eliminada con éxito:', response);
                        // Realizar alguna acción adicional si es necesario
                        selecUniversidad();
                        $('#modalBase').hide(); // Ocultar el modal
                    },
                    error: function(error) {
                        console.error('Error al eliminar la universidad:', error);
                    }
                });
    });



