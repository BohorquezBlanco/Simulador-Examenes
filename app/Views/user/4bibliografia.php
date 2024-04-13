<style>
  .imagen 
{
  max-width: 100%;
  object-fit: cover;
  width: 200px; 
  height: 300px;
}
#img { 
  width: 200px; 
  height: 300px; 
}
</style>
<section id="folio" class="sec-folio">
    <div class="container">
      <h1 class="mb-3"><?php echo $titulo['nombreMateria'] ;?></h1>
      <p class="text-center mb-3"><?php echo $titulo['descripcionMateria'] ;?></p>
      <div class="row justify-content-center">
        <?php $n=0 ;?>
        <?php foreach($libros as $libro):?>
        <div class="d-flex flex-wrap text-center col col-12"> 
          <div class="d-flex flex-column align-center pa-2 item" style="width: 16.6667%;">
            <div class="d-flex justify-center align-center overflow-hidden mb-0 pb-2">
              <a href="<?php echo $libro['urlLibro']?>" target="_self" class="d-flex v-card v-card--flat v-card--link v-sheet theme--light rounded-0">
                <img class="center-block imagen" id="img" src="<?php echo $libro['imagenLibro'] ;?>" alt="By Håkon Sataøen"/>
              </a>
            </div>
            <div class="d-flex justify-center align-center overflow-hidden mb-0 pb-2">
            <a href="<?php echo $libro['urlLibro']?>" class="card-title text-center p-2" >
            <p class="text-uppercase fw-bold m-1"><?php echo $libro['nombreLibro'] ;?></p>
            </div>
            </a>
          </div>
        </div>
          <?php $n=$n+1 ;?>
        <?php endforeach;?>
        </div>
      </div>
    </div>
</section>

