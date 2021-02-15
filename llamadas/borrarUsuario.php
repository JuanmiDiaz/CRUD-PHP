<?php
//tienen que retroceder un nivel por la carpeta en la que estan
require "../modelo/Usuario.php";
require "../modelo/Bd.php";
require "../modelo/funciones.php";
require "../modelo/ListaUsuarios.php";


//tenemos una proteccion par no mostras los accesos a las paginas, pero con esto directamente no dejaríamos entrar
//a usuario que no tengan un persmiso superior a 1.
if($_SESSION['permiso']<1){
    header("location:index.php");
}

$id=intval($_GET['id']);
//borro el elemento de la base de datos y su foto
$usuario = new Usuario();
$usuario -> borrarUsuario($id);

//Pido de nuevo la lista de elementos y la envio a ajax

$lista = new ListaUsuarios();
$lista ->obtenerElementos();

echo $lista->imprimirUsuariosEnBack();