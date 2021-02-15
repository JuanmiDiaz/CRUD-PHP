<?php

//creamos una clase Bd que sera la encargada de conectarnos con la base de datos//
class Bd
{

    private $server = "localhost";  //atributo de la direccion que necesitara//
    private $usuario = "root"; //atributo del usuario para entrar en la base datos//
    private $pass = "root";  //como es windows la clave no hace falta, si fuera mac sería root
    private $basedatos = "crudbasico"; //y esta es la base de datos que hemos creado en phpMyadmin

    private $conexion;  //para gestionar todas las operaciones
    private $resultado;  //aqui guardo la ultima consulta realizada

    public function __construct(){
        //lo primero que hace es mandar los 4 atributos que tenemos arriba
        $this->conexion = new mysqli($this->server, $this->usuario, $this->pass , $this->basedatos);
        $this->conexion->select_db($this->basedatos);
        $this->conexion->query("SET NAMES 'utf8'");
    }
//con esto tendriamos configurada la conexion a la base de datos


//ahora vamos a configurar el insert generico


    public function  insertarElemento($tabla, $datos,$carpeta, $foto){ //le mandamos como parametros la tabla y los datos

        $claves = array();
        $valores=array();

                                            //clave valor, va recorriendo el formulario entero y sacando todos los datos. Va creando un array con todas las claves y otro con todos los valores
        foreach ($datos as $clave => $valor) {
            $claves[]=$clave;
            $valores[]="'".$valor."'";      //nos saca el valor enste comillas
        }

         if($foto['name']!=""){
             $ruta = subirFoto($foto,$carpeta); //aqui ya estoy subiendo la foto

             $claves[]="foto"; //variable de la base de datos
             $valores[]="'".$ruta."'";
         }



                                            //esto me va a generar  un insert con todos los valores del formulario con los datos clave valor sacados del foreach
        $sql= "INSERT INTO ".$tabla." (".implode(',',$claves).") VALUES (".implode(',',$valores).")";
                                            //con el implode vamos sacando todos los valores separados con "," como le indicamos
                                            //haremos un echo para comprobar que va bien
        //echo $sql;

        $this->resultado = $this->conexion->query($sql);
        $res=$this->resultado;
        return $res;
    }

    //con este otro insertar podremos insertar usuarios, que no llevan foto
    public function  insertarElemento2($tabla, $datos) { //le mandamos como parametros la tabla y los datos

        $claves = array();
        $valores=array();

        //clave valor, va recorriendo el formulario entero y sacando todos los datos. Va creando un array con todas las claves y otro con todos los valores
        foreach ($datos as $clave => $valor) {
            $claves[]=$clave;
            $valores[]="'".$valor."'";      //nos saca el valor entre comillas
        }



        //esto me va a generar  un insert con todos los valores del formulario con los datos clave valor sacados del foreach
        $sql= "INSERT INTO ".$tabla." (".implode(',',$claves).") VALUES (".implode(',',$valores).")";
        //con el implode vamos sacando todos los valores separados con "," como le indicamos
        //haremos un echo para comprobar que va bien
        //echo $sql;
        $this->resultado = $this->conexion->query($sql);
        $res=$this->resultado;
        return $res;

    }


    public function editarElemento($id, $tabla, $datos, $foto="", $directorio=""){

        $sentencias=array();

        foreach ($datos as $campo => $valor) {
            if($campo != "id" && $campo != "x" && $campo != "y"){
                $sentencias[]=$campo . "='".addslashes($valor)."'";  //metemos en el array sentencias, el campo y el valor para nuestra Base de datos
            }
        }
        if(strlen($foto['name'])>0){                    //si el campo foto tiene algun valor
                $this->borrarFoto($id, $tabla);        //borra la foto antigua
                $ruta= subirFoto($foto, $directorio);   //subir nueva foto
                $sentencias[]= "foto='".$ruta."'";
            }

        //y aqui iremos actualizando cada campo de la tabla donde corresponda con el id
        $campos = implode(",",$sentencias);
        $sql="UPDATE ". $tabla . " SET " . $campos . " WHERE  id=" . $id;
        $conexion=new Bd();
        $conexion->consulta($sql);

    }

    public function borrarFoto($id, $tabla){

        $sql = "SELECT foto FROM " .$tabla. " WHERE id= '" .$id. "'";   //ruta a la base de datos

        $this->resultado=$this->conexion->query($sql);

        if($this->numeroElementos()>0) {                                //significa que algo me has devuelvo

            $res = mysqli_fetch_assoc($this->resultado);
            $rutaAborrar =$res['foto'];
            if(!unlink($rutaAborrar)){
                      //si esto no funciona//
                lanzarError("Error de escritura, contacte con su admistrador");
            }
        }

    }



        //funcion donde se envia una query de sql

    public function consulta($consulta){
        // echo $consulta;   esto era para comprobar
        $this->resultado= $this->conexion->query($consulta); //y nos devuelve ese resultado
        $res=$this->resultado;
        return $res;

    }

    public function numeroElementosConSql($sql){            // nos da el numero de elementos que tiene en sql
        $this->resultado=$this->conexion->query($sql);
        $num = $this->numeroElementos();
        return $num;
    }

    public function numeroElementos(){
        $num=$this->resultado->num_rows;
        return $num;
    }




}