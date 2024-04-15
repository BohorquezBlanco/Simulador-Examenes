<section id="folio" class="sec-folio">
    <div class="container">
      <h1 class="mb-3"><?php echo $titulo;?></h1>
      <div class="row justify-content-center">
        <?php $n=0 ;?>
        <?php foreach($carreras as $carrera):?>
        <div class="col-md-3 border m-1">
              <h5 class="card-title m-3 text-center"><?php echo $carrera['nombreCarrera'] ;?></h5>
              <a  href="<?php echo base_url().'materias/'.$carrera['idCarrera'];?>">
              <img class="center-block" src="<?php echo $carrera['imagenCarrera'] ;?>" alt="By Håkon Sataøen" />
            </a>
            <div class="card-body ">
              <a href="<?php echo base_url().'materias/'.$carrera['idCarrera'];?>" class="btn btn-light col-12 m-1 ">MATERIAS DEL CURSO</a>
              <a href="" class="btn btn-light col-12 m-1">RESOLVER UN EXAMEN ALEATORIO</a>
            </div>
        </div>
          <?php $n=$n+1 ;?>
        <?php endforeach;?>
        </div>
      </div>
    </div>
</section>

    
