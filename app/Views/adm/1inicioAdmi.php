<!--HEADER-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">

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
        <span>ANISSOFT</span>
      </div>
    </div>
    <!--1ra seccion-->
    <!--2da seccion-->
    <nav class="opciones">
      <ul>
        <li>
          <a class="active" id="btn" type="button" onclick="mostrarSeccion('univInst')" title="Universidades o Institutos">
            <ion-icon name="school-outline"></ion-icon>
            <span>Universidades</span>
          </a>
        </li>
        <li>
          <a id="btn" type="button" onclick="mostrarSeccion('carrera')" title="Carreras">
            <ion-icon name="briefcase-outline"></ion-icon>
            <span>Carreras</span>
          </a>
        </li>
        <li>
          <a type="button" onclick="mostrarSeccion('materia')" title="Materias">
            <ion-icon name="document-text-outline"></ion-icon>
            <span>Materias</span>
          </a>
        </li>
        <li>
          <a type="button" onclick="mostrarSeccion('libro')" title="Libros">
            <ion-icon name="book-outline"></ion-icon>
            <span>Libros</span>
          </a>
        </li>
        <li>
          <a type="button" onclick="mostrarSeccion('temarioPregunta')" title="Temarios, Preguntas">
            <ion-icon name="document-attach-outline"></ion-icon>
            <span>Temarios</span>
          </a>
        </li>
        <li class="nav-item">
          <a type="button" onclick="mostrarSeccion('video')" title="Videos">
            <ion-icon name="videocam-outline"></ion-icon>
            <span>Videos</span>
          </a>
        </li>
      </ul>
    </nav>
    <!--2da seccion-->
    <!--3ra seccion-->
    <div>
      <div class="linea"></div>
      <div class="modo-otoño">
        <button id="otoño" title="Otoño" onclick="cambiarTexto()">
          <ion-icon name="leaf-outline"></ion-icon>
          <span id="TextoC">Otoño</span>
        </button>
      </div>
      <div class="usuario">
        <img src="<?php $imgUsuario; ?>">
        <div class="info-usuario">
          <div class="nombre-email">
            <span class="nombre"><?php $nombre; ?></span>
            <span class="email"><?php $correo; ?></span>
          </div>
          <ion-icon name="ellipsis-vertical-outline"></ion-icon>
        </div>
      </div>
    </div>
    <!--3ra seccion-->
  </div>
  <!--MENÚ-->
  <!--CONTENIDO-->
  <main>
    <!--SECCIONES-->
    <!--UNIVERSIDAD-->
    <section id="univInst" class="seccion">
      <h2 class="center">UNIVERSIDADES E INSTITUTOS</h2>
      <div class="card-container">
        <?php $n = 0; ?>
        <?php foreach ($unis as $uni) : ?>
          <div class="card" draggable="true" id="<?php echo $uni['idU']; ?>" data="<?php echo base_url('eliminarUni'); ?>" aria-hidden="<?php echo base_url('editarUni'); ?>">
            <img src="<?php echo $uni['imagenU']; ?>" alt="By AnisSoft" title="<?php echo $uni['nombreU']; ?>" draggable="false" />
            <div class="card-body">
              <h3 draggable="false" class="card-title"><?php echo $uni['nombreU']; ?></h3>
            </div>
          </div>
          <?php $n = $n + 1; ?>
        <?php endforeach; ?>
        <button class="abrirModal" type="button" data-target="añadirU">
          <ion-icon name="add-circle-outline"></ion-icon>
        </button>
        <div class="modal" id="añadirU">
          <div class="contenido-modal">
            <div class="head">
              <h3>Añadir Universidad/instituto</h3>
              <button class="cerrar">
                <ion-icon name="close-circle-outline"></ion-icon>
              </button>
            </div>
            <form action="<?php echo base_url('/crearUni') ?>" method="post" id="crear">
              <div class="celda">
                <label class="form-label">Nombre de la universidad/instituto</label>
                <input name="nombreU" id="nombreU" type="text" class="form-control" placeholder="Nombre de la universidad/instituto">
              </div>
              <div class="celda">
                <label class="form-label">Descripción de la universidad/instituto</label>
                <textarea class="form-control" rows="3" name="descripcionU" id="descripcionU" placeholder="Descripción de la universidad/instituto"></textarea>
              </div>
              <div class="celda">
                <label class="form-label">Imagen de la universidad/instituto</label>
                <textarea class="form-control" rows="3" name="imagenU" id="imagenU" placeholder="Imagen de la universidad/instituto"></textarea>
              </div>
              <div class="añadir">
                <button type="submit" class="btn-modificar">Añadir nueva</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!--UNIVERSIDAD-->
    <!--CARRERAS-->
    <section id="carrera" class="seccion">
      <h2 class="center">CARRERAS</h2>
      <div class="card-container">
        <?php $n = 0; ?>
        <?php foreach ($carreras as $carrera) : ?>
          <div class="card<?php $n; ?>" draggable="true" id="<?php echo $carrera['idCarrera']; ?>" data="<?php echo base_url('eliminarCarrera'); ?>" aria-required="<?php echo base_url('editarCarreras'); ?>">
            <img src="<?php echo $carrera['imagenCarrera']; ?>" alt="By AnisSoft" title="<?php echo $carrera['nombreCarrera']; ?>" />
            <div class="card-body">
              <h3 class="card-title"><?php echo $carrera['nombreCarrera']; ?></h3>
            </div>
          </div>
          <?php $n = $n + 1; ?>
        <?php endforeach; ?>
        <button type="button" class="abrirModal" data-target="añadirC">
          <ion-icon name="add-circle-outline"></ion-icon>
        </button>
        <div class="modal" id="añadirC">
          <div class="contenido-modal">
            <div class="head">
              <h3>Añadir Carreras</h3>
              <button class="cerrar">
                <ion-icon name="close-circle-outline"></ion-icon>
              </button>
            </div>
            <form action="<?php echo base_url('/crearCarrera') ?>" method="post" id="crear">
              <div class="celda">
                <label class="form-label">Universidad</label>
                <select name="idU">
                  <?php foreach ($unis as $uni) : ?>
                    <option value="<?php echo $uni['idU']; ?>"><?php echo $uni['nombreU']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="celda">
                <label class="form-label">Nombre de la carrera</label>
                <input name="nombreCarrera" type="text" class="form-control" placeholder="Nombre de la carrera">
              </div>
              <div class="celda">
                <label for="exampleFormControlTextarea1" class="form-label">Descripción de la carrera</label>
                <textarea class="form-control" rows="3" name="descripcionCarrera" placeholder="Descripción de la carrera"></textarea>
              </div>
              <div class="celda">
                <label class="form-label">Imagen de la carrera</label>
                <textarea class="form-control" rows="3" name="imagenCarrera" placeholder="Imagen de la carrera"></textarea>
              </div>
              <div class="añadir">
                <button type="submit" class="btn-modificar">Añadir nueva</button>
              </div>
            </form>
          </div>
        </div>
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
              <h3 class="card-title"><?php echo $materia['nombreMateria']; ?></h3>
            </div>
          </div>
          <?php $n = $n + 1; ?>
        <?php endforeach; ?>
        <button type="button" class="abrirModal" data-target="añadirM">
          <ion-icon name="add-circle-outline"></ion-icon>
        </button>
        <div class="modal" id="añadirM">
          <div class="contenido-modal">
            <div class="head">
              <h3>AÑADIR</h3>
              <button class="cerrar">
                <ion-icon name="close-circle-outline"></ion-icon>
              </button>
            </div>
            <form action="<?php echo base_url('/crearMateria') ?>" method="post" id="crear">
              <div class="celda">
                <label class="form-label">Carrera</label>
                <select class="form-select" name="idCarrera">
                  <?php foreach ($carreras as $carrera) : ?>
                    <option value="<?php echo $carrera['idCarrera']; ?>"><?php echo $carrera['nombreCarrera']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="celda">
                <label class="form-label">Nombre de la materia</label>
                <input name="nombreMateria" type="text" class="form-control" placeholder="Nombre de la materia">
              </div>
              <div class="celda">
                <label class="form-label">Descripción de la materia</label>
                <textarea class="form-control" rows="3" name="descripcionMateria" placeholder="Descripción de la materia"></textarea>
              </div>
              <div class="celda">
                <label class="form-label">Imagen de la materia</label>
                <textarea class="form-control" rows="3" name="imagenMateria" placeholder="Imagen de la materia"></textarea>
              </div>
              <div class="añadir">
                <button type="submit" class="btn-modificar">Añadir nueva</button>
              </div>
            </form>
          </div>
        </div>
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
              <h3 class="card-title"><?php echo $libro['nombreLibro']; ?></h3>
            </div>
          </div>
          <?php $n = $n + 1; ?>
        <?php endforeach; ?>
        <button type="button" class="abrirModal" data-target="añadirL">
          <ion-icon name="add-circle-outline"></ion-icon>
        </button>
        <div class="modal" id="añadirL">
          <div class="contenido-modal">
            <div class="head">
              <h3>AÑADIR</h3>
              <button class="cerrar">
                <ion-icon name="close-circle-outline"></ion-icon>
              </button>
            </div>
            <form action="<?php echo base_url('/crearLibro') ?>" method="post" id="crear">
              <div class="celda">
                <label for="exampleFormControlInput1" class="form-label">Materia</label>
                <select class="form-select" aria-label="Default select example" name="idMateria">
                  <?php foreach ($materias as $materia) : ?>
                    <option value="<?php echo $materia['idMateria']; ?>"><?php echo $materia['nombreMateria']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="celda">
                <label class="form-label">Nombre del libro</label>
                <input name="nombreLibro" type="text" class="form-control" placeholder="Nombre del libro">
              </div>
              <div class="celda">
                <label class="form-label">Descripción del libro</label>
                <textarea class="form-control" rows="3" name="descripcionLibro" placeholder="Descripción del libro"></textarea>
              </div>
              <div class="celda">
                <label class="form-label">Imagen del libro</label>
                <textarea class="form-control" rows="3" name="imagenLibro" placeholder="Imagen del libro"></textarea>
              </div>
              <div class="celda">
                <label class="form-label">Pdf del libro</label>
                <textarea class="form-control" rows="3" name="pdfLibro" placeholder="Pdf del libro"></textarea>
              </div>
              <div class="añadir">
                <button type="submit" class="btn-modificar">Añadir nuevo</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!--LIBROS-->
    <!--TEMARIOS, PREGUNTAS-->
    <!--TEMARIOS, PREGUNTAS-->
    <!--VIDEOS-->
    <!--VIDEOS-->
    <!--SECCIONES-->

    <div class="cambiar" title="Modificar">
    <h4>Modificar</h4>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
        <path d="M256 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V192h64V32zm320 0c0-17.7-14.3-32-32-32s-32 14.3-32 32V480c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM224 512c17.7 0 32-14.3 32-32V320H192V480c0 17.7 14.3 32 32 32zM320 0c-9.3 0-18.1 4-24.2 11s-8.8 16.3-7.5 25.5l31.2 218.6L288.6 409.7c-3.5 17.3 7.8 34.2 25.1 37.7s34.2-7.8 37.7-25.1l.7-3.6c1.3 16.4 15.1 29.4 31.9 29.4c17.7 0 32-14.3 32-32c0 17.7 14.3 32 32 32s32-14.3 32-32V32c0-17.7-14.3-32-32-32H320zM112 80A48 48 0 1 0 16 80a48 48 0 1 0 96 0zm0 261.3V269.3l4.7 4.7c9 9 21.2 14.1 33.9 14.1H224c17.7 0 32-14.3 32-32s-14.3-32-32-32H157.3l-41.6-41.6c-14.3-14.3-33.8-22.4-54-22.4C27.6 160 0 187.6 0 221.6v55.7l0 .9V480c0 17.7 14.3 32 32 32s32-14.3 32-32V384l32 42.7V480c0 17.7 14.3 32 32 32s32-14.3 32-32V421.3c0-10.4-3.4-20.5-9.6-28.8L112 341.3z" />
      </svg>
    </div>
    <div class="botar" title="Eliminar">
    <h4>Eliminar</h4>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
        <path d="M256 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 9.8c0 39-23.7 74-59.9 88.4C71.6 154.5 32 213 32 278.2V352c0 17.7 14.3 32 32 32s32-14.3 32-32l0-73.8c0-10 1.6-19.8 4.5-29L261.1 497.4c9.6 14.8 29.4 19.1 44.3 9.5s19.1-29.4 9.5-44.3L222.6 320H224l80 0 38.4 51.2c10.6 14.1 30.7 17 44.8 6.4s17-30.7 6.4-44.8l-43.2-57.6C341.3 263.1 327.1 256 312 256l-71.5 0-56.8-80.2-.2-.3c44.7-29 72.5-79 72.5-133.6l0-9.8zM96 80A48 48 0 1 0 0 80a48 48 0 1 0 96 0zM464 286.1l58.6 53.9c4.8 4.4 11.9 5.5 17.8 2.6s9.5-9 9-15.5l-5.6-79.4 78.7-12.2c6.5-1 11.7-5.9 13.1-12.2s-1.1-13-6.5-16.7l-65.6-45.1L603 92.2c3.3-5.7 2.7-12.8-1.4-17.9s-10.9-7.2-17.2-5.3L508.3 92.1l-29.4-74C476.4 12 470.6 8 464 8s-12.4 4-14.9 10.1l-29.4 74L343.6 68.9c-6.3-1.9-13.1 .2-17.2 5.3s-4.6 12.2-1.4 17.9l39.5 69.1-65.6 45.1c-5.4 3.7-8 10.3-6.5 16.7c.1 .3 .1 .6 .2 .8l19.4 0c20.1 0 39.2 7.5 53.8 20.8l18.4 2.9L383 265.3l36.2 48.3c2.1 2.8 3.9 5.7 5.5 8.6L464 286.1z" />
      </svg>
    </div>
    <!--MODIFICAR-->
    <div class="modal" id="modificar">
      <div class="contenido-modal">
        <div class="head">
          <h3>Modificar</h3>
          <button class="cerrar">
            <ion-icon name="close-circle-outline"></ion-icon>
          </button>
        </div>
        <form method="post" id="modificar">
          <div class="celda">
            <label class="form-label">¿Que componente desea modificar?</label>
            <input name="nombreLibro" type="text" class="form-control" placeholder="Nombre del libro">
          </div>
          <div class="añadir">
            <button type="submit" class="btn-modificar">Añadir nuevo</button>
          </div>
        </form>
      </div>
    </div>
    <!--MODIFICAR-->
    <!--ELIMINAR-->
    <div class="modal" id="eliminar">
      <div class="contenido-modal">
        <div class="head">
          <h3>Eliminar</h3>
          <button class="cerrar">
            <ion-icon name="close-circle-outline"></ion-icon>
          </button>
        </div>
        <form id="eliminar">
          <div class="celda">
            <label class="form-label">¿Está seguro que desea eliminar el componente?</label>
          </div>
          <div class="botones">
            <button type="submit" class="btn-eliminar">Eliminar</button>
          </div>
        </form>
      </div>
    </div>
    <!--ELIMINAR-->
  </main>
  <!--contenido-->
  <script src="<?php echo base_url(); ?>js/script.js"></script>

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
      $('#univInst').show();
    });

    function mostrarSeccion(seccion) {
      $(".seccion").hide();
      $("a").removeClass("active");
      $("#" + seccion).show();
      $("a[onclick=\"mostrarSeccion('" + seccion + "')\"]").addClass("active");
    }
  </script>
<script>
$(function() {
    $(".card").sortable({
        connectWith: ".card", // Permite conectar diferentes listas de tarjetas
        start: function(event, ui) {
            $(ui.item).data('original-value', $(ui.item).html()); // Guarda el valor original del elemento al comenzar el arrastre
        },
        receive: function(event, ui) {
            var element = $(ui.item);
            var groupName = $(this).attr('id'); // Obtiene el nombre del grupo al que se ha añadido la tarjeta
            element.attr('name', groupName); // Asigna el nombre del grupo como atributo 'name' de la tarjeta
            if (groupName === 'grupo1') { // Si la tarjeta se añade al grupo 'grupo1'
                var originalValue = element.data('original-value');
                element.html(originalValue); // Restaura el valor original del elemento
            }
        }
    }).disableSelection(); // Deshabilita la selección de texto mientras se arrastra
});
</script>

  <!--Botar-->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const cards = document.querySelectorAll(".card");
      const dropZone = document.querySelector(".botar");
      const id = cards.id;
      const urlP = cards.data;
      let draggedCard = null;
      cards.forEach(card => {
        card.addEventListener("dragstart", event => {
          draggedCard = card;
          const id = card.getAttribute('id');
          const urlP = card.getAttribute('data');

          draggedCard.dataset.draggedId = id;
          draggedCard.dataset.urlP = urlP;

          card.classList.add("dragging");
        });
      });
      dropZone.addEventListener("dragover", event => {
        event.preventDefault(); // Evita el comportamiento por defecto
      });
      dropZone.addEventListener("drop", event => {
        event.preventDefault();
        if (draggedCard) {
          const id = draggedCard.dataset.draggedId;
          const urlP = draggedCard.dataset.urlP;

          const eliminarModal = document.getElementById("eliminar");
          eliminarModal.style.display = "block";

          const eliminarBtn = document.querySelector(".btn-eliminar");
          eliminarBtn.addEventListener("click", function(event) {
            event.preventDefault();
            eliminarModal.style.display = "none";
            var temaData = {
              id: id,
            };
            console.log('Datos a enviar:', temaData);
            $.ajax({
              type: 'POST',
              url: urlP,
              data: temaData,
              success: function(response) {
                window.location.reload();
              }
            });
          });
          const cerrarBtn = document.querySelector(".cerrar");
          cerrarBtn.addEventListener("click", function() {
            // Ocultar el modal de eliminación
            eliminarModal.style.display = "none";
          });
        }
      });
      // Evento al finalizar el arrastre
      document.addEventListener("dragend", () => {
        cards.forEach(card => card.classList.remove("dragging"));
        draggedCard = null;
      });
    });
  </script>
  <!--Botar-->
  <!--Modificar-->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const cards = document.querySelectorAll(".card");
      const dropZone = document.querySelector(".cambiar");
      const id = cards.id;
      const urlP = cards.data;
      let draggedCard = null;
      cards.forEach(card => {
        card.addEventListener("dragstart", event => {
          draggedCard = card;
          const id = card.getAttribute('id');
          const urlP = card.getAttribute('data');

          draggedCard.dataset.draggedId = id;
          draggedCard.dataset.urlP = urlP;

          card.classList.add("dragging");
        });
      });
      dropZone.addEventListener("dragover", event => {
        event.preventDefault(); // Evita el comportamiento por defecto
      });
      dropZone.addEventListener("drop", event => {
        event.preventDefault();
        if (draggedCard) {
          const id = draggedCard.dataset.draggedId;
          const urlP = draggedCard.dataset.urlP;

          const eliminarModal = document.getElementById("eliminar");
          eliminarModal.style.display = "block";

          const eliminarBtn = document.querySelector(".btn-eliminar");
          eliminarBtn.addEventListener("click", function(event) {
            event.preventDefault();
            eliminarModal.style.display = "none";
            var temaData = {
              id: id,
            };
            console.log('Datos a enviar:', temaData);
            $.ajax({
              type: 'POST',
              url: urlP,
              data: temaData,
              success: function(response) {
                window.location.reload();
              }
            });
          });
          const cerrarBtn = document.querySelector(".cerrar");
          cerrarBtn.addEventListener("click", function() {
            // Ocultar el modal de eliminación
            eliminarModal.style.display = "none";
          });
        }
      });
      // Evento al finalizar el arrastre
      document.addEventListener("dragend", () => {
        cards.forEach(card => card.classList.remove("dragging"));
        draggedCard = null;
      });
    });
  </script>
</body>

</html>