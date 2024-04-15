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
    <h1 class="text-center">RESOLVER: </h1><br>
    <div class="container ">

        <?php   foreach($preguntas as $pregunta): ?>
            <form action="verificar_respuesta.php" method="post">
            <input type="hidden" class="respuesta_correcta" value="<?php echo $pregunta['respuesta']; ?>">

            <div class="col-12">
                <p class="col-12"><?php echo $pregunta['enunciado'];?></p>
                <div class="col-6">
                    <img src="<?php echo $pregunta['imagenPregunta'];?>" alt="" class="img-fluid">
                </div>
            </div>
            <div class="container mb-5">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="a">
                    <label class="form-check-label" for="inlineRadio1">a)<?php echo $pregunta['a'];?></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="b">
                    <label class="form-check-label" for="inlineRadio2">b)<?php echo $pregunta['b'];?></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="c" >
                    <label class="form-check-label" for="inlineRadio3">c)<?php echo $pregunta['c'];?></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="d" >
                    <label class="form-check-label" for="inlineRadio4">d)<?php echo $pregunta['d'];?></label>
                </div>
            </div>
 
                <button class="btn btn-success col-12" >VERIFICAR</button>
                </form>
        <?php endforeach  ;?>
    

    </div>
                 <div id=resultadoParrafo>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Resultado</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="resultado"></div> <!-- Elemento para mostrar el resultado -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>
                 </div>

    <script>
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


document.addEventListener("DOMContentLoaded", function() {
    var formularios = document.querySelectorAll('form');
    
    formularios.forEach(function(formulario) {
        formulario.addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar que el formulario se envíe
            
            // Obtener el valor de la respuesta correcta
            var respuestaCorrecta = this.querySelector('.respuesta_correcta').value;
            
            // Obtener el valor del radio button seleccionado
            var respuestaSeleccionada = this.querySelector('input[name="inlineRadioOptions"]:checked').value;
            
            // Obtener el elemento donde se mostrará el resultado en el modal
            var resultadoDiv = document.getElementById('resultado');
            
            // Configurar el mensaje para respuesta correcta o incorrecta
            var mensaje = '';
            if (respuestaSeleccionada === respuestaCorrecta) {
                mensaje = "¡Bien hecho!";
                resultadoDiv.classList.add('correcto'); // Agregar una clase para el estilo de "Bien hecho"
            } else {
                mensaje = "¡Incorrecto!";
                resultadoDiv.classList.add('incorrecto'); // Agregar una clase para el estilo de "Incorrecto"
            }
            
            // Mostrar el mensaje en el modal
            resultadoDiv.textContent = mensaje;
            
            // Mostrar el modal
            var modal = new bootstrap.Modal(document.getElementById('exampleModal'));
            modal.show();
        });
    });
});
</script>
    
