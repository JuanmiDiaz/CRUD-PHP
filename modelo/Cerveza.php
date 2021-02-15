<?php


class Cerveza
{
    /**
     * atributos de la clase Cerveza
     */
    private $id;
    private $nombre;
    private $pais;
    private $estilo;
    private $unidades;
    private $precio;
    private $coleccion;
    private $foto;
    private $descripcion;
    private $tabla;
    private $carpetaFotos;

    /**
     * Cerveza constructor
     * @param string $id
     * @param string $nombre
     * @param string $pais
     * @param string $estilo
     * @param string $unidades
     * @param string $precio
     * @param string $coleccion
     * @param string $foto
     * @param string $descripcion
     * @param string $tabla
     * @param string carpetaFotos
     */
    public function __construct($id="", $nombre="", $pais="", $estilo="", $unidades="", $precio="", $coleccion="", $foto="", $descripcion=""){

        $this->id=$id;
        $this->nombre=$nombre;
        $this->pais=$pais;
        $this->estilo=$estilo;
        $this->unidades=$unidades;
        $this->precio=$precio;
        $this->coleccion=$coleccion;
        $this->foto=$foto;
        $this->descripcion=$descripcion;
        $this->tabla="cerveza";
        $this->carpetaFotos="fotos/";
    }

    private function llenar($id, $nombre, $pais, $estilo, $unidades, $precio, $coleccion, $foto, $descripcion){

        $this->id=$id;
        $this->nombre=$nombre;
        $this->pais=$pais;
        $this->estilo=$estilo;
        $this->unidades=$unidades;
        $this->precio=$precio;
        $this->coleccion=$coleccion;
        $this->foto=$foto;
        $this->descripcion=$descripcion;
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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * @param string $pais
     */
    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    /**
     * @return string
     */
    public function getEstilo()
    {
        return $this->estilo;
    }

    /**
     * @param string $estilo
     */
    public function setEstilo($estilo)
    {
        $this->estilo = $estilo;
    }

    /**
     * @return string
     */
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * @param string $unidades
     */
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;
    }

    /**
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param string $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * @return string
     */
    public function getColeccion()
    {
        return $this->coleccion;
    }

    /**
     * @param string $coleccion
     */
    public function setColeccion($coleccion)
    {
        $this->coleccion = $coleccion;
    }

    /**
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param string $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }


    public function insertar($datos,$foto){  //aqui recibimos los datos y la foto
        $conexion=new Bd();
        $conexion-> insertarElemento($this->tabla,$datos,$this->carpetaFotos,$foto); //aqui se lo enviamos a la clase Bd

    }

    public  function update($id, $datos, $foto){
        $conexion=new Bd();
        $conexion->editarElemento($id, $this->tabla, $datos, $foto, $this->carpetaFotos);

    }

// version larga//
    public function obtenerPorId($id){
        $sql= "SELECT * FROM ".$this->tabla." WHERE id=".$id;
        $conexion = new Bd();
        $res=$conexion->consulta($sql);
        list($id, $nombre, $pais, $estilo, $unidades, $precio, $coleccion, $foto, $descripcion) = mysqli_fetch_array($res);
        $this->llenar($id, $nombre, $pais, $estilo, $unidades, $precio, $coleccion, $foto, $descripcion);
        //echo $sql; comprobar consulta a base de datos
        //print_r($res);  comprobar los datos que trae
    }

        //metodo para borrar una cerveza de la base de datos
        public function borrarCerveza($id){
        $conexion=new Bd();
        $conexion->borrarFoto($id, $this->tabla,"../".$this->carpetaFotos);
        $sql = "DELETE FROM " .$this->tabla." WHERE id=".$id;
        $conexion->consulta($sql);
        }



    public function imprimeteEnTr(){

        $html =  "  <table>
                    <tr>
                    <td width='7%'>".$this->id."</td>
                    <td width='10.4%' >".$this->nombre."</td>
                    <td width='9.8%'>".$this->pais."</td>
                    <td width='9.8%'>".$this->estilo."</td>
                    <td width='7%'>".$this->unidades."</td>
                    <td width='7%'>".$this->precio." € </td>
                    <td width='7%'>".$this->coleccion."</td>
                    <td width='10.4%'>".$this->descripcion."</td>
                    <td width='5%'><img  src='".$this->carpetaFotos.$this->foto.  "'></td>
                    <td width='7%'><a href='verCerveza.php?id=".$this->getId()."'>Ver</a></td> <!--con este getId nos llevamos a la otra pagina el id -->
                    <td width='7%'><a href='edCerveza.php?id=".$this->getId()."'>Editar</a></td>
                    <td width='7%'><a href='javascript:borrarCerveza(".$this->id.")'>Borrar</a></td></tr> </table>";

        return $html;
}

    public function imprimirEnFicha(){
        $html= "<table>
                 <tr><td rowspan='8'><img  src='".$this->carpetaFotos.$this->foto."'></td></tr>
                <tr><td>Nombre</td><td>".$this->nombre."</td></tr>
                <tr><td>Pais</td><td>".$this->pais."</td></tr>
                <tr><td>Estilo</td><td>".$this->estilo."</td></tr>
                <tr><td>Unidades</td><td>".$this->unidades."</td></tr>
                <tr><td>Precio</td><td>".$this->precio."</td></tr>
                <tr><td>Coleccion</td><td>".$this->coleccion."</td></tr>
                <tr><td>Descripcion</td><td>".$this->descripcion."</td></tr>     
    </table>";
    
    return $html;
    }


    public function imprimirEnFicha2(){
        $html= "<div class=\"cajaCerveza\">
        <div class=\"cajaCervezaFoto\"><img  src='".$this->carpetaFotos.$this->foto."'></div>
        <div class=\"cajaCervezaInfo\">
            <div class=\"cajaCervezaNombre\">" . $this->nombre . "</div>
            
            <div class=\"cajaCervezaInfo2\">
                <div class=\"infoCerveza1\">Unidades</div>
                <div class=\"infoCerveza2\">".$this->unidades."</div>

                <div class=\"infoCerveza1\">Precio</div>
                <div class=\"infoCerveza2\">".$this->precio." € </div>

                <div class=\"infoCerveza1\">Colección</div>
                <div class=\"infoCerveza2\">".$this->coleccion."</div>
                <div class='infoCerveza6'><img src=\"img/logo.png\"></div>
            </div>
            
                <div class=\"cajaCervezaInfo3\">

                <div class=\"infoCerveza3\">Pais</div>
                <div class=\"infoCerveza4\">".$this->pais."</div>

                <div class=\"infoCerveza3\">Estilo</div>
                <div class=\"infoCerveza4\">".$this->estilo."</div>

                <div class=\"infoCerveza3\">Descripción</div>
                <div class=\"infoCerveza4\">".$this->descripcion."</div>
                <div class='infoCerveza7'><img src=\"img/what+beer+grains_text.png\"></div>

                
            </div>
            
        </div>
        </div>";

        return $html;
    }



}