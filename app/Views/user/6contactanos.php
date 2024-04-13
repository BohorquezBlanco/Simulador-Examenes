<?php echo $this->extend('plantilla/layout');?>

<?php echo $this->section('contenido');?>

<section id="contact" class="sec-contact align-items-center">
    <div class="container d-flex flex-column">
        <h1>Contáctanos</h1>

        <div class="py-5">
        <div class="row">
        <div class=" col-sm-offset-4">
            <form class="center-block" action="#" method="post">
            <div class="form-group">
                <label class="sr-only" for="inputName">Nombre</label>

                <input id="inputName" class="form-control" type="text" placeholder="Adam Smith" required />
            </div>

            <div class="form-group">
                <label for="inputMail" class="sr-only">Correo</label>

                <input id="inputMail" class="form-control" type="email" placeholder="adam.smith@gmail.com" required />
            </div>

            <div class="form-group">
                <label for="inputMessage" class="sr-only">Tu mensaje</label>

                <textarea id="inputMessage" class="form-control" name="message" cols="30" rows="8" required></textarea>
            </div>
        </div>

            <div class="d-grid gap-2 col-6 mx-auto" >
                <button class="btn btn-default center-block" type="submit" value="Hire me">Enviar</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    </section>
</div>

<?php echo $this->endSection();?>

<!--<?php echo $this->section('scripts'); ?>
<script>
    alert("Hola Natt")

</script>
<?php echo $this->endSection();?>-->