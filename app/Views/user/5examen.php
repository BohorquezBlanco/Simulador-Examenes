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
        <h1 class="text-center">EXAMEN DE INGRESO FACULTAD DE CIENCIAS TECNOLOGICAS</h1><br>
    <div class="container ">
        <?php $contador= 0;?>
        <?php $cont= 0;?>

        <!---pregunta entra --->
        <?php foreach($materias as $materia):?>
    
            <h4 class="text-center text-danger"><?php echo $materia['nombreMateria'];?></h4>
            <p class="text-danger"><?php echo $materia['descripcionMateria'];?></p>
            <hr class="border  border-2  border-danger col-12">
            <section id="<?php echo $materia['nombreMateria'];?>">
                <!---pregunta divide--->
                <?php foreach($examenes as $examen):?>
                    <?php $idmateriaE=$examen->idMateria; ?>
                        <?php $idmateria=$materia['idMateria']; ?>
                        <?php if($idmateria== $idmateriaE):?>

                            <hr class="border  border-1 opacity-75 col-12">

                            <p> <?php echo $examen->enunciado;?> </p>
                        <div class="d-flex justify-content-between">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="exampleRadios<?php echo $cont;?>" id="exampleRadios<?php echo $contador;?>" value="option" checked>
                                <label class="form-check-label" for="exampleRadios<?php echo $contador;?>">a) <?php echo $examen->a;?> </label>
                            </div>  
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="exampleRadios<?php echo $cont;?>" id="exampleRadios<?php echo $contador=$contador+1;?>" value="option">
                                <label class="form-check-label" for="exampleRadios<?php echo $contador;?>">b) <?php echo $examen->b;?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="exampleRadios<?php echo $cont;?>" id="exampleRadios<?php echo $contador=$contador+1;?>" value="option">
                                <label class="form-check-label" for="exampleRadios<?php echo $contador;?>">c) <?php echo $examen->c;?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="exampleRadios<?php echo $cont;?>" id="exampleRadios<?php echo $contador=$contador+1;?>" value="option">
                                <label class="form-check-label" for="exampleRadios<?php echo $contador;?>">d) <?php echo $examen->d;?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="exampleRadios<?php echo $cont;?>" id="exampleRadios<?php echo $contador=$contador+1;?>" value="option">
                                <label class="form-check-label" for="exampleRadios<?php echo $contador;?>">e) <?php echo $examen->e;?></label>
                            </div>
                        
                        </div>
                        <hr class="border  border-1 opacity-75 col-12">
                        <?php endif;?>
                <?php endforeach;?>
            </section>

          <?php $contador= $contador+1;?>
          <?php $cont= $cont+1;?>
          <?php endforeach;?>
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
        window.location.href = 'finalizacion/examen';
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
    
