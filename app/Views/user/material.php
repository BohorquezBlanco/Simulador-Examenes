<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Quicksand:400,600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styleM.css">
  <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <title>ANISSOFT</title>
</head>

<body>
  <div class="site-navbar-wrap">
    <div class="container">
      <div class="navbar-content">
        <h1 class="site-logo"><a href="index.html">ANISSOFT</a></h1>
        <nav class="site-navigation">
          <ul class="site-menu">
            <li><a href="<?php echo base_url(); ?>/" class="nav-link">Inicio</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>/material" class="nav-link">Material</a></li>
            <li><a href="<?php echo base_url(); ?>/examen" class="nav-link">Examenes</a></li>
            <li><a href="<?php echo base_url(); ?>/comunidad" class="nav-link">Comunidad</a></li>
            <li><a href="<?php echo base_url(); ?>/iniciarSesion" class="nav-link"><i class="fa-solid fa-circle-user"></i></a></li>
            <li><a href="https://wa.me/59171792338" target="_blank" class="nav-link"><i class="fa-brands fa-whatsapp"></i></a></li>
          </ul>
          <div class="menu-toggle">
            <span class="icon-menu"></span>
          </div>
        </nav>
      </div>
    </div>
  </div>

  <section id="carrera" class="seccion">
    <div class="carrerasCont">
      <div class="mensaje-inicio1">
        <h1>Bienvenido a la sección material</h1>
      </div>
      <!--CARRERAS_FILTRO_MATERIAS-->
      <div class="card-container" id="selectCarrAjax">
        <!--AQUI SE MUESTRAN LAS CARRERAS-->
      </div>
    </div>
  </section>
  <!--CARRERAS-->
  <!--MATERIAS-->
  <section id="materia" class="seccion" style="display:none;">
    <div class="materiasCont">
      <div class="mensaje-inicio2">
        <h1>Bienvenido a la sección materias</h1>
      </div>
      <!--CARRERAS_FILTRO_MATERIAS-->
      <div class="card-container" id="selectMatAjax">
      </div>
    </div>
  </section>
  <!--MATERIAS-->
  <!--TEMARIOS, LIBROS, VIDEOS-->
  <section id="temario" class="seccion" style="display:none;">
    <div class="temariosCont">
      <div class="mensaje-inicio3">
        <h1>Bienvenido a la sección temarios</h1>
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
      

<div id="videoContainer"></div>
    </div>
  </section>
  <section class="footer-background">
    <div class="container3">
      <div class="social-links">
        <a href="https://www.facebook.com/profile.php?id=61558840375496" target="_blank" class="social-link">
          <i class="fa-brands fa-facebook-f"></i>
        </a>
        <a href="https://t.me/+xFbS2PzWZoY5MWYx" target="_blank" class="social-link">
          <i class="fa-brands fa-telegram"></i>
        </a>
        <a href="https://wa.me/59171792338" target="_blank" class="social-link">
          <i class="fa-brands fa-whatsapp"></i>
        </a>
      </div>
      <p class="footer-text">
        © 2024 Anissoft, Inc. All rights reserved.
      </p>
    </div>
  </section>
  <!--TEMARIOS, LIBROS, VIDEOS-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!--VARIABLE GLOBAL PARA PODER USARLO EN LOS JS-->
  <script>
    var baseUrl = "<?php echo base_url(); ?>";
  </script>
  <script src="<?php echo base_url(); ?>js/crud_user/carrera.js"></script>