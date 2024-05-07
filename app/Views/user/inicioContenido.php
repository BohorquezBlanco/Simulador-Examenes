<!--HEADER-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="<?php echo base_url(); ?>css/styleC.css" rel="stylesheet">

</head>
<!--HEADER-->
<!--BODY-->

<body>
  <!--MENÚ-->
  <div class="menu">
    <!-- NOMBRE EMPRESA -->
    <div class="nombreE">
      <img id="logo" src="<?php echo base_url('img/AnisSoft.png'); ?>">
    </div>
    <!-- Opciones de Navegación -->
    <nav class="opciones">
      <ul>
        <!-- List Items for Navigation Links -->
        <li><a href="#" onclick="mostrarSeccion('carrera')">Carreras</a></li>
        <li><a href="#" onclick="mostrarSeccion('materia')">Materias</a></li>
        <li><a href="#" onclick="mostrarSeccion('libro')">Libros</a></li>
        <li><a href="#" onclick="mostrarSeccion('temarioPregunta')">Temarios</a></li>
        <li><a href="#" onclick="mostrarSeccion('video')">Videos</a></li>
      </ul>
    </nav>
  </div>
    <!--MENÚ-->
    <!--CONTENIDO-->
    <main>
      <!--SECCIONES-->
      <!--CARRERAS-->
      <section id="carrera" class="seccion">
        <h2 class="center">CARRERAS</h2>
        <div class="card-container">
          <?php $n = 0; ?>
          <?php foreach ($carreras as $carrera) : ?>
            <div class="card<?php $n; ?>" draggable="true" id="<?php echo $carrera['idCarrera']; ?>" data="<?php echo base_url('eliminarCarrera'); ?>" aria-required="<?php echo base_url('editarCarreras'); ?>">
              <img src="<?php echo $carrera['imagenCarrera']; ?>" alt="By AnisSoft" title="<?php echo $carrera['nombreCarrera']; ?>" />
              <div class="card-body">
                <p class="card-title"><?php echo $carrera['nombreCarrera']; ?></p>
              </div>
            </div>
            <?php $n = $n + 1; ?>
          <?php endforeach; ?>
        </div>
      </section>
      <!--CARRERAS-->
      <!--MATERIAS-->
      <section id="materia" class="seccion">
        <h2 class="center">MATERIAS</h2>
        <div class="card-container">
          <?php $n = 0; ?>
          <?php foreach ($materias as $materia) : ?>
            <div class="card<?php $n; ?>" draggable="true" id="<?php echo $materia['idMateria']; ?>" data="<?php echo base_url('eliminarMateria'); ?>" aria-required="<?php echo base_url('editarMaterias'); ?>">
              <img src="<?php echo $materia['imagenMateria']; ?>" alt="By AnisSoft" title="<?php echo $materia['nombreMateria']; ?>" />
              <div class="card-body">
                <p class="card-title"><?php echo $materia['nombreMateria']; ?></p>
              </div>
            </div>
            <?php $n = $n + 1; ?>
          <?php endforeach; ?>
        </div>
  </div>
  </section>
  </div>
  </section>
  <!--MATERIAS-->
  <!--LIBROS-->
  <section id="libro" class="seccion">
    <h2 class="center">LIBROS</h2>
    <div class="card-container">
      <?php $n = 0; ?>
      <?php foreach ($libros as $libro) : ?>
        <div class="card<?php $n; ?>" draggable="true" id="<?php echo $libro['idLibro']; ?>" data="<?php echo base_url('eliminarLibro'); ?>" aria-required="<?php echo base_url('editarMaterias'); ?>">
          <img src="<?php echo $libro['imagenLibro']; ?>" alt="By AnisSoft" title="<?php echo $libro['nombreLibro']; ?>" />
          <div class="card-body">
            <p class="card-title"><?php echo $libro['nombreLibro']; ?></p>
          </div>
        </div>
        <?php $n = $n + 1; ?>
      <?php endforeach; ?>
    </div>
  </section>
  <!--LIBROS-->
  <!--TEMARIOS, PREGUNTAS-->
  <!--TEMARIOS, PREGUNTAS-->
  <!--VIDEOS-->
  <!--VIDEOS-->
  <!--SECCIONES-->

  </main>
  <!--contenido-->
  <script src="<?php echo base_url(); ?>js/scriptC.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

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
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      $(".seccion").hide();
      $('#carrera').show();
    });

    function mostrarSeccion(seccion) {
      $(".seccion").hide();
      $("a").removeClass("active");
      $("#" + seccion).show();
      $("a[onclick=\"mostrarSeccion('" + seccion + "')\"]").addClass("active");
    }
  </script>
</body>

</html>