<?php
//tienen que retroceder un nivel por la carpeta en la que estan
require "../modelo/Cerveza.php";
require "../modelo/Bd.php";
require "../modelo/funciones.php";
require "../modelo/ListaCervezas.php";


//tenemos una proteccion par no mostras los accesos a las paginas, pero con esto directamente no dejaríamos entrar
//a usuario que no tengan un persmiso superior a 1.
if($_SESSION['permiso']<1){
    header("location:index.php");
}

$id=intval($_GET['id']);
//borro el elemento de la base de datos y su foto
$cerveza = new Cerveza();
$cerveza -> borrarCerveza($id);

//Pido de nuevo la lista de elementos y la envio a ajax

$lista = new ListaCervezas();
$lista ->obtenerElementos();

echo $lista->imprimirCervezasEnBack();