<!--HEADER-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">

</head>
<!--HEADER-->
<!--BODY-->

<body>
  <div class="menuA">
    <ion-icon name="menu-outline"></ion-icon>
    <ion-icon name="close-circle-outline"></ion-icon>
  </div>
  <!--MENÚ-->
  <div class="menu">
    <!--NOMBRE EMPRESA-->
    <!--1ra seccion-->
    <div>
      <div class="nombreE">
        <img id="logo" src="<?php echo base_url('img/AnisSoft.png'); ?>">
        <span>ANISSOFT</span>
      </div>
    </div>
    <!--1ra seccion-->
    <!--2da seccion-->
    <nav class="opciones">
      <ul>
        <li>
          <a class="active" id="btn" type="button" onclick="mostrarSeccion('univInst')" title="Universidades o Institutos">
            <ion-icon name="school-outline"></ion-icon>
            <span>Universidades</span>
          </a>
        </li>
        <li>
          <a id="btn" type="button" onclick="mostrarSeccion('carrera')" title="Carreras">
            <ion-icon name="briefcase-outline"></ion-icon>
            <span>Carreras</span>
          </a>
        </li>
        <li>
          <a type="button" onclick="mostrarSeccion('materia')" title="Materias">
            <ion-icon name="document-text-outline"></ion-icon>
            <span>Materias</span>
          </a>
        </li>
        <li>
          <a type="button" onclick="mostrarSeccion('libro')" title="Libros">
            <ion-icon name="book-outline"></ion-icon>
            <span>Libros</span>
          </a>
        </li>
        <li>
          <a type="button" onclick="mostrarSeccion('temarioPregunta')" title="Temarios, Preguntas">
            <ion-icon name="document-attach-outline"></ion-icon>
            <span>Temarios</span>
          </a>
        </li>
        <li class="nav-item">
          <a type="button" onclick="mostrarSeccion('video')" title="Videos">
            <ion-icon name="videocam-outline"></ion-icon>
            <span>Videos</span>
          </a>
        </li>
      </ul>
    </nav>
    <!--2da seccion-->
    <!--3ra seccion-->
    <div>
      <div class="linea"></div>
      <div class="modo-otoño">
        <button id="otoño" title="Otoño" onclick="cambiarTexto()">
          <ion-icon name="leaf-outline"></ion-icon>
          <span id="TextoC">Otoño</span>
        </button>
      </div>
      <div class="usuario">
        <img src="<?php $imgUsuario; ?>">
        <div class="info-usuario">
          <div class="nombre-email">
            <span class="nombre"><?php $nombre; ?></span>
            <span class="email"><?php $correo; ?></span>
          </div>
          <ion-icon name="ellipsis-vertical-outline"></ion-icon>
        </div>
      </div>
    </div>
    <!--3ra seccion-->
  </div>
  <!--MENÚ-->
  <!--CONTENIDO-->
  <main>
    <!--MODAL BASE PARA TODOS-->
    <div class="modal" id="modalBase">
      <div class="contenido-modal">
        <div class="head">
          <h3>Añadir Universidad/instituto</h3>
          <button class="cerrar">
            <ion-icon name="close-circle-outline"></ion-icon>
          </button>
        </div>
        <div id="contenidoModal">
        </div>
      </div>
    </div>
      <!--MODAL BASE PARA TODOS-->

    <!--UNIVERSIDAD-->
    <section id="univInst" class="seccion">
      <h2 class="center">UNIVERSIDADES E INSTITUTOS</h2>
        <div class="card-container" id="selectUniAjax">   
        </div>
    </section>
    
    <!--CARRERAS-->
    <section id="carrera" class="seccion">
      <h2 class="center">CARRERAS</h2>
        <div class="card-container" id="selectCarrAjax">   
        </div>
    </section>
   
    <!--MATERIAS-->
    <section id="materia" class="seccion">
      <h2 class="center">MATERIAS</h2>
        <div class="card-container" id="selectMatAjax">   
        </div>
    </section>

    <!--LIBROS-->
    <section id="libro" class="seccion">

    </section>   

    <div id="modificar" class="cambiar" title="Modificar">
      <h4>Modificar</h4>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
        <path d="M256 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V192h64V32zm320 0c0-17.7-14.3-32-32-32s-32 14.3-32 32V480c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM224 512c17.7 0 32-14.3 32-32V320H192V480c0 17.7 14.3 32 32 32zM320 0c-9.3 0-18.1 4-24.2 11s-8.8 16.3-7.5 25.5l31.2 218.6L288.6 409.7c-3.5 17.3 7.8 34.2 25.1 37.7s34.2-7.8 37.7-25.1l.7-3.6c1.3 16.4 15.1 29.4 31.9 29.4c17.7 0 32-14.3 32-32c0 17.7 14.3 32 32 32s32-14.3 32-32V32c0-17.7-14.3-32-32-32H320zM112 80A48 48 0 1 0 16 80a48 48 0 1 0 96 0zm0 261.3V269.3l4.7 4.7c9 9 21.2 14.1 33.9 14.1H224c17.7 0 32-14.3 32-32s-14.3-32-32-32H157.3l-41.6-41.6c-14.3-14.3-33.8-22.4-54-22.4C27.6 160 0 187.6 0 221.6v55.7l0 .9V480c0 17.7 14.3 32 32 32s32-14.3 32-32V384l32 42.7V480c0 17.7 14.3 32 32 32s32-14.3 32-32V421.3c0-10.4-3.4-20.5-9.6-28.8L112 341.3z" />
      </svg>
    </div>

    <div id="eliminar" class="botar" title="Eliminar">
      <h4>Eliminar</h4>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
        <path d="M256 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 9.8c0 39-23.7 74-59.9 88.4C71.6 154.5 32 213 32 278.2V352c0 17.7 14.3 32 32 32s32-14.3 32-32l0-73.8c0-10 1.6-19.8 4.5-29L261.1 497.4c9.6 14.8 29.4 19.1 44.3 9.5s19.1-29.4 9.5-44.3L222.6 320H224l80 0 38.4 51.2c10.6 14.1 30.7 17 44.8 6.4s17-30.7 6.4-44.8l-43.2-57.6C341.3 263.1 327.1 256 312 256l-71.5 0-56.8-80.2-.2-.3c44.7-29 72.5-79 72.5-133.6l0-9.8zM96 80A48 48 0 1 0 0 80a48 48 0 1 0 96 0zM464 286.1l58.6 53.9c4.8 4.4 11.9 5.5 17.8 2.6s9.5-9 9-15.5l-5.6-79.4 78.7-12.2c6.5-1 11.7-5.9 13.1-12.2s-1.1-13-6.5-16.7l-65.6-45.1L603 92.2c3.3-5.7 2.7-12.8-1.4-17.9s-10.9-7.2-17.2-5.3L508.3 92.1l-29.4-74C476.4 12 470.6 8 464 8s-12.4 4-14.9 10.1l-29.4 74L343.6 68.9c-6.3-1.9-13.1 .2-17.2 5.3s-4.6 12.2-1.4 17.9l39.5 69.1-65.6 45.1c-5.4 3.7-8 10.3-6.5 16.7c.1 .3 .1 .6 .2 .8l19.4 0c20.1 0 39.2 7.5 53.8 20.8l18.4 2.9L383 265.3l36.2 48.3c2.1 2.8 3.9 5.7 5.5 8.6L464 286.1z" />
      </svg>
    </div>

  </main>
  <!--contenido-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
  <script src="<?php echo base_url(); ?>js/script.js"></script>
  <script src="<?php echo base_url(); ?>js/base.js"></script>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <!--<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>-->

  <script>

//#################################-AREA DE NAVEGACION DEL USUARIO-#############################################  
    //SECCION POR DEFECTO
      document.addEventListener('DOMContentLoaded', function() {
        $(".seccion").hide();
        $('#univInst').show();
        selecUniversidad();
      });

      //SECCIONES DONDE SE MOSTRARA EL CODIGO DEPENDIENDO AL USO
      function mostrarSeccion(seccion) {
        $(".seccion").hide();
        $("a").removeClass("active");
        $("#" + seccion).show();
        $("a[onclick=\"mostrarSeccion('" + seccion + "')\"]").addClass("active");

        // Agregar contenido HTML a la sección universidad 
        if (seccion === 'univInst') {    
          selecUniversidad();
        }
        // Agregar contenido HTML a la sección carrera
        if (seccion === 'carrera') {
          selecCarrera();
        }
        // Agregar contenido HTML a la sección materia
        if (seccion === 'materia') {
          selecMateria();
        }
      }


//#######################################-UNIVERSIDAD-###################################################  
    //---------------------------------SELECT UNIVERCITY-------------------------------------------------
  function selecUniversidad() {
    $('#selectUniAjax').empty();//BORRA TODO EL CONTENEDOR 
    $.ajax({
      type: 'GET',
      url: '<?php echo base_url('univercidadAjax'); ?>',
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
          url: '<?php echo base_url('editarUni2'); ?>',
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
        url: '<?php echo base_url('crearUni2'); ?>',
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
                url: '<?php echo base_url('eliminarUni2'); ?>',
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


//###################################################-CARRERA-#########################################################  
    //---------------------------------SELECT CARRERA-------------------------------------------------
function selecCarrera() {
    $('#selectCarrAjax').empty();//BORRA TODO EL CONTENEDOR 
    $.ajax({
      type: 'GET',
      url: '<?php echo base_url('carreraAjax');?>',
      dataType: 'json',
      success: function(response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function(index, carrera) {
        //crear un objeto para pasarlo por data-universidad la cual será utilizada mas adelante.
        var carreraData = {
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
      $('#modificar').on('dragover', function(event) {
        event.preventDefault();
      });
      $('#modificar').on('drop', function(event) {
        event.preventDefault();
  
        var idCarrera = event.originalEvent.dataTransfer.getData('text/plain');

        // Obtener el objeto de datos de la universidad asociado a la tarjeta con el id almacenado en idUniversidad
        var carreraData = $('#' + idCarrera).data('carrera');

        $('#contenidoModal').empty();

        //--ESCRIBIR MODAL :D
        var contenidoModal = 
            `
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
          $('#modalBase').show(); // Mostrar el modal

      });
      //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--AQUI SE REALIZA EL EVENTO A LA HORA DE ARRASTRAR A ELIMINAR--!!!!!!!!!!!!!!!!!!!!!!!!
      $('#eliminar').on('dragover', function(event) {
        event.preventDefault();
      });

      $('#eliminar').on('drop', function(event) {
        event.preventDefault();
        var idCarrera = event.originalEvent.dataTransfer.getData('text/plain');

        // Obtener el objeto de datos de la carrera asociado a la tarjeta con el id almacenado en idCarrera
        var carreraData = $('#' + idCarrera).data('carrera');

        $('#contenidoModal').empty();

        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--ESCRIBIR MODAL :D--!!!!!!!!!!!!!!!!!!!!!!!!
        var contenidoModal = 
            `
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
          $('#modalBase').show(); // Mostrar el modal

      });
    },
    error: function(xhr, status, error) {
      console.error('Error al cargar las carreras:', error);
    }   
     
  });
}



//OTRAS FUNCIONES NECESARIAS 

// Asociar eventos de arrastrar y soltar fuera de las funciones esto con el fin de que funcione para todos tanto para carreras, como para materias , y univercidades.
$(document).ready(function() {
    // Evento para arrastrar
    $('.draggable').on('dragstart', function(event) {
        var idElemento = $(this).attr('id');
        event.originalEvent.dataTransfer.setData('text/plain', idElemento);
    });

    // Evento para soltar en el contenedor de modificar
    $('#modificar').on('dragover', function(event) {
        event.preventDefault();
    });

    $('#modificar').on('drop', function(event) {
        event.preventDefault();
        var idElemento = event.originalEvent.dataTransfer.getData('text/plain');
        var tipoElemento = obtenerTipoElemento(idElemento);

        // Lógica para manejar el evento de soltar según el tipo de elemento
        if (tipoElemento === 'universidad') {
           console.log("soy universidad");
        } else if (tipoElemento === 'carrera') {
          console.log("soy carrera");
        }
    });
});

  </script>



</body>

</html>