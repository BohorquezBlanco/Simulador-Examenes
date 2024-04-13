<?php helper('form'); ?>

    <section id="folio" class="sec-folio">
        <div class="container">
          <h1><?php echo $titulo['nombreCarrera'] ;?></h1>
          <p><?php echo $titulo['descripcionCarrera'] ;?></p>
          <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              Añadir Materias Al Curso
            </button>

            <!-- MODAL AGREGAR MATERIAS-->
              <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar una materia</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <?php echo form_open_multipart(base_url('crearMateria'), ['id' => 'uploadForm']) ;?>
                    <input name="idCarrera" type="hidden" class="form-control" value="<?php echo $idCarrera ;?>">
                      <div class="modal-body">
                        <div class="mb-3">
                          <label  for="exampleFormControlInput1" class="form-label">Nombre de la materia</label>
                          <input name="nombreMateria" type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlTextarea1" class="form-label">Descripcion de la materia</label>
                          <textarea name="descripcionMateria" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlTextarea1" class="form-label">Imagen de la materia</label>
                          <textarea name="imagenMateria" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary col-12">Añadir Materia</button>
                      </div>
                    </form>

                  </div>
                </div>
              </div>
 
          <hr />
          <div class="row justify-content-center">
            <?php $n=0 ;?>
            <?php foreach($materias as $materia):?>
            <div class="col-md-3 border m-1">
                  <h5 class="card-title text-center p-2"><?php echo $materia['nombreMateria'] ;?></h5>
                <img class="center-block" src="<?php echo $materia['imagenMateria'] ;?>" alt="By Håkon Sataøen" />

                <div class="card-body ">
                  <a href="<?php echo base_url().'bibliografiaAdm/'.$materia['idMateria']?>" class="btn btn-light col-12 m-1 ">MATERIAL DE ESTUDIO</a>
                  <a href="<?php echo base_url().'reforzarAdmi/'.$idCarrera.'/'.$materia['idMateria'];?>" class="btn btn-light col-12 m-1">EXAMENES Y BANCO DE PREGUNTAS</a>
                  
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

                    <?php echo form_open_multipart(base_url('editarMateria'), ['id' => 'uploadForm']) ;?>
                      <div class="modal-body">
                        <h5 class="card-title m-3 text-center"><?php echo $materia['nombreMateria'] ;?></h5>
                          <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nombre de la materia</label>
                            <input value="<?php echo $materia['nombreMateria'] ;?>" name="nombreMateria" type="text" class="form-control" id="exampleFormControlInput1" placeholder="nombre de la materia" >
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Descripcion del curso</label>
                            <textarea  class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcionMateria"><?php echo $materia['descripcionMateria'] ;?></textarea>
                          </div>
                          <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Imagen del curso</label>
                            <textarea  class="form-control" id="exampleFormControlTextarea1" rows="3" name="imagenMateria"><?php echo $materia['imagenMateria'] ;?></textarea>
                          </div>
                      </div>
                      <div class="modal-footer">
                      <input type="hidden" value="<?php echo $materia['idMateria'];?>" name="idMateria">
                      <input type="hidden" value="<?php echo $materia['idCarrera'];?>" name="idCarrera">

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
                    <div class="modal-body">
                      <?php echo form_open_multipart(base_url('eliminarMateria'), ['id' => 'uploadForm']) ;?>
                        <input type="hidden" value="<?php echo $materia['idMateria'];?>" name="idMateria">
                        <input type="hidden" value="<?php echo $materia['idCarrera'];?>" name="idCarrera">

                        <h5>ESTAS SEGURO DE ELIMINARLO ?</h5>
                        <button type="submit" class="btn btn-danger col-12 ">ELIMINAR MATERIA</button>
                      </form>
                    </div>
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

    
