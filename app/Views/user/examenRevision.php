<?php helper('form'); ?>
<style>
    #cronometro {
        position: fixed;
        top: 10px;
        right: 10px;
        background-color: #f1f1f1;
        padding: 10px;
        border-radius: 5px;
    }
</style>

<section id="folio" class="sec-folio">
<div id="cronometro">
   Calificacion total: 80
</div>
    <h1 class="text-center"><?php echo $nombreCarrera;?></h1><br>

        <div class="container ">
            
                <input type="hidden" name="nombreCarrera"  value="<?php echo $nombreCarrera;?>">
                <input type="hidden" name="idCarrera" value="<?php echo $idCarrera;?>">

            <?php $contador= 0;?>
            <?php $cont= 0;?>
            <?php $i= 0;?>


            <!---pregunta entra --->
            <?php foreach($materias as $materia):?>
        
                <section id="<?php echo $materia['nombreMateria'];?>">
                <h4 class="text-center text-danger"><?php echo $materia['nombreMateria'];?></h4>
                <h6 class="text-danger"><?php echo $materia['descripcionMateria'];?></h6>
                <h6 class="text-danger text-center">Año: <?php echo $materia['añoExamen'];?></h6>
                <h6 class="text-danger text-center">Opcion:<?php echo $materia['opcionExamen'];?></h6>
                <h6 class="text-danger text-center">puntaje evaluado sobre:<?php echo $materia['puntaje'];?></h6>
                <hr class="col-12 border-4">

                    <!---pregunta divide--->
       
                    <?php $cantidad = 0;?>

                    <?php foreach($examenes as $examen):?>
                        <?php $idmateriaE=$examen['idMateria']; ?>
                            <?php $idmateria=$materia['idMateria']; ?>
                            <?php if($idmateria== $idmateriaE):?>

                                <?php $cantidad++;?>

                                <hr class="border  border-1 opacity-75 col-12">

                                <p> <?php echo $examen['enunciado'];?> </p>
                            <div class="d-flex justify-content-between">
                                <!---------------------------INPUT DE LA RESPUESTA PARA ENVIAR AL SERVIDOR--------------------->
                            <div>
                            <label class="col-12 m-1 fs-5 text-success" for="">Inciso correcto: "<?php echo $examen['respuesta'];?>"</label>

                            
                            <?php if($seleccion[$i] == $examen['respuesta']): ?>
                                <label class="col-12 m-1 fs-5 text-success" for="">Tu respuesta: "<?php   echo $seleccion[$i];?>"</label>                               
                                 <?php else: ?>
                                    <label class="col-12 m-1 fs-5 text-danger" for="">Tu respuesta: "<?php   echo $seleccion[$i];?>"</label>                               
                                <?php endif; ?>
                            <?php $i= $i+1;?>


                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="seleccionado<?php echo $contador;?>" id="<?php echo $cont;?>" value="a" checked>
                                    <label class="form-check-label" for="<?php echo $cont;?>">a) <?php echo $examen['a'];?> </label>
                                </div>  
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="seleccionado<?php echo $contador;?>" id="<?php echo $cont=$cont+1;?>" value="b">
                                    <label class="form-check-label" for="<?php echo $cont;?>">b) <?php echo $examen['b'];?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="seleccionado<?php echo $contador;?>" id="<?php echo $cont=$cont+1;?>" value="c">
                                    <label class="form-check-label" for="<?php echo $cont;?>">c) <?php echo $examen['c'];?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="seleccionado<?php echo $contador;?>" id="<?php echo $cont=$cont+1;?>" value="d">
                                    <label class="form-check-label" for="<?php echo $cont;?>">d) <?php echo $examen['d'];?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="seleccionado<?php echo $contador;?>" id="<?php echo $cont=$cont+1;?>" value="e">
                                    <label class="form-check-label" for="<?php echo $cont;?>">e) <?php echo $examen['e'];?></label>
                                </div>
                                <div class=" col-12">
                                    <a class="btn btn-primary col-12" target="_blank" href="">Ver Resolucion</a>                                
                                </div>
                            
                            </div>

                            </div>
                            <hr class="border  border-1 opacity-75 col-12">
                            <?php $contador= $contador+1;?>

                            <?php endif;?>
                    <?php endforeach;?>
                </section>
                <input type="hidden" name="delimitador[]" value="<?php echo $cantidad;?>">
            <?php $cont= $cont+1;?>

            <?php endforeach;?>

            <a href="<?php echo base_url().'examenesAdmi/'.$idCarrera.'/0';?>" class="btn btn-light col-12 m-1"  >TERMINAR REVISION</a>
        </div>
                        

</section>



    
