  <div class="container">
    <h1 class="fs-4 m-2 text-center"><?php echo $nombre;?></h1>
    <p>Refuerza tus conocimientos</p>
    <hr />
      <div class="row">
            <button class="btn btn-primary col-5" type="button">RESOLVER EXAMEN ALEATORIO</button>
            <div class="col-2"></div> <!-- Espacio de separación -->
            <button class="btn btn-primary col-5" type="button">RESOLVER EXAMEN PERSONALIZADO</button>
      </div>
      <hr class="col-12"/>
      <!------------------IDEA DE TABLAS---------------->
      <div class="table-responsive">
        <table class="table bordered">
          <thead>
            <tr>
              <th scope="col" class="col-1">#</th>
              <th class="text-center align-middle col-8" colspan="3">PREGUNTA</th>
              <th class="col-1">Resolver/Resolucion</th>
            </tr>
          </thead>
          <tbody>
          <?php $n=1;  foreach($preguntas as $pregunta): ?>
            <tr>
              <td scope="row"><?php echo $n ;?></td>
              <td colspan="2"><?php echo $pregunta['enunciado'];?></td>
              <td><img src="<?php echo $pregunta['imagenPregunta'];?>" alt="" class="img-fluid"></td>
              <td><div class="btn-group" role="group" aria-label="Grupo de botones">
                  <a target="_blank" href="<?php echo base_url().'resolverPregunta/'.$pregunta['idPregunta'];?>" class="btn btn-primary">Resolver</a>
                  <a target="_blank" href="<?php echo $pregunta['formula'];?>" class="btn btn-secondary">Resolución</a>
                  </div>
              </td>
            </tr>
            <?php $n=$n+1; endforeach  ;?>
          </tbody>
        </table>
      </div>

  </div>






  