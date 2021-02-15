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
    $mail = addslashes($_POST['mail']);
    $pass = addslashes($_POST['pass']);

    $usuario=new Usuario();
    /**
     *     ahora comprpbamos si ese usuario esta o no en la base de datos
     */
    if($usuario->login($mail, $pass)){
    header("location:coleccion.php");
    }else{
        lanzarError("Usuario NO existe");

    }
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
            <form name="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <ul>
                    <li><input placeholder="Email" type="email" name="mail"></li>
                    <li><input placeholder="Password" type="password" name="pass"></li>
        </div>

        <li><input type="submit" value="Entrar"></li>
                </ul>
            </form>

        <div class="caja2login">
            <form name="registro" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <ul>
                    <li><label>Aún no estas registrado?         </label><li><a class="botonregistrate" href=" registro.php">Registrate</a></li></li>
                </ul>
            </form>
        </div>
    </div>


    </div>


</div>
</body>
</html>




