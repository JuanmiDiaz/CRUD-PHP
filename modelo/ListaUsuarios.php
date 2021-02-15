<?php


class ListaUsuarios
{
    private $lista;
    private $tabla;

    public function __construct(){

        $this->lista=array();
        $this->tabla="Usuario";
    }

    public function obtenerElementos(){

        //haremos una select  a la base de datos
        $sql = "SELECT * FROM ".$this->tabla.";";

        //ahora generamos un archivo conexion que envia la consulta y nos retorne una estructura de datos con la peticion que hacemos a la base de datos


        $conexion = new Bd();
        $res = $conexion -> consulta($sql);

        //print_r($res);  esto era para comprobar solo

        //ahora tenemos que coger cada fila de la base de datos que hemos traido ( con la funcion list)
        //asignarle una variable , en el mismo orden que la base de datos
        //meter el dato
        //y luego crear un objeto con esos datos

        while(list($id, $mail, $permiso, $pass, $nombre, $apellidos) = mysqli_fetch_array($res)) {    //mysqli_fetch_array esto hace coger el array de sql y lo devuelve de una manera que php pueda interpretar bien, para que el list pueda asignarle las variables

            $fila = new Usuario($id, $mail, $permiso, $pass, $nombre, $apellidos);
            array_push($this->lista,$fila);
            //cada vez que el while coge una linea de la respuesta de mysql la convierta en variable, luego construya un objeto con esas variable y lo inserto en la lista.
        }

        //traza($this); con esto comprobamos que traemos los datos de la base de datos y los sacamos arriba de la pagina
    }

    public function obtenerElementoFavorito($nombreFavorita){

        //haremos una select  a la base de datos
        /* $sql = "SELECT * FROM ".$this->tabla." WHERE id LIKE  1 ;";*/
        $sql = "SELECT * FROM ".$this->tabla." WHERE nombre LIKE  '%$nombreFavorita%' ;";   /*ESTO SERIA PARA BUSCAR POR NONMBRE*/


        //ahora generamos un archivo conexion que envia la consulta y nos retorne una estructura de datos con la peticion que hacemos a la base de datos


        $conexion = new Bd();
        $res = $conexion -> consulta($sql);

        //print_r($res);  esto era para comprobar solo

        //ahora tenemos que coger cada fila de la base de datos que hemos traido ( con la funcion list)
        //asignarle una variable , en el mismo orden que la base de datos
        //meter el dato
        //y luego crear un objeto con esos datos

        while(list($id, $mail, $permiso, $pass, $nombre, $apellidos) = mysqli_fetch_array($res)) {    //mysqli_fetch_array esto hace coger el array de sql y lo devuelve de una manera que php pueda interpretar bien, para que el list pueda asignarle las variables

            $fila = new Usuario($id, $mail, $permiso, $pass, $nombre, $apellidos);
            array_push($this->lista,$fila);
            //cada vez que el while coge una linea de la respuesta de mysql la convierta en variable, luego construya un objeto con esas variable y lo inserto en la lista.
        }

        //traza($this); con esto comprobamos que traemos los datos de la base de datos y los sacamos arriba de la pagina
    }

    public function imprimirUsuariosEnBack(){

        $html = "<table border=1>";

        for($i=0;$i<sizeof($this->lista);$i++){
            $html .=$this->lista[$i]->imprimeteEnTr();  //eso va a devolver cada fila de cada objeto configurada en el html
        }

        $html .="</table>";


        return $html;
    }

    public function imprimirUsuariosFavorita(){

        $html = "<table border=1>";

        for($i=0;$i<sizeof($this->lista);$i++){
            $html .=$this->lista[$i]->imprimeteEnTr();  //eso va a devolver cada fila de cada objeto configurada en el html
        }

        $html .="</table>";


        return $html;
    }
}