<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  
    <div class="container">
        <h1 class="text-center">Login Base</h1>


        <form action="<?php echo base_url().'login' ;?>" method="POST" class="row">
          <div class="input-group mb-3 col-4">
            <span class="input-group-text" id="basic-addon1">Correo</span>
            <input name="correo" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
          </div>

          <div class="input-group mb-3 col-4">
            <span class="input-group-text" id="basic-addon2">Contraseña</span>
            <input name="password" type="password" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">

          </div>
          <button type="button col-12" class="btn btn-primary">Ingresar</button>
        </form>
    </div>

    <!-----------CON ESTO SE MUESTRA LOS MENSAJES , PUEDES EDITARLO Y COLOCARLO DONDE MAS SE--------->
    <?php if(session()->has('msg')): ?>
      <div class="danger">
          <?php echo session('msg'); ?>
      </div>
    <?php endif; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>