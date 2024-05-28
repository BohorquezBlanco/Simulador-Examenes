<!--HEADER-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SimuladorNS</title>
  <link href="<?php echo base_url(); ?>css/styleA.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>css/samuel.css" rel="stylesheet">
  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</head>
<!--HEADER-->
<!--BODY-->

<body>

  <!--MENÚ-->
  <button class="toggle-btn" onclick="toggleMenu()">☰</button>
  <div class="menu-responsive">
    <ul>
      <a onclick="mostrarSeccion('univInst'); ocultarMenuR();" class="active">Universidades</a>
      <a onclick="mostrarSeccion('carrera'); ocultarMenuR();">Carreras</a>
      <a onclick="mostrarSeccion('materia'); ocultarMenuR();">Materias</a>
      <a onclick="mostrarSeccion('temarioLibroVideo'); ocultarMenuR();">Temarios</a>
      <a onclick="mostrarSeccion('temas'); ocultarMenuR();">Temas</a>
      <a onclick="mostrarSeccion('preguntasExamenes'); ocultarMenuR();">Preguntas</a>
      <a onclick="mostrarSeccion('usuario'); ocultarMenuR();">Usuario</a>
      <a href="<?php echo base_url(); ?>/logout" onclick="ocultarMenuR();">Cerrar sesión</a>
    </ul>
  </div>
  <div class="menu">
    <!-- NOMBRE EMPRESA -->
    <div class="nombreE">
      <img id="logo" src="<?php echo base_url('img/AnisSoft.png'); ?>">
    </div>
    <!-- Opciones de Navegación -->
    <nav class="opciones">
      <ul>
        <!-- List Items for Navigation Links -->
        <li><a onclick="mostrarSeccion('univInst')" class="active">Universidades</a></li>
        <li><a onclick="mostrarSeccion('carrera')">Carreras</a></li>
        <li><a onclick="mostrarSeccion('materia')">Materias</a></li>
        <li><a onclick="mostrarSeccion('temarioLibroVideo')">Temarios</a></li>
        <li><a onclick="mostrarSeccion('temas')">Temas</a></li>
        <li><a onclick="mostrarSeccion('preguntasExamenes')">Preguntas</a></li>
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
          <div class="acciones-usuario">
            <button onclick="mostrarOpciones()" class="boton-usuario"><ion-icon name="caret-down-circle-outline"></ion-icon></button>
            <div id="opcionesUsuario" class="desplegable">
              <a onclick="mostrarSeccion('usuario'); ocultarMenu();">Editar usuario</a>
              <a href="<?php echo base_url(); ?>/logout" onclick="ocultarMenu();">Cerrar sesión</a>
            </div>
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
          <!--AQUI SE ALMACENARAN LOS DITISNTOS TIPOS DE MODALES-->
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
      <div class="contSelect">
        <div class="filter-container">
          <div class="labelSelect">Universidad</div>
          <button class="filterButton"><i class="fa-solid fa-filter"></i></button>
        </div>
        <div id="filterOptions" class="filter-options">
          <select class="universidadSelect" multiple>
            <option value="1"></option>
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
      <div class="contSelect2">
        <div class="contSelect">
          <div class="filter-container">
            <div class="labelSelect">Universidad</div>
            <button class="filterButton"><i class="fa-solid fa-filter"></i></button>
          </div>
          <div id="filterOptions" class="filter-options">
            <select class="universidadSelect" name="universidadSelect" multiple>
              <option value="1"></option>
            </select>
          </div>
        </div>

        <div class="contSelect">
          <div class="filter-container">
            <div class="labelSelect">Carrera</div>
            <button class="filterButton"><i class="fa-solid fa-filter"></i></button>
          </div>
          <div id="filterOptions" class="filter-options">
            <select class="carreraSelect" name="carreraSelect" multiple>
              <option value="1"></option>
            </select>

          </div>
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
      <!--btn filtros-->


      <div class="contSelect2">
        <div class="contSelect">
          <div class="filter-container">
            <div class="labelSelect">Universidad</div>
            <button class="filterButton"><i class="fa-solid fa-filter"></i></button>
          </div>
          <div id="filterOptions" class="filter-options">
            <select class="universidadSelect" name="universidadSelect" multiple>
              <option value="1"></option>
            </select>
          </div>
        </div>

        <div class="contSelect">
          <div class="filter-container">
            <div class="labelSelect">Carrera</div>
            <button class="filterButton"><i class="fa-solid fa-filter"></i></button>
          </div>
          <div id="filterOptions" class="filter-options">
            <select class="carreraSelect" name="carreraSelect" multiple>
              <option value="1"></option>
            </select>

          </div>
        </div>

        <div class="contSelect">
          <div class="filter-container">
            <div class="labelSelect">Materia</div>
            <button class="filterButton"><i class="fa-solid fa-filter"></i></button>
          </div>
          <div id="filterOptions" class="filter-options">
            <select class="materiaSelect" name="materiaSelect" multiple>
              <option value="1"></option>
            </select>

          </div>
        </div>
      </div>

      <div class="botonT">
        <button class="enviarT" id="crearTemario">
          Agregar temario
        </button>
      </div>
      <br>
      <div id="divModificarTemario">
      </div>
      <br>
      <br>
      <!-------TABLAS DONDE CARGAN LOS TEMARIOS EXISTENTES ----------->
      <div class="contTable">
        <table>
          <thead>
            <tr>
              <th>Temario</th>
              <th>Contenido</th>
              <th>Libro</th>
              <th>Materia</th>
              <th>M</th>
              <th>E</th>
            </tr>
          </thead>
          <tbody id="temarioMateria">
            <!-- Agregar temarios existentes de la materia -->

          </tbody>
        </table>
      </div>
    </section>
    <!--TEMARIOS, LIBROS, VIDEOS-->

<!--TEMAS-->
<section id="temas" class="seccion">
  <h5 class="center">TEMAS-TEMARIO</h5> 
  <!--Aqui estan los botones para el manejo de temas-->
  <div class="row">
    <div class="columna center">
      <button class="enviarT btn btn-primary" id="btnFiltrarTema">FILTRO DE TEMAS</button>
    </div>
    <div class="columna center">
      <button class="enviarT btn btn-primary" type="button" id="btnFiltrarArea">FILTRO POR AREAS</button>
    </div>
    <div class="columna center">
      <button class="enviarT btn btn-primary" type="button" id="btnAgregarTemaTemario">AGREGAR TEMAS A UN TEMARIO</button>
    </div>
    <div class="columna center">
      <button class="enviarT btn btn-primary" type="button" id="btnAgregarTema">AGREGAR TEMA</button>
    </div>
  </div>
  <br>
  <div id="divFiltrosTema">
    <!--Aqui estan todos los filtros existentes--> 
  </div>
  <br>
  <!-------TABLAS DONDE CARGAN LOS TEMAS ----------->
  <div class="contTable">
    <table>
      <thead id="cabezaTemasTemario">
        <tr>
          <th>nombreTema</th>
          <th>descripcionTema</th>
          <th>videoTema</th>
          <th>Eliminar</th>
          <th>Modificar</th>
        </tr>
      </thead>
      <tbody id="temasTemario">
        </tbody>
      </table>
      <!--Aqui estaran los <td> del cuerpo de la tabla--> 
  </div>
</section>

    
<!--PREGUNTAS Y EXAMENES-->
<section id="preguntasExamenes" class="seccion">
<h5 class="center">Preguntas</h5>

<!--btn filtros-->
<div class="row">
  <div class="columna center"><button class="enviarT " id="btnFiltrarPreguntaTemario">FILTRAR POR TEMARIO</button></div>
  <div class="columna center"><button class="enviarT " id="btnFiltrarPreguntaArea">FILTRAR POR AREA</button></div>
  <div class="columna center"><button class="enviarT btn btn-primary" type="button" id="toggleOffcanvas">AGREGAR PREGUNTA</button></div>
</div>



    <div class="offcanvas" id="staticBackdrop">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="staticBackdropLabel">AGREGAR PREGUNTA</h5>
            <button type="button" class="btn-close" id="closeOffcanvas" aria-label="Close">&times;</button>
        </div>
        <div class="offcanvas-body" id="offcanvas-body">
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
                          <input name="resolucionPDF" id="resolucionPDF" type="text" class="form-control" placeholder="resolucion">
                        </div>
                    </div>

                    <button id="insertarPregunta" type="button" class="btn-modificar">Agregar Pregunta</button>
                </form>
            </div>
        </div>
    </div>






<div id="divFiltrosPreguntas">
</div>
<br>

<!-------TABLAS DONDE CARGAN LOS TEMARIOS EXISTENTES ----------->
<h5 class="center" id="tituloPreguntas">Carrera - Materia</h5>
<div class="centrarSearch">
    <input class="center" type="search">
    <label class="center" for="">Buscar</label>
  </div><br>
<!--AQUI SE MOSTRARA EL CONTENIDO COMO LA TABLA Y EL ACORDEON-->
  <div id="divContenido">

  </div>
    </section>
    <!--PREGUNTAS Y EXAMENES-->
    <!--USUARIO-->
    <section id="usuario" class="seccion">
      <div class="contenedorU" id="selectUserAjax">
        <?php if (session()->has('is_logged') && session('is_logged')) : ?>
          <form id="formUsuario" method="POST" enctype="multipart/form-data">
            <h5 class="center">USUARIO</h5>
            <!-- Contenedor principal -->
            <div class="perfil-info">
              <!-- Sección de imagen de perfil -->
              <div class="perfil-imagen">
                <label for="file-upload" class="changeIU">
                  <img src="<?php echo session('img'); ?>" alt="Imagen de perfil" id="preview-image">
                  <input type="file" id="file-upload" name="imagen" accept="image/*" style="display: none;" onchange="previewImage(event)">
                </label>
              </div>
              <!-- Sección de información -->
              <div class="perfil-datos">
                <!-- Nombre -->
                <div class="campo">
                  <i class="fas fa-user"></i>
                  <input type="text" id="nombre" name="nombre" value="<?php echo session('nombre'); ?>" required placeholder="Nombre">
                </div>
                <!-- Correo Electrónico -->
                <div class="campo">
                  <i class="fas fa-envelope"></i>
                  <input type="email" id="correo" name="correo" value="<?php echo session('correo'); ?>" required placeholder="Correo Electrónico">
                </div>
                <!-- Contraseña -->
                <div class="campo">
                  <i class="fas fa-lock"></i>
                  <input type="password" id="contraseñaN" name="contraseñaN" placeholder="Contraseña nueva">
                </div>
                <!-- Contraseña confirmar-->
                <div class="campo">
                  <i class="fas fa-lock"></i>
                  <input type="password" id="contraseña" name="contraseña" required placeholder="Contraseña para confirmar">
                </div>
              </div>
            </div>

            <!-- Botón de guardar cambios -->
            <div class="anchoU">
              <button class="btnUser" type="submit">Guardar</button>
            </div>
          </form>
        <?php endif; ?>
      </div>
    </section>
    <!--USUARIO-->

  </main>
  <!--contenido-->
  <script src="<?php echo base_url(); ?>js/scriptA.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!--VARIABLE GLOBAL PARA PODER USARLO EN LOS JS-->
  <script>
    var baseUrl = "<?php echo base_url(); ?>";
  </script>
  <script src="<?php echo base_url(); ?>js/crud_adm/OtrasFunciones.js"></script>
  <script src="<?php echo base_url();?>js/crud_adm/universida.js"></script>
  <script src="<?php echo base_url();?>js/crud_adm/carrera.js"></script>
  <script src="<?php echo base_url();?>js/crud_adm/materia.js"></script>
  <script src="<?php echo base_url();?>js/crud_adm/temario.js"></script>
  <script src="<?php echo base_url();?>js/crud_adm/tema.js"></script>
  <script src="<?php echo base_url();?>js/crud_adm/preguntas.js"></script>





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
      $("a[onclick*='" + seccion + "']").addClass("active");
    }
    //Funcion al hacer click a la img Usuario
    function previewImage(event) {
      var input = event.target;
      var reader = new FileReader();

      reader.onload = function() {
        var imgElement = document.getElementById('preview-image');
        imgElement.src = reader.result;
      };

      if (input.files && input.files[0]) {
        // Si se selecciona un archivo local, cargar la imagen
        reader.readAsDataURL(input.files[0]);
      } else if (input.value.startsWith('http') || input.value.startsWith('data:image')) {
        // Si se ingresa una URL o una cadena de datos de imagen, mostrar la imagen
        var imgElement = document.getElementById('preview-image');
        imgElement.src = input.value;
      }
    }
    //funcion para enviar el form usuario
    $(document).ready(function() {
      $('#formUsuario').submit(function(e) {
        e.preventDefault();
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contraseñaNueva = $_POST['contraseñaN'];
        if ($contraseñaNueva == "") {
          $contraseñaConfirmar = $_POST['contraseña'];
          $usuario = array(
            nombre => $nombre,
            correo => $correo,
            contraseña => $contraseñaConfirmar, );

          $usuario = array(
            nombre => $nombre,
            correo => $correo,
            contraseña => $contraseñaconfirmar,
          );
          $.ajax({
            type: 'POST',
            data: $usuario,
            url: '<?php echo base_url(); ?>/userAjax',
            processData: false,
            contentType: false,
            success: function(response) {
              // Maneja la respuesta del servidor
              alert('Los cambios han sido guardados correctamente.');
              // Aquí puedes realizar otras acciones, como actualizar la interfaz de usuario con la nueva información
            },
            error: function(err) {
              alert('Ha ocurrido un error. Por favor, intenta nuevamente.');
              console.error(err);
            }
          });

        } else {

          // Ejemplo: Almacenar datos en un array
          $usuario = array(
            nombre => $nombre,
            correo => $correo,
            contraseña => $contraseñaNueva,
          );

          // Envía la solicitud AJAX
          $.ajax({
            type: 'POST',
            data: $usuario,
            url: '<?php echo base_url(); ?>/userAjax',
            processData: false,
            contentType: false,
            success: function(response) {
              // Maneja la respuesta del servidor
              alert('Los cambios han sido guardados correctamente.');
              // Aquí puedes realizar otras acciones, como actualizar la interfaz de usuario con la nueva información
            },
            error: function(err) {
              alert('Ha ocurrido un error. Por favor, intenta nuevamente.');
              console.error(err);
            }
          });
        }
      });
    });
  </script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const accordionHeaders = document.querySelectorAll(".accordion-header");

    accordionHeaders.forEach(header => {
      header.addEventListener("click", function() {
        const accordionItem = this.parentElement;
        const accordionContent = accordionItem.querySelector(".accordion-content");

        accordionItem.classList.toggle("active");

        if (accordionItem.classList.contains("active")) {
          accordionContent.style.maxHeight = accordionContent.scrollHeight + "px";
        } else {
          accordionContent.style.maxHeight = 0;
        }
      });
    });
  });
</script>





<script>
// Función para hacer las celdas editables al hacer doble clic
document.addEventListener('DOMContentLoaded', function() {
    var toggleOffcanvasButton = document.getElementById('toggleOffcanvas');
    var offcanvas = document.getElementById('staticBackdrop');
    var closeOffcanvasButton = document.getElementById('closeOffcanvas');

    toggleOffcanvasButton.addEventListener('click', function() {
        offcanvas.classList.toggle('show');
    });

    closeOffcanvasButton.addEventListener('click', function() {
        offcanvas.classList.remove('show');
    });

    // Evitar el cierre del offcanvas cuando se hace clic fuera de él
    offcanvas.addEventListener('click', function(event) {
        if (event.target === offcanvas) {
            offcanvas.classList.remove('show');
        }
    });
});
</script>
</body>

</html>