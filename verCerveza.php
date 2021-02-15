<?php
/**
 *requires para llamar a las dos clases que hemos creado
 **/
require "includes/privado.php";
require "modelo/Cerveza.php";
require "modelo/Bd.php";
require "modelo/funciones.php";
require "modelo/ListaCervezas.php";
/**
 * tenemos una proteccion par no mostras los accesos a las paginas, pero con esto directamente no dejaríamos entrar
 * a usuario que no tengan un persmiso superior a 1.
 */
if($_SESSION['permiso']<1){
    header("location:index.php");
}
/**
 * con esto nos traemos el id que nos viene por el GET de la url, y nos aseguramos que es un entero
 */

$id = intval($_GET['id']);

$cerveza=new Cerveza();

$cerveza->obtenerPorId($id);

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
    <div class="mensaje"> <h3>Cerveza seleccionada</h3></div>


    <section >

    <?php
    echo $cerveza->imprimirEnFicha2();
    ?>

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