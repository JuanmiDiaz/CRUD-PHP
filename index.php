<?php
session_start();
/**
 *requires para llamar a las dos clases que hemos creado
 **/
require "modelo/Cerveza.php";
require "modelo/Bd.php";
require "modelo/funciones.php";

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/stilos.css">
    <script src="js/script.js"></script>


</head>
<body onload="showSlides2();">

<?php
/**
 * incluye includes del menu y del header
 */
        include "includes/menu.php";
        include "includes/header.php";

?>
    <div class="container">
    <!--pagina principal donde tendremos algunas fotos y texto para rellenar-->
    <div class="mensaje"> <h3>Pagina de la colección de cervezas de Juanmi</h3></div>


    <section >
         <!-- slider principal que muestra una coleccion de fotos de cervezas-->

        <div class="noticia">
        <div class="slider"><div class="mySlides2"><img src="img/slider1.jpg"width="100%"></div><div class="mySlides2"><img src="img/slider2.jpg"width="100%" ></div><div class="mySlides2"><img src="img/slider3.jpg"width="100%"></div></div>
        <div style="text-align:center"><span class="dot2"></span><span class="dot2"></span><span class="dot2"></span></div></div>

        <div class="noticia">
            <p>Lorem fistrum ese hombree pecador jarl eiusmod cillum benemeritaar se calle ustée te voy a borrar el cerito a gramenawer. Irure llevame al sircoo officia apetecan aute no te digo trigo por no llamarte Rodrigor pupita pecador caballo blanco caballo negroorl aliquip. Ut quis commodo esse labore. De la pradera benemeritaar te va a hasé pupitaa nostrud voluptate ahorarr exercitation adipisicing. Irure a wan ese hombree amatomaa tiene musho peligro te voy a borrar el cerito aute. Irure sed enim aliquip no te digo trigo por no llamarte Rodrigor quietooor aute labore quis.</p>
        </div>

    </section>

        <?php
        /**
         * imprime el include del footer
         */
            include "includes/footer.php";
        ?>


</div>
</body>
</html>