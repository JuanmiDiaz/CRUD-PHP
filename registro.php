<?php
/**
 *requires para llamar a las dos clases que hemos creado
 **/
require "modelo/Bd.php";
require "modelo/funciones.php";
require "modelo/Usuario.php";
/**
 * para que no nos de error al iniciar la pagina y que no tenga datos aun
 */
if(isset($_POST) && !empty($_POST)){
    /**
     * primero queremos que nos genere un objeto cerveza
     */
    $usuario=new Usuario();
    /**
     * y ahora quiero que a ese objeto cerveza se le inserte el POST ( que son los datos)
     */
    $usuario-> insertar($_POST);
}


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
<body>



<div class="bodyLogin">
    <?php
    /**
     * incluye includes del menu
     */
    include "includes/menu.php";
    ?>
    <div class="cajaLogin">

        <div class="caja2Login">
            <form name="Usuario" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                <ul>
                    <li><input placeholder="Nombre" type="text" name="nombre"></li>
                    <li><input placeholder="Apellidos" type="text" name="apellidos"></li>
                    <li><input placeholder="Email" type="email" name="mail"></li>
                    <li><input placeholder="Password" type="password" name="pass"></li>
                    <!--le damos el valos 2 de permiso a todos los usuario que se registren para que puedan ver la pagina e insertar y borrar cervezas-->
                    <li><input placeholder="Permiso" type="hidden" name="permiso" value="2"></li> <!--poniendo el campo HIDDen no se vera en la pagina-->

        </div>

        <li><input type="submit" value="Entrar"></li>
                </ul>
            </form>

        <div class="caja2login">
            <p>Los nuevos usuario empezarán con nivel 2</p>
        </div>
    </div>


    </div>


</div>
</body>
</html>




