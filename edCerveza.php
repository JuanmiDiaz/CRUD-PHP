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
/**
 * creamos el objeto cerveza
 */
$cerveza=new Cerveza();
/**
 * cogemos el id que nos viene del GET
 * comprobamos que es un entero
 */
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id=intval($_GET['id']);
    $cerveza->obtenerPorId($id);
}
/**
 * eliminar el error de formulario vacio
 * llamamos al metodo para actualizar el objeto
 * con el location le decimos que vaya a esa localizacion
 */
if(isset($_POST) && !empty($_POST)){

    if(!empty($_POST['id'])){
        $id=intval($_POST['id']);
        $cerveza->update($id,$_POST, $_FILES['foto']);
    }else {

        $cerveza->insertar($_POST, $_FILES['foto']);
    }
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
    <div class="mensaje"> <h3>Aquí podemos editas nuevas cervezas ya insertadas</h3></div>


    <section >

    </section>

    <header>
        <form name="cerveza" action="<?php echo $_SERVER['PHP_SELF']?> " method="post" enctype="multipart/form-data">
            <ul>
                <input type="hidden" name="id" value="<?php echo $cerveza->getId() ?>">  <!--en este campo me traigo el id aunque no aparezca en la pagina-->
                <!--ahora nos vamos trayendo al formulario todos los datos de la base de datos por php-->
                <li><input class="dato1" type="text" name="nombre" value="<?php echo $cerveza->getNombre() ?>"></li>
                <li><input class="dato1" type="text" name="pais" value="<?php echo $cerveza->getPais() ?>"></li>
                <li><input class="dato1" type="text" name="estiLo" value="<?php echo $cerveza->getEstilo() ?>"></li>
                <li><input class="dato1" type="text" name="unidades" value="<?php echo $cerveza->getUnidades() ?>"></li>
                <li><input class="dato1" type="text" name="precio" value="<?php echo $cerveza->getPrecio() ?>"></li>
                <li><input class="dato1" type="text" name="coleccion" value="<?php echo $cerveza->getColeccion() ?>"></li>
                <li><input type="file" name="foto"></li>
                <!--le decimos que si hay foto nos la muestre-->
                <?php
                    if(strlen($cerveza->getFoto())>0){
                        echo "<li><img src='" .$cerveza->getFoto()."' width='55px'></li>";                    }
                ?>
                <li><textarea class="dato1" name="descripcion" ><?php echo $cerveza->getDescripcion() ?></textarea></li>
                <li><input type="submit" value="Editar"></li>
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