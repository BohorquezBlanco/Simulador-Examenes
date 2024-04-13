<?php helper('form'); ?>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> <!----ENLACE PARA USAR JQUERY----->
<style>
  .cont {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px;

  }
  .item {
    background-color: #f9f9f9;
    padding: 5px;
    margin-bottom: 5px;
    cursor: pointer;
  }
  input[type="text"] {
    width: 100%;
    padding: 5px;
    box-sizing: border-box;
  }
</style>

<div class="container-xxl">
  <div class="row">
    <h1 class="text-center m-2"><?php echo $idMateria ;?></h1>
      <div class="col-6 border mb-4 me-3">
        <h4 class="text-center m-2">CREACION DE TEMAS</h4>
          <form id="temaForm" class="row">
            <div class="col-6">
              <div class="mb-3">
                <input  id="nombreTema" name="nombreTema" type="text" class="form-control" placeholder="nombre Tema">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <textarea  class="form-control" id="descripcionTema" name="descripcionTema" rows="1" placeholder="Una descripcion breve" ></textarea>
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <textarea  class="form-control" id="pdfTema" name="pdfTema" rows="1" placeholder="PDF del tema" ></textarea>
              </div>
            </div>
            <div class="col-6 mb-4">
              <div class="mb-3">
                <button id="crearTemabtn" type="button" class="btn btn-primary col-12">Crear</button>
              </div>
            </div>
          </form>
            <h5 class="text-center">FILTRAR TEMA</h5>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <input type="text" id="searchtemas" class="form-control" placeholder="Buscar temas">
                </div>
            </div>
      </div>
    <div class="col-5 mb-4 row border">
      <h5 class="text-center m-2">TEMAS EXISTENTES</h5>
        <div class="overflow-auto" style="max-height: 250px;">
        
          <div class="row list-group" id="almacenTemas">
            <!----------AQUI SE CARGARA LOS TEMAS ESTO EN BASE A AJAX---------->

          </div>                 
        </div>
    </div>



    <!---COLUMNA 1---->
    <div class="col-6 bg-body-secondary me-2">
      <!--------------------------------INICIO DE FORMULARIO------------------------------------------------>
        <div class="col-12" style="max-height: 70vh; overflow-y: auto;">
            <h2 class="text-center">BANCO DE PREGUNTAS</h2>
            <div class="list-group col-12 p-2 border "  id="divOrigen">
                <h6>PREGUNTAS:</h6>
                <div id="bancoPreguntas" class="cont cont2"> 

                  <!----------TODO LO QUE ESTE DENTRO DEL ANCLA "a" se podra mover al otro contenedor---------->
         
                    

                </div>
            </div>
                    
        </div>
     
    </div>

    <!---COLUMNA 2---->
    <div class="col-5 ">
      <div class="row">
        <div class="list-group col-12 p-2 border">
          <div class="row mb-2">
            <!-- Button trigger modal -->
            <button type="button" class="btn bg-light col-11 ms-4 fs-5 mb-2" data-bs-toggle="modal" data-bs-target="#creacionPreguntaModal">
              Crear Pregunta
            </button>
            <!-- Modal -->
            <div class="modal fade" id="creacionPreguntaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  <form id="carreraForm" class="row">
                          <div class="col-6">
                            <div class="mb-3">
                            <label for="">Enunciado:</label>
                              <input  id="enunciado" type="text" class="form-control" placeholder="Enunciado de la preguntas">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">Formula:</label>
                              <input  id="formula" type="text" class="form-control" placeholder="Si tiene formula agregarla aqui">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">Grafico:</label>
                              <input  id="imagenPregunta" type="text" class="form-control" placeholder="Si tiene grafica agregarla como imagen aqui">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">a)</label>
                              <input  id="a" type="text" class="form-control" placeholder="inciso 'a'">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">b)</label>
                              <input  id="b" type="text" class="form-control" placeholder="inciso 'b'">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">c)</label>
                              <input  id="c" type="text" class="form-control" placeholder="inciso 'c'">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">d)</label>
                              <input  id="d" type="text" class="form-control" placeholder="inciso 'd'">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">e)</label>
                              <input  id="e" type="text" class="form-control" placeholder="inciso 'e'">
                            </div>
                          </div>
                          <div class="col-2  mb-1">
                            <label for="">Correcta:</label>
                            <select id="respuesta" name="respuesta"  class="form-select form-select-sm" aria-label="Small select example">
                              <option  value="a" selected>a)</option>
                              <option  value="b">b)</option>
                              <option value="c">c)</option>
                              <option  value="d">d)</option>
                              <option value="e">e)</option>
                            </select>
                          </div>
                          <div class="col-3  mb-1">
                            <label for="">Tema:</label>
                            <select id="selectTemas" name="temaAjax"  class="form-select form-select-sm" aria-label="Small select example">
                            <option selected>Materia:</option>
                            </select>
                          </div>
                          <div class="col-3  mb-1">
                            <label for="">Dificultad:</label>
                            <select id="dificultad" name="dificultad"  class="form-select form-select-sm" aria-label="Small select example">
                              <option  value="Muy Fasil" selected>Muy Fasil</option>
                              <option  value="Fasil">Fasil</option>
                              <option value="Moderada">Moderada</option>
                              <option  value="Dificil">Dificil</option>
                            </select>
                          </div>
                          <div class="col-4  mb-1">
                            <label for="">Es una pregunta de examen pasado?</label>
                            <select id="exPas" name="exPas"  class="form-select form-select-sm" aria-label="Small select example">
                              <option  value="NO" selected>NO</option>
                              <option  value="SI">SI</option>
                            </select>
                          </div>
                          <div class="col-12 mb-4">
                            <div class="mb-3">
                              <button id="crearPreguntabtn" type="button" class="btn btn-primary col-12">Crear Pregunta</button>
                            </div>
                          </div>
                        </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>


            <h5 class="text-center mt-2">FILTRAR PREGUNTA</h5>
            <div class="col-1">
              <label for="">Tema:</label>
            </div>
            <div  class="col-11">
              <input type="text" class="form-control" id="searchPreguntas">
            </div>

          </div>
                   
          <h5 class="text-center ">PREGUNTAS EXISTENTES</h5>
          <div class="overflow-auto mb-4" style="max-height: 250px;">
              <div id="almacenPreguntas" class="cont cont1">
                <!----------TODO LO QUE ESTE DENTRO DEL ANCLA "a" se podra mover al otro contenedor---------->
                <a href="#" class="list-group-item list-group-item-action tema">
                  <div class="row">
                      <div class="col-8">
                        <input class="tema-id col-11" type="hidden" value="">sdfsadf</input>
                      </div>
                      <div class="col-2">
                        <button type="button" class="btn btn-primary btn-danger">
                          Eliminar
                        </button>              
                      </div>
                      <div class="col-2">
                        <button type="button" class="btn btn-primary btn-success" >
                            Editar
                        </button>              
                      </div>
                  </div>
                </a>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>  
  </div>
</div>


<!-----------------COMIENZO MODAL PARA EDITAR ELIMINAR TEMAS PREGUNTAS ---------------->
    <!-- Modal -->
    <div class="modal fade" id="editarEliminarModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Tema</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="contenedorEditDelete">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>





<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- jQuery UI -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- jQuery UI Touch Punch -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>



<script>
$(function() {
  $(".cont").sortable({
    connectWith: ".cont",
    start: function(event, ui) {
      $(ui.item).data('original-value', $(ui.item).find('input').val());
    },
    receive: function(event, ui) {
      var inputPregunta = $(ui.item).find('.idPregunta');
      var inputMateria = $(ui.item).find('.idMateria');
      
      var valorPregunta = inputPregunta.val();
      var valorMateria = inputMateria.val();
      
      if ($(this).hasClass('cont1')) {
        console.log('Valor de pregunta agregado a contenedor 1:', valorPregunta);
        console.log('Valor de materia agregado a contenedor 1:', valorMateria);
        //Si se mueve a cont 1 va a ajax 
        var temaData = {
            idMateria: valorMateria,
            idPregunta: valorPregunta,
        };
        console.log("temaData:", temaData);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('deleteBancoPregunta'); ?>',
            data: temaData, 
            success: function(response) {
                console.log('Tema insertado correctamente:', response);
                $('#nombreTema, #descripcionTema, #pdfTema').val('');
                      },
            error: function(xhr, status, error) {
                console.error('Error al insertar el tema:', error);
            }
        });



      }
      
      if ($(this).hasClass('cont2')) {
        console.log('Valor de pregunta agregado a contenedor 2:', valorPregunta);
        console.log('Valor de materia agregado a contenedor 2:', valorMateria);
                //Si se mueve a cont 1 va a ajax 
        var temaData = {
            idMateria: valorMateria,
            idPregunta: valorPregunta,
          };
        console.log("temaData:", temaData);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('insertBancoPregunta'); ?>',
            data: temaData, 
            success: function(response) {
                console.log('Tema insertado correctamente:', response);
                $('#nombreTema, #descripcionTema, #pdfTema').val('');
                       },
            error: function(xhr, status, error) {
                console.error('Error al insertar el tema:', error);
            }
        });
      }
    }
  }).disableSelection();
});



$(document).ready(function() {
    // Cargar temas cuando se cargue la página por primera vez
    cargarTemas();
    // Cargar preguntas cuando se cargue la página por primera vez
    cargarPreguntas();
    BancoPreguntasMateria();
    var temasOptions = ''; // VARIABLE GLOBAL DE TEMAS PARA PODER USARLAS LUEGO 
    function cargarTemas() {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url('cargarTemas'); ?>',
            dataType: 'json',
            success: function(response) {
                $('#almacenTemas').empty(); // Limpiar el contenedor de temas
                // Iterar sobre cada tema y agregarlo al contenedor
                $.each(response, function(index, tema) {
                    var temaHTML = `
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="tema-container">
                                <div class="row">
                                    <div class="col-8">
                                        <p>${tema.nombreTema}</p>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-primary btn-danger eliminarTemaBtn"  data-bs-toggle="modal" data-bs-target="#editarEliminarModal">
                                            Eliminar
                                        </button>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-success editarTemaBtn" data-bs-toggle="modal" data-bs-target="#editarEliminarModal">
                                            Editar
                                        </button>
                                    </div>
                                </div>
                                <div class="tema-details" style="display: none;">
                                    <input type="hidden" class="idTema" value="${tema.idTema}">
                                    <input type="hidden" class="nombreTema" value="${tema.nombreTema}">
                                    <input type="hidden" class="pdfTema" value="${tema.pdfTema}">
                                    <input type="hidden" class="descripcionTema" value="${tema.descripcionTema}">
                                </div>
                            </div>
                        </a>`;
                        $('#almacenTemas').append(temaHTML);
                // Agregar el tema como opción al select y almacenar en la variable global
                temasOptions += `<option value="${tema.idTema}">${tema.nombreTema}</option>`;
            });
                       // Agregar las opciones de temas al select fuera del bucle
                       $('#selectTemas').html('<option selected>Materia:</option>' + temasOptions);
        },
            error: function(xhr, status, error) {
                console.error('Error al cargar los temas:', error);
            }
        });
    }
  
    // Cargar preguntas cuando se cargue la página por primera vez
    function cargarPreguntas() {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url('cargarPreguntas/'.$idMateria);?>',
            dataType: 'json',
            success: function(response) {
                $('#almacenPreguntas').empty(); // Limpiar el contenedor de temas

                // Iterar sobre cada tema y agregarlo al contenedor
                $.each(response, function(index, pregunta) {
                    var preguntaHTML = `
                <!----------TODO LO QUE ESTE DENTRO DEL ANCLA "a" se podra mover al otro contenedor---------->
                <a href="#" class="list-group-item list-group-item-action tema">
                  <div class="row pregunta-container">
                      <div class="col-8">
                      <p>${pregunta.enunciado}</p>
                        <input class="tema-id col-11" type="hidden" value="${pregunta.idPregunta}">
                      </div>
                      <div class="col-2">
                        <button type="button" class="btn btn-primary btn-danger eliminarPreguntaBtn" data-bs-toggle="modal" data-bs-target="#editarEliminarModal">
                          Eliminar
                        </button>              
                      </div>
                      <div class="col-2">
                        <button type="button" class="btn btn-primary btn-success editarPreguntaBtn"  data-bs-toggle="modal" data-bs-target="#editarEliminarModal">
                            Editar
                        </button>              
                      </div>

                      <div class="tema-details" style="display: none;">
                      <input type="hidden" class="idMateria" value="<?php echo $idMateria;?>">
                        <input type="hidden" class="idPregunta" value="${pregunta.idPregunta}">
                        <input type="hidden" class="enunciado" value="${pregunta.enunciado}">
                        <input type="hidden" class="formula" value="${pregunta.formula}">
                        <input type="hidden" class="imagenPregunta" value="${pregunta.imagenPregunta}">
                        <input type="hidden" class="a" value="${pregunta.a}">
                        <input type="hidden" class="b" value="${pregunta.b}">
                        <input type="hidden" class="c" value="${pregunta.c}">
                        <input type="hidden" class="d" value="${pregunta.d}">
                        <input type="hidden" class="e" value="${pregunta.e}">
                        <input type="hidden" class="respuesta" value="${pregunta.respuesta}">
                        <input type="hidden" class="idTema" value="${pregunta.idTema}">
                        <input type="hidden" class="nombreTema" value="${pregunta.nombreTema}">
                        <input type="hidden" class="exPas" value="${pregunta.exPas}">
                        <input type="hidden" class="dificultad" value="${pregunta.dificultad}">
                      </div>
                  </div>
                </a>`;
                    $('#almacenPreguntas').append(preguntaHTML);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar los temas:', error);
            }
        });
    }



    // Función para filtrar los temas en función del texto de búsqueda
    $('#searchtemas').on('input', function() {
        var searchText = $(this).val().trim().toLowerCase();
        
        $('#almacenTemas .list-group-item').each(function() {
            var temaText = $(this).find('.tema-container .col-8 p').text().trim().toLowerCase();
            
            if (temaText.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Función para filtrar los temas en función del texto de búsqueda
    $('#searchPreguntas').on('input', function() {
      var searchText = $(this).val().trim().toLowerCase();  
      $('#almacenPreguntas .list-group-item').each(function() {
            var temaText = $(this).find('.pregunta-container .col-8 p').text().trim().toLowerCase();
    
            if (temaText.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    
    
//##########################################-----INICIO DE CRUD DE TEMAS-----#################################################################################3
    // Evento para crear un nuevo tema
    $('#crearTemabtn').click(function() {
        var nombreTema = $('#nombreTema').val();
        var descripcionTema = $('#descripcionTema').val();
        var pdfTema = $('#pdfTema').val();

        var temaData = {
            nombreTema: nombreTema,
            descripcionTema: descripcionTema,
            pdfTema: pdfTema
        };

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('crearTema'); ?>',
            data: temaData, 
            success: function(response) {
                console.log('Tema insertado correctamente:', response);
                $('#nombreTema, #descripcionTema, #pdfTema').val('');
                cargarTemas(); // Recargar la lista de temas
            },
            error: function(xhr, status, error) {
                console.error('Error al insertar el tema:', error);
            }
        });
    });

    // Delegar el evento click de editarTemaBtn para poder editar
    $('#almacenTemas').on('click', '.editarTemaBtn', function() {
        var temaContainer = $(this).closest('.tema-container');
        var idTema = temaContainer.find('.idTema').val();
        var nombreTema = temaContainer.find('.nombreTema').val();
        var pdfTema = temaContainer.find('.pdfTema').val();
        var descripcionTema = temaContainer.find('.descripcionTema').val();

      //Idea de agregar temas a un div para usar solo 1 modal
      $('#contenedorEditDelete').empty();

      var preguntaHTML = `
          <form id="editarTemaform" class="row">
            <div class="col-6">
              <div class="mb-3">
           
                <!---idTEMA EDITAR ---->
                <input type="hidden" id="idTemaEditar" value="${idTema}">
                <!---nombreTEMA EDITAR ---->
                <input id="nombreTemaEditar"  value="${nombreTema}" name="nombreTemaEdit" type="text" class="form-control" placeholder="nombre Tema">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <textarea  class="form-control" id="descripcionTemaEditar" name="descripcionTemaEdit" rows="1" placeholder="Una descripcion breve" >${descripcionTema}</textarea>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <textarea  class="form-control" id="pdfTemaEditar" name="pdfTemaEdit" rows="1" placeholder="PDF del tema" >${pdfTema}</textarea>
              </div>
            </div>
            <div class="col-12 mb-4">
              <div class="mb-3" id="btnEditElim">
                <button id="editarTemabtn" type="button" class="btn btn-success col-12" data-bs-dismiss="modal">Editar</button>
              </div>
            </div>
          </form>`;
      $('#contenedorEditDelete').append(preguntaHTML);
    });

    // Evento para editar un tema
    $('#contenedorEditDelete').on('click', '#editarTemabtn', function() {
        var idTemaEditar = $('#idTemaEditar').val();
        var nombreTemaEditar = $('#nombreTemaEditar').val();
        var descripcionTemaEditar = $('#descripcionTemaEditar').val();
        var pdfTemaEditar = $('#pdfTemaEditar').val();

        var temaData = {
            idTema: idTemaEditar,
            nombreTema: nombreTemaEditar,
            descripcionTema: descripcionTemaEditar,
            pdfTema: pdfTemaEditar
        };

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('editarTema'); ?>',
            data: temaData,
            success: function(response) {
                cargarTemas(); // Recargar la lista de temas
            },
            error: function(xhr, status, error) {
                console.error('Error al editar el tema:', error);
            }
        });
    });

    // Delegar el evento click de eliminarTemaBtn para poder eliminar
    $('#almacenTemas').on('click', '.eliminarTemaBtn', function() {
        var temaContainer = $(this).closest('.tema-container');
        var idTema = temaContainer.find('.idTema').val();
        var nombreTema = temaContainer.find('.nombreTema').val();
        var descripcionTema = temaContainer.find('.descripcionTema').val();

      //Idea de agregar temas a un div para usar solo 1 modal
      $('#contenedorEditDelete').empty();

      var preguntaHTML = `
          <form id="eliminarTemaform" class="row">
            <div class="col-6">
              <div class="mb-3"> 
                <!---idTEMA ELIMINAR ---->
                <input type="text" id="idTemaEliminar" value="${idTema}">
                <input type="text" id="nombreTemaEliminar" value="${nombreTema}">
                <input type="text" id="descripcionTemaEliminar" value="${descripcionTema}">
                <!---nombreTEMA ELIMINAR ---->
                <p class="col-12 fs-4">${nombreTema}</p>
                <p class="col-12">${descripcionTema}</p>
              </div>
            </div>
            <div class="col-12 mb-4">
              <div class="mb-3" id="btnEliminar">
                <button id="eliminarTemabtn" type="button" class="btn btn-danger col-12" data-bs-dismiss="modal">Eliminar</button>
              </div>
            </div>
          </form>`;
      $('#contenedorEditDelete').append(preguntaHTML);
    });

    // Evento para eliminar un tema de forma logica
    $('#contenedorEditDelete').on('click', '#eliminarTemabtn', function() {
        var idTemaEliminar = $('#idTemaEliminar').val();
        var nombreTemaEliminar = $('#nombreTemaEliminar').val();
        var descripcionTemaEliminar = $('#descripcionTemaEliminar').val();

        var temaData = {
            idTema: idTemaEliminar,
            nombreTema: nombreTemaEliminar,
            descripcionTema: descripcionTemaEliminar,
        };
        
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('eliminarTema'); ?>',
            data: temaData,
            success: function(response) {
                cargarTemas(); // Recargar la lista de temas
            },
            error: function(xhr, status, error) {
                console.error('Error al editar el tema:', error);
            }
        });
    });



//##########################################-----INICIO DE CRUD DE PREGUNTA-----#################################################################################3
    
    // Evento para crear una nueva PREGUNTA
    $('#crearPreguntabtn').click(function() {
        var enunciado = $('#enunciado').val();
        var formula = $('#formula').val();
        var imagenPregunta = $('#imagenPregunta').val();
        var a = $('#a').val();
        var b = $('#b').val();
        var c = $('#c').val();
        var d = $('#d').val();
        var e = $('#e').val();
        var respuesta = $('#respuesta').val();
        var idTema = $('#selectTemas').val();
        var exPas = $('#exPas').val();
        var dificultad = $('#dificultad').val();

        // Mostrar los valores que se van a enviar
        console.log('Datos del tema a enviar:', {
            enunciado: enunciado,
            formula: formula,
            imagenPregunta: imagenPregunta,
            a: a,
            b: b,
            c: c,
            d: d,
            e: e,
            respuesta: respuesta,
            idTema: idTema,
            exPas: exPas,
            dificultad: dificultad,
        });

        var temaData = {
            enunciado: enunciado,
            formula: formula,
            imagenPregunta: imagenPregunta,
            a: a,
            b: b,
            c: c,
            d: d,
            e: e,
            respuesta: respuesta,
            idTema: idTema,
            exPas: exPas,
            dificultad: dificultad,
        };

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('crearPregunta'); ?>',
            data: temaData, 
            success: function(response) {
                console.log('Pregunta insertada correctamente:', response);
                // Limpiar los campos del formulario después de insertar la pregunta
                $('#enunciado, #formula, #imagenPregunta, #a, #b, #c, #d, #e, #respuesta, #exPas, #dificultad').val('');
                cargarPreguntas(); // Recargar la lista de preguntas
            },
            error: function(xhr, status, error) {
                console.error('Error al insertar el tema:', error);
            }
        });
    });

    // Delegar el evento click de "EDITAR" UNA PREGUNTA
    $('#almacenPreguntas').on('click', '.editarPreguntaBtn', function() {
        var preguntaContainer = $(this).closest('.pregunta-container'); //agarrar la clase pregunta container
        var idPregunta = preguntaContainer.find('.idPregunta').val();
        var enunciado = preguntaContainer.find('.enunciado').val();
        var formula = preguntaContainer.find('.formula').val();
        var imagenPregunta = preguntaContainer.find('.imagenPregunta').val();
        var a = preguntaContainer.find('.a').val();
        var b =  preguntaContainer.find('.b').val();
        var c =  preguntaContainer.find('.c').val();
        var d =  preguntaContainer.find('.d').val();
        var e =  preguntaContainer.find('.e').val();
        var respuesta =  preguntaContainer.find('.respuesta').val();
        var idTema =  preguntaContainer.find('.idTema').val();
        var nombreTema =  preguntaContainer.find('.nombreTema').val();
        var exPas =  preguntaContainer.find('.exPas').val();
        var dificultad =  preguntaContainer.find('.dificultad').val();

      //Idea de agregar temas a un div para usar solo 1 modal
      $('#contenedorEditDelete').empty();

      var preguntaHTML = `
                      <form id="carreraForm" class="row">
                      <input type="hidden" id="idPreguntaEditar" value="${idPregunta}">
                          <div class="col-6">
                            <div class="mb-3">
                            <label for="">Enunciado:</label>
                              <input value="${enunciado}"  id="enunciadoEditar" type="text" class="form-control" placeholder="Enunciado de la preguntas">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">Formula:</label>
                              <input value="${formula}" id="formulaEditar" type="text" class="form-control" placeholder="Si tiene formula agregarla aqui">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">Grafico:</label>
                              <input value="${imagenPregunta}"  id="imagenPreguntaEditar" type="text" class="form-control" placeholder="Si tiene grafica agregarla como imagen aqui">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">a)</label>
                              <input value="${a}" id="aEditar" type="text" class="form-control" placeholder="inciso 'a'">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">b)</label>
                              <input value="${b}"  id="bEditar" type="text" class="form-control" placeholder="inciso 'b'">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">c)</label>
                              <input value="${c}" id="cEditar" type="text" class="form-control" placeholder="inciso 'c'">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">d)</label>
                              <input value="${d}"  id="dEditar" type="text" class="form-control" placeholder="inciso 'd'">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">e)</label>
                              <input value="${e}" id="eEditar" type="text" class="form-control" placeholder="inciso 'e'">
                            </div>
                          </div>
                          <div class="col-6  mb-1">
                            <label for="">Correcta:</label>
                            <select id="respuestaEditar" name="respuesta"  class="form-select form-select-sm" aria-label="Small select example">
                              <option  value="${respuesta}" selected>${respuesta}</option>
                              <option  value="${a}">a)</option>
                              <option  value="${b}">b)</option>
                              <option value="${c}">c)</option>
                              <option  value="${d}">d)</option>
                              <option value="${e}">e)</option>
                            </select>
                          </div>
                          <div class="col-6  mb-1">
                            <label for="">Dificultad:</label>
                            <select id="dificultadEditar" name="dificultad"  class="form-select form-select-sm" aria-label="Small select example">
                              <option  value="${dificultad}" selected>${dificultad}</option>
                              <option  value="Muy Fasil">Muy Fasil</option>
                              <option  value="Fasil">Fasil</option>
                              <option value="Moderada">Moderada</option>
                              <option  value="Dificil">Dificil</option>
                            </select>
                          </div>
                          <div class="col-6  mb-1">
                            <label for="">Es una pregunta de examen pasado?</label>
                            <select id="exPasEditar" name="exPas"  class="form-select form-select-sm" aria-label="Small select example">
                              <option  value="${exPas}" selected>${exPas}</option>
                              <option  value="NO">NO</option>
                              <option  value="SI">SI</option>
                            </select>
                          </div>
                          <div class="col-6  mb-1">
                            <label for="">Tema seleccionado:</label>
                            <select id="selectTemasEditar" name="temaAjax"  class="form-select form-select-sm" aria-label="Small select example">
                            <option  value="${idTema}">${nombreTema}</option>
                            `+temasOptions+`
                            </select>
                          </div>
                          <div class="col-12 mb-4">
                            <div class="mb-3">
                            <button id="editarPreguntabtn" type="button" class="btn btn-success col-12" data-bs-dismiss="modal">Editar</button>
                            </div>
                          </div>
  
                    </form>`;
      $('#contenedorEditDelete').append(preguntaHTML);
    });

    // Evento para "EDITAR" UNA PREGUNTA
    $('#contenedorEditDelete').on('click', '#editarPreguntabtn', function() {

        var idPreguntaEditar = $('#idPreguntaEditar').val();
        var enunciadoEditar = $('#enunciadoEditar').val();
        var formulaEditar = $('#formulaEditar').val();
        var imagenPreguntaEditar = $('#imagenPreguntaEditar').val();
        var aEditar = $('#aEditar').val();
        var bEditar =  $('#bEditar').val();
        var cEditar =  $('#cEditar').val();
        var dEditar =  $('#dEditar').val();
        var eEditar =  $('#eEditar').val();
        var respuestaEditar =  $('#respuestaEditar').val();
        var idTemaEditar =  $('#selectTemasEditar').val();
        var exPasEditar =  $('#exPasEditar').val();
        var dificultadEditar =  $('#dificultadEditar').val();

        var temaData = {
            idPregunta: idPreguntaEditar,
            enunciado: enunciadoEditar,
            formula: formulaEditar,
            imagenPregunta: imagenPreguntaEditar,
            a: aEditar,
            b: bEditar,
            c: cEditar,
            d: dEditar,
            e: eEditar,
            respuesta: respuestaEditar,
            idTema: idTemaEditar,
            exPas: exPasEditar,
            dificultad: dificultadEditar,
        };

        console.log('Datos a enviar:', temaData);

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('editarPregunta');?>',
            data: temaData,
            success: function(response) {
                cargarPreguntas(); // Recargar la lista de temas
                BancoPreguntasMateria(); // Recargar la lista de temas

            },
            error: function(xhr, status, error) {
                console.error('Error al editar el tema:', error);
            }
        });
    });


    // Delegar el evento click de "ELIMINAR" UNA PREGUNTA
    $('#almacenPreguntas').on('click', '.eliminarPreguntaBtn', function() {
        var preguntaContainer = $(this).closest('.pregunta-container'); //agarrar la clase pregunta container
        var idPregunta = preguntaContainer.find('.idPregunta').val();
        var enunciado = preguntaContainer.find('.enunciado').val();
        var formula = preguntaContainer.find('.formula').val();
        var imagenPregunta = preguntaContainer.find('.imagenPregunta').val();
      //Idea de agregar temas a un div para usar solo 1 modal
      $('#contenedorEditDelete').empty();

      var preguntaHTML = `
                    <form id="preguntaForm" class="row">
                      <input type="hidden" id="idPreguntaEliminar" value="${idPregunta}">
                        <div class="col-12 mb-4">
                          <p class="col-12">Enunciado: ${enunciado}</p>
                          <p class="col-12">Formula: ${formula}</p>
                          <p class="col-12">Grafico: ${imagenPregunta}</p>
                        </div>

                        <div class="col-12 mb-4">
                          <div class="mb-3">
                            <button id="eliminarPreguntabtn" type="button" class="btn btn-danger col-12" data-bs-dismiss="modal">Eliminar</button>
                          </div>
                        </div>
                    </form>`;
      $('#contenedorEditDelete').append(preguntaHTML);
    });

    // Evento para "ELIMINAR" UNA PREGUNTA
    $('#contenedorEditDelete').on('click', '#eliminarPreguntabtn', function() {

        var idPreguntaEliminar = $('#idPreguntaEliminar').val();

        var temaData = {
            idPregunta: idPreguntaEliminar,
        };

        console.log('Datos a enviar:', temaData);

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('eliminarPregunta');?>',
            data: temaData,
            success: function(response) {
                cargarPreguntas(); // Recargar la lista de temas
            },
            error: function(xhr, status, error) {
                console.error('Error al editar el tema:', error);
            }
        });
    });

//##########################################-----BANCO DE PREGUNTAS-----#################################################################################
    // Cargar preguntas cuando se cargue la página por primera vez
    function BancoPreguntasMateria() {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url('BancoPreguntasMateria/'.$idMateria);?>',
            dataType: 'json',
            success: function(response) {
                $('#bancoPreguntas').empty(); // Limpiar el contenedor de temas

                // Iterar sobre cada tema y agregarlo al contenedor
                $.each(response, function(index, pregunta) {
                    var preguntaHTML = `
                <!----------TODO LO QUE ESTE DENTRO DEL ANCLA "a" se podra mover al otro contenedor---------->
                <a href="#" class="list-group-item list-group-item-action tema">
                  <div class="row pregunta-container">
                      <div class="col-8">
                      <p>${pregunta.enunciado}</p>
         
                      </div>
                      <div class="col-2">
                        <button type="button" class="btn btn-primary btn-danger eliminarPreguntaBtn" data-bs-toggle="modal" data-bs-target="#editarEliminarModal">
                          Eliminar
                        </button>              
                      </div>
                      <div class="col-2">
                        <button type="button" class="btn btn-primary btn-success editarPreguntaBtn"  data-bs-toggle="modal" data-bs-target="#editarEliminarModal">
                            Editar
                        </button>              
                      </div>

                      <div class="tema-details" style="display: none;">
                      <input type="hidden" class="idMateria" value="${pregunta.idMateria}">
                        <input type="hidden" class="idPregunta" value="${pregunta.idPregunta}">
                        <input type="hidden" class="enunciado" value="${pregunta.enunciado}">
                        <input type="hidden" class="formula" value="${pregunta.formula}">
                        <input type="hidden" class="imagenPregunta" value="${pregunta.imagenPregunta}">
                        <input type="hidden" class="a" value="${pregunta.a}">
                        <input type="hidden" class="b" value="${pregunta.b}">
                        <input type="hidden" class="c" value="${pregunta.c}">
                        <input type="hidden" class="d" value="${pregunta.d}">
                        <input type="hidden" class="e" value="${pregunta.e}">
                        <input type="hidden" class="respuesta" value="${pregunta.respuesta}">
                        <input type="hidden" class="idTema" value="${pregunta.idTema}">
                        <input type="hidden" class="nombreTema" value="${pregunta.nombreTema}">
                        <input type="hidden" class="exPas" value="${pregunta.exPas}">
                        <input type="hidden" class="dificultad" value="${pregunta.dificultad}">
                      </div>
                  </div>
                </a>`;
                    $('#bancoPreguntas').append(preguntaHTML);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar los temas:', error);
            }
        });
    }

    // Delegar el evento click de "EDITAR" UNA PREGUNTA DEL BANCO DE PREGUNTAS
    $('#bancoPreguntas').on('click', '.editarPreguntaBtn', function() {
        var preguntaContainer = $(this).closest('.pregunta-container'); //agarrar la clase pregunta container
        var idPregunta = preguntaContainer.find('.idPregunta').val();
        var enunciado = preguntaContainer.find('.enunciado').val();
        var formula = preguntaContainer.find('.formula').val();
        var imagenPregunta = preguntaContainer.find('.imagenPregunta').val();
        var a = preguntaContainer.find('.a').val();
        var b =  preguntaContainer.find('.b').val();
        var c =  preguntaContainer.find('.c').val();
        var d =  preguntaContainer.find('.d').val();
        var e =  preguntaContainer.find('.e').val();
        var respuesta =  preguntaContainer.find('.respuesta').val();
        var idTema =  preguntaContainer.find('.idTema').val();
        var nombreTema =  preguntaContainer.find('.nombreTema').val();
        var exPas =  preguntaContainer.find('.exPas').val();
        var dificultad =  preguntaContainer.find('.dificultad').val();

      //Idea de agregar temas a un div para usar solo 1 modal
      $('#contenedorEditDelete').empty();

      var preguntaHTML = `
                      <form id="carreraForm" class="row">
                      <input type="hidden" id="idPreguntaEditar" value="${idPregunta}">
                          <div class="col-6">
                            <div class="mb-3">
                            <label for="">Enunciado:</label>
                              <input value="${enunciado}"  id="enunciadoEditar" type="text" class="form-control" placeholder="Enunciado de la preguntas">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">Formula:</label>
                              <input value="${formula}" id="formulaEditar" type="text" class="form-control" placeholder="Si tiene formula agregarla aqui">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">Grafico:</label>
                              <input value="${imagenPregunta}"  id="imagenPreguntaEditar" type="text" class="form-control" placeholder="Si tiene grafica agregarla como imagen aqui">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">a)</label>
                              <input value="${a}" id="aEditar" type="text" class="form-control" placeholder="inciso 'a'">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">b)</label>
                              <input value="${b}"  id="bEditar" type="text" class="form-control" placeholder="inciso 'b'">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">c)</label>
                              <input value="${c}" id="cEditar" type="text" class="form-control" placeholder="inciso 'c'">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">d)</label>
                              <input value="${d}"  id="dEditar" type="text" class="form-control" placeholder="inciso 'd'">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="mb-3">
                              <label for="">e)</label>
                              <input value="${e}" id="eEditar" type="text" class="form-control" placeholder="inciso 'e'">
                            </div>
                          </div>
                          <div class="col-6  mb-1">
                            <label for="">Correcta:</label>
                            <select id="respuestaEditar" name="respuesta"  class="form-select form-select-sm" aria-label="Small select example">
                              <option  value="${respuesta}" selected>${respuesta}</option>
                              <option  value="${a}">a)</option>
                              <option  value="${b}">b)</option>
                              <option value="${c}">c)</option>
                              <option  value="${d}">d)</option>
                              <option value="${e}">e)</option>
                            </select>
                          </div>
                          <div class="col-6  mb-1">
                            <label for="">Dificultad:</label>
                            <select id="dificultadEditar" name="dificultad"  class="form-select form-select-sm" aria-label="Small select example">
                              <option  value="${dificultad}" selected>${dificultad}</option>
                              <option  value="Muy Fasil">Muy Fasil</option>
                              <option  value="Fasil">Fasil</option>
                              <option value="Moderada">Moderada</option>
                              <option  value="Dificil">Dificil</option>
                            </select>
                          </div>
                          <div class="col-6  mb-1">
                            <label for="">Es una pregunta de examen pasado?</label>
                            <select id="exPasEditar" name="exPas"  class="form-select form-select-sm" aria-label="Small select example">
                              <option  value="${exPas}" selected>${exPas}</option>
                              <option  value="NO">NO</option>
                              <option  value="SI">SI</option>
                            </select>
                          </div>
                          <div class="col-6  mb-1">
                            <label for="">Tema seleccionado:</label>
                            <select id="selectTemasEditar" name="temaAjax"  class="form-select form-select-sm" aria-label="Small select example">
                            <option  value="${idTema}">${nombreTema}</option>
                            `+temasOptions+`
                            </select>
                          </div>
                          <div class="col-12 mb-4">
                            <div class="mb-3">
                            <button id="editarPreguntabtn" type="button" class="btn btn-success col-12" data-bs-dismiss="modal">Editar</button>
                            </div>
                          </div>
  
                    </form>`;
      $('#contenedorEditDelete').append(preguntaHTML);
    });





});



    </script>
