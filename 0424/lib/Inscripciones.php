<?php
// importar conex 
class Inscripciones
{

    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function getALL()
    {
        $sql = "select * from inscripciones"; // creamos una consulta 
        $rs = $this->db->query($sql); // ejecutamos la consulta 
        return $rs;
    }

    public function getByEventoID($dato)
    {
       $sql = "SELECT ins.*, ev.titulo, ev.fecha, ev.lugar, us.apellido, us.nombre, us.mail, us.doc FROM `inscripciones` ins JOIN eventos ev on ev.id=ins.evento_id JOIN usuarios us on us.id=ins.usuario_id WHERE `ins`.`evento_id` = " . $dato;
        $rs = $this->db->query($sql);
        return $rs;
    }
    public function getByID($dato)
    {
        $sql = "SELECT * FROM `inscripciones` WHERE `inscripciones`.`id` = " . $dato;
        $rs = $this->db->query($sql);
        return $rs;
    }

    public function insert($datos)
    {
        $sql = "INSERT INTO `inscripciones` (
    `usuario_id`, 
    `evento_id`, 
    `estado`, 
    `checkin`, 
    `observacion` 
    ) VALUES ('" . $datos['usuario_id'] . "', '" . $datos['evento_id'] . "', '" . $datos['estado'] . "', '" . $datos['checkin'] . "',
     '" . $datos['observacion'] . "')";
        return $this->db->query($sql);
    }
    public function update($datos)
    {

        //$sql = "UPDATE `usuarios` SET `apellido` = '" . $datos['apellido'] . "', `nombre` = '" . $datos['nombre'] . "', `doc` = '" . $datos['doc'] . "', `mail` = '" . $datos['mail'] . "', `contrasena` = '" . $datos['contrasena'] . "', `telefono` = '" . $datos['telefono'] . "', `direccion` = '" . $datos['direccion'] . "', `fenac` = '" . $datos['fenac'] . "', `esadmin` = " . $datos['esadmin'] . " WHERE `usuarios`.`id` = " . $datos['id'];
        $sql = "UPDATE `inscripciones` SET 
        `estado` = '" . $datos['estado'] . "', 
        `checkin` = '" . $datos['checkin'] . "',
        `fecha_checkin` = " . $datos['fecha_checkin'] . ",  
        `observacion` = '" . $datos['observacion'] . "' 
        
        WHERE `inscripciones`.`id`    = " . $datos['id'];

        return $rs = $this->db->query($sql);
    }
    public function delete($dato)
    {
        //DELETE FROM `usuarios` WHERE `usuarios`.`id` = 7
        $sql = "DELETE FROM `inscripciones` WHERE `inscripciones`.`id` = " . $dato;
        $rs = $this->db->query($sql);
    }
    public function checkInscripto($evento_id, $usuario_id)
    {
        $sql = "SELECT * FROM `inscripciones` WHERE `evento_id` = " . $evento_id . " AND `usuario_id` = " . $usuario_id;
        $rs = $this->db->query($sql);
        if ($rs->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
