<!--HEADER-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="<?php echo base_url(); ?>css/styleC.css" rel="stylesheet">
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
        <li><a href="#" onclick="mostrarSeccion('examenes')">Examenes</a></li>
      </ul>
    </nav>
  </div>
  <!--MENÚ-->
  <!--CONTENIDO-->
  <main>
    <!--SECCIONES-->
    
    <!--UNIVERSIDAD-->
    <section id="univInst" class="seccion">
      <h5 class="center">UNIVERSIDADES E INSTITUTOS</h5>
      <div class="card-container" id="selectUniAjax">   
      <!--En este div cargara las universidades por medio de ajax-->
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
    </section>
    <!--MATERIAS-->
    <!--TEMARIOS, LIBROS, VIDEOS-->
    <section id="temarioLibroVideo" class="seccion">
      <h5 class="center">TEMARIOS</h5>
      
    </section>
    <!--TEMARIOS, LIBROS, VIDEOS-->
    <!--PREGUNTAS Y EXAMENES-->
    <section id="preguntasExamenes" class="seccion">
      <h5 class="center">PREGUNTAS</h5>
      
    </section>
    <!--PREGUNTAS Y EXAMENES-->


    
  </main>
  <!--contenido-->
  <script src="<?php echo base_url(); ?>js/scriptC.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!--VARIABLE GLOBAL PARA PODER USARLO EN LOS JS-->
  <script> var baseUrl = "<?php echo base_url(); ?>";</script>
  <script src="<?php echo base_url(); ?>js/crud_user/OtrasFunciones.js"></script>
  <script src="<?php echo base_url();?>js/crud_user/universidad.js"></script>
  <script src="<?php echo base_url();?>js/crud_user/carrera.js"></script>
  <script src="<?php echo base_url();?>js/crud_user/materia.js"></script>

  <script>
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
    }
  </script>


</body>

</html>