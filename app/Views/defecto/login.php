<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <link href="<?php echo base_url(); ?>css/login.css" rel="stylesheet">
</head>

<body>
  <div class="loginT">
    <div class="section nat">
      <img src="<?php echo base_url('img/nat.png'); ?>" alt="Contactanos">
    </div>
    <div class="section form">
      <form action="<?php echo base_url() . 'login'; ?>" method="POST">
        <h3>-- SOLO ADMIN --</h3>
        <!--Correo-->
        <label for="username">Correo</label>
        <input type="text" name="correo" id="username" placeholder="Ingrese su usuario" required>
        <!--Contraseña-->
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="Ingrese su contraseña" required>
        <!--Manda a errores de la contraseña-->
        <p><?php echo session('errors.password'); ?></p>
        <!--Ingresa al sistema-->
        <button type="submit">INGRESAR</button>
      </form>
    </div>
    <div class="section sam">
      <img src="<?php echo base_url('img/sam.png'); ?>" alt="Contactanos">
    </div>
  </div>

  <!-----------CON ESTO SE MUESTRA LOS MENSAJES , PUEDES EDITARLO Y COLOCARLO DONDE MAS SE--------->
  <?php if (session()->has('msg')) : ?>
    <div class="danger">
      <?php echo session('msg'); ?>
    </div>
  <?php endif; ?>

</body>

</html>