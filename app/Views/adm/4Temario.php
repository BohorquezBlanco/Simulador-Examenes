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
<div class="container-xxl">
    <h1 class="text-center "><?php echo $materia['nombreMateria'];?></h1>
    <div class="row">

        <div class="col-5 bg-body-secondary me-2">
            <?php echo form_open_multipart(base_url('crearTemario'), ['id' => 'uploadForm']) ?>

                <input type="hidden" value="<?php echo  $materia['idCarrera'];?>" name="idCarrera">
                <input type="hidden" value="<?php echo $materia['idMateria'];?>" name="idMateria">

                <div class="col-12" style="max-height: 70vh; overflow-y: auto;">
                    <h1 class="text-center">TEMARIO</h1>

                    <div class="list-group col-12 p-2 border "  id="divOrigen">
                    <h6>Temario de la materia</h6>
                        <div id="temarioNuevo[]" class="cont"> 
                        <?php foreach($temasExistentes as $temarioExistente):?>
                                <a href="#" class="list-group-item list-group-item-action tema">
                                    <div class="row">
                                        <div class="col-8">
                                        <?php echo $temarioExistente['nombreTema'] ;?>
                                        <input name="temarioNuevo[]" class="tema-id col-11" type="hidden" value="<?php echo $temarioExistente['idTema'] ;?>"></input>
                                        </div>

                                        <div class="col-2">
                                            <button type="button" class="btn btn-primary btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $temarioExistente['idTema'] ;?>">
                                                Eliminar
                                            </button>              
                                        </div>

                                        <div class="col-2">
                                            <button type="button" class="btn btn-primary btn-success" data-bs-toggle="modal" data-bs-target="#editar<?php echo $temarioExistente['idTema'] ;?>" >
                                               Editar
                                            </button>              
                                        </div>

                                    </div>

                                </a> 
<!--································································································INICIO Modal Eliminar ································································································································-->
                                            <div class="modal fade" id="staticBackdrop<?php echo $temarioExistente['idTema'] ;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">ELIMINAR TEMA</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo form_open_multipart(base_url('eliminarTema'), ['id' => 'uploadForm']) ;?>                                            
                                                            <div class="position-relative">
                                                                <p>ESTAS SEGURO DE ELIMINARLO ? </p>
                                                                <input name="idMateria" class="col-11" type="hidden" value="<?php echo $idMateria ;?>"></input>
                                                                <input name="idCarrera" class="col-11" type="hidden" value="<?php echo $idCarrera ;?>"></input>

                                                                <textarea  style="display: none;" name="idTema" class="col-11" type="hidden" value="<?php echo $temarioExistente['idTema'] ;?>"><?php echo $temarioExistente['idTema'] ;?></textarea>
                                                                <button class="btn btn-danger eliminarBtn text-center" type="submit"  >Eliminar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
<!--································································································FINAL Modal Eliminar ································································································································-->

<!--································································································INICIO Modal Editar································································································································-->
                                            <div class="modal fade" id="editar<?php echo $temarioExistente['idTema'] ;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">EDITAR TEMA</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo form_open_multipart(base_url('editarTema'), ['id' => 'uploadForm']) ;?>                                            
                                                            <div class="position-relative">
                                                            <input name="idMateria" class="col-11" type="hidden" value="<?php echo $idMateria;?>"></input>
                                                            <input name="idCarrera" class="col-11" type="hidden" value="<?php echo $idCarrera;?>"></input>

                                                            <textarea  style="display: none;" name="idTema" class="col-11" type="hidden" value="<?php echo $temarioExistente['idTema'] ;?>"><?php echo $temarioExistente['idTema'] ;?></textarea>

                                                            <input name="nombreTema" id="nombreTema" type="text" class="form-control" id="exampleFormControlInput1" placeholder="nombre Tema" value="<?php echo $temarioExistente['nombreTema'] ;?>"><br>
                                                                <textarea placeholder="No es necesario una descripcion" class="col-12" name="descripcionTema" row="2" type="text" value="descripcion"><?php echo $temarioExistente['descripcionTema'] ;?></textarea>
                                                                <button class="btn btn-success col-12 text-center" type="submit"  >EDITAR</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
<!--································································································FINAL Modal Editar ································································································································-->
                            <?php endforeach;?>
                        </div>
                    </div>
                    <button class="btn col-12 btn-success">GUARDAR</button>
                </div>
            </form>
        </div>

        <!---AQUI APARECERAN LAS PREGUNTAS---->
        <div class="col-6 ">

            <div class="row">

                <div class="list-group col-12 p-2 border">
                    <h5 class="text-center">CREAR TEMA</h5>
                    <div class="row mb-4">
                        <!---------------FORMULARIO ENVIADO POR AJAX PARA CREAR TEMAS---------------->
                        <form id="carreraForm" class="row">
                        <div class="col-5">
                            <div class="mb-3">
                                <input id="idMateriaAjax" class="col-11" type="hidden" value="<?php echo $idMateria ;?>"></input>

                                <input  id="nombreTemaAjax" type="text" class="form-control" placeholder="nombre Tema">

                            </div>
                        </div>
                        <div class="col-5">
                            <div class="mb-3">
                                <textarea  class="form-control" id="descripcionTemaAjax" rows="1" placeholder="Una descripcion breve" ></textarea>
                            </div>
                        </div>
                        <div class="col-2 mb-4">
                            <div class="mb-3">
                            <button id="submitBtn" type="button" class="btn btn-primary col-12">Agregar </button>
                            </div>
                        </div>
                        </form>
                        <!---------------FORMULARIO ENVIADO POR AJAX PARA CREAR TEMAS---------------->
                        <h5 class="text-center">FILTRAR TEMA</h5>

                        <div class="col-1">
                           <label for="">Tema:</label>
                        </div>
                        <div  class="col-11">
                            <input type="text" class="form-control" id="searchInput">
                        </div>
                    </div>
                   
                    <h5 class="text-center m-2">TEMAS EXISTENTES</h5>

                    <div class="overflow-auto" style="max-height: 250px;">

                        <div id="inicio" class="cont"  >


                            <?php foreach($temarios as $temario):?>
                                <a href="#" class="list-group-item list-group-item-action tema">
                                    <div class="row">
                                        <div class="col-8">
                                        <?php echo $temario['nombreTema'] ;?>
                                        <input class="tema-id col-11" type="hidden" value="<?php echo $temario['idTema'] ;?>"></input>
                                        </div>

                                        <div class="col-2">
                                            <button type="button" class="btn btn-primary btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $temario['idTema'] ;?>">
                                                Eliminar
                                            </button>              
                                        </div>

                                        <div class="col-2">
                                            <button type="button" class="btn btn-primary btn-success" data-bs-toggle="modal" data-bs-target="#editar<?php echo $temario['idTema'] ;?>" >
                                               Editar
                                            </button>              
                                        </div>

                                    </div>

                                </a> 
<!--································································································INICIO Modal Eliminar ································································································································-->
                                            <div class="modal fade" id="staticBackdrop<?php echo $temario['idTema'] ;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">ELIMINAR TEMA</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo form_open_multipart(base_url('eliminarTema'), ['id' => 'uploadForm']) ;?>                                            
                                                            <div class="position-relative">
                                                            <input name="idMateria" class="col-11" type="hidden" value="<?php echo $idMateria ;?>"></input>
                                                            <input name="idCarrera" class="col-11" type="hidden" value="<?php echo $idCarrera;?>"></input>

                                                                <p>ESTAS SEGURO DE ELIMINARLO ? </p>
                                                                <textarea  style="display: none;" name="idTema" class="col-11" type="hidden" value="<?php echo $temario['idTema'] ;?>"><?php echo $temario['idTema'] ;?></textarea>
                                                                <button class="btn btn-danger eliminarBtn text-center" type="submit"  >Eliminar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
<!--································································································FINAL Modal Eliminar ································································································································-->

<!--································································································INICIO Modal Editar································································································································-->
                                            <div class="modal fade" id="editar<?php echo $temario['idTema'] ;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">EDITAR TEMA</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo form_open_multipart(base_url('editarTema'), ['id' => 'uploadForm']) ;?>                                            
                                                            <div class="position-relative">
                                                            <input name="idMateria" class="col-11" type="hidden" value="<?php echo $idMateria ;?>"></input>
                                                            <input name="idCarrera" class="col-11" type="hidden" value="<?php echo $idCarrera;?>"></input>

                                                            <textarea  style="display: none;" name="idTema" class="col-11" type="hidden" value="<?php echo $temario['idTema'] ;?>"><?php echo $temario['idTema'] ;?></textarea>

                                                            <input name="nombreTema" id="nombreTema" type="text" class="form-control" id="exampleFormControlInput1" placeholder="nombre Tema" value="<?php echo $temario['nombreTema'] ;?>"><br>
                                                                <textarea placeholder="No es necesario una descripcion" class="col-12" name="descripcionTema" row="2" type="text" value="descripcion"><?php echo $temario['descripcionTema'] ;?></textarea>
                                                                <button class="btn btn-success col-12 text-center" type="submit"  >EDITAR</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
<!--································································································FINAL Modal Editar ································································································································-->
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>







<div class="col-12 m-2">
    <a class="btn btn-primary col-12" href="<?php echo base_url().'/materiasAdmi/'.$idCarrera;?>">TERMINAR Y VOLVER</a>
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

<script>
$(document).ready(function() {
    $('#submitBtn').click(function() {
        // Obtener los valores de los campos del formulario
        var nombreTema = $('#nombreTemaAjax').val();
        var descripcionTema = $('#descripcionTemaAjax').val();
        var idMateriaAjax = $('#idMateriaAjax').val();

        // Crear un objeto con los datos a enviar al servidor
        var temaData = {
            nombreTema: nombreTema,
            descripcionTema: descripcionTema,
            idMateriaAjax : idMateriaAjax ,
        };

        // Enviar la solicitud AJAX al servidor
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('crearTema'); ?>', // URL del servidor para insertar el tema
            data: temaData,
            success: function(response) {
                // Manejar la respuesta del servidor
                console.log('Tema insertado correctamente:', response);

                // Limpiar los campos del formulario después de la inserción exitosa
                $('#nombreTema').val('');
                $('#descripcionTema').val('');

                // Agregar el nuevo tema a la lista de temas
                $('#inicio').append('<a href="#" class="list-group-item list-group-item-info">' + nombreTema +
                                    ' <input type="hidden" value="'+response.idTema+'"></input>'+
                                    '<form method="post"  enctype="multipart/form-data" accept-charset="utf-8" action="<?php echo base_url('eliminarTema') ;?>">'+
                                        '<div class="position-relative">'+
                                            '<input name="idMateria" class=" col-11" type="hidden" value="'+response.idMateria+'"></input>'+

                                            '<input name="idTema" class=" col-11" type="hidden" value="'+response.idTema+'"></input>'+
                                            '<button class="btn btn-danger " type="submit"  >Eliminar</button>'+
                                        '</div>'+
                                    '</form>' );
            },
            error: function(xhr, status, error) {
                // Manejar errores de la solicitud AJAX
                console.error('Error al insertar el tema:', error);
            }
        });
    });
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
