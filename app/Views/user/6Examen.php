
<style>
    #cronometro {
        position: fixed;
        top: 10px;
        right: 10px;
        background-color: #f1f1f1;
        padding: 10px;
        border-radius: 5px;
        margin-top: 50px;
    }
    .correcto {
    color: green;
    font-weight: bold;

}

.incorrecto {
    color: red;
}
</style>

<section id="folio" class="sec-folio">
<div id="cronometro">
    00:00:00
</div>
<div id="resultadosExamen">
   
</div>


    <div class="container ">
        <form >
    <input type="hidden" name="idCarrera" value="<?php echo $datosMaterias['idCarrera'];?>">
    <input type="hidden" name="nombreCarrera" value="<?php echo $datosMaterias['nombreCarrera'];?>">

    <?php $contador = 0; ?> <!-- Inicializar la variable contador -->
    <?php $cont = 0; ?> <!-- Inicializar la variable contador -->

    <?php foreach($materias as $materia):?>
        <?php 
        // Verificar si hay preguntas asociadas a esta materia
        $preguntasAsociadas = array_filter($preguntas, function($examen) use ($materia) {
            return $examen['idMateria'] == $materia['idMateria'];
        });
        
        // Si hay preguntas asociadas, mostrar la información del examen
        if (!empty($preguntasAsociadas)):
        ?>
            <!---pregunta entra --->
            <h4 class="text-center text-danger"><?php echo $materia['nombreMateria'];?></h4>
            <input type="hidden" name="idMateria[]" value="<?php echo $materia['idMateria'];?>">
            <h6 class="text-danger text-center">Duracion: <?php echo $tiempo;?></h6>
            <h6 class="text-danger text-center">Cantidad de preguntas: <?php echo $cantidad;?></h6>
            
            <?php $cantidad = 0;?>
            <?php foreach($preguntasAsociadas as $pregunta):?>
                <!---pregunta divide--->
                <?php $cantidad++;?>
                <hr class="border  border-1 opacity-75 col-12">
                <input type="hidden" name="correctas[]" value="<?php echo $pregunta['respuesta'];?>">

                <div class="elementosOcultos">
                    <h6 class="respuesta-hidden">La respuesta es: "<?php echo $pregunta['respuesta'];?>"</h6>
                    <a class="respuesta-hidden" href="<?php echo $pregunta['resolucionPdf'];?>">Ver Resolución</a>
                </div>

                <div class="col-12">
                    <p class="col-12"><?php echo $pregunta['enunciado'];?></p>
                    <div class="col-6">
                        <img src="<?php echo $pregunta['imagenPregunta'];?>" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="container mb-5">

                <!---------------------------------SI ESTA VACIO ENTONCES SERA COMO SELECCIONAR ESTO----------------------------------------->
                    <div class="form-check form-check-inline d-none">
                        <input checked class="form-check-input check" type="radio" name="respuestasSeleccionadas[<?php echo $cont; ?>]" id="inlineRadio<?php echo $contador;?>" value="NO">
                        <label class="form-check-label check" for="inlineRadio<?php echo $contador;?>">NO) <?php $contador=$contador+1 ;?> NO</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input check" type="radio" name="respuestasSeleccionadas[<?php echo $cont; ?>]" id="inlineRadio<?php echo $contador;?>" value="a">
                        <label class="form-check-label check" for="inlineRadio<?php echo $contador;?>">a) <?php $contador=$contador+1 ;echo $pregunta['a'];?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input check" type="radio" name="respuestasSeleccionadas[<?php echo $cont; ?>]" id="inlineRadio<?php echo $contador;?>" value="b">
                        <label class="form-check-label check" for="inlineRadio<?php echo $contador;?>">b) <?php $contador=$contador+1 ; echo $pregunta['b'];?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input check" type="radio" name="respuestasSeleccionadas[<?php echo $cont; ?>]" id="inlineRadio<?php echo $contador;?>" value="c" >
                        <label class="form-check-label check" for="inlineRadio<?php echo $contador;?>">c) <?php $contador=$contador+1 ; echo $pregunta['c'];?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input check" type="radio" name="respuestasSeleccionadas[<?php echo $cont; ?>]" id="inlineRadio<?php echo $contador;?>" value="d" >
                        <label class="form-check-label check" for="inlineRadio<?php echo $contador;?>">d) <?php $contador=$contador+1 ; echo $pregunta['d'];?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input check" type="radio" name="respuestasSeleccionadas[<?php echo $cont; ?>]" id="inlineRadio<?php echo $contador;?>" value="e" >
                        <label class="form-check-label check" for="inlineRadio<?php echo $contador;?>">e) <?php $contador=$contador+1 ; echo $pregunta['e'];?></label>
                    </div>
                </div>
                <hr class="border  border-1 opacity-75 col-12">
                <?php $cont= $cont+1;?>
            <?php endforeach;?>
            
            <!-- Agregar el input oculto con la cantidad de preguntas -->
            <input type="hidden" name="delimitador[]" value="<?php echo $cantidad;?>">
        <?php endif;?>
    <?php endforeach;?>
    
    <button type="button" class="btn col-12 btn-success" id="btnCalificar">Terminar Examen</button>
</form>

        </div>
                        

</section>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
var tipo = <?php echo json_encode($tiempo); ?>;
    
    if (tipo == "SL") {
     
        var segundos = 0, minutos = 0, horas = 0;
    var cronometroDisplay = document.getElementById('cronometro');

    function actualizarCronometro() {
        segundos++;


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
    }
    else{
        var minutos = <?php echo $tiempo; ?>;
    
        var segundos = 0;
        var cronometroDisplay = document.getElementById('cronometro');

        function actualizarCronometro() {
            segundos--;

            // Si los segundos alcanzan 0, reiniciar los segundos y disminuir los minutos
            if (segundos < 0) {
                segundos = 59;
                minutos--;
            }

            // Verificar si el tiempo ha llegado a cero
            if (minutos === 0 && segundos === 0) {
                $('#btnCalificar').trigger('click'); // Activar automáticamente el botón
                clearInterval(intervalo); // Detener el intervalo del cronómetro
                var tiempo="finalizado"
                cronometroDisplay.innerHTML = tiempo;
                return;
            }

            var tiempo = (minutos < 10 ? "0" + minutos : minutos) + ":" + (segundos < 10 ? "0" + segundos : segundos);
            cronometroDisplay.innerHTML = tiempo;
        }
    }


    var intervalo = setInterval(actualizarCronometro, 1000); // Actualizar cada segundo


    $(document).ready(function() {
    // Ocultar los elementos al cargar la página
    $('.elementosOcultos').hide();

    $('#btnCalificar').click(function() {

        $('.elementosOcultos').show(); // Mostrar los elementos ocultos
        var respuestasSeleccionadas = $('input[name^="respuestasSeleccionadas"]:checked');
        var respuestasCorrectas = $('input[name^="correctas"]');
        var respuestasCorrectasCount = 0;
        var respuestasIncorrectasCount = 0;

        // Iterar sobre las respuestas seleccionadas
        respuestasSeleccionadas.each(function(index, element) {
            var respuestaSeleccionada = $(element).val();
            var respuestaCorrecta = $(respuestasCorrectas[index]).val();

            if (respuestaSeleccionada == respuestaCorrecta) {
                // La respuesta es correcta
                respuestasCorrectasCount++;
                // Marcar la respuesta seleccionada como correcta (opcional)
                $(element).siblings('label').css('color', 'green');
                $(element).siblings('input').css('color', 'green');

            } else {
                // La respuesta es incorrecta
                respuestasIncorrectasCount++;
                // Marcar la respuesta seleccionada como incorrecta (opcional)
                $(element).siblings('label').css('color', 'red');
                $(element).siblings('input').css('color', 'red');

            }
            
            // Deshabilitar el elemento de entrada
            $('.check').prop('disabled', true);
                });

        // Calcular la puntuación del examen
        var totalPreguntas = respuestasCorrectas.length;
        var puntuacion = (respuestasCorrectasCount / totalPreguntas) * 100;

        // Mostrar los resultados en el elemento #resultadosExamen
        $('#resultadosExamen').empty();
        var preguntaHTML = `
            <div class="card text-center " style="height: 70vh;">
                <div class="card-header">
                    Calificación
                </div>
                <div class="card-body">
                    <h5 class="card-title">total Preguntas:${totalPreguntas}</h5><br>
                    <h5 class="card-title">Preguntas Incorrectas: ${respuestasCorrectasCount}</h5><br>
                    <h5 class="card-title">Calificacion total : ${puntuacion}</h5><br>
                </div>
                <div class="card-footer text-body-secondary">
                    Resolucion de examen mas abajo
                </div>
            </div></br>`;
        $('#resultadosExamen').append(preguntaHTML);

        // Desplazarse automáticamente hacia arriba de la página
        $('html, body').animate({
            scrollTop: 0
        }, 'slow');
    });
});

</script>



