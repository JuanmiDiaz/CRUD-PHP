<?php
/**
 *requires para llamar a las dos clases que hemos creado
 **/require "includes/privado.php";
require "modelo/Usuario.php";
require "modelo/Bd.php";
require "modelo/funciones.php";
/**
 * tenemos una proteccion par no mostras los accesos a las paginas, pero con esto directamente no dejaríamos entrar
 * a usuario que no tengan un persmiso superior a 1.
 */
if($_SESSION['permiso']<3){
    header("location:index.php");
}
/**
 * creamos el objeto usuario
 */
$usuario=new Usuario();
/**
 * cogemos el id que nos viene del GET
 * comprobamos que es un entero
 */
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id=intval($_GET['id']);
    $usuario->obtenerPorId($id);
}
/**
 * eliminar el error de formulario vacio
 * llamamos al metodo para actualizar el objeto
 * y le insertamos los datos que traemos por el POST
 * con el location le decimos que vaya a esa localizacion
 */
if(isset($_POST) && !empty($_POST)){

    if(!empty($_POST['id'])){
        $id=intval($_POST['id']);
        $usuario->update($id,$_POST);
    }else {
        $usuario->insertar($_POST);
    }
    header('location:controlUsuarios.php');

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
    <div class="mensaje"> <h3>Edición de un usuario ya registrado</h3></div>


    <section >

    </section>

    <header>
        <form name="usuario" action="<?php echo $_SERVER['PHP_SELF']?> " method="post" enctype="multipart/form-data">
            <ul>
                <input type="hidden" name="id" value="<?php echo $usuario->getId() ?>">  <!--en este campo me traigo el id aunque no aparezca en la pagina-->
                <!--ahora nos vamos trayendo al formulario todos los datos de la base de datos por php-->
                <li><input placeholder="Nombre" type="text" name="nombre"></li>
                <li><input placeholder="Apellidos" type="text" name="apellidos"></li>
                <li><input placeholder="Email" type="email" name="mail"></li>
                <li><input placeholder="Password" type="password" name="pass"></li>
                <li><input placeholder="Permiso" type="text" name="permiso" value="2"></li>
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