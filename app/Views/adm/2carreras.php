<?php helper('form'); ?>
    <section id="folio" class="sec-folio">
        <div class="container">
          <h1><?php echo $titulo;?></h1>
    
          <hr />
          <div class="row justify-content-center">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              Agregar Carrera
            </button>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar una carrera</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <?php echo form_open_multipart(base_url('crearCarrera'), ['id' => 'uploadForm']) ;?>
                    <div class="modal-body">
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Nombre de la carrera</label>
                          <input name="nombreCarrera" type="text" class="form-control" id="exampleFormControlInput1" placeholder="nombre de la carrera" >
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlTextarea1" class="form-label">Descripción del curso</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcionCarrera"></textarea>
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlTextarea1" class="form-label">Imagen del curso</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="imagenCarrera"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">AÑADIR NUEVA CARRERA</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
    
            <?php $n=0 ;?>
            <?php foreach($carreras as $carrera):?>
            <div class="col-md-3 border m-1">
                  <h5 class="card-title m-3"><?php echo $carrera['nombreCarrera'] ;?></h5>
                  <a  href="<?php echo base_url().'materias/'.$carrera['idCarrera'];?>">
                <img class="center-block" src="<?php echo $carrera['imagenCarrera'] ;?>" alt="By Håkon Sataøen" />
                </a>
                <div class="card-body ">
                  <a href="<?php echo base_url().'materiasAdmi/'.$carrera['idCarrera'];?>" class="btn btn-light col-12 m-1 ">MATERIAS DEL CURSO</a>
                  <a href="" class="btn btn-light col-12 m-1">RESOLVER UN EXAMEN ALEATORIO</a>
        
                  <!-- MODAL MODIFICAR-->
                  <button type="button" class="btn btn-success col-12 mb-1" data-bs-toggle="modal" data-bs-target="#modificar<?php echo $n;?>">EDITAR</button>
                  <!-- FIN MODAL DE MODIFICAR -->

                  <!-- MODAL ELIMINAR-->
                  <button type="button" class="btn btn-danger col-12 mb-1" data-bs-toggle="modal" data-bs-target="#eliminar<?php echo $n;?>">ELIMINAR</button>
                  <!-- FIN MODAL ELIMINAR -->

                </div>
            </div>

              <!-- Modal MODIFICAR-->
              <div class="modal fade" id="modificar<?php echo $n;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <?php echo form_open_multipart(base_url('editarCarrera'), ['id' => 'editar']) ;?>
                      <div class="modal-body">
                        <h5 class="card-title m-3 text-center"><?php echo $carrera['nombreCarrera'] ;?></h5>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nombre de la carrera</label>
                            <input value="<?php echo $carrera['nombreCarrera'] ;?>" name="nombreCarrera" type="text" class="form-control" id="exampleFormControlInput1" placeholder="nombre de la carrera" >
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Descripcion del curso</label>
                            <textarea  class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcionCarrera"><?php echo $carrera['descripcionCarrera'] ;?></textarea>
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Imagen del curso</label>
                            <textarea  class="form-control" id="exampleFormControlTextarea1" rows="3" name="imagenCarrera"><?php echo $carrera['imagenCarrera'] ;?></textarea>
                          </div>
                      </div>
                      <div class="modal-footer">
                      <input type="hidden" value="<?php echo $carrera['idCarrera'];?>" name="idCarrera">
                        <button type="submit" class="btn btn-primary">EDITAR</button>
                      </div>
                    </form>

                  </div>
                </div>
              </div>
              <!-- FIN Modal MODIFICAR-->

              <!-- Modal ELIMINAR-->
              <div class="modal fade" id="eliminar<?php echo $n;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">ELIMINAR</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <?php echo form_open_multipart(base_url('eliminarCarrera'), ['id' => 'uploadForm']) ;?>
                    <input type="hidden" value="<?php echo $carrera['idCarrera'];?>" name="idCarrera">
                    <input type="text" class="input col-12" name="codigoEliminacion" placeholder="Codigo de eliminacion">
                    <div class="modal-body">
                        <h5>ESTAS SEGURO DE ELIMINARLO?</h5>
                        <button type="submit" class="btn btn-danger col-12 ">ELIMINAR CARRERA</button>
                    </div>
                    </form>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- FIN MODAL ELIMINAR-->

              

              <?php $n=$n+1 ;?>
            <?php endforeach;?>
            </div>
          </div>
        </div>
    </section>

