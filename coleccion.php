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
 * creamos el objeto lista
 */
$lista=new ListaCervezas();
$lista->obtenerElementoFavorito($_POST['nombreFavorita']);
/**
 * esto sería para que nos quite el fallo de formulario vacio, pero no funciona
 */
if (isset($_POST) && !empty($_POST)) {
    $nombreFavorita = $_POST['nombreFavorita'];
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<link rel="stylesheet" type="text/css" href="css/stilos.css">
    <script src="js/scriptCerveza.js" type="text/javascript"></script>

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
<div class="mensaje"> <h3>Aquí veremos la coleccion de cervezas</h3></div>


<section >
    <div class="buscador"> Busca tu cerveza favorita
        <header>
            <form name="cerveza" action="<?php echo $_SERVER['PHP_SELF']?> " method="post" enctype="multipart/form-data">
                <ul>
                    <li><input class="dato1" placeholder="  Nombre" type="text" name="nombreFavorita"></li>
                    <li><input type="submit" value="Enviar"></li>
                </ul>
            </form>
        </header>

        <div class="tablafija">
        <table>
            <tr>
                <td class='coleccion'  width='7%'>Id</td>
                <td class='coleccion' width='10.4%' >Nombre</td>
                <td class='coleccion'width='9.8%'>Pais</td>
                <td class='coleccion'width='9.8%'>Estilo</td>
                <td class='coleccion' width='7%'>Unidades</td>
                <td class='coleccion'  width='7%'>Precio</td>
                <td class='coleccion'  width='7%'>Coleccion</td>
                <td class='coleccion' width='10.4%'>Descripción</td>
                <td class='coleccion' width='5%'>Foto</td>
                <td class='coleccion' width='7%'>Ver</a></td>
                <td class='coleccion' width='7%'>Editar</a></td>
                <td class='coleccion'  width='7%'>Borrar</a></td></tr> </table></div>
        <p> </p>
        <div class="lista" id="lista">
            <?php
            /**
             * me imprime la lista de cervezas
             */
            echo $lista->imprimirCervezasEnBack();
            ?>
        </div>


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