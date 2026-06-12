<?php
// importar conex 
class Usuario {

    private $db;
    public function __construct($conn)
    {
        $this->db=$conn;
    }
    public function getALL()
        {
        $sql="select * from usuarios"; // creamos una consulta 
        $rs=$this->db->query($sql); // ejecutamos la consulta
        return $rs;
        }
    public function getByID($dato) {
        //DELETE FROM `usuarios` WHERE `usuarios`.`id` = 7
         $sql="SELECT * FROM `usuarios` WHERE `usuarios`.`id` = ".$dato;
         $rs=$this->db->query($sql);
         return $rs;
     }
    public function insert($datos) {
          $sql="INSERT INTO `usuarios` 
(`id`, `apellido`, `nombre`, `fenac`, `doc`, `mail`, `telefono`, `direccion`, `contrasena`, `esadmin`)
 VALUES (NULL, '".$datos['apellido']."', '".$datos['nombre']."', '".$datos['fenac']."', '".$datos['doc']."', '".$datos['mail']."', '".$datos['telefono']."', '".$datos['direccion']."', '".$datos['contrasena']."', ".$datos['esadmin'].")";
        
        $rs=$this->db->query($sql);
    }
        public function update($datos) {
/*         UPDATE `usuarios` 
SET `apellido` = 'Rios', `nombre` = 'Luis', `doc` = '12345678', `mail` = 'luis@mail.com', 
contrasena=" ", telefono="", direccion="", fenac="2026/01/01"
`telefono` = '232124', `esadmin` = '1' WHERE `usuarios`.`id` = 2; */
        $sql="UPDATE `usuarios` SET `apellido` = '".$datos['apellido']."', `nombre` = '".$datos['nombre']."', `doc` = '".$datos['doc']."', `mail` = '".$datos['mail']."', `contrasena` = '".$datos['contrasena']."', `telefono` = '".$datos['telefono']."', `direccion` = '".$datos['direccion']."', `fenac` = '".$datos['fenac']."', `esadmin` = ".$datos['esadmin']." WHERE `usuarios`.`id` = ".$datos['id'];

      $rs=$this->db->query($sql);
    }    
     public function delete($dato) {
        //DELETE FROM `usuarios` WHERE `usuarios`.`id` = 7
         $sql="DELETE FROM `usuarios` WHERE `usuarios`.`id` = ".$dato;
         $rs=$this->db->query($sql);
     }
}
?>