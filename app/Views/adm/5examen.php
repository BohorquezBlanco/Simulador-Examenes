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
    00:00:00
</div>
    <h1 class="text-center"><?php echo $nombreCarrera;?></h1><br>


        <div class="container ">
        <?php echo form_open_multipart(base_url('examenResultado'), ['id' => 'uploadForm']) ?>
            
        <input type="hidden" name="nombreCarrera"  value="<?php echo $nombreCarrera;?>">
                <input type="hidden" name="idCarrera" value="<?php echo $idCarrera;?>">

            <?php $contador= 0;?>
            <?php $cont= 0;?>

            <!---pregunta entra --->
            <?php foreach($materias as $materia):?>
        
                <section id="<?php echo $materia['nombreMateria'];?>">
                <h4 class="text-center text-danger"><?php echo $materia['nombreMateria'];?></h4>
                <h6 class="text-danger"><?php echo $materia['descripcionMateria'];?></h6>
                <h6 class="text-danger text-center">Año: <?php echo $materia['añoExamen'];?></h6>
                <h6 class="text-danger text-center">Opcion:<?php echo $materia['opcionExamen'];?></h6>
                <h6 class="text-danger text-center">puntaje evaluado sobre:<?php echo $materia['puntaje'];?></h6>
                <input type="hidden" name="puntaje[]" value="<?php echo $materia['puntaje'];?>">
                <input type="hidden" name="materia[]" value="<?php echo $materia['nombreMateria'];?>">
                <input type="hidden" name="codigoExamen" value="<?php echo $materia['codigoExamen'];?>">


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
                                <input type="hidden" name="respuestas[]" value="<?php echo $examen['respuesta'];?>">
                            <div>
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
            <button class="btn col-12 btn-success" id="btnDuplicar">Terminar Examen</button>
        </form>
        </div>
                        

</section>


    <script>
var segundos = 0, minutos = 0, horas = 0;
var cronometroDisplay = document.getElementById('cronometro');

function actualizarCronometro() {
    segundos++;

    // Verificar si se han alcanzado los 3 minutos (180 segundos)
    if (segundos === 50) {
        clearInterval(intervalo); // Detener el intervalo
        window.location.href = 'revisarExamen';
    }

    // Si los segundos alcanzan 60, reiniciar los segundos y aumentar los minutos
    if (segundos === 60) {
        segundos = 0;
        minutos++;
    }

    // Si los minutos alcanzan 60, reiniciar los minutos y aumentar las horas
    if (minutos === 60) {
        minutos = 0;
        horas++;
    }

    var tiempo = (horas < 10 ? "0" + horas : horas) + ":" + (minutos < 10 ? "0" + minutos : minutos) + ":" + (segundos < 10 ? "0" + segundos : segundos);
    cronometroDisplay.innerHTML = tiempo;
}

var intervalo = setInterval(actualizarCronometro, 1000); // Actualizar cada segundo

</script>
    
