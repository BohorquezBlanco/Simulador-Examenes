<!--HEADER-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="<?php echo base_url(); ?>css/styleD.css" rel="stylesheet">

</head>
<!--HEADER-->
<!--BODY-->

<body>
  <!--Icono de menu arriba-->
  <div class="menuA">
    <ion-icon name="menu-outline"></ion-icon>
    <ion-icon name="close-circle-outline"></ion-icon>
  </div>
  <!--Icono de menu arriba-->
  <!--MENÚ-->
  <div class="menu">
    <!--NOMBRE EMPRESA-->
    <!--Logo de la empresa-->
    <div class="nombreE">
      <img id="logo" src="<?php echo base_url('img/AnisSoft.png'); ?>">
    </div>
    <!--Logo de la empresa-->
    <!--Clickear para el modo otoño-->
    <div class="modo-otoño">
      <a id="otoño" title="Otoño">
        <ion-icon id="mode" name="leaf-outline"></ion-icon>
      </a>
    </div>
    <!--Clickear para el modo otoño-->
    <!--Clickear para acceder al login-->
    <div class="inicio-usuario">
      <a href="<?php echo base_url(); ?>iniciarSesion" id="inicio" title="Iniciar sesión">
        <ion-icon id="usuario" name="person-add-outline"></ion-icon>
      </a>
    </div>
    <!--Clickear para acceder al login-->
  </div>
  <!--Contenedor barra arriba "Practica con nosotros"-->
  <div class="contenedorP">
    <h1>PRACTICA CON NOSOTROS</h1>
  </div>
  <!--Contenedor barra arriba "Practica con nosotros"-->
  <!--Contenedor porque practicar con nosotros-->
  <div class="contenedorT">
    <p>
      "Con nuestro sistema, tendrás la capacidad de resolver los exámenes de ingreso a la UMSS, así como también acceder a exámenes pasados.
      Esto te permitirá mejorar tu rendimiento y prepararte de manera efectiva para el examen de ingreso.
      Solo necesitas <a href="<?php echo base_url('/contenido'); ?>">ingresar aquí</a>
    </p>
    <div class="imgT">
      <img src="https://www.educaciontrespuntocero.com/wp-content/uploads/2018/06/examenes-1-978x652.jpg" alt="By AnisSoft">
    </div>
  </div>
  <!--Contenedor porque practicar con nosotros-->
  <!--1ra seccion-->
  <!--Beneficios-->
  <div class="textoB">
    <h2>Beneficios</h2>
  </div>
  <div class="contenedorB">
    <table class="tablaB">
      <tr>
        <th>Examenes pasados</th>
        <th>¡Todo resuelto!</th>
        <th>Simulacro de examen</th>
      </tr>
      <tr>
        <td><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR87Z5qOF3bmLBvV_P7zsCVbHAUvZuwsyKDfrvlUm1KWQ&s" alt="Examenes pasados"></td>
        <td><img src="https://miprofevirtual.online/wp-content/uploads/2020/04/resoluci%C3%B3n-tareas-y-ex%C3%A1menes-matem%C3%A1tica-por-whatsapp.jpg" alt="Resolución de examenes"></td>
        <td><img src="https://www.cazatuplaza.com/blog/wp-content/uploads/2021/03/examen-tpo-test-1.jpg" alt=""></td>
      </tr>
      <tr>
        <td>Usted podrá dar examenes pasados.</td>
        <td>Podrá ver paso a paso la resolución de los ejercicios.</td>
        <td>Usted podrá tener acceso a simulacros de examenes.</td>
      </tr>
    </table>
  </div>
  <!--Que hacemos-->
  <!--Contenedor que hacemos nosotros-->
  <div class="textoW">
    <h2>¿Qué hacemos?</h2>
  </div>
  <div class="contenedorW">
    <!--Contenedor 1-->
    <div class="contenedor 1">
      <img src="<?php echo base_url('img/fondo.png'); ?>" alt="Diseño de paginas web">
      <h3>Diseño de paginas web</h3>
      <p>Diseñamos páginas web a su estilo</p>
    </div>
    <!--Contenedor 1-->
    <!--Contenedor 2-->
    <div class="contenedor 2">
      <img src="<?php echo base_url('img/fondo.png'); ?>" alt="Creación de documentos">
      <h3>Creación de documentos</h3>
      <p>Creamos documentos de todas las plataformas</p>
    </div>
    <!--Contenedor 2-->
    <!--Botones antes y despues -->
    <button class="ant" onclick="cambiarSlide(-1)">&#10094;</button>
    <button class="sig" onclick="cambiarSlide(1)">&#10095;</button>
    <!--Botones antes y despues -->
  </div>
  <!--Contenedor de contactanos, aqui debe entrar las listas de redes sociales y paginas personales, asi como las estadisticas de la pagina-->
  <div class="textoC">
    <h2>Contáctanos</h2>
  </div>
  <div class="imgC">
    <img src="https://www.bupasalud.com.bo/sites/default/files/portada/2021-11/full/heroimage-contactanos_1_5.jpeg" alt="Contactanos">
  </div>
  <table class="tablaC">
    <tr>
      <th>24/7</th>
      <th>9</th>
      <th>10%</th>
      <th>6+</th>
    </tr>
    <tr>
      <td>Atención al cliente</td>
      <td>Departamentos</td>
      <td>Descuentos</td>
      <td>Experiencia</td>
    </tr>
  </table>
  <!--Contenedor de contactanos, aqui debe entrar las listas de redes sociales y paginas personales, asi como las estadisticas de la pagina-->
  <!--Que hacemos-->
  <!--SCRIPT-->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="<?php echo base_url(); ?>js/scriptD.js"></script>
  <!--SCRIPT-->
</body>
<!--BODY-->

</html>