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
    <h1 class="text-center">CREACION DE EXAMENES</h1>
    <div class="row">

        <div class="col-6 bg-body-secondary">
            <?php echo form_open_multipart(base_url('naceExamen'), ['id' => 'uploadForm']) ?>
                <div class="row">
                    <div class="col-6">
                        <label for="exampleFormControlInput1" class="form-label">Gestion</label>
                        <input type="text" name="gestionExamen" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class=" col-6">
                        <label for="exampleFormControlInput1" class="form-label">Año</label>
                        <input type="text" name="añoExamen" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                </div>
                <div class="mb-3 col-12">
                    <label for="exampleFormControlInput1" class="form-label">Opcion</label>
                    <input type="text" name="opcionExamen" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>

                <input type="hidden" value="<?php echo $idCarrera;?>" name="idCarrera">

                <div class="col-12" style="max-height: 70vh; overflow-y: auto;">
                    <h1>SECCIONES DEL EXAMEN</h1>
                    <?php foreach($materias as $materia):?>

                        <!----------INPUT HIDDEN PARA PODER OBTENER ID DE LAS MATERIAS------------------->
                        <input type="hidden" name="idMateria[]" value="<?php echo $materia['idMateria'];?>">
                        <!----------INPUT HIDDEN PARA PODER OBTENER ID DE LAS MATERIAS------------------->

                    <div class="list-group col-12 p-2 border "  id="divOrigen">
                    <h6><?php echo $materia['nombreMateria'];?></h6>
                        <div id="p<?php echo $materia['idMateria'];?>[]" class="cont"> 
                        <input type="hidden" name="[<?php echo $materia['idMateria'];?>]" value="<?php echo $materia['idMateria'];?>">
                        </div>
                    </div>
                    <?php endforeach;?>
                    <input type="hidden" value="<?php echo $idCarrera;?>">
                    <button class="btn col-12 btn-success" id="btnDuplicar">Crear Examen</button>
                </div>
            </form>
        </div>

        <!---AQUI APARECERAN LAS PREGUNTAS---->
        <div class="col-6">
        <h1 class="text-center">FILTRAR PREGUNTAS</h1>

            <div class="row">
                <div class="col-4">
                    <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected>Carrera</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-4">
                    <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected>Materia</option>
                        <option value="1">Introduccion a las ciencias Administrativas</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-4">
                    <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected>Año</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <br>
                <div class="col-12 p-2">
                    <button class="btn col-12 btn-success">Filtrar Preguntas</button>
                </div> 

                <div class="list-group col-12 p-2 border">
                    <h5 class="text-center">PREGUNTAS</h5>

                    <div id="inicio" class="cont">

                        <?php $cont=1;?>
                        <?php foreach($preguntas as $pregunta):?>

                        <a href="#" class="list-group-item list-group-item-action">
                            <?php echo $cont.'.- '.$pregunta['enunciado'];?>
                            <input type="hidden" value="<?php echo $pregunta['idPregunta'];?>"> </input>
                        </a>
                        
                        <?php $cont=$cont+1;?>
                        <?php endforeach;?>

                    </div>

                </div>

            </div>
        </div>
        <!---AQUI APARECERAN LOS EXAMENES---->

            <!---SEGUNDA COLUMNA---->


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
                    var input = $(ui.item).find('input');
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
