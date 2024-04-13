<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url();?>css/micss.scss" rel="stylesheet" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php echo $this->include('plantilla/menu'); ?>

<?php echo $this->renderSection("contenido");?>

    <footer id="footer">
    <div class="container">
    <ul class="soc-media-ul">
        <li>
        <a href="https://twitter.com/AlexDevero" class="fa fa-twitter" target="_blank"></a>
        </li>

        <li>
        <a href="https://plus.google.com/u/0/+AlexDevero" class="fa fa-google-plus" target="_blank"></a>
        </li>

        <li>
        <a href="https://cz.linkedin.com/pub/alex-devero/38/262/70/" class="fa fa-linkedin" target="_blank"></a>
        </li>

        <li>
        <a href="https://www.behance.net/d3v3r0" class="fa fa-behance" target="_blank"></a>
        </li>

        <li>
        <a href="mailto:example@gmail.com" class="fa fa-envelope"></a>
        </li>
    </ul>
    </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!--<?php echo $this->renderSection("scripts"); ?>-->

</body>

</html>