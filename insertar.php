<?php
/**
 *requires para llamar a las dos clases que hemos creado
 **/require "includes/privado.php";
require "modelo/Cerveza.php";
require "modelo/Bd.php";
require "modelo/funciones.php";
/**
 * tenemos una proteccion par no mostras los accesos a las paginas, pero con esto directamente no dejaríamos entrar
 * a usuario que no tengan un persmiso superior a 1.
 */
if($_SESSION['permiso']<1){
    header("location:index.php");
}


if(isset($_POST) && !empty($_POST)){
    /**
     * generamos el objeto cerveza
     */
    $cerveza=new Cerveza();
    /**
     * y ahora quiero que a ese objeto cerveza se le inserte el POST ( que son los datos)
     * vete a esta localizacion y abre esa direccion
     */
    $cerveza-> insertar($_POST, $_FILES['foto']);

    header('location:coleccion.php');

}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/stilos.css">
    <script src="js/scriptValidacion.js"></script>
    
</head>
<body>
    <?php
    /**
     * incluye includes del menu y del header
     */
        include "includes/menu.php";
        include "includes/header.php";

    ?>
<div class="container">
    <!--pagina principal donde tendremos algunas fotos y texto para rellenar-->
    <div class="mensaje"> <h3>Aquí podemos insertar nuevas cervezas</h3></div>


    <section >

    </section>

    <header>
        <form name="cerveza" action="<?php echo $_SERVER['PHP_SELF']?> " method="post" enctype="multipart/form-data" onsubmit="return validacion()">
            <ul>
                <li><input class="dato1" placeholder="  Nombre" type="text" id="nombre" name="nombre"></li>
                <li><input class="dato1" placeholder="  Pais" type="text"  id="pais" name="pais"></li>
                <li><input class="dato1" placeholder="  Estilo" type="text"  id="estilo" name="estiLo"></li>
                <li><input class="dato1" placeholder="  Unidades" type="text" id="unidades" name="unidades"></li>
                <li><input class="dato1" placeholder="  Precio" type="text" id="precio" name="precio"></li>
                <li><input class="dato1" placeholder="  Coleccion" type="text" id="coleccion" name="coleccion"></li>
                <li><input placeholder="Foto" type="file" name="foto"></li>
                <li><textarea class="dato1" placeholder="  Descripción" type="text" name="descripcion"></textarea></li>
                <li><input type="submit" value="Enviar"></li>
            </ul>
        </form>
    </header>

    <?php
    /**
     * imprime el include del footer
     */
        include "includes/footer.php";
    ?>

    </footer>
</div>
</body>
</html>