<?php
/**
 *requires para llamar a las dos clases que hemos creado
 **/
require "includes/privado.php";
require "modelo/Usuario.php";
require "modelo/Bd.php";
require "modelo/funciones.php";
require "modelo/ListaUsuarios.php";
/**
 * tenemos una proteccion para no mostrar los accesos a las paginas, pero con esto directamente no dejaríamos entrar
 * a usuario que no tengan un persmiso superior a 2.
 */
if($_SESSION['permiso']<3){
    header("location:index.php");
}
/**
 * creamos el objeto lista
 */
$lista=new ListaUsuarios();
$lista->obtenerElementoFavorito($_POST['nombreFavorita']);
/**
 * eliminar el error de formulario vacio
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
    <script src="js/scriptUsuario.js" type="text/javascript"></script>

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
<div class="mensaje"> <h3>Listado de todos los usuarios registrados</h3></div>


<section >
    <div class="buscador"> Buscar un usuario por nombre
        <header>
            <form name="usuario" action="<?php echo $_SERVER['PHP_SELF']?> " method="post" enctype="multipart/form-data">
                <ul>
                    <li><input class="dato1" placeholder="  Nombre" type="text" name="nombreFavorita"></li>
                    <li><input type="submit" value="Enviar"></li>
                </ul>
            </form>
        </header>

        <div class="tablafija">
        <table>
            <tr>
                <td class='coleccion'  width='10%'>Id</td>
                <td class='coleccion' width='15%' >Nombre</td>
                <td class='coleccion'width='15%'>Apellidos</td>
                <td class='coleccion'width='20%'>Mail</td>
                <td class='coleccion' width='10%'>Permiso</td>
                <td class='coleccion' width='15%'>Editar</a></td>
                <td class='coleccion'  width='15%'>Borrar</a></td></tr> </table></div>
        <p> </p>
        <div class="lista" id="lista">
            <?php
            echo $lista->imprimirUsuariosEnBack();
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