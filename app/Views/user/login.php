<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Quicksand:400,600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/login.css">
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
            <li class="active"><a href="<?php echo base_url(); ?>/" class="nav-link">Inicio</a></li>
            <li><a href="<?php echo base_url(); ?>/material" class="nav-link">Material</a></li>
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

  <div class="mayorC">
    <div class="wrapper" id="wrapper">
      <div class="form-box register-box">
        <form action="#">
          <h1>Registrate</h1>
          <div class="social-box">
            <a onclick="loginWithFacebook()" class="social"><i class="fab fa-facebook-f"></i></a>
            <a onclick="loginWithGoogle()" class="social"><i class="fab fa-google-plus-g"></i></a>
          </div>
          <span>o usa tu correo</span>
          <input type="text" placeholder="Nombre" />
          <input type="email" placeholder="Correo" />
          <input type="password" placeholder="Contraseña" />
          <button>Registrate</button>
        </form>
      </div>
      <div class="form-box login-box">
        <form action="<?php echo base_url(); ?>/login" method="POST">
          <h1>Acceso</h1>
          <input type="email" name="correo" placeholder="Correo" required />
          <input type="password" name="password" placeholder="Contraseña" required />
          <button type="submit">Accede</button>
        </form>
      </div>

      <div class="overlay-box">
        <div class="overlay">
          <div class="overlay-panel overlay-left">
            <h1>Bienvenido de vuelta!</h1>
            <p>Para permanecer conectado, inicie sesión con su información personal</p>
            <button class="ghost" id="login">Accede</button>
          </div>
          <div class="overlay-panel overlay-right">
            <h1>Hola, amigo!</h1>
            <p>Ingresa tus datos para comenzar tu viaje con nosotros</p>
            <button class="ghost" id="register">Registrate</button>
          </div>
        </div>
      </div>
    </div>
  </div>
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
  <!-----------CON ESTO SE MUESTRA LOS MENSAJES , PUEDES EDITARLO Y COLOCARLO DONDE MAS SE--------->
  <?php if (session()->has('msg')) : ?>
    <div class="danger">
      <?php echo session('msg'); ?>
    </div>
  <?php endif; ?>

  <script src="js/script.js"></script>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script>
    window.fbAsyncInit = function() {
      FB.init({
        appId: 'YOUR_APP_ID',
        cookie: true,
        xfbml: true,
        version: 'v10.0'
      });
    };

    function checkLoginState() {
      FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
      });
    }

    function statusChangeCallback(response) {
      if (response.status === 'connected') {
        console.log('Logged in.');
        // Perform post-login actions here.
      } else {
        console.log('Not authenticated.');
      }
    }

    function loginWithFacebook() {
      FB.login(checkLoginState, {
        scope: 'public_profile,email'
      });
    }
  </script>

  <script>
    function loginWithGoogle() {
      gapi.load('auth2', function() {
        var auth2 = gapi.auth2.init({
          client_id: 'YOUR_CLIENT_ID.apps.googleusercontent.com'
        });
        auth2.signIn().then(function(googleUser) {
          console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
          // Perform post-login actions here.
        });
      });
    }
  </script>

</body>

</html>