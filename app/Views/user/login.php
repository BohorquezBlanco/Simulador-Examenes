<style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .pelicula-principal {
        font-size: 16px;
        min-height: 48.62em;
        color: #fff;
        background: linear-gradient(rgba(0, 0, 0, .50) 0%, rgba(0,0,0,.50) 100%), url(https://images.pexels.com/photos/6344239/pexels-photo-6344239.jpeg );
        background-position: center center;
        background-size: cover;
        margin-bottom: 2.12em;
    
      }
      .login{
        max-width: 330px;
        background: transparent;
        backdrop-filter: blur(5px);
        border: 1px solid gray;
        border-radius: 8px;
      
      }
      @media (min-width: 2560px) 
      {
        .login 
        {
          background: transparent;
          backdrop-filter: blur(5px);
          border: 1px solid gray;
          border-radius: 8px;
          max-width: 450px;
          height: 500px;
        }

        /* Estilos específicos para la etiqueta h1 dentro de la media query */
        .login h1
        {
          font-size: 50px;
          align-items: center;
        }
        .login input
        {
          font-size: 30px;
          height: auto; /* Establecer el ancho a 'auto' para eliminar la propiedad anterior */
          width: 100%; 
          height: 100%;
        }
        .login button
        {
          padding-top: 45px;
          font-size: 35px;

        }
        .login label 
        {
      
          font-size: 25px;

        }
        .login p
        {
      
          font-size: 25px;
        }
      }



    </style>



  <body class=" align-items-center  bg-body-tertiary pelicula-principal">
    <br>
    <br>
    <br>

<main class=" form-signin w-100 m-auto login">
<form action="<?php echo base_url().'login' ;?>" method="POST">

    <h1 class="h3 mb-3 fw-normal text-center">Iniciar Sesión</h1>

    <div class="form-floating">
      <input type="text" name="correo" class="form-control" id="floatingInput" placeholder="name@example.com" style="height: 100%;">
      <label for="floatingInput">Usuario</label>
    </div><br>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" style="height: 100%;">
      <label for="floatingPassword">Contraseña</label>
    </div><br>

    <p><?php echo session('errors.password') ?></p>
    <button class="btn btn-outline-light w-100 py-2" type="submit">INGRESAR</button>

    <p class="mt-5 mb-3 text-body-white ">&copy; 2024</p>
</form>
</main>





<script src="<?php echo base_url()?>js/bootstrap.bundle.min.js"></script>

    </body>
</html>
