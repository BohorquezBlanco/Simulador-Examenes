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
  <div class="row">
    <h1 class="text-center m-2"><?php echo $titulo['nombreMateria']; ?></h1>
    <div class="col-5 bg-body-secondary me-2">
      <div class="col-12" style="max-height: 70vh; overflow-y: auto;">
        <h2 class="text-center m-2">BIBLIOGRAFIA</h2>
        <div class="list-group overflow-auto " style="max-height: 250px;" id="divOrigen">
          <div id="temarioNuevo" class="cont">
            <?php $n = 0; ?>
            <?php foreach ($libros as $libro) : ?>
              <a href="#" id="temarioNuevo" class="list-group-item list-group-item-action guarda">
                <div class="row">
                  <div class="col-7">
                    <input class="guarda form-control" name="nombreLibro<?php echo $n; ?>" type="text" value="<?php echo $libro['nombreLibro']; ?>">
                  </div>
                  <div class="col-2">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminar2<?php echo $n; ?>">Eliminar</button>
                  </div>
                  <div class="col-2">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editar2<?php echo $n; ?>">Editar</button>
                  </div>
                  <input class="guarda form-control" name="descripcionLibro<?php echo $n; ?>" type="hidden" value="<?php echo $libro['descripcionLibro']; ?>">
                  <input class="guarda form-control" name="imagenLibro<?php echo $n; ?>" type="hidden" value="<?php echo $libro['imagenLibro']; ?>">
                  <input class="guarda form-control" name="urlLibro<?php echo $n; ?>" type="hidden" value="<?php echo $libro['urlLibro']; ?>">
                </div>
              </a>
                <div class="modal fade" id="editar2<?php echo $n; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Libro</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <?php echo form_open_multipart(base_url('editarLibro'), ['id' => 'uploadFormEditar' . $n]); ?>

                      <div class="modal-body">
                        <div class="mb-2">
                          <label for="exampleFormControlInput1" class="form-label">Nombre del libro</label>
                          <input value="<?php echo $libro['nombreLibro']; ?>" name="nombreLibro" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nombre del libro">
                        </div>
                        <div class="mb-2">
                          <label for="exampleFormControlTextarea1" class="form-label">Descripcion del libro</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcionLibro"><?php echo $libro['descripcionLibro']; ?></textarea>
                        </div>
                        <div class="mb-2">
                          <label for="exampleFormControlTextarea2" class="form-label">Imagen del libro</label>
                          <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" name="imagenLibro"><?php echo $libro['imagenLibro']; ?></textarea>
                        </div>
                        <div class="mb-2">
                          <label for="exampleFormControlTextarea3" class="form-label">Url del libro</label>
                          <textarea class="form-control" id="exampleFormControlTextarea3" rows="3" name="urlLibro"><?php echo $libro['urlLibro']; ?></textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" value="<?php echo $libro['idLibro']; ?>" name="idLibro">
                        <input type="hidden" value="<?php echo $idMateria; ?>" name="idMateria">
                        <button type="submit" class="btn btn-primary">EDITAR</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              
              <div class="modal fade" id="eliminar2<?php echo $n; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">ELIMINAR</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?php echo form_open_multipart(base_url('eliminarLibro'), ['id' => 'uploadFormEliminar' . $n]); ?>
                      <input type="hidden" value="<?php echo $libro['idLibro']; ?>" name="idLibro">
                      <input type="hidden" value="<?php echo $idMateria; ?>" name="idMateria">
                      <h5>ESTAS SEGURO DE ELIMINARLO ?</h5>
                      <button type="submit" class="btn btn-danger col-12 ">Eliminar Libro</button>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
              <?php $n++; ?>

            <?php endforeach; ?>
          </div>
        </div>
        <button class="btn col-12 btn-success" id="guardarBtn">GUARDAR</button>
        <div id="mensajeGuardado" style="display: none;" class="alert alert-success" role="alert">Libro guardado.</div>
      </div>
    </div>

    <div class="col-6">
      <div class="row">
        <div class="list-group col-12 p-4 border">
          <h5 class="text-center">AÑADIR LIBRO</h5>
          
          <?php echo form_open_multipart(base_url('crearLibro'), ['id' => 'uploadFormCrear']); ?>
          
          <input name="idMateria" type="hidden" class="form-control" value="<?php echo $idMateria; ?>">
          
          <div class="row mb-4">
            <div class="col-16">
              <div class="mb-3">
                <input name="nombreLibro" id="nombreTemaAjax" type="text" class="form-control" placeholder="Nombre del Libro">
              </div>
            </div>
            <div class="col-15">
              <div class="mb-3">
                <textarea name="descripcionLibro" class="form-control" id="descripcionTemaAjax" rows="1" placeholder="Una descripción breve"></textarea>
              </div>
            </div>
            <div class="col-15">
              <div class="mb-3">
                <input name="imagenLibro" id="imagenTemaAjax" type="text" class="form-control" placeholder="Imagen del libro">
              </div>
            </div>
            <div class="col-15">
              <div class="mb-3">
                <input name="urlLibro" id="urlTemaAjax" type="text" class="form-control" placeholder="Url del libro">
              </div>
            </div>
            <div class="col-12 mb-2 ">
              <div class="mb-2">
                <button type="submit" class="btn btn-primary col-12">Crear</button>
              </div>
            </div>
          </div>
        </form>

          <h5 class="text-center">FILTRAR LIBROS</h5>
          <div class="col-1">
            <label>Tema:</label>
          </div>
          <div class="col-12">
            <input type="text" class="form-control" id="searchInput">
          </div>
          <h5 class="text-center m-2">LIBROS EXISTENTES</h5>
          <div class="overflow-auto" style="max-height: 250px;">
            <div id="inicio" class="cont">
              <?php $n = 0; ?>
              <?php foreach ($libros2 as $libro2) : ?>
                <a href="#" id="contenedor<?php echo $n; ?>" class="list-group-item list-group-item-action tema">
                  <div class="row">
                    <div class="col-7">
                      <input class="tema-id form-control" type="text" value="<?php echo $libro2['nombreLibro']; ?>">
                      <input class="tema-id form-control" type="hidden" value="<?php echo $libro2['descripcionLibro']; ?>">
                      <input class="tema-id form-control" type="hidden" value="<?php echo $libro2['imagenLibro']; ?>">
                      <input class="tema-id form-control" type="hidden" value="<?php echo $libro2['urlLibro']; ?>">
                    </div>
                    <div class="col-2">
                      <button type="button" class="btn btn-primary btn-danger" data-bs-toggle="modal" data-bs-target="#eliminar<?php echo $n; ?>">Eliminar</button>
                    </div>
                    <div class="col-2">
                      <button type="button" class="btn btn-primary btn-success" data-bs-toggle="modal" data-bs-target="#modificar<?php echo $n; ?>">Editar</button>
                    </div>
                  </div>
                </a>
                <div class="modal fade" id="modificar<?php echo $n; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar libro</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <?php echo form_open_multipart(base_url('editarLibro'), ['id' => 'uploadFormEditar2' . $n]); ?>
                      <div class="modal-body">
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Nombre del libro</label>
                          <input value="<?php echo $libro2['nombreLibro']; ?>" name="nombreLibro" type="text" class="form-control" id="exampleFormControlInput1" placeholder="nombre del libro">
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlTextarea1" class="form-label">Descripcion del libro</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcionLibro"><?php echo $libro2['descripcionLibro']; ?></textarea>
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlTextarea2" class="form-label">Imagen del libro</label>
                          <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" name="imagenLibro"><?php echo $libro2['imagenLibro']; ?></textarea>
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlTextarea3" class="form-label">Url del libro</label>
                          <textarea class="form-control" id="exampleFormControlTextarea3" rows="3" name="urlLibro"><?php echo $libro2['urlLibro']; ?></textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" value="<?php echo $libro2['idLibro']; ?>" name="idLibro">
                        <input type="hidden" value="<?php echo $idMateria; ?>" name="idMateria">
                        <button type="submit" class="btn btn-primary">EDITAR</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="eliminar<?php echo $n; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">ELIMINAR</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <?php echo form_open_multipart(base_url('eliminarLibro'), ['id' => 'uploadFormEliminar2' . $n]); ?>
                        <input type="hidden" value="<?php echo $libro2['idLibro']; ?>" name="idLibro">
                        <input type="hidden" value="<?php echo $idMateria; ?>" name="idMateria">
                        <h5>ESTAS SEGURO DE ELIMINARLO ?</h5>
                        <button type="submit" class="btn btn-danger col-12 ">Eliminar Libro</button>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
                <?php $n++; ?>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
  //Cambia de un contenedor a otro
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
  //Filtra los libros
  document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const temas = document.querySelectorAll('.tema');

    searchInput.addEventListener('input', function() {
      const searchText = this.value.trim().toLowerCase();

      temas.forEach(function(tema) {
        const temaText = tema.querySelector('.tema-id').value.trim().toLowerCase();

        if (temaText.includes(searchText)) {
          tema.style.display = 'block';
        } else {
          tema.style.display = 'none';
        }
      });
    });
  });
  $(document).ready(function() {
    var currentUrl = window.location.href;
    var parts = currentUrl.split('/');
    var id = parts[parts.length - 1];
    console.log('ID de la ruta:', id);
    $(".cont").sortable({
      connectWith: ".cont",
      start: function(event, ui) {
        var inputValues = [];

        // Encuentra todos los inputs dentro del elemento arrastrado y obtén sus valores
        $(ui.item).find('input').each(function() {
          inputValues.push($(this).val());
        });

        $(ui.item).data('original-values', inputValues);
      },
      receive: function(event, ui) {
        setTimeout(function() {
          // Obtén los valores actualizados después de un breve retraso
          var updatedValues = [];

          // Encuentra todos los inputs dentro del elemento y obtén sus valores actualizados
          $(ui.item).find('input').each(function() {
            updatedValues.push($(this).val());
          });

          console.log('Valores actualizados:', updatedValues);
          $('#guardarBtn').click(function() {

            var nombreLibro = updatedValues[0];
            var descripcionLibro = updatedValues[1];
            var imagenLibro = updatedValues[2];
            var urlLibro = updatedValues[3];

            $.ajax({
              url: '/simuladorNS3/public/index.php/guardarLibro',
              method: 'POST',
              data: {
                nombreLibro: nombreLibro,
                descripcionLibro: descripcionLibro,
                imagenLibro: imagenLibro,
                urlLibro: urlLibro,
                idMateriaLibro: id,
              },
              success: function(response) {
                $("#mensajeGuardado").fadeIn().delay(3000).fadeOut();
                $(".cont").sortable("refresh");
              },
              error: function(xhr, status, error) {
                console.error('Error al guardar el libro:', error);
              }
            });
          });
        });
      }
    }).disableSelection();
  });
</script>