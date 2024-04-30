<section id="folio" class="sec-folio">
    <div class="container">
      <h1 class="mb-3"><?php echo $titulo['nombreCarrera'] ;?></h1>
      <p class="text-center mb-3"><?php echo $titulo['descripcionCarrera'] ;?></p>
      <div class="row justify-content-center">
        <?php $n=0 ;?>
        <?php foreach($carreras as $carrera):?>
        <div class="col-md-3 border m-1">
              <h5 class="card-title text-center p-2"><?php echo $carrera['nombreMateria'] ;?></h5>
              <a  href="<?php echo base_url().'materias/'.$carrera['idMateria'];?>">
            <img class="center-block img-fluid" src="<?php echo $carrera['imagenMateria'] ;?>" alt="By AnisSoft" style="height: 200px; object-fit: cover;">
            </a>
            <div class="card-body ">
              <a href="<?php echo base_url().'bibliografia/'.$carrera['idMateria'];?>" class="btn btn-light col-12 m-1 ">BIBLIOGRAFIA</a>
              <a href="<?php echo base_url().'examenes/'.$carrera['idMateria'].'/'.$carrera['idMateria'];?>" class="btn btn-light col-12 m-1">DAR EXAMEN DE LA MATERIA</a>
            </div>
          </div>
          <?php $n=$n+1 ;?>
        <?php endforeach;?>
        </div>
      </div>
    </div>
</section>

    
