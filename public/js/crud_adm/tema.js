var idCarreraTema = null;
var idMateriaTema = null;
var nombreCarreraTema = '';
var nombreMateriaTema = '';
var nombreArea = null;

var globalTemaData = null; // Definir la variable global
var idTemario; // Variable global para almacenar el id del temario seleccionado

//########################################-AREA DE FILTROS-#############################################
  //---------------------------------- BOTONES DE LOS FILTROS PARA TEMAS--------------------------------
    //Carga el filtro de temas por Carrera y Materia
    var btnFiltrarTema = document.getElementById("btnFiltrarTema");
    btnFiltrarTema.addEventListener("click", function() {
      // accion a realizar una vez que se apreto :D
      $('#divFiltrosTema').empty();
      var filtroTema = 
      ` 
        <p class="center">Filtrar Pregunta Por Temarios </p>
        <div class="contSelect2">
          <!--Filtro donde aparecen todas las carreras-->
          <div class="" >
            <select class="selectCarreraT" name="selectCarreraT" >
              <option value="0">Carrera:</option>
            </select>
          </div>
          <!--Filtro donde aparecen todas las materias en base a carrera-->
          <div class="">
            <select class="selectMateriaT" name="selectMateriaT" >
              <option value="0">Materia:</option>
              <option value="huerfano">Temas huerfanos</option>
              <option value="allTemas">Todos los temas</option>
            </select>
          </div>
        </div> <br>
        <div class="centrarSearch">
          <input class="center" type="search">
          <label class="center" for="">Buscar</label>
        </div>
      `;
      $("#divFiltrosTema").append(filtroTema);
      AllCarrerasTema();
    });


    //Carga el filtro de temas por AREA
    var btnFiltrarPreguntaTemario = document.getElementById("btnFiltrarArea");
    btnFiltrarPreguntaTemario.addEventListener("click", function() {
      // accion a realizar una vez que se apreto :D
      $('#divFiltrosTema').empty();
      var filtroPregunta = 
      ` 
      <div class="">
        <select class="selectArea2" name="selectArea2" >
          <option value="0">Todos Los Temas:</option>
          <option value="Matemáticas">Matemáticas:</option>
          <option value="Química">Química:</option>
          <option value="Biología">Biología</option>
          <option value="Física">Física:</option>
          <option value="Economia">Economia:</option>
          <option value="Administración">Administración:</option>
          <option value="Contables">Contables:</option>
          <option value="Ingles">Ingles:</option>
        </select>
      </div>  <br> 
        <div class="centrarSearch">
          <input class="center" type="search">
          <label class="center" for="">Buscar</label>
        </div>
      `;
      $("#divFiltrosTema").append(filtroPregunta);
      });

  //--------------------------------------- MANIPULACION DE SELECTS TEMAS---------------------------------
    //Accion al realizar al seleccionar una carrera
    $(document).on("change", ".selectCarreraT", function(event) {
      idCarreraTema = $(this).val();
      nombreCarreraTema = $('.selectCarreraT option:selected').text(); // Obtiene el texto de la opción seleccionada
      nombreCarreraTema = nombreCarreraTema.substring(8); // Recorta las primeras 5 letras
      $("#tituloPreguntas").empty();
      $("#tituloPreguntas").append(nombreCarreraTema);

      CarrerasMateriaT(idCarreraTema);
    console.log(idCarreraTema);
    });

    //Accion al realizar al seleccionar una materia
    $(document).on("change", ".selectMateriaT", function(event) {
      idMateriaTema = $(this).val();
      nombreMateriaTema= $('.selectMateriaP option:selected').text(); // Obtiene el texto de la opción seleccionada
      nombreMateriaTema = nombreMateriaTema.substring(8); // Recorta las primeras 5 letras
      $("#tituloPreguntas").empty();
      $("#tituloPreguntas").append(nombreMateriaTema);
      tiposTemas();
    });

      //Accion para cargar dependiendo a lo que se seleccionó
      function tiposTemas()
      {
        if (idMateriaTema=="huerfano") 
        {
          //si marcamos en huerfanito entonces cargaremos la funcion para ver solo temas huerfanos
          MateriaTemasHuerfanosT();
        }
        else 
        {
          if (idMateriaTema=="allTemas") 
            {
            AllTemas2();
            } 
          else 
            {
              if(nombreArea!==null)
              {
                temasArea2(nombreArea);
              }
              else
              {
                MateriaTemasT(idMateriaTema);
              }
          
            }         
        }

      }

//########################################-SOLICITUDES AJAX-#############################################
  //Solicitud que devuelve todas las carreras
  function AllCarrerasTema() {
    $('.selectCarreraT').empty();//BORRA TODO EL CONTENEDOR
    $('.selectCarreraT').append('<option value="0">Carrera:</option>');
    $.ajax({
      type: 'POST',
      url: baseUrl+'allCarreras',
      dataType: 'json',
      success: function(response) {
        // Iterar sobre cada universidad y agregarlo al contenedor
        $.each(response, function (index, carrera) {
        //llenar el filtro
        var filtroCarrera = ` <option value="${carrera.idCarrera}">Carrera:${carrera.nombreCarrera}</option>`;
        $(".selectCarreraT").append(filtroCarrera);
      });

      },
      error: function(xhr, status, error) {
        // Manejar errores si es necesario
      }
    });
  }

  //Solicitud que devuelve todas las materias dependiendo al idCarrera enviado
  function CarrerasMateriaT(idCarrera) {
    $('.selectMateriaT').empty();//BORRA TODO EL CONTENEDOR
    $(".selectMateriaT").append('<option value="0">Materia:</option>');
  
    var uniData = {
      idCarrera: idCarrera, // Crear un objeto con lo necesario
    }; 
    $.ajax({
      type: 'POST',
      data: uniData,
      url: baseUrl+'materiaAjax',
      dataType: 'json',
      success: function(response) {
        // Iterar sobre cada universidad y agregarlo al contenedor
        $.each(response, function (index, materia) {
        //llenar el filtro
        var filtroMateria = ` <option value="${materia.idMateria}">Materia:${materia.nombreMateria}</option>`;
        $(".selectMateriaT").append(filtroMateria);
      });
      $(".selectMateriaT").append('<option value="huerfano" class="text-blue">Temas huerfanos</option>');
      $(".selectMateriaT").append('<option value="allTemas" class="text-blue">Todos los temas</option>');

      },
      error: function(xhr, status, error) {
        // Manejar errores si es necesario
      }
    });
  }

  //Solicitud que devuelve todos los temas dependiendo al idMateria enviada
  function MateriaTemasT(idMateria) {
    $('#temasTemario').empty();//BORRA TODO EL CONTENEDOR
    var uniData = {
      idMateria: idMateria, // Crear un objeto con lo necesario
    }; 
    $.ajax({
      type: 'POST',
      data: uniData,
      url: baseUrl+'temaCarrera',
      dataType: 'json',
      success: function(response) {
        // Iterar sobre cada universidad y agregarlo al contenedor
        $.each(response, function(index, tema) {

          // Todo el response lo enviamos a la funcion  tablaTema donde creamos la tabla
          var tablaTema = tableTemaCreate(tema);
          $("#temasTemario").append(tablaTema);
        });

      },
      error: function(xhr, status, error) {
        // Manejar errores si es necesario
      }
    });
  }

  //Solicitud que devuelve todos los temas que no estan involucrados con algun temario
  function MateriaTemasHuerfanosT() {
    $('#temasTemario').empty();//BORRA TODO EL CONTENEDOR

    $.ajax({
      type: 'POST',
      url: baseUrl+'temaCarreraHuerfanos',
      dataType: 'json',
      success: function(response) {
        // Iterar sobre cada universidad y agregarlo al contenedor
        $.each(response, function(index, tema) {
          // Todo el response lo enviamos a la funcion  tablaTema donde creamos la tabla
          var tablaTema = tableTemaCreate(tema);
          $("#temasTemario").append(tablaTema);
        });
      },
      error: function(xhr, status, error) {
        // Manejar errores si es necesario
      }
    });
  }

  //Solicitud que devuelve todos los temas existentes
  function AllTemas2() {
    console.log("estoy en all temas");
    $('#temasTemario').empty();//BORRA TODO EL CONTENEDOR

    $.ajax({
      type: 'POST',
      url: baseUrl+'allTemas',
      dataType: 'json',
      success: function(response) {
        // Iterar sobre cada universidad y agregarlo al contenedor
        $.each(response, function(index, tema) {
          // Todo el response lo enviamos a la funcion  tablaTema donde creamos la tabla
          var tablaTema = tableTemaCreate(tema);
          $("#temasTemario").append(tablaTema);
        });
      },
      error: function(xhr, status, error) {
        // Manejar errores si es necesario
      }
    });
  }


//###################################################-CRUD TEMA-#######################################################
  //--------------------------------------- CREATE TEMA----------------------------------------------------------------
  var btnAgregarTema = document.getElementById("btnAgregarTema");
  btnAgregarTema.addEventListener("click", function () {
    // 1.Eliminar Modal
    $("#contenidoModal").empty();
    // 2.Construir el contenido del modal
    var contenidoModal = 
      `
        <div class="head">
          <div class="left-section">
          <p>Agregar Tema</p>
          </div>
          <div class="right-section">
              <button class="cerrar">
                  <ion-icon name="close-circle-outline"></ion-icon>
              </button>
          </div>
        </div>
        <form id="agregarTema">
        <div class="celda">
          <label class="form-label">nombreTema</label>
          <input name="nombreTema" id="nombreTema" type="text" class="form-control" placeholder="Nombre del tema">
        </div>
        <div class="celda">
          <label class="form-label">DescripcionTema</label>
          <textarea  rows="3"  name="descripcionTema" id="descripcionTema" placeholder="DescripcionTema" ></textarea>
        </div>
        <div class="celda">
          <label class="form-label">Video Tema</label>
          <input name="videoTema" id="videoTema" type="text" class="form-control" placeholder="Nombre del tema">
        </div>
        <div class="celda">
          <label class="form-label">Area del Tema</label>
          <select name="temaArea">
            <option value="Matemáticas" selected>Matemáticas:</option>
            <option value="Química">Química</option>
            <option value="Física">Física</option>
            <option value="Biología">Biología</option>
            <option value="Economía">Economía</option>
            <option value="Administración">Administración</option>
            <option value="Contables">Contables</option>
            <option value="Ingles">Ingles</option>
          </select>
        </div>
        <div class="añadir">
          <button id="insertarTema" type="button" class="btn">Agregar</button>
        </div>
        </form>
      `;
    // 3. Agregar la creacion al modal :D
    $("#contenidoModal").append(contenidoModal);
    cerrarModal(); //Agrega la funcionalidad del boton de cerrar el modal
  });

  //Solicitud de insertar un tema al apretar el boton insertarTema que esta dentro de contenidoModal 
  $("#contenidoModal").on("click", "#insertarTema", function (event) {
    event.preventDefault(); // Evitar el envío del formulario por defecto
    // Serializar el formulario para obtener todos los valores de los inputs
    var formData = $("#agregarTema").serialize();

    // Realizar la solicitud AJAX para agregar la nueva universidad
    $.ajax({
      url: baseUrl + "crearTema",
      type: "POST",
      data: formData,
      success: function (response) {
        console.log("Tema agregado al temario:", response);
        // Realizar alguna accióaln adicional si es necesario
        MateriaTemasHuerfanosT();
        $("#modalBase").hide(); // Ocultar el modal
      },
      error: function (error) {
        console.error("Error al agregar al temario", error);
      },
    });
  });

  //--------------------------------------- UPDATE TEMAS ----------------------------------------------------------------
  $("#temasTemario").on("click", ".modificar", function () {
    var temarioDataString = $(this).attr("data-temasData");
    var temarioData = JSON.parse(temarioDataString);

    $("#contenidoModal").empty();
    var temarioHTML = `
    <div class="head">
      <div class="left-section">
        <p>Modificar Tema</p>
      </div>
      <div class="right-section">
        <button class="cerrar">
            <ion-icon name="close-circle-outline"></ion-icon>
        </button>
      </div>
    </div>
    <form id="modificarT">
      <div class="celda">
        <label class="form-label">Nombre del Tema</label>
        <input type="text" class="form-control" name="nombreTema" id="nombreTema" value="${temarioData.nombreTema}">
        <input type="hidden" class="form-control" name="idTema" id="idTema" value="${temarioData.idTema}">
      </div>
      <div class="celda">
        <label class="form-label">Contenido del Temario</label>
        <input type="text" class="form-control" name="descripcionTema" id="descripcionTema" value="${temarioData.descripcionTema}" >
      </div>
      <div class="celda">
        <label class="form-label">Libro del Temario</label>
        <input type="text" class="form-control" name="videoTema"  id="videoTema" value="${temarioData.videoTema}" >
      </div>
      <div class="celda">
        <label class="form-label">Area del Tema</label>
        <select name="temaArea">
          <option value="${temarioData.temaArea}" selected>${temarioData.temaArea}</option>
          <option value="Matemáticas">Matemáticas:</option>
          <option value="Química">Química</option>
          <option value="Física">Física</option>
          <option value="Economia">Economia</option>
          <option value="Administración">Administración</option>
          <option value="Contables">Contables</option>
          <option value="Ingles">Ingles</option>
        </select>
      </div>
      <div class="añadir">
        <button id="modificarTemaForm" type="submit" class="btn">Modificar Tema</button>
      </div>
    </form>
    `;
    $("#contenidoModal").append(temarioHTML);
    cerrarModal();
  });

  //Solicitud de modificar un tema al apretar el boton modificarTemaForm que esta dentro de contenidoModal 
  $("#contenidoModal").on("click", "#modificarTemaForm", function (event) {
    // Evitar el envío del formulario por defecto
    event.preventDefault();

    // Serializar el formulario para obtener todos los valores de los inputs
    var formData = $("#modificarT").serialize();

    console.log(formData);
    $.ajax({
      url: baseUrl + "modificarTema",
      type: "POST",
      data: formData,
      success: function (response) {
        console.log("Temario modificado con éxito:", response);
      
        // Realizar alguna acción adicional si es necesario
        tiposTemas();

        $("#modalBase").hide(); // Ocultar el modal
      },
      error: function (error) {
        console.error("Error al modificar el temario:", error);
      },
    });
  });

  //--------------------------------------- DELETE TEMAS ----------------------------------------------------------------
  $("#temasTemario").on("click", ".eliminar", function () {
    var temarioDataString = $(this).attr("data-temasData");
    var temarioData = JSON.parse(temarioDataString);
    $("#contenidoModal").empty();

    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--ESCRIBIR MODAL :D--!!!!!!!!!!!!!!!!!!!!!!!!
    var contenidoModal = `
        <div class="head">
          <div class="left-section">
          <p>Eliminar Tema</p>
          </div>
          <div class="right-section">
              <button class="cerrar">
                  <ion-icon name="close-circle-outline"></ion-icon>
              </button>
          </div>
        </div>
        <form id="eliminarTema">
        <input type="hidden" name="idTema" id="idTema" value="${temarioData.idTema}">
          <div class="celda">
              <label class="form-label">¿Está seguro que desea eliminar el temario: " ${
                temarioData.nombreTema
              }"?</label>
          </div>
        <br>
        </form>
        <div class="añadir">
          <button id="eliminarTema" type="button" class="btn">Eliminar Tema</button>
        </div>
        `;
    $("#contenidoModal").append(contenidoModal);

    cerrarModal();
  });

  $("#contenidoModal").on("click", "#eliminarTema", function (event) {
    event.preventDefault(); // Evitar el envío del formulario por defecto
    var formData = $("#eliminarTema").serialize();
    // Realizar la solicitud AJAX para eliminar la universidad
    $.ajax({
      url: baseUrl + "eliminarTema",
      type: "POST",
      data: formData, // Serializar el objeto a JSON
      success: function (response) {
        console.log("Tema eliminado con éxito:", response);
        // Realizar alguna acción adicional si es necesario      
        $("#modalBase").hide(); // Ocultar el modal
        tiposTemas();
      },
        error: function (error) {
        console.error("Error al eliminar el Tema:", error);
      },
    });
  });

//########################################-RELACION TEMA_TEMARIO -#######################################################
  //------------------------------ CREACION DE LOS FILTROS DE LA RELACION------------------------------------------------
  var btnAgregarTemaTemario = document.getElementById("btnAgregarTemaTemario");
  btnAgregarTemaTemario.addEventListener("click", function() {
  // accion a realizar una vez que se apreto :D
  $('#divFiltrosTema').empty();//BORRA TODO EL CONTENEDOR

  //FILTRO DE PREGUNTAS EN BASE A TEMAS
  var filtroPregunta = 
  ` 
  <p class="center">Añadir Temas a un temario</p>
  <div class="contSelect2">

  </div> <br>

  <div  class="row">
      <div class="columna center">
        <div class="contSelect2">
        <!--Filtro donde aparecen todas las carreras-->
        <div class="" >
          <select class="selectCarreraTemario" name="selectCarreraTemario" >
            <option value="0">Carrera:</option>
          </select>
        </div>
        <!--Filtro donde aparecen todas las materias en base a carrera-->
        <div class="">
          <select class="selectMateriaTemario" name="selectMateriaT" >
            <option value="0">Materia:</option>
          </select>
        </div>
        <div class="">
          <select class="selectTemarios" name="selectTemarios" >
            <option value="0">Temario:</option>
          </select>
        </div>
      </div> <br>
      <div class="centrarSearch">
        <input class="center" type="search">
        <label class="center" for="">Buscar</label>
      </div><br>
      <p id="nombreTemario" class="center">Temario:</p>
      <div id="caja1" class="caja">
      <!----------- <a href="#" class="boton">Geometria Plana</a>---->
      </div>
    </div>
    <div class="columna center">
    <br>
      <div class="">
        <select class="selectArea" name="selectArea" >
          <option value="0">Todos Los Temas:</option>
          <option value="Matemáticas">Matemáticas:</option>
          <option value="Química">Química:</option>
          <option value="Física">Física:</option>
          <option value="Economia">Economia:</option>
          <option value="Administración">Administración:</option>
          <option value="Contables">Contables:</option>
          <option value="Ingles">Ingles:</option>
        </select>
      </div>  <br> 
      <div class="centrarSearch">
      <input class="center" type="search">
      <label class="center" for="">Buscar</label>
    </div>
      <br>
      <p class="center">Temas Para filtrar</p>

      <div id="caja2" class="caja">

      </div>
    </div>
  </div>
  `;
  $("#divFiltrosTema").append(filtroPregunta);
  $('#temasTemario').empty();//BORRA TODO EL CONTENEDOR
  AllCarrerasTemario();

  });

  //-------------------------- DELETE AND CREATE RELACION TEMA_TEMARIO-----------------------------------------------------
  // Movimiento entre las cajas creadas en el boton "btnAgregarTemaTemario"
  $(document).on("click", ".boton", function() {
    // Verificar si se ha seleccionado un temario
    if (!idTemario) {
      $("#contenidoModal").empty();
      var temarioHTML = `
        <div class="head">
          <div class="left-section">
            <p>Modificar Temario</p>
          </div>
          <div class="right-section">
            <button class="cerrar">
                <ion-icon name="close-circle-outline"></ion-icon>
            </button>
          </div>
        </div>
        <form id="modificarT">
          <div class="celda">
            <label class="form-label">Tiene que elegir un temario primero</label>
          </div>
        </form>
        `;
      $("#contenidoModal").append(temarioHTML);
      $(".cerrar").on("click", function () {
        // Ocultar el modal al hacer clic en el botón de cerrar
        $("#modalBase").hide();
      });
      // Mostrar el modal después de que se haya construido completamente
      $("#modalBase").fadeIn();
          return; // Salir de la función si no se ha seleccionado un temario
    }
    
    var cajaActual = $(this).parent().attr("id");
    var idTema = $(this).find('input[name="idTema"]').val();
    var formData = {
      idTema: idTema, // Crear un objeto con lo necesario
      idTemario: idTemario, // Crear un objeto con lo necesario
    };
    if (cajaActual === "caja1") {
      $(this).appendTo("#caja2");
  //si va de caja 1 a caja 2
      $.ajax({
        url: baseUrl + "eliminarTemaTemario",
        type: "POST",
        data: formData, // Serializar el objeto a JSON
        success: function (response) {
          console.log("Tema eliminado con éxito:", response);
          // Realizar alguna acción adicional si es necesario
          $("#modalBase").hide(); // Ocultar el modal
        
        },
        error: function (error) {
          console.error("Error al eliminar el Tema:", error);
        },
      });
    } else {
      $(this).appendTo("#caja1");
      //si va de caja 2 a caja 1
      $.ajax({
        url: baseUrl + "agregarTemaTemario",
        type: "POST",
        data: formData, // Serializar el objeto a JSON
        success: function (response) {
          console.log("Tema agregado con éxito:", response);
          // Realizar alguna acción adicional si es necesario
          $("#modalBase").hide(); // Ocultar el modal
      
        },
        error: function (error) {
          console.error("Error al agregar el Tema:", error);
        },
      });
    }
  });


  //Muestra todas las carreras existentes
  function AllCarrerasTemario() {
    $('.selectCarreraTemario').empty();//BORRA TODO EL CONTENEDOR
    $('.selectCarreraTemario').append('<option value="0">Carrera:</option>');
    $.ajax({
      type: 'POST',
      url: baseUrl+'allCarreras',
      dataType: 'json',
      success: function(response) {
        // Iterar sobre cada universidad y agregarlo al contenedor
        $.each(response, function (index, carrera) {
        //llenar el filtro
        var filtroCarrera = ` <option value="${carrera.idCarrera}">Carrera:${carrera.nombreCarrera}</option>`;
        $(".selectCarreraTemario").append(filtroCarrera);
      });

      },
      error: function(xhr, status, error) {
        // Manejar errores si es necesario
      }
    });
  }

  //Muestras todas las materias dependiendo al idCarrera 
  function CarrerasMateriaTemario(idCarrera) {
    $('.selectMateriaTemario').empty();//BORRA TODO EL CONTENEDOR
    $(".selectMateriaTemario").append('<option value="0">Materia:</option>');
  
    var uniData = {
      idCarrera: idCarrera, // Crear un objeto con lo necesario
    }; 
    $.ajax({
      type: 'POST',
      data: uniData,
      url: baseUrl+'materiaAjax',
      dataType: 'json',
      success: function(response) {
        // Iterar sobre cada universidad y agregarlo al contenedor
        $.each(response, function (index, materia) {
        //llenar el filtro
        var filtroMateria = ` <option value="${materia.idMateria}">Materia:${materia.nombreMateria}</option>`;
        $(".selectMateriaTemario").append(filtroMateria);
      });
      },
      error: function(xhr, status, error) {
        // Manejar errores si es necesario
      }
    });
  }

  //Muestras todos los temarios que tiene la carrera 
  function materiaTemarioT(idMateria) {
    $('.selectTemarios').empty();//BORRA TODO EL CONTENEDOR
    $(".selectTemarios").append('<option value="0">Temario:</option>');
  
    var uniData = {
      idMateria: idMateria, // Crear un objeto con lo necesario
    }; 
    $.ajax({
      type: 'POST',
      data: uniData,
      url: baseUrl+'temarioMateria',
      dataType: 'json',
      success: function(response) {
        // Iterar sobre cada universidad y agregarlo al contenedor
        $.each(response, function (index, materia) {
        //llenar el filtro
        var filtroMateria = ` <option value="${materia.idTemario}">Temario:${materia.nombreTemario}</option>`;
        $(".selectTemarios").append(filtroMateria);
      });
      },
      error: function(xhr, status, error) {
        // Manejar errores si es necesario
      }
    });
  }

  //Muestras todos los temas que contiene el temario elegido
  function temasTemarios(idTemario) {
    $('#caja1').empty();//BORRA TODO EL CONTENEDOR 
    var uniData = {
      idTemario: idTemario, // Crear un objeto con lo necesario
    }; 
    $.ajax({
      type: 'POST',
      data: uniData,
      url: baseUrl+'temaTemario',
      dataType: 'json',
      success: function(response) {
        // Iterar sobre cada universidad y agregarlo al contenedor
        $.each(response, function (index, materia) {
        //llenar el filtro
        var filtroMateria = 
        `
        <a href="#" class="boton">
        ${materia.nombreTema}
        <input type="hidden" name="idTema" value="${materia.idTema}">
        </a>
        `;
        $("#caja1").append(filtroMateria);
      });
      },
      error: function(xhr, status, error) {
        // Manejar errores si es necesario
      }
    });
  }

  //Muestras todos los temas que contiene el temario elegido
  function temasArea(nombreArea){
    $('#caja2').empty();//BORRA TODO EL CONTENEDOR 
    var uniData = {
      nombreArea: nombreArea, // Crear un objeto con lo necesario
    }; 
    $.ajax({
      type: 'POST',
      data: uniData,
      url: baseUrl+'areaTema',
      dataType: 'json',
      success: function(response) {
        // Iterar sobre cada universidad y agregarlo al contenedor
        $.each(response, function (index, materia) {
        //llenar el filtro
        var filtroMateria = 
        `
        <a href="#" class="boton">
        ${materia.nombreTema}
        <input type="hidden" name="idTema" value="${materia.idTema}">
        </a>
        `;
        $("#caja2").append(filtroMateria);
      });
      },
      error: function(xhr, status, error) {
        // Manejar errores si es necesario
      }
    });
  }

  //SELECT CARRERA
  $(document).on("change", ".selectCarreraTemario", function(event) {
    idCarreraTema = $(this).val();

    nombreCarreraTema = $('.selectCarreraTemario option:selected').text(); // Obtiene el texto de la opción seleccionada

    nombreCarreraTema = nombreCarreraTema.substring(8); // Recorta las primeras 5 letras
    $("#tituloPreguntas").empty();
    $("#tituloPreguntas").append(nombreCarreraTema);

    CarrerasMateriaTemario(idCarreraTema);
  console.log(idCarreraTema);
  idTemario =null;
  });

  //SELECT MATERIA
  $(document).on("change", ".selectMateriaTemario", function(event) {
    idMateriaTema = $(this).val();
    nombreMateriaTema= $('.selectMateriaTemario option:selected').text(); // Obtiene el texto de la opción seleccionada
    nombreMateriaTema = nombreMateriaTema.substring(8); // Recorta las primeras 5 letras
    materiaTemarioT(idMateriaTema); 
    idTemario =null;
  });

  //SELECT TEMARIO
  $(document).on("change", ".selectTemarios", function(event) {
    idTemario = $(this).val();
    nombreTemario= $('.selectTemarios option:selected').text(); // Obtiene el texto de la opción seleccionada
    temasTemarios(idTemario);
    $("#nombreTemario").empty(); //;
    $("#nombreTemario").append(nombreTemario);

  });

  //SELECT AREAS
  $(document).on("change", ".selectArea", function(event) {
    nombreArea = $(this).val();
    temasArea(nombreArea);
  });

  //SELECT AREAS
  $(document).on("change", ".selectArea2", function(event) {
      nombreArea = $(this).val();
      temasArea2(nombreArea);

  });

  //Muestras todos los temas que contiene el area del tema
  function temasArea2(nombreArea){
    $('#temasTemario').empty();//BORRA TODO EL CONTENEDOR 
    var uniData = {
      nombreArea: nombreArea, // Crear un objeto con lo necesario
    }; 
    $.ajax({
      type: 'POST',
      data: uniData,
      url: baseUrl+'areaTema',
      dataType: 'json',
      success: function(response) {
        // Iterar sobre cada universidad y agregarlo al contenedor
        $.each(response, function (index, tema) {

          var temaData = {
            idTema: tema.idTema,
            nombreTema: tema.nombreTema,
            descripcionTema: tema.descripcionTema,
            videoTema: tema.videoTema,
            temaArea: tema.temaArea,
          };
        //llenar el filtro
        var filtroTema = `
        <tr>
        <td>${tema.nombreTema}</td>
        <td>${tema.descripcionTema}</td>
        <td>${tema.videoTema}</td>
        <td>${tema.temaArea}</td>
        <td><button class="modificar" data-temasData='${JSON.stringify(
          temaData
        )}'><i class="fa-solid fa-pen-to-square"></i></button></td>
        <td><button class="eliminar" data-temasData='${JSON.stringify(
          temaData
        )}'><i class="fa-solid fa-eraser"></i></button></td>
        </tr>`;
        $("#temasTemario").append(filtroTema);
      });
      },
      error: function(xhr, status, error) {
        // Manejar errores si es necesario
      }
    });
  }


//########################################-IMPRESIONES-#######################################################
  //Construccion de la tabla donde se muestran los temas existentes
  function tableTemaCreate(tema) {
    var temaData = {
      idTema: tema.idTema,
      nombreTema: tema.nombreTema,
      descripcionTema: tema.descripcionTema,
      videoTema: tema.videoTema,
      temaArea: tema.temaArea,
      idTemario: idTemario,
    };
  
    var tablaTema = `
    <tr>
      <td>${tema.nombreTema}</td>
      <td>${tema.descripcionTema}</td>
      <td>${tema.videoTema}</td>
      <td>${tema.temaArea}</td>
      <td><button class="modificar" data-temasData='${JSON.stringify(temaData)}'><i class="fa-solid fa-pen-to-square"></i></button></td>
      <td><button class="eliminar" data-temasData='${JSON.stringify(temaData)}'><i class="fa-solid fa-eraser"></i></button></td>
    </tr>`;
    
    return tablaTema;
  }
  