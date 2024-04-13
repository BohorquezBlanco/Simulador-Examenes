<?php helper('form'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        <h1 class="text-center"><?php echo $nombreCarrera;?></h1>
            <h2 class="fs-4 m-2 text-center">TU PUNTUACION:</h2>

            <?php echo form_open_multipart(base_url('revisarExamen'), ['id' => 'uploadForm']);?>
                <!-- nombre_de_tu_vista.php -->
                <input type="hidden" name="nombreCarrera"  value="<?php echo $nombreCarrera;?>">
                <input type="hidden" name="idCarrera" value="<?php echo $idCarrera;?>">
                <input type="hidden" name="codigoExamen" value="<?php echo $codigoExamen;?>">

                <?php foreach ($calificacion as $item): ?>
                    <h4>Seccion: <?php echo $item['Materia']; ?></h4>
                    <p>Total: <?php echo $item['Total']; ?> / <?php echo $item['Puntaje']; ?></p>
                <?php endforeach; ?>

                <?php foreach ($seleccion as $seleccionado): ?>
                    <input type="hidden" name="seleccion[]"  value="<?php echo $seleccionado;?>">
                <?php endforeach; ?>
                <?php foreach ($resultados as $resultado): ?>
                    <input type="hidden" name="resultados[]"  value="<?php echo $resultado;?>">
                <?php endforeach; ?>

                <button class="btn btn-success col-12" >VER EXAMEN</button>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
