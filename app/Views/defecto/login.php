<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <link href="<?php echo base_url(); ?>css/login.css" rel="stylesheet">
</head>

<body>
  <main class="login">
    <form action="<?php echo base_url() . 'login'; ?>" method="POST">
      <h1>Iniciar Sesión</h1>

      <label for="username">Correo</label>
      <input type="text" name="correo" id="username" placeholder="Ingrese su usuario" required>

      <label for="password">Contraseña</label>
      <input type="password" name="password" id="password" placeholder="Ingrese su contraseña" required>

      <p><?php echo session('errors.password'); ?></p>

      <button type="submit">INGRESAR</button>
    </form>
  </main>

  <!-----------CON ESTO SE MUESTRA LOS MENSAJES , PUEDES EDITARLO Y COLOCARLO DONDE MAS SE--------->
  <?php if(session()->has('msg')): ?>
      <div class="danger">
          <?php echo session('msg'); ?>
      </div>
    <?php endif; ?>

</body>

</html>
