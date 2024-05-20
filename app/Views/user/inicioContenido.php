<!--HEADER-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SimuladorNS</title>
  <link href="<?php echo base_url(); ?>css/styleC.css" rel="stylesheet">
  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
  <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<!--HEADER-->
<!--BODY-->

<body>
  <!--MENÚ-->
  <button class="toggle-btn" onclick="toggleMenu()">☰</button>
  <div class="menu-responsive">
    <ul>
      <a onclick="mostrarSeccion('carrera'); ocultarMenuR();">Carreras</a>
      <a onclick="mostrarSeccion('examenes'); ocultarMenuR();">Examenes</a>
      <a onclick="mostrarSeccion('recurso'); ocultarMenuR();">Recursos</a>
    </ul>
  </div>
  <div class="menu">
    <!-- NOMBRE EMPRESA -->
    <div class="nombreE">
      <a href="<?php echo base_url(); ?>/"><img id="logo" src="<?php echo base_url('img/AnisSoftW.png'); ?>"></a>
    </div>
    <!-- Opciones de Navegación -->
    <nav class="opciones">
      <ul>
        <li><a onclick="mostrarSeccion('carrera')">Carreras</a></li>
        <li><a onclick="mostrarSeccion('examenes')">Examenes</a></li>
        <li><a onclick="mostrarSeccion('recurso')">Recursos</a></li>
      </ul>
    </nav>
  </div>
  <!--MENÚ-->
  <!--CONTENIDO-->
  <main>
    <!--SECCIONES-->
    <!--CARRERAS-->
    <section id="carrera" class="seccion">
      <div class="mensaje-inicio" style="background-image: url('https://www.umss.edu.bo/wp-content/uploads/2019/09/1010290.jpg');">
        <h1>Bienvenido a la sección carreras</h1>
        <p>Universidad Mayor de San Simón</p>
      </div>
      <!--CARRERAS_FILTRO_MATERIAS-->
      <div class="card-container" id="selectCarrAjax">
        <!--AQUI SE MUESTRAN LAS CARRERAS-->
      </div>
    </section>
    <!--CARRERAS-->
    <!--MATERIAS-->
    <section id="materia" class="seccion">
      <div class="mensaje-inicio2">
        <h1>Bienvenido a la sección materias</h1>
        <p>Aquí encontrarás recursos de las materias.</p>
      </div>
      <!--CARRERAS_FILTRO_MATERIAS-->

      <div class="card-container" id="selectMatAjax">
      </div>
    </section>
    <!--MATERIAS-->
    <!--TEMARIOS, LIBROS, VIDEOS-->
    <section id="temario" class="seccion">
      <div class="mensaje-inicio3">
        <h1>Bienvenido a la sección temarios</h1>
        <p>Aquí encontrarás recursos de los temarios.</p>
      </div>
      <div class="contT">
      <div class="contTemario">
          <ul id="temarioList">
          </ul>
      </div>
      <div class="temasLib">
            <div id="temas">
            </div>
            <div id="lib">
            </div>
          </div>
        </div>
    </section>
    <!--TEMARIOS, LIBROS, VIDEOS-->
    <!--PREGUNTAS Y EXAMENES-->
    <section id="examenes" class="seccion">
      <div class="mensaje-inicio4" style="background-image: url(https://cdn2.ondavasca.com/6c143009-1961-43d9-be0e-550e1f1d5cd4_16-9-discover_1200x675.jpg) ;">
        <h1>Bienvenido a la sección examenes</h1>
        <p>Aquí podrás dar tus examenes</p>
      </div>
    </section>
    <!--PREGUNTAS Y EXAMENES-->
    <!--RECURSOS-->
    <section id="recurso" class="seccion">
      <div class="mensaje-inicio5" style="background-image: url(https://img.freepik.com/vector-premium/ilustracion-hilo-rojo-dibujado-mano_23-2150055034.jpg) ;">
        <h1>Bienvenido a la sección examenes</h1>
        <p>Aquí podrás dar tus examenes</p>
      </div>
    </section>
    <!--RECURSOS-->
    <footer class="footer">
      <p>&copy; 2024 Plataforma de Exámenes. Todos los derechos reservados.</p>
      <div class="iconC">
        <!--facebook-->
        <a class="ic" href="https://www.facebook.com/profile.php?id=61558840375496" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z" />
          </svg></a>
        <a class="tc" href="https://www.facebook.com/profile.php?id=61558840375496" target="_blank">Más sobre nosotros</a>
        <!--wpp-->
        <a class="ic" href="https://wa.me/59171792338" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
          </svg></a>
        <a class="tc" href="https://wa.me/59171792338" target="_blank">Contáctanos</a>
        <!--telegram-->
        <a class="ic" href="https://t.me/+xFbS2PzWZoY5MWYx" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path d="M248 8C111 8 0 119 0 256S111 504 248 504 496 393 496 256 385 8 248 8zM363 176.7c-3.7 39.2-19.9 134.4-28.1 178.3-3.5 18.6-10.3 24.8-16.9 25.4-14.4 1.3-25.3-9.5-39.3-18.7-21.8-14.3-34.2-23.2-55.3-37.2-24.5-16.1-8.6-25 5.3-39.5 3.7-3.8 67.1-61.5 68.3-66.7 .2-.7 .3-3.1-1.2-4.4s-3.6-.8-5.1-.5q-3.3 .7-104.6 69.1-14.8 10.2-26.9 9.9c-8.9-.2-25.9-5-38.6-9.1-15.5-5-27.9-7.7-26.8-16.3q.8-6.7 18.5-13.7 108.4-47.2 144.6-62.3c68.9-28.6 83.2-33.6 92.5-33.8 2.1 0 6.6 .5 9.6 2.9a10.5 10.5 0 0 1 3.5 6.7A43.8 43.8 0 0 1 363 176.7z" /><a href="https://t.me/+xFbS2PzWZoY5MWYx" target="_blank">
          </svg></a>
        <a class="tc" href="https://t.me/+xFbS2PzWZoY5MWYx" target="_blank">Aporta contenido</a>
      </div>
    </footer>
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
  <script src="<?php echo base_url(); ?>js/crud_user/OtrasFunciones.js"></script>
  <script src="<?php echo base_url(); ?>js/crud_user/universidad.js"></script>
  <script src="<?php echo base_url(); ?>js/crud_user/carrera.js"></script>
  <script src="<?php echo base_url(); ?>js/crud_user/materia.js"></script>
  <script src="<?php echo base_url(); ?>js/crud_user/temario.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Al cargar la página, ocultar todas las secciones excepto la primera activa
      $(".seccion").hide();
      var link = document.querySelector('a[onclick="mostrarSeccion(\'carrera\')"]');
    
    // Agregar la clase "active" al elemento obtenido
    if (link) {
        link.classList.add("active");
    }
      $('#carrera').show();
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
    }
  </script>
</body>
</html>