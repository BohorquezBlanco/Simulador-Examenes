<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styleE.css">
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>ANISSOFT</title>
</head>

<body>
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
        <h1 class="text-center">Examen</h1><br>

        <div class="container">
            
            <?php foreach ($datosCarreraUniversidad as $carrera => $materias) : ?>
                <h2><?php echo $carrera; ?></h2>
                <?php foreach ($materias as $materia => $temas) : ?>
                    <h3><?php echo $materia; ?></h3>
                    <?php foreach ($temas as $tema) : ?>
                        <section id="<?php echo $tema['nombreTema']; ?>">
                            <h4 class="text-center text-danger"><?php echo $tema['nombreTema']; ?></h4>
                            <h6 class="text-danger"><?php echo $tema['descripcionTema']; ?></h6>
                            <!-- Aquí podrías mostrar más información sobre el tema si lo deseas -->
                            <?php foreach ($tema['preguntas'] as $pregunta) : ?>
                                <hr class="col-12 border-4">
                                <p><?php echo $pregunta['enunciado']; ?></p>
                                <div class="d-flex justify-content-between">
                                    <input type="hidden" name="respuestas[]" value="<?php echo $pregunta['respuesta']; ?>">
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="seleccionado<?php echo $pregunta['idPregunta']; ?>" id="<?php echo $pregunta['idPregunta']; ?>a" value="a" checked>
                                            <label class="form-check-label" for="<?php echo $pregunta['idPregunta']; ?>a">a) <?php echo $pregunta['a']; ?></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="seleccionado<?php echo $pregunta['idPregunta']; ?>" id="<?php echo $pregunta['idPregunta']; ?>b" value="b">
                                            <label class="form-check-label" for="<?php echo $pregunta['idPregunta']; ?>b">b) <?php echo $pregunta['b']; ?></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="seleccionado<?php echo $pregunta['idPregunta']; ?>" id="<?php echo $pregunta['idPregunta']; ?>c" value="c">
                                            <label class="form-check-label" for="<?php echo $pregunta['idPregunta']; ?>c">c) <?php echo $pregunta['c']; ?></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="seleccionado<?php echo $pregunta['idPregunta']; ?>" id="<?php echo $pregunta['idPregunta']; ?>d" value="d">
                                            <label class="form-check-label" for="<?php echo $pregunta['idPregunta']; ?>d">d) <?php echo $pregunta['d']; ?></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="seleccionado<?php echo $pregunta['idPregunta']; ?>" id="<?php echo $pregunta['idPregunta']; ?>e" value="e">
                                            <label class="form-check-label" for="<?php echo $pregunta['idPregunta']; ?>e">e) <?php echo $pregunta['e']; ?></label>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </section>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
            <button class="btn col-12 btn-success" id="btnDuplicar">Terminar Examen</button>
        </div>
    </section>
<script>
    function startCountdown(duration, display) {
    let timer = duration, hours, minutes, seconds;
    const interval = setInterval(() => {
        hours = parseInt(timer / 3600, 10);
        minutes = parseInt((timer % 3600) / 60, 10);
        seconds = parseInt(timer % 60, 10);

        hours = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = hours + ":" + minutes + ":" + seconds;

        if (--timer < 0) {
            clearInterval(interval);
        }
    }, 1000);
}

window.onload = () => {
    const countdownTime = 3600; // Tiempo en segundos (por ejemplo, 1 hora)
    const display = document.querySelector('#contador');
    startCountdown(countdownTime, display);
};

</script>
</body>

</html>
