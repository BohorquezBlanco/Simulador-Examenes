<section id="folio" class="sec-folio">
    <div class="container">
      <h1 class="mb-3"><?php echo $titulo;?></h1>
      <div class="row justify-content-center">
        <?php $n=0 ;?>
        <?php foreach($carreras as $carrera):?>
        <div class="col-md-3 border m-1">
              <h5 class="card-title m-3 text-center"><?php echo $carrera['nombreCarrera'] ;?></h5>
              <a  href="<?php echo base_url().'materias/'.$carrera['idCarrera'];?>">
              <img class="center-block img-fluid" src="<?php echo $carrera['imagenCarrera'] ;?>" alt="By AnisSoft" style="height: 200px; object-fit: cover;">
            </a>
            <div class="card-body ">
              <a href="<?php echo base_url().'materias/'.$carrera['idCarrera'];?>" class="btn btn-light col-12 m-1 ">MATERIAS DEL CURSO</a>
              <a href="<?php echo base_url().'examenes/'.$carrera['idCarrera'];?>/0" class="btn btn-light col-12 m-1">RESOLVER UN EXAMEN ALEATORIO</a>
            </div>
        </div>
          <?php $n=$n+1 ;?>
        <?php endforeach;?>
        </div>
      </div>
    </div>
</section>

    
