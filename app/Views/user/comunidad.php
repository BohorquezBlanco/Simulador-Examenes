<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styleC.css">
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
    <section id="comunity" class="seccion">
        <div class="comunidadCont">
            <div class="mensaje-inicio1">
                <h1>Bienvenido a nuestra comunidad</h1>
            </div>
            <section id="folio" class="sec-folio">
            </section>
        </div>
    </section>

    <section>
        <div class="container">
            <h1>Subir Archivos</h1>
            <form id="uploadForm" enctype="multipart/form-data">
                <input type="file" name="file" id="file" accept=".pdf,.doc,.docx,.txt">
                <button type="submit" onclick="uploadFile()">Subir Archivo</button>
            </form>
            <p id="status"></p>
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

    <script src="js/script.js"></script>
</body>

</html>