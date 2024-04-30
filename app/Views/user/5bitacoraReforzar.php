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

  <div class="container">
    <h1 class="fs-4 m-2 text-center"><?php echo $nombre;?></h1>
    <p>Refuerza tus conocimientos! , puede ver nuestro banco de preguntas como tambien resolver examenes las cuales pueden ser aleatorias y personalizadas.</p>
    <hr />
      <div class="row">
        <a href="<?php echo base_url().'ResolverExamen/'.$idMateria.'/'.$idCarrera.'/0';?>" class="btn btn-primary col-5" type="button">RESOLVER EXAMEN ALEATORIO</a>
        <div class="col-2"></div> <!-- Espacio de separación -->

          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary col-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
          RESOLVER EXAMEN PERSONALIZADO
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Personaliza el examen</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php echo form_open_multipart(base_url('ExamenPersonalizado'), ['id' => 'examenAleatorio','class' => 'row']) ;?>
                  <div class="mb-3 col-6">
                    <input name="idCarrera" type="hidden" value="<?php echo $idCarrera;?>">
                    <input name="idMateria" type="hidden" value="<?php echo $idMateria;?>">
                    <label for="exampleFormControlInput1" class="form-label">Duración del examen:</label>
                    <input name="tiempo" type="number" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="0">
                  </div>
                  <div class="mb-3 col-6">
                    <label for="exampleFormControlInput1" class="form-label">Cantidad de preguntas:</label>
                    <input name="cantidad" type="number" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="1" min="1" max="100">
                  </div>

                  <div class="col-12">
                    <p class="text-danger fst-italic">Arrastre los temas que desea para las preguntas del examen, puede añadir la cantidad que vea conveniente "si no añade ningun tema automaticamente resolvera un examen aleatorio"</p>
                  </div>

                  <div class="col-6">
                    <div class="col-12" style="max-height: 70vh; overflow-y: auto;">
                      <h6 class="text-center">Temas del Examen</h6>
                      <div class="list-group col-12 p-2 border "  id="divOrigen">
                       
                        <div id="idTema[]" class="cont"> 
                        <!----------TODO LO QUE ESTE DENTRO DEL ANCLA "a" se podra mover al otro contenedor---------->
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="col-6">
                    <h6 class="text-center">Temas existentes</h6>
                    <div class="overflow-auto mb-4 list-group" style="max-height: 250px;">
                        <div id="inicio" class="cont">
                          <!----------TODO LO QUE ESTE DENTRO DEL ANCLA "a" se podra mover al otro contenedor---------->
                          
                          <?php foreach($temas as $tema): ?>
                          <a href="#" class="list-group-item list-group-item-action tema">
                            <div class="row">
                                <div class="col-8">
                                  <input class="tema-id col-11" type="hidden" value="<?php echo $tema['idTema'];?>"><?php echo $tema['nombreTema'];?></input>
                                </div>
                            </div>
                          </a>
                          <?php endforeach;?>
                        </div>

                      </div>
                    </div>
                    <button class="btn btn-success">Resolver Examen</button>   
                    </form>       
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                   
                  </div>
                </div>
              </div>
            </div>
                  </div>
      <hr class="col-12"/>
      <!------------------IDEA DE TABLAS---------------->
      <div class="table-responsive ">
        <table class="table table-bordered table-hover">
          <thead class="table-dark">
            <tr>
              <th scope="col" class="col-1 fs-4">#</th>
              <th class="text-center align-middle col-8 fs-4" colspan="3">PREGUNTA</th>
              <th class="col-1 fs-4">Resolver/Resolucion</th>
            </tr>
          </thead>
          <tbody>
          <?php $n=1;  foreach($preguntas as $pregunta): ?>
            <tr>
              <td scope="row"><?php echo $n ;?></td>
              <td colspan="2"><?php echo $pregunta['enunciado'];?></td>
              <td><img src="<?php echo $pregunta['imagenPregunta'];?>" alt="" class="img-fluid"></td>
              <td><div class="btn-group" role="group" aria-label="Grupo de botones">
                  <a target="_blank" href="<?php echo base_url().'resolverPregunta/'.$pregunta['idPregunta'].'/'.$idCarrera.'/'.$idMateria;?>" class="btn btn-primary">Resolver</a>
                  <a target="_blank" href="<?php echo $pregunta['resolucionPdf'];?>" class="btn btn-secondary">Resolución</a>
                  </div>
              </td>
            </tr>
            <?php $n=$n+1; endforeach  ;?>
          </tbody>
        </table>
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



  