<!--HEADER-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="<?php echo base_url(); ?>css/styleA.css" rel="stylesheet">
  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
  <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</head>
<!--HEADER-->
<!--BODY-->

<body>
  <!--MENÚ-->
  <div class="menu">
    <button class="toggle-btn" onclick="toggleMenu()">☰</button>
    <!-- NOMBRE EMPRESA -->
    <div class="nombreE">
      <img id="logo" src="<?php echo base_url('img/AnisSoft.png'); ?>">
    </div>
    <!-- Opciones de Navegación -->
    <nav class="opciones">
      <ul>
        <!-- List Items for Navigation Links -->
        <li><a href="#" onclick="mostrarSeccion('univInst')" class="active">Universidades</a></li>
        <li><a href="#" onclick="mostrarSeccion('carrera')">Carreras</a></li>
        <li><a href="#" onclick="mostrarSeccion('materia')">Materias</a></li>
        <li><a href="#" onclick="mostrarSeccion('temarioLibroVideo')">Temarios</a></li>
        <li><a href="#" onclick="mostrarSeccion('tema')">Temas</a></li>
        <li><a href="#" onclick="mostrarSeccion('preguntasExamenes')">Preguntas</a></li>
      </ul>
    </nav>
    <!-- Información de Usuario -->
    <div class="usuario">
      <?php if (session()->has('is_logged') && session('is_logged')) : ?>
        <img src="<?php echo session('img'); ?>" alt="Imagen de perfil">
        <div class="info-usuario">
          <div class="nombre-email">
            <span class="nombre"><?php echo session('nombre'); ?></span>
            <hr>
            <span class="email"><?php echo session('correo'); ?></span>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <!--MENÚ-->
  <!--CONTENIDO-->
  <main>
    <!--SECCIONES-->
    <!--MODAL BASE PARA UNIVERSIDADES CARRERAS Y MATERIAS,"se reutilizará el codigo para evitar tener un modal para cada uno"-->
    <div class="modal abrir" id="modalBase">
      <div class="contenido-modal">
        <div id="contenidoModal">
            <!--AQUI SE ALMACENARAN LOS DISTINTOS TIPOS DE MODALES-->
        </div>
      </div>
    </div>
    <!--MODAL BASE PARA TODOS-->

    <!--UNIVERSIDAD-->
    <section id="univInst" class="seccion">
      <h5 class="center">UNIVERSIDADES E INSTITUTOS</h5>
      <div class="card-container" id="selectUniAjax">   
      <!--En este div cargara las universidades por medio de ajax-->
      </div>
      <!--DIV PARA MODIFICAR Y ELIMINAR LA UNIVERSIDAD-->
      <div class="cambiar" title="Modificar" id="modificarU">
        <p>Modificar</p>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
          <path d="M256 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V192h64V32zm320 0c0-17.7-14.3-32-32-32s-32 14.3-32 32V480c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM224 512c17.7 0 32-14.3 32-32V320H192V480c0 17.7 14.3 32 32 32zM320 0c-9.3 0-18.1 4-24.2 11s-8.8 16.3-7.5 25.5l31.2 218.6L288.6 409.7c-3.5 17.3 7.8 34.2 25.1 37.7s34.2-7.8 37.7-25.1l.7-3.6c1.3 16.4 15.1 29.4 31.9 29.4c17.7 0 32-14.3 32-32c0 17.7 14.3 32 32 32s32-14.3 32-32V32c0-17.7-14.3-32-32-32H320zM112 80A48 48 0 1 0 16 80a48 48 0 1 0 96 0zm0 261.3V269.3l4.7 4.7c9 9 21.2 14.1 33.9 14.1H224c17.7 0 32-14.3 32-32s-14.3-32-32-32H157.3l-41.6-41.6c-14.3-14.3-33.8-22.4-54-22.4C27.6 160 0 187.6 0 221.6v55.7l0 .9V480c0 17.7 14.3 32 32 32s32-14.3 32-32V384l32 42.7V480c0 17.7 14.3 32 32 32s32-14.3 32-32V421.3c0-10.4-3.4-20.5-9.6-28.8L112 341.3z" />
        </svg>
      </div>
      <div class="botar" title="EliminarU" id="eliminarU">
        <p>Eliminar</p>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
          <path d="M256 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 9.8c0 39-23.7 74-59.9 88.4C71.6 154.5 32 213 32 278.2V352c0 17.7 14.3 32 32 32s32-14.3 32-32l0-73.8c0-10 1.6-19.8 4.5-29L261.1 497.4c9.6 14.8 29.4 19.1 44.3 9.5s19.1-29.4 9.5-44.3L222.6 320H224l80 0 38.4 51.2c10.6 14.1 30.7 17 44.8 6.4s17-30.7 6.4-44.8l-43.2-57.6C341.3 263.1 327.1 256 312 256l-71.5 0-56.8-80.2-.2-.3c44.7-29 72.5-79 72.5-133.6l0-9.8zM96 80A48 48 0 1 0 0 80a48 48 0 1 0 96 0zM464 286.1l58.6 53.9c4.8 4.4 11.9 5.5 17.8 2.6s9.5-9 9-15.5l-5.6-79.4 78.7-12.2c6.5-1 11.7-5.9 13.1-12.2s-1.1-13-6.5-16.7l-65.6-45.1L603 92.2c3.3-5.7 2.7-12.8-1.4-17.9s-10.9-7.2-17.2-5.3L508.3 92.1l-29.4-74C476.4 12 470.6 8 464 8s-12.4 4-14.9 10.1l-29.4 74L343.6 68.9c-6.3-1.9-13.1 .2-17.2 5.3s-4.6 12.2-1.4 17.9l39.5 69.1-65.6 45.1c-5.4 3.7-8 10.3-6.5 16.7c.1 .3 .1 .6 .2 .8l19.4 0c20.1 0 39.2 7.5 53.8 20.8l18.4 2.9L383 265.3l36.2 48.3c2.1 2.8 3.9 5.7 5.5 8.6L464 286.1z" />
        </svg>
      </div>
    </section>
    <!--UNIVERSIDAD-->
    <!--CARRERAS-->
    <section id="carrera" class="seccion">
    <h5 class="center">CARRERAS</h5>
      <!--CARRERAS_FILTRO_MATERIAS-->
      <div class="contenido">
      <div class="labelSelect">Seleccione Universidad</div>
      <div class="celda">
          <select  class="universidadSelect">
          <option value="1">Universidad:</option>
        </select>
      </div>
      </div>
      <!--CARRERAS_FILTRO_MATERIAS-->

      <div class="card-container" id="selectCarrAjax">   
        <!--AQUI SE MUESTRAN LAS CARRERAS-->
      </div>

      <!--DIV PARA MODIFICAR Y ELIMINAR LA UNIVERSIDAD-->
      <div class="cambiar" title="Modificar" id="modificarC">
        <p>Modificar</p>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
          <path d="M256 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V192h64V32zm320 0c0-17.7-14.3-32-32-32s-32 14.3-32 32V480c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM224 512c17.7 0 32-14.3 32-32V320H192V480c0 17.7 14.3 32 32 32zM320 0c-9.3 0-18.1 4-24.2 11s-8.8 16.3-7.5 25.5l31.2 218.6L288.6 409.7c-3.5 17.3 7.8 34.2 25.1 37.7s34.2-7.8 37.7-25.1l.7-3.6c1.3 16.4 15.1 29.4 31.9 29.4c17.7 0 32-14.3 32-32c0 17.7 14.3 32 32 32s32-14.3 32-32V32c0-17.7-14.3-32-32-32H320zM112 80A48 48 0 1 0 16 80a48 48 0 1 0 96 0zm0 261.3V269.3l4.7 4.7c9 9 21.2 14.1 33.9 14.1H224c17.7 0 32-14.3 32-32s-14.3-32-32-32H157.3l-41.6-41.6c-14.3-14.3-33.8-22.4-54-22.4C27.6 160 0 187.6 0 221.6v55.7l0 .9V480c0 17.7 14.3 32 32 32s32-14.3 32-32V384l32 42.7V480c0 17.7 14.3 32 32 32s32-14.3 32-32V421.3c0-10.4-3.4-20.5-9.6-28.8L112 341.3z" />
        </svg>
      </div>
      <div class="botar" title="Eliminar" id="eliminarC">
        <p>Eliminar</p>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
          <path d="M256 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 9.8c0 39-23.7 74-59.9 88.4C71.6 154.5 32 213 32 278.2V352c0 17.7 14.3 32 32 32s32-14.3 32-32l0-73.8c0-10 1.6-19.8 4.5-29L261.1 497.4c9.6 14.8 29.4 19.1 44.3 9.5s19.1-29.4 9.5-44.3L222.6 320H224l80 0 38.4 51.2c10.6 14.1 30.7 17 44.8 6.4s17-30.7 6.4-44.8l-43.2-57.6C341.3 263.1 327.1 256 312 256l-71.5 0-56.8-80.2-.2-.3c44.7-29 72.5-79 72.5-133.6l0-9.8zM96 80A48 48 0 1 0 0 80a48 48 0 1 0 96 0zM464 286.1l58.6 53.9c4.8 4.4 11.9 5.5 17.8 2.6s9.5-9 9-15.5l-5.6-79.4 78.7-12.2c6.5-1 11.7-5.9 13.1-12.2s-1.1-13-6.5-16.7l-65.6-45.1L603 92.2c3.3-5.7 2.7-12.8-1.4-17.9s-10.9-7.2-17.2-5.3L508.3 92.1l-29.4-74C476.4 12 470.6 8 464 8s-12.4 4-14.9 10.1l-29.4 74L343.6 68.9c-6.3-1.9-13.1 .2-17.2 5.3s-4.6 12.2-1.4 17.9l39.5 69.1-65.6 45.1c-5.4 3.7-8 10.3-6.5 16.7c.1 .3 .1 .6 .2 .8l19.4 0c20.1 0 39.2 7.5 53.8 20.8l18.4 2.9L383 265.3l36.2 48.3c2.1 2.8 3.9 5.7 5.5 8.6L464 286.1z" />
        </svg>
      </div>
    </section>
    <!--CARRERAS-->
    <!--MATERIAS-->
    <section id="materia" class="seccion">
      <h5 class="center">MATERIAS</h5>
        <!--CARRERAS_FILTRO_MATERIAS-->
        <div class="contenido">
        <div class="labelSelect">Seleccione Universidad</div>
        <div class="celda">
          <select  class="universidadSelect">
             <option value="1">Universidad:</option>
          </select>
        </div>
        <div class="labelSelect">Seleccione Carrera</div>
        <div class="celda">
          <select class="carreraSelect" name="carreraSelect">
            <option value="1">Carrera:</option>
          </select>
        </div>
        </div>
         <div class="card-container" id="selectMatAjax">   
        </div>

      <!--DIV PARA MODIFICAR Y ELIMINAR LA UNIVERSIDAD-->
      <div class="cambiar" title="Modificar" id="modificarM">
        <p>Modificar</p>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
          <path d="M256 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V192h64V32zm320 0c0-17.7-14.3-32-32-32s-32 14.3-32 32V480c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM224 512c17.7 0 32-14.3 32-32V320H192V480c0 17.7 14.3 32 32 32zM320 0c-9.3 0-18.1 4-24.2 11s-8.8 16.3-7.5 25.5l31.2 218.6L288.6 409.7c-3.5 17.3 7.8 34.2 25.1 37.7s34.2-7.8 37.7-25.1l.7-3.6c1.3 16.4 15.1 29.4 31.9 29.4c17.7 0 32-14.3 32-32c0 17.7 14.3 32 32 32s32-14.3 32-32V32c0-17.7-14.3-32-32-32H320zM112 80A48 48 0 1 0 16 80a48 48 0 1 0 96 0zm0 261.3V269.3l4.7 4.7c9 9 21.2 14.1 33.9 14.1H224c17.7 0 32-14.3 32-32s-14.3-32-32-32H157.3l-41.6-41.6c-14.3-14.3-33.8-22.4-54-22.4C27.6 160 0 187.6 0 221.6v55.7l0 .9V480c0 17.7 14.3 32 32 32s32-14.3 32-32V384l32 42.7V480c0 17.7 14.3 32 32 32s32-14.3 32-32V421.3c0-10.4-3.4-20.5-9.6-28.8L112 341.3z" />
        </svg>
      </div>
      <div class="botar" title="Eliminar" id="eliminarM">
        <p>Eliminar</p>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
          <path d="M256 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 9.8c0 39-23.7 74-59.9 88.4C71.6 154.5 32 213 32 278.2V352c0 17.7 14.3 32 32 32s32-14.3 32-32l0-73.8c0-10 1.6-19.8 4.5-29L261.1 497.4c9.6 14.8 29.4 19.1 44.3 9.5s19.1-29.4 9.5-44.3L222.6 320H224l80 0 38.4 51.2c10.6 14.1 30.7 17 44.8 6.4s17-30.7 6.4-44.8l-43.2-57.6C341.3 263.1 327.1 256 312 256l-71.5 0-56.8-80.2-.2-.3c44.7-29 72.5-79 72.5-133.6l0-9.8zM96 80A48 48 0 1 0 0 80a48 48 0 1 0 96 0zM464 286.1l58.6 53.9c4.8 4.4 11.9 5.5 17.8 2.6s9.5-9 9-15.5l-5.6-79.4 78.7-12.2c6.5-1 11.7-5.9 13.1-12.2s-1.1-13-6.5-16.7l-65.6-45.1L603 92.2c3.3-5.7 2.7-12.8-1.4-17.9s-10.9-7.2-17.2-5.3L508.3 92.1l-29.4-74C476.4 12 470.6 8 464 8s-12.4 4-14.9 10.1l-29.4 74L343.6 68.9c-6.3-1.9-13.1 .2-17.2 5.3s-4.6 12.2-1.4 17.9l39.5 69.1-65.6 45.1c-5.4 3.7-8 10.3-6.5 16.7c.1 .3 .1 .6 .2 .8l19.4 0c20.1 0 39.2 7.5 53.8 20.8l18.4 2.9L383 265.3l36.2 48.3c2.1 2.8 3.9 5.7 5.5 8.6L464 286.1z" />
        </svg>
      </div>
    </section>
    <!--MATERIAS-->
    <!--TEMARIOS, LIBROS, VIDEOS-->
    <section id="temarioLibroVideo" class="seccion">
      <h5 class="center">TEMARIOS</h5>
      <div class="contenido">
        <div class="labelSelect">Seleccione materia</div>
        <div class="celda">
          <select name="idM">
            <?php foreach ($materias as $materia) : ?>
              <?php
              $selected = $materia['idMateria'] ? 'selected' : '';
              ?>
              <option value="<?php echo $materia['idMateria']; ?>" <?php echo $selected; ?>>
                <?php echo $materia['nombreMateria']; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="contTable">
        <table id="miTabla">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Contenido</th>
              <th>Libro</th>
              <th>Video</th>
            </tr>
          </thead>
          <tbody contenteditable="true">
          </tbody>
        </table>
      </div>
      <div class="botonT">
        <button class="enviarT">
          Guardar datos
        </button>
      </div>
    </section>
    <!--TEMARIOS, LIBROS, VIDEOS-->
    <!--PREGUNTAS Y EXAMENES-->
    <section id="preguntasExamenes" class="seccion">
      <h5 class="center">PREGUNTAS</h5>
      <div class="card-container">
      </div>
    </section>
    <!--PREGUNTAS Y EXAMENES-->


    
  </main>
  <!--contenido-->
  <script src="<?php echo base_url(); ?>js/scriptA.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!--VARIABLE GLOBAL PARA PODER USARLO EN LOS JS-->
  <script> var baseUrl = "<?php echo base_url(); ?>";</script>
  <script src="<?php echo base_url(); ?>js/crud_adm/OtrasFunciones.js"></script>
  <script src="<?php echo base_url();?>js/crud_adm/universidad.js"></script>
  <script src="<?php echo base_url();?>js/crud_adm/carrera.js"></script>
  <script src="<?php echo base_url();?>js/crud_adm/materia.js"></script>

  <script>
    $(document).ready(function() {
      $('.abrirModal').click(function() {
        var modalId = $(this).data('target');
        $('#' + modalId).fadeIn();
      });
      $('.cerrar').click(function() {
        $(this).closest('.modal').fadeOut();
      });
    });
    document.addEventListener('DOMContentLoaded', function() {
      // Al cargar la página, ocultar todas las secciones excepto la primera activa
      $(".seccion").hide();
      $('#univInst').show();
      selecUniversidad();
    });

    function mostrarSeccion(seccion) {
      // Ocultar todas las secciones
      $(".seccion").hide();

      // Quitar la clase 'active' de todos los enlaces
      $("a").removeClass("active");

      // Mostrar la sección correspondiente
      $("#" + seccion).show();

      // Agregar la clase 'active' al enlace seleccionado
      $("a[href='#'][onclick*='" + seccion + "']").addClass("active");

      // Mostrar u ocultar los elementos 'cambiar' y 'botar' según la sección
      if (seccion === 'univInst' || seccion === 'carrera' || seccion === 'materia') {
        $(".cambiar, .botar").show(); // Mostrar en Universidades, Carreras y Materias
      } else {
        $(".cambiar, .botar").hide(); // Ocultar en Temarios y Preguntas
      }
    }

    document.addEventListener("DOMContentLoaded", () => {
      const cards = document.querySelectorAll(".card");
      const dropZone = document.querySelector(".botar");
      const id = cards.id;
      const urlP = cards.data;
      let draggedCard = null;
      cards.forEach(card => {
        card.addEventListener("dragstart", event => {
          draggedCard = card;
          const id = card.getAttribute('id');
          const urlP = card.getAttribute('data');

          draggedCard.dataset.draggedId = id;
          draggedCard.dataset.urlP = urlP;

          card.classList.add("dragging");
        });
      });
      dropZone.addEventListener("dragover", event => {
        event.preventDefault(); // Evita el comportamiento por defecto
      });
      dropZone.addEventListener("drop", event => {
        event.preventDefault();
        if (draggedCard) {
          const id = draggedCard.dataset.draggedId;
          const urlP = draggedCard.dataset.urlP;
          const eliminarModal = document.getElementById("eliminar");
          eliminarModal.style.display = "block";
          const eliminarBtn = document.querySelector(".btn-eliminar");
          eliminarBtn.addEventListener("click", function(event) {
            event.preventDefault();
            eliminarModal.style.display = "none";
            var temaData = {
              id: id,
            };
            console.log('Datos a enviar:', temaData);
            $.ajax({
              type: 'POST',
              url: urlP,
              data: temaData,
              success: function(response) {
                window.location.reload();
              }
            });
          });
          const cerrarBtn = document.querySelector(".cerrar");
          cerrarBtn.addEventListener("click", function() {
            eliminarModal.style.display = "none";
          });
        }
      });
      // Evento al finalizar el arrastre
      document.addEventListener("dragend", () => {
        cards.forEach(card => card.classList.remove("dragging"));
        draggedCard = null;
      });
    });

    /*Generar tabla*/
    var tbody = document.querySelector('#miTabla tbody');
    var valoresPorFila = [];
    var numRows = 8;
    var numCellsPerRow = 4;
    for (var i = 0; i < numRows; i++) {
      var row = document.createElement('tr');
      var valoresFilaActual = [];

      for (var j = 0; j < numCellsPerRow; j++) {
        var cellNumber = i * numCellsPerRow + j + 1;
        var cell = document.createElement('td');
        row.appendChild(cell);
        valoresFilaActual.push(cellNumber);
      }
      tbody.appendChild(row);
      valoresPorFila.push(valoresFilaActual);
    }

    /*Datos excel*/
    function mostrarValoresPorFila() {
      var resume_table = document.getElementById("miTabla");
      var filas = resume_table.rows;
      var arregloFilas = [];
      var selectElement = document.getElementsByName("idM")[0];
      var valorSeleccionado = selectElement.value;

      for (var i = 0; i < filas.length; i++) {
        var fila = filas[i];
        var arregloCeldas = [];
        var todasCeldasEnBlanco = true;
        for (var j = 0; j < fila.cells.length; j++) {
          var celda = fila.cells[j];
          var textoCelda = celda.innerText.trim();
          if (textoCelda !== "") {
            todasCeldasEnBlanco = false;
          }
          arregloCeldas.push(textoCelda);
        }
        if (!todasCeldasEnBlanco) {
          arregloFilas.push(arregloCeldas);
        }
      }
      /*manda a la base de datos */
      for (var k = 1; k < arregloFilas.length; k++) {
        var filaActual = arregloFilas[k];
        if (filaActual.length > 0) {
          
          var temaData = {
            nombreTemario: filaActual[0],
            contenidoTemario: filaActual[1],
            libroTemario: filaActual[2],
            videoTemario: filaActual[3],
            idMateria: valorSeleccionado
          };

          console.log('Datos a enviar:', temaData);

          $.ajax({
            type: 'POST',
            url: '<?php echo base_url("crearTemario"); ?>',
            data: temaData,
            success: function(response) {
              window.location.reload();
            }
          });
        }
      }
    }

    // Evento click del botón "Guardar datos"
    document.querySelector('.enviarT').addEventListener('click', mostrarValoresPorFila);
  </script>


</body>

</html>