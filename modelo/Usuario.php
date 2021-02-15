<?php


class Usuario
{
    private $id;
    private $mail;
    private $pass;    //la ley de protecion de datos prohibe traer el pass a la web
    private $permiso;
    private $tabla;
    private $nombre;
    private $apellidos;

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @param mixed $apellidos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }


    /**
     * Usuario constructor.
     * @param $id
     * @param $mail
     * @param $pass
     * @param $permiso
     */
    public function __construct($id="", $mail="", $permiso="", $pass="", $nombre="", $apellidos="")
    {
        $this->id = $id;
        $this->mail = $mail;
        $this->pass = $pass;
        $this->permiso = $permiso;
        $this->tabla="Usuario";
        $this->nombre=$nombre;
        $this->apellidos=$apellidos;
    }

    public function llenar($id, $mail, $pass,$permiso, $nombre, $apellidos)
    {
        $this->id = $id;
        $this->mail = $mail;
        $this->pass = $pass;
        $this->permiso = $permiso;
        $this->nombre=$nombre;
        $this->apellidos=$apellidos;
    }
    /**
     * @return string
     */
    public function getTabla()
    {
        return $this->tabla;
    }

    /**
     * @param string $tabla
     */
    public function setTabla($tabla)
    {
        $this->tabla = $tabla;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param string $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return string
     */
    public function getPermiso()
    {
        return $this->permiso;
    }

    /**
     * @param string $permiso
     */
    public function setPermiso($permiso)
    {
        $this->permiso = $permiso;
    }


    public function login($mail, $pass){
        $conexion =new Bd();
       // $sql="SELECT id, nombre, permiso, apellidos FROM ".$this->tabla.
        //    " WHERE mail='".$mail."' AND pass='".md5($pass)."';";           con esto sacariamos el dato si tiene codificacion md5
        $sql="SELECT id, nombre, permiso, apellidos FROM ".$this->tabla.
            " WHERE mail='".$mail."' AND pass='".$pass."';";
        $res = $conexion->consulta($sql);
        if($conexion->numeroElementos()>0){
            list($id, $nombre, $permiso, $apellidos)=mysqli_fetch_array($res);
            session_start();
            //y ahora guardamos en la sesion los datos que obtenemos de la base de datos
            $_SESSION['id_usuario']=$id;
            $_SESSION['nombre']=$nombre;
            $_SESSION['permiso']=$permiso;
            $_SESSION['apellidos']=$apellidos;
            $respuesta=true;
        }else{
            $respuesta=false;
        }
        echo $sql;
        return $respuesta;

    }

    public function insertar($datos){  //aqui recibimos los datos y la foto
        $conexion=new Bd();
        $conexion-> insertarElemento2($this->tabla,$datos); //aqui se lo enviamos a la clase Bd
    }

    public  function update($id, $datos){
        $conexion=new Bd();
        $conexion->editarElemento($id, $this->tabla, $datos);
    }

    public function obtenerPorId($id){
        $sql= "SELECT * FROM ".$this->tabla." WHERE id=".$id;
        $conexion = new Bd();
        $res=$conexion->consulta($sql);
        list($id, $mail, $permiso, $pass, $nombre, $apellidos) = mysqli_fetch_array($res);
        $this->llenar($id, $mail, $permiso, $pass, $nombre, $apellidos);
        echo $sql; //comprobar consulta a base de datos
        print_r($res);  //comprobar los datos que trae
    }

    public function borrarUsuario($id){
        $conexion=new Bd();
        $sql = "DELETE FROM " .$this->tabla." WHERE id=".$id;
        $conexion->consulta($sql);
    }

    public function imprimeteEnTr(){

        $html =  "  <table>
                    <tr>
                    <td width='10%'>".$this->id."</td>
                    <td width='15%' >".$this->nombre."</td>
                    <td width='15%'>".$this->apellidos."</td>
                    <td width='20%'>".$this->mail."</td>
                    <td width='10%'>".$this->pass."</td>
                    <td width='15%'><a href='edUsuario.php?id=".$this->getId()."'>Editar</a></td>
                    <td width='15%'><a href='javascript:borrarUsuario(".$this->id.")'>Borrar</a></td></tr> </table>";

        return $html;
    }
}