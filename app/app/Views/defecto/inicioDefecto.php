<!--HEADER-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="<?php echo base_url(); ?>css/styleU.css" rel="stylesheet">

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
      </div>
      <div class="modo-otoño">
        <button id="otoño" title="Otoño">
          <ion-icon id="mode" name="leaf-outline"></ion-icon>
        </button>
      </div>
      <div class="inicio-usuario">
        <button id="inicio" title="Iniciar sesión">
          <ion-icon id="usuario" name="person-add-outline"></ion-icon>
        </button>
      </div>
    </div>
  </div>
  <div class="contenedorP">
    <h1>PRACTICA CON NOSOTROS</h1>
  </div>
  <!--Porque practicar con nosotros-->
  <div class="contenedorT">
    <p>
      "Con nuestro sistema, tendrás la capacidad de resolver los exámenes de ingreso a la UMSS, así como también acceder a exámenes pasados.
      Esto te permitirá mejorar tu rendimiento y prepararte de manera efectiva para el examen de ingreso.
      Solo necesitas <a href="#">iniciar sesión</a>
    </p>
    <div class="imgT">
      <img src="https://www.educaciontrespuntocero.com/wp-content/uploads/2018/06/examenes-1-978x652.jpg" alt="By AnisSoft">
    </div>
  </div>
  <!--Beneficios-->
  <div class="textoB">
    <h2>Beneficios</h2>
  </div>
  <div class="contenedorB">
    <div class="contenedor 1">
      <img src="<?php echo base_url('img/fondo.png'); ?>" alt="Banco de examenes pasados">
      <h2>Banco de examenes pasados</h2>
      <p>Usted podra acceder a examenes pasados para enriquecer su conocimiento.</p>
    </div>
    <div class="contenedor 2">
      <img src="https://img.freepik.com/foto-gratis/fila-estudiantes-haciendo-examen_1098-174.jpg" alt="Examenes resueltos">
      <h2>¡Todo esta resuelto!</h2>
      <p>Usted podrá ver paso a paso como se resuelven los ejercicios</p>
    </div>
    <div class="contenedor 3">
      <img src="https://img.freepik.com/foto-gratis/fila-estudiantes-haciendo-examen_1098-174.jpg" alt="Simulacro de examenes">
      <h2>Simulacro de examenes</h2>
      <p>Usted podra tener acceso a simulacros de examenes para mejorar su desempeño</p>
    </div>
    <button class="ant" onclick="cambiarSlide(-1)">&#10094;</button>
    <button class="sig" onclick="cambiarSlide(1)">&#10095;</button>
  </div>
  <!--Que hacemos-->
  <div class="textoW">
    <h2>¿Qué hacemos?</h2>
  </div>
  <div class="contenedorW">
    <div class="card-container">
      <div class="card">
        <h3>Desarrollo<br>Web</h3>
        <hr>
        <p>Nos encargamos del desarrollo de páginas web para su negocio, dependiendo de sus requerimientos.</p>
        <button>Ver precios</button>
      </div>
      <div class="card">
        <h3>Reparación y mantenimiento</h3>
        <hr>
        <p>Ofrecemos reparación y mantenimiento de computadoras a domicilio.</p>
        <button>Ver precios</button>
      </div>
      <div class="card">
        <h3>Creación de<br>Documentos</h3>
        <hr>
        <p>Realizamos la creación de documentos para colegios, universidades o negocios.</p>
        <button>Ver precios</button>
      </div>
    </div>
  </div>
  <div class="textoC">
    <h2>Contáctanos</h2>
  </div>
  <div class="imgC">
    <img src="https://www.bupasalud.com.bo/sites/default/files/portada/2021-11/full/heroimage-contactanos_1_5.jpeg" alt="">
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
  <div class="contenedorC">
    <div class="numC">
      <p>24/7</p>
      <p>9</p>
      <p>10%</p>
      <p>6+</p>
    </div>
    <div class="textC">
      <p>Atención al cliente</p>
      <p>Departamentos</p>
      <p>Descuentos</p>
      <p>Experiencia</p>
    </div>
  </div>
  <!--Que hacemos-->
  <!--SCRIPT-->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="<?php echo base_url(); ?>js/scriptU.js"></script>
  <!--SCRIPT-->
</body>
<!--BODY-->

</html>