<?php helper('form'); ?>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
<div class="container">
    <h1 class="text-center">EDITAR EXAMEN</h1>
    <div class="row">

        <div class="col-5 me-2 bg-body-secondary">
        <h5 class="text-center">EDICIÓN DEL EXAMEN</h5>
            <?php echo form_open_multipart(base_url('editarExamen'), ['id' => 'uploadForm']);?>
 
            <?php foreach($idExamenesCodigos as $idExamenCodigo):?>
            <!--------------------ID DE LOS EXAMENES EXISTENTES :v----------------------->
            <input class="tema-id " name="examenes[]" type="hidden" value="<?php echo $idExamenCodigo['idExamen'];?>"> </input>
            <!--------------------ID DE LOS EXAMENES EXISTENTES :v----------------------->
            <?php endforeach; ?>

            
                <div class="row">
                    <div class="col-6">
                        <label for="exampleFormControlInput1" class="form-label">Gestion</label>
                        <input value="<?php echo $examenes['gestionExamen'];?>" type="text" name="gestionExamen" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class=" col-6">
                        <label for="exampleFormControlInput1" class="form-label">Año</label>
                        <input value="<?php echo $examenes['añoExamen'];?>" type="text" name="añoExamen" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="col-6">
                        <label for="exampleFormControlInput1" class="form-label">Opcion</label>
                        <input value="<?php echo $examenes['opcionExamen'];?>" type="text" name="opcionExamen" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="col-6">
                        <input value="<?php echo $examenes['codigoExamen'];?>" type="hidden" name="codigoExamen" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                </div>
      

                <input type="hidden" value="<?php echo $idCarrera;?>" name="idCarrera">

                <div class="col-12" style="max-height: 70vh; overflow-y: auto;">
                    <h1>SECCIONES DEL EXAMEN</h1>
                    <?php foreach($materias as $materia):?>
                        <?php $repetir=1 ;?>
                        <!----------INPUT HIDDEN PARA PODER OBTENER ID DE LAS MATERIAS LAS CUALES ACTUARAN COMO SECCIONES------------------->
                        <input type="hidden" name="idMateria[]" value="<?php echo $materia['idMateria'];?>">
                        <!----------INPUT HIDDEN PARA PODER OBTENER ID DE LAS MATERIAS LAS CUALES ACTUARAN COMO SECCIONES------------------->

                    <div class="list-group col-12 p-2 border "  id="divOrigen">
                    <h6><?php echo $materia['nombreMateria'];?></h6>
                    
                    

                        <div id="p<?php echo $materia['idMateria'];?>[]" class="cont"> 
                        <?php 
                        $cont=0;
                        $idMateria1 = $materia['idMateria'];
                        ?>

                        <?php foreach($examenPreguntas as $examenPregunta):?>

  
                            <?php if ($repetir==1) {?>
                                    <div class="col-row-4">
                                    <input type="text" min="15" placeholder="minutos" value="<?php echo $examenPregunta['duracionExamen'];?>" name="tiempo[]">                            
                                    </div>
                            <?php }?>
                            <?php $repetir=0 ;?>

                            <?php 
                            $cont=0;
                            $idMateria2 = $examenPregunta['idMateria'];
                            ?>
                            <?php if ($idMateria1==$idMateria2) {?>
            
                                <a href="#" class="list-group-item list-group-item-action tema row">
                                    <p class="col-12"><?php echo $cont.'.- '.$examenPregunta['idMateria'].' \( '.$examenPregunta['formula'].' \)'; ?></p>
                                    <input class="tema-id" name="p<?php echo $materia['idMateria'];?>[]" type="hidden" value="<?php echo $examenPregunta['idPregunta'];?>"> </input>
                                    <!-- Button trigger modal -->
            
                                    <button type="button" class="btn btn-success  preguntica col-2 "  data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            EDITAR
                                            <input class="preguntica-id" type="hidden" value="<?php echo $examenPregunta['idPregunta'];?>"> </input>                               
                                            <input class="pregunticaEnunciado" type="hidden" value="<?php echo $examenPregunta['enunciado'];?>"> </input>
                                            <input class="pregunticaFormula" type="hidden" value="<?php echo $examenPregunta['formula'];?>"> </input>
                                            <input class="pregunticaA" type="hidden" value="<?php echo $examenPregunta['a'];?>"> </input>
                                            <input class="pregunticaB" type="hidden" value="<?php echo $examenPregunta['b'];?>"> </input>
                                            <input class="pregunticaC" type="hidden" value="<?php echo $examenPregunta['c'];?>"> </input>
                                            <input class="pregunticaD" type="hidden" value="<?php echo $examenPregunta['d'];?>"> </input>
                                            <input class="pregunticaE" type="hidden" value="<?php echo $examenPregunta['e'];?>"> </input>
                                            <input class="pregunticaCorrecta" type="hidden" value="<?php echo $examenPregunta['respuesta'];?>"> </input>
                                            <input class="pregunticaTema" type="hidden" value="<?php echo $examenPregunta['idTema'];?>"> </input>
                                            <input class="pregunticaNombreTema" type="hidden" value="<?php echo $examenPregunta['nombreTema'];?>"> </input>
                                    </button>
            
                                    <button type="button" class="btn btn-danger  preguntica2 col-2 "  data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                            Eliminar
                                            <input class="preguntica-id" type="hidden" value="<?php echo $examenPregunta['idPregunta'];?>"> </input>                               
                                            <input class="pregunticaEnunciado" type="hidden" value="<?php echo $examenPregunta['enunciado'];?>"> </input>
                                            <input class="pregunticaFormula" type="hidden" value="<?php echo $examenPregunta['formula'];?>"> </input>
                                    </button>
                                </a>
                                <?php } $cont=$cont+1;?>


                            <?php endforeach;?>
                        </div>
                    </div>

                    <?php endforeach;?>
                    <input type="hidden" value="<?php echo $idCarrera;?>">
                    <button class="btn col-12 btn-success" id="btnDuplicar">Editar Examen</button>
                </div>
            </form>
        </div>

        <!---AQUI APARECERAN LAS PREGUNTAS---->
        <div class="col-6 col-s-12">
        <h5 class="text-center">CREAR PREGUNTAS</h5>
<div class="accordion accordion-flush m-2" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        CREAR PREGUNTA
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
 
        <?php echo form_open_multipart(base_url('crearPregunta'), ['id' => 'uploadForm2']) ?>
        <div class="row">
                <input type="hidden" name="idCarrera" value="<?php echo $idCarrera;?>">

                <div class="col-6">
                    <input type="text" name="enunciado" class="form-control mb-1" id="exampleFormControlInput1" placeholder="Enunciado">
                </div>
                <div class="col-6">
                    <input type="text" name="formula" class="form-control mb-1" id="exampleFormControlInput1" placeholder="Si existe formula agregarlo aqui">
                </div>
                <div class="col-6">
                    <input type="text" name="a" class="form-control mb-1" id="exampleFormControlInput1" placeholder="a)">
                </div>
                <div class="col-6">
                    <input type="text" name="b" class="form-control mb-1" id="exampleFormControlInput1" placeholder="b)">
                </div>
                <div class="col-6">
                    <input type="text" name="c" class="form-control mb-1" id="exampleFormControlInput1" placeholder="c)">
                </div>
                <div class="col-6">
                    <input type="text" name="d" class="form-control mb-1" id="exampleFormControlInput1" placeholder="d)">
                </div>
                <div class="col-6">
                    <input type="text" name="e" class="form-control mb-1" id="exampleFormControlInput1" placeholder="e)">
                </div>
                <div class="col-6  mb-1">
                    <label for="">Correcta:</label>
                     <select name="correcta"  class="form-select form-select-sm" aria-label="Small select example">
                        <option  value="a" selected>a)</option>
                        <option  value="b">b)</option>
                        <option value="c">c)</option>
                        <option  value="d">d)</option>
                        <option value="e">e)</option>
                    </select>
                </div>
                <h6>Tema a la que pertenece la pregunta: </h6>
            <div class="row mb-2">
                <div class="col-4">
                    <select id="carreraSelect" class="form-select form-select-sm" aria-label="Small select example">
                        <option selected>Carrera</option>
                      <?php foreach($carreras as $carrera): ?>
                        <option value="<?php echo $carrera['idCarrera'];?>"><?php echo $carrera['nombreCarrera'];?></option>
                      <?php endforeach ;?>

                    </select>
                </div>
                <div class="col-4">
                    <select id="materiaSelect" class="form-select form-select-sm" aria-label="Small select example">
                        <option selected>Materia</option>
                    </select>
                </div>
                <div class="col-4">
                    <select id="temaSelect" name="idTema" class="form-select form-select-sm" aria-label="Small select example">
                        <option selected>Tema</option>

                    </select>
                </div>
                <button class="btn col-12 btn-primary m-2" >Crear Pregunta</button>
                </div>
            </form>


      </div>
    </div>
  </div>

  <!-------------------------------EDITAR PREGUNTA------------------------------------------>
  <div class="accordion-item ">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        FILTRAR PREGUNTA
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <!---------------FORMULARIO ENVIADO POR AJAX PARA CREAR TEMAS---------------->
        <h6 class="text-center">FILTRAR PREGUNTA</h6>

        <div class="col-2">
        <label for="">Pregunta:</label>
        </div>
        <div  class="col-10 mb-2">
            <input type="text" class="form-control" id="searchInput">
        </div>
      </div>
    </div>
  </div>
</div>














            <div class="row mt-4">
      

                <br>

                <div class="list-group col-12 p-2 border">
                    <h5 class="text-center">PREGUNTAS</h5>
                    <div class="overflow-auto" style="max-height: 450px;">
                    <div id="inicio" class="cont ">

                    <?php
                        $cont = 1;
                        foreach ($preguntas as $pregunta):
                            $idPregunta1 = $pregunta['idPregunta'];
                            $existePareja = false; // Variable para controlar si se encuentra una pareja

                            foreach ($examenPreguntas as $examenPregunta):
                                $idPregunta2 = $examenPregunta['idPregunta'];
                                // Si se encuentra una pareja, cambia el valor de $existePareja a true
                                if ($idPregunta2 == $idPregunta1) {
                                    $existePareja = true;
                                    break; // Termina el bucle porque ya encontraste una pareja
                                }
                            endforeach;
                        // Si no se encuentra una pareja, muestra la pregunta
                        if (!$existePareja):
                                    ?>
                        <a href="#" class="list-group-item list-group-item-action tema row">
                            <p class="col-12"><?php echo $cont . '.- ' . $pregunta['enunciado'] . ' \( ' . $pregunta['formula'] . ' \)'; ?></p>
                            <input class="tema-id" type="hidden" value="<?php echo $pregunta['idPregunta']; ?>"> </input>
                            <!-- Botón de editar -->
                            <button type="button" class="btn btn-success  preguntica col-2 "  data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                                EDITAR
                                                                <input class="preguntica-id" type="hidden" value="<?php echo $pregunta['idPregunta'];?>"> </input>                               
                                                                <input class="pregunticaEnunciado" type="hidden" value="<?php echo $pregunta['enunciado'];?>"> </input>
                                                                <input class="pregunticaFormula" type="hidden" value="<?php echo $pregunta['formula'];?>"> </input>
                                                                <input class="pregunticaA" type="hidden" value="<?php echo $pregunta['a'];?>"> </input>
                                                                <input class="pregunticaB" type="hidden" value="<?php echo $pregunta['b'];?>"> </input>
                                                                <input class="pregunticaC" type="hidden" value="<?php echo $pregunta['c'];?>"> </input>
                                                                <input class="pregunticaD" type="hidden" value="<?php echo $pregunta['d'];?>"> </input>
                                                                <input class="pregunticaE" type="hidden" value="<?php echo $pregunta['e'];?>"> </input>
                                                                <input class="pregunticaCorrecta" type="hidden" value="<?php echo $pregunta['respuesta'];?>"> </input>
                                                                <input class="pregunticaTema" type="hidden" value="<?php echo $pregunta['idTema'];?>"> </input>
                                                                <input class="pregunticaNombreTema" type="hidden" value="<?php echo $pregunta['nombreTema'];?>"> </input>
                                                        </button>
                                                        <button type="button" class="btn btn-danger  preguntica2 col-2 "  data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                                                Eliminar
                                                                <input class="preguntica-id" type="hidden" value="<?php echo $pregunta['idPregunta'];?>"> </input>                               
                                                                <input class="pregunticaEnunciado" type="hidden" value="<?php echo $pregunta['enunciado'];?>"> </input>
                                                                <input class="pregunticaFormula" type="hidden" value="<?php echo $pregunta['formula'];?>"> </input>
                                                        </button>

                        </a>
                        <?php
                        $cont++; // Incrementa el contador de preguntas mostradas
                        endif;
                        endforeach;
                        ?>



                

                        
                        <!-- Modal De Editar -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                             <!-----------------------------------------AQUI ESTARA PARA EDITAR ------------------------------>
                             <div class="row">
                                <?php echo form_open_multipart(base_url('editarPregunta'), ['id' => 'uploadForm3']) ?>
                                <input type="hidden" name="idCarrera" value="<?php echo $idCarrera;?>">

                                            <div class="col-12 row" id="editarAjax">
                                                <!-----------------AQUI ENTRARA PARA EDITAR :D POR MEDIO DE AJAX------------------------>
                                            </div>
                                            <h6>Cambiar el tema: </h6>
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <select id="carreraSelectP" class="form-select form-select-sm" aria-label="Small select example">
                                                    <option selected>Carrera</option>
                                                <?php foreach($carreras as $carrera): ?>
                                                    <option value="<?php echo $carrera['idCarrera'];?>"><?php echo $carrera['nombreCarrera'];?></option>
                                                <?php endforeach ;?>

                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <select id="materiaSelectP" class="form-select form-select-sm" aria-label="Small select example">
                                                    <option selected>Materia</option>
                                                </select>
                                            </div>
                                                <div class="col-4 mb-2">
                                                <select id="temaSelectP" class="form-select form-select-sm" aria-label="Small select example">

                                                </select>
                                                </div>

                                                <button class="btn col-12 btn-success m-2" id="btnDuplicar">Editar Pregunta</button>
                                        </div>
                                </form>
                                        </div>
                                    </div>
                    
                                </div>
                            </div>
                        </div>

                        <!-- Modal De ELiminar -->
                        <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">ELIMINAR</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-----------------------------------------AQUI ESTARA PARA EDITAR ------------------------------>
                                    <div class="row">
                                        <?php echo form_open_multipart(base_url('eliminarPregunta'), ['id' => 'uploadForm3']) ?>
                                            <input type="hidden" name="idCarrera" value="<?php echo $idCarrera;?>">

                                            <div class="col-12 row" id="eliminarAjax">
                                                <!-----------------AQUI ENTRARA PARA EDITAR :D POR MEDIO DE AJAX------------------------>
                                            </div>
                                                <button class="btn col-12 btn-danger m-2" id="btnDuplicar">ENSERIO QUIERE ELIMINAR</button>
                                        </form>
                                        
                                    </div>
                    
                                </div>
                            </div>
                        </div>

                        
                        </div>
                    </div>
                </div>

            </div>
        </div><br>
        <br><br><br><br><br>
        <!---AQUI APARECERAN LOS EXAMENES---->

            <!---SEGUNDA COLUMNA---->


    </div>
</div>
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- jQuery UI -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- jQuery UI Touch Punch -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>





<script>
$(document).ready(function() {
    $('.preguntica2').click(function() {
        var preguntaId = $(this).find('.preguntica-id').val(); // Obtener el ID de la pregunta
        var pregunticaEnunciado = $(this).find('.pregunticaEnunciado').val(); // Obtener el ID de la pregunta
        var pregunticaFormula = $(this).find('.pregunticaFormula').val(); // Obtener el ID de la pregunta


        //eliminar todo
        $('#eliminarAjax').empty();
        
                '+pregunticaFormula+'
        $('#eliminarAjax').append('<input type="hidden" name="idPregunta" class="form-control mb-1" id="idPregunta" placeholder="Enunciado" value="'+preguntaId+'">'+
        '<div class="col-12"><p for="">Enunciado:'+pregunticaEnunciado+'</p> </div> '+
        '<div class="col-12"><p for="">Formula: \( '+pregunticaFormula+' \)</p></div>' );

    });
});




$(document).ready(function() {
    $('.preguntica').click(function() {
        var preguntaId = $(this).find('.preguntica-id').val(); // Obtener el ID de la pregunta
        var pregunticaEnunciado = $(this).find('.pregunticaEnunciado').val(); // Obtener el ID de la pregunta
        var pregunticaFormula = $(this).find('.pregunticaFormula').val(); // Obtener el ID de la pregunta
        var pregunticaA = $(this).find('.pregunticaA').val(); // Obtener el ID de la pregunta
        var pregunticaB = $(this).find('.pregunticaB').val(); // Obtener el ID de la pregunta
        var pregunticaC = $(this).find('.pregunticaC').val(); // Obtener el ID de la pregunta
        var pregunticaD = $(this).find('.pregunticaD').val(); // Obtener el ID de la pregunta
        var pregunticaE = $(this).find('.pregunticaE').val(); // Obtener el ID de la pregunta
        var pregunticaCorrecta = $(this).find('.pregunticaCorrecta').val(); // Obtener el ID de la pregunta
        var pregunticaTema = $(this).find('.pregunticaTema').val(); // Obtener el ID de la pregunta
        var pregunticaNombreTema = $(this).find('.pregunticaNombreTema').val(); // Obtener el ID de la pregunta

        //eliminar todo
        $('#editarAjax').empty();
        
                
        $('#editarAjax').append('<input type="hidden" name="idPregunta" class="form-control mb-1" id="idPregunta" placeholder="Enunciado" value="'+preguntaId+'">'+
        '<div class="col-6"><label for="">enunciado:</label><input type="text" name="enunciado" class="form-control mb-1" id="enunciado" placeholder="Enunciado" value="'+pregunticaEnunciado+'"></div>'+
        '<div class="col-6"><label for="">formula:</label><input type="text" name="formula" class="form-control mb-1" id="formula" placeholder="Enunciado" value="'+pregunticaFormula+'"></div>'+
        '<div class="col-6"><label for="">a):</label><input type="text" name="a" class="form-control mb-1" id="a" placeholder="Enunciado" value="'+pregunticaA+'"></div>'+
        '<div class="col-6"><label for="">b):</label><input type="text" name="b" class="form-control mb-1" id="b" placeholder="Enunciado" value="'+pregunticaB+'"></div>'+ 
        '<div class="col-6"><label for="">c):</label><input type="text" name="c" class="form-control mb-1" id="c" placeholder="Enunciado" value="'+pregunticaC+'"></div>'+
        '<div class="col-6"><label for="">d):</label><input type="text" name="d" class="form-control mb-1" id="d" placeholder="Enunciado" value="'+pregunticaD+'"></div>'+
        '<div class="col-6"><label for="">e):</label><input type="text" name="e" class="form-control mb-1" id="e" placeholder="Enunciado" value="'+pregunticaE+'"></div>'+
        '<div class="col-6"><label for="">Correcta:</label>'+
                     '<select name="correcta" class="form-select form-select-sm" aria-label="Small select example">'+
                        '<option value="'+pregunticaCorrecta+'" selected>'+pregunticaCorrecta+')</option>'+
                        '<option value="a">a)</option>'+
                        '<option value="b">b)</option>'+
                        '<option value="c">c)</option>'+
                        '<option value="d">d)</option>'+
                        '<option value="e">e)</option>'+

                    '</select></div>'+
        '<div class="col-12" id="temaEditarAjax">'+
        '<input type="hidden" name="idTema" class="form-control mb-1" id="idTema" placeholder="Enunciado" value="'+pregunticaTema+'">'+
        '<label for="">tema:</label><input type="text"  class="form-control mb-1" placeholder="Enunciado" value="'+pregunticaNombreTema+'">'+
        '</div>'

        );

    });
});

//para mostrar las materias en base a la carrera
$(document).ready(function() {
    $('#carreraSelect').change(function() {
        var carreraIdAjax = $(this).val(); // Obtener el ID de la carrera seleccionada
        var temaData={
            carreraIdAjax:carreraIdAjax,
        };
        //Enviar la solicitud AJAX al servidor 
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('seleccionarCarrera'); ?>', // URL del servidor para insertar el tema
            data: temaData,
            dataType: 'json', // Especifica que esperas recibir datos JSON
            success: function(response) {
                // Limpiar el select de materias
                $('#materiaSelect').empty();
                $('#materiaSelect').append('<option selected >Materia</option>');

                // Iterar sobre las materias recibidas y agregarlas al select
                $.each(response, function(index, materia) {
                    $('#materiaSelect').append('<option value="' + materia.idMateria + '">' + materia.nombreMateria + '</option>');
                });
            },
            error: function(xhr, status, error) {
                // Manejar errores de la solicitud AJAX
                console.error('Error al insertar el tema:', error);
            }
        });

    });
});


//para mostrar los temas en base a la materia
$(document).ready(function() {
    $('#materiaSelect').change(function() {
        var materiaIdAjax = $(this).val(); // Obtener el ID de la materia seleccionada
        var temaData2={
            materiaIdAjax:materiaIdAjax,
        };

        //Enviar la solicitud AJAX al servidor 
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('seleccionarMateria'); ?>', // URL del servidor para devolver los temas
            data: temaData2,
            dataType: 'json', // Especifica que esperas recibir datos JSON
            success: function(response) {
                // Limpiar el select de materias
                $('#temaSelect').empty();
                $('#temaSelect').append('<option selected >Temas</option>');

                // Iterar sobre las materias recibidas y agregarlas al select
                $.each(response, function(index, tema) {
                    $('#temaSelect').append('<option value="' + tema.idTema + '">' + tema.nombreTema + '</option>');
                });
            },
            error: function(xhr, status, error) {
                // Manejar errores de la solicitud AJAX
                console.error('Error al mostrar tema:', error);
            }
        });

    });
});

//para mostrar las materias en base a la carrera
$(document).ready(function() {
    $('#carreraSelectP').change(function() {
        var carreraIdAjax = $(this).val(); // Obtener el ID de la carrera seleccionada
        var temaData={
            carreraIdAjax:carreraIdAjax,
        };
        //Enviar la solicitud AJAX al servidor 
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('seleccionarCarrera'); ?>', // URL del servidor para insertar el tema
            data: temaData,
            dataType: 'json', // Especifica que esperas recibir datos JSON
            success: function(response) {
                // Limpiar el select de materias
                $('#materiaSelectP').empty();
                $('#materiaSelectP').append('<option selected >Materia</option>');

                // Iterar sobre las materias recibidas y agregarlas al select
                $.each(response, function(index, materia) {
                    $('#materiaSelectP').append('<option value="' + materia.idMateria + '">' + materia.nombreMateria + '</option>');
                });
            },
            error: function(xhr, status, error) {
                // Manejar errores de la solicitud AJAX
                console.error('Error al insertar el tema:', error);
            }
        });

    });
});
//para mostrar los temas en base a la materia
$(document).ready(function() {
    $('#materiaSelectP').change(function() {
        var materiaIdAjax = $(this).val(); // Obtener el ID de la materia seleccionada
        var temaData2={
            materiaIdAjax:materiaIdAjax,
        };

        //Enviar la solicitud AJAX al servidor 
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('seleccionarMateriaP'); ?>', // URL del servidor para devolver los temas
            data: temaData2,
            dataType: 'json', // Especifica que esperas recibir datos JSON
            success: function(response) {
                // Limpiar el select de materias
                $('#temaSelectP').empty();

                // Iterar sobre las materias recibidas y agregarlas al select
                $.each(response, function(index, tema) {
                    $('#temaSelectP').append('<option value="' + tema.idTema + '">' + tema.nombreTema + '</option>');
                });
            },
            error: function(xhr, status, error) {
                // Manejar errores de la solicitud AJAX
                console.error('Error al mostrar tema:', error);
            }
        });

    });
});


//SELECCIONA UN TEMA Y ESTE SE ESCRIBE EN EL INPUT DE EDITAR

$(document).ready(function() {
    $('#temaSelectP').change(function() {
        var materiaIdAjax = $(this).val(); // Obtener el ID de la materia seleccionada


        $('#temaEditarAjax').empty();
        $('#temaEditarAjax').append('<label for="">tema:</label><input disabled type="text" name="idTema" class="form-control mb-1" id="enunciado" placeholder="Enunciado" value="'+ materiaIdAjax +'">'+
        '<input type="hidden" name="idTema" class="form-control mb-1" id="idTema" placeholder="Enunciado" value="'+materiaIdAjax+'">');
    

    });
});




//para mover de un div inicial a uno final y viceversa 
$(function() {
    $(".cont").sortable({
        connectWith: ".cont",
        start: function(event, ui) {
            $(ui.item).data('original-value', $(ui.item).find('input').val());
        },
        receive: function(event, ui) {
            var input = $(ui.item).find('input').filter(function() {
                return $(this).closest('button').length === 0;
            });
            var groupName = $(this).attr('id');
            input.attr('name', groupName);
            if (groupName === 'grupo1') {
                var originalValue = $(ui.item).data('original-value');
                input.val(originalValue);
            }
        }
    }).disableSelection();
});



    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const temas = document.querySelectorAll('.tema');

            searchInput.addEventListener('input', function() {
                const searchText = this.value.trim().toLowerCase();

                temas.forEach(function(tema) {
                    const temaText = tema.textContent.trim().toLowerCase();
                    const temaId = tema.querySelector('.tema-id').value;

                    if (temaText.includes(searchText)) {
                        tema.style.display = 'block';
                    } else {
                        tema.style.display = 'none';
                    }
                });
            });
        });
    </script>
