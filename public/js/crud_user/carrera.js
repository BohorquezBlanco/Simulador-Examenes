$(document).ready(function () {
  var globalCarrData = 1; // Definir la variable global
  var globalUniData = 1; // Definir la variable global para la universidad

  //###################################################-CARRERA-#########################################################
  //---------------------------------SELECT CARRERA-------------------------------------------------
  function selecCarrera(globalUniData) {
    $("#selectCarrAjax").empty(); //BORRA TODO EL CONTENEDOR

    var uniData = {
      idU: globalUniData, // Crear un objeto con lo necesario
    };
    $.ajax({
      type: "POST",
      data: uniData,
      url: baseUrl + "carreraAjax",
      dataType: "json",
      success: function (response) {
        // Iterar sobre cada universidad y agregarlo al contenedor
        $.each(response, function (index, carrera) {
          //crear un objeto para pasarlo por data-universidad la cual será utilizada mas adelante.
          var carreraData = {
            idU: carrera.idU,
            idCarrera: carrera.idCarrera,
            nombreCarrera: carrera.nombreCarrera,
            descripcionCarrera: carrera.descripcionCarrera,
            imagenCarrera: carrera.imagenCarrera,
          };

          var carreraHTML = `
          <div class="card" id="carrera-${
            carrera.idCarrera
          }" data-carrera='${JSON.stringify(carreraData)}'>
          <img src="${carrera.imagenCarrera}" alt="By AnisSoft" title="${
            carrera.nombreCarrera
          }" />
          <div class="card-body">
            <h5 class="card-title">${carrera.nombreCarrera}</h5>
            <p>Presionar para ver materias</p>
          </div>
        </div>
          `;
          $("#selectCarrAjax").append(carreraHTML);
        });

        $(".card").click(function () {
          // Obtener el ID de la carrera del ID del card
          var idCarrera = $(this).attr('id').split('-')[1];
          
          // Ocultar la sección de carreras y mostrar la de materias
          $("#carrera").hide();
          $("#materia").show();
          
          // Cargar las materias correspondientes
          selecMateria(idCarrera);
        });
        
      },
    });
  }

  // Inicializa la carga de carreras con la universidad global
  selecCarrera(globalUniData);
});


function selecMateria(idCarrera) {
  $("#selectMatAjax").empty(); //BORRA TODO EL CONTENEDOR
  var carreraData = {
    idCarrera: idCarrera, // Usar el ID de la carrera proporcionado como argumento
  };
  $.ajax({
    type: "POST",
    data: carreraData,
    url: baseUrl + "materiaAjax",
    dataType: "json",
    success: function (response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, materia) {
        //crear un objeto para pasarlo por data-universidad la cual será utilizada mas adelante.
        var materiaData = {
          idCarrera: materia.idCarrera,
          idMateria: materia.idMateria,
          nombreMateria: materia.nombreMateria,
          descripcionMateria: materia.descripcionMateria,
          imagenMateria: materia.imagenMateria,
        };

        var materiaHTML = `
        <div class="card" id="materia-${materia.idMateria}" data-materia='${JSON.stringify(materiaData)}'>
          <img src="${materia.imagenMateria}" alt="By AnisSoft" title="${
          materia.nombreMateria
        }" draggable="false" />
          <div class="card-body">
            <h5 class="card-title">${materia.nombreMateria}</h5>
            <p>Para ver temarios, haga click aquí</p>
          </div>
        </div>
      `;
        $("#selectMatAjax").append(materiaHTML);
      });

      // Asignar evento de clic a las tarjetas de materia
      $(".card").click(function () {
        var materiaData = $(this).data("materia");
        var idMateria = materiaData.idMateria;
        // Ocultar la sección de materias y mostrar la de temarios
        $("#materia").hide();
        $("#temario").show();
        // Cargar los temarios correspondientes
        selecTemario(idMateria);
      });
    },
  });
}


function selecTemario(globalMateriaData) {
  $("#temarioMateria").empty(); // BORRA TODO EL CONTENEDOR
  var uniData = {
    idMateria: globalMateriaData, // Crear un objeto con lo necesario
  };
  $.ajax({
    type: "POST",
    url: baseUrl + "temarioMateria",
    data: uniData,
    dataType: "json",
    success: function (response) {
      console.log("Respuesta de temarioMateria:", response);
      $.each(response, function (index, temario) {
        // Crear un objeto para pasarlo por data-id-temario la cual será utilizada más adelante.
        var temarioHTML = `
          <li onclick="manejarClickT(this)" data-id-temario="${temario.idTemario}" data-libro-temario="${temario.libroTemario}">${temario.nombreTemario}</li>
        `;
        $("#temarioList").append(temarioHTML);

        // Mostrar los libros solo para el primer temario
        if (index === 0) {
          var libroHTML = `
            <p>Libros</p>
            <a href="${temario.libroTemario}" target="_blank">PDF</a>
          `;
          $("#lib").append(libroHTML);
        }
      });

      // Llamar a manejarClickT para el primer temario por defecto
      $("#temarioList li:first-child").each(function () {
        manejarClickT(this);
      });
    },
    error: function (xhr, status, error) {
      console.error("Error al obtener el temario:", error);
      // Opcional: Muestra un mensaje de error en la interfaz de usuario
      $("#lib").empty(); // Limpiar el contenedor del libro
      var errorHTML = `
        <p>Error al obtener el temario. Por favor, intenta de nuevo más tarde.</p>
      `;
      $("#lib").append(errorHTML);
    },
  });
}

function manejarClickT(li) {
  const idTemario = li.getAttribute("data-id-temario");
  const libroTemario = li.getAttribute("data-libro-temario");
  console.log("ID Temario seleccionado:", idTemario);
  console.log("Libro del temario seleccionado:", libroTemario);

  $("#lib").empty();
  var libroHTML = `
    <p>Libros</p>
    <a href="${libroTemario}" target="_blank">PDF</a>
  `;
  $("#lib").append(libroHTML);

  var uniData = {
    idTemario: idTemario
  };
  console.log("Datos para obtener temas:", uniData);

  $.ajax({
    type: "POST",
    url: baseUrl + "temaTemario",
    data: uniData,
    dataType: "json",
    success: function (response) {
      console.log("Respuesta de temaTemario:", response);
      $("#temas").empty(); 
      $.each(response, function (index, tema) {
        var temaHTML = `
        <li class="tema" data-id-tema="${tema.idTema}" data-video-tema="${tema.videoTema}" data-nombre-tema="${tema.nombreTema}">${tema.nombreTema}</li>
        `;
        $("#temas").append(temaHTML);
      });
      $(".tema").click(function () {

    // Ocultar la parte que quieres ocultar
    $(".contT").hide();

        // Mostrar el video del tema
        const videoTema = $(this).attr("data-video-tema");
        const nombreTema = $(this).attr("data-nombre-tema");
        
        $("#videoContainer").append(`
        <div>
            <iframe width="560" height="315" src="${videoTema}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <p>${nombreTema}</p>
        </div>
    `);
    

    // Mostrar solo el videoContainer
    $("#videoContainer").show();
      });
    },
    error: function (xhr, status, error) {
      console.error("Error al obtener los temas:", error);
    },
  });
}

