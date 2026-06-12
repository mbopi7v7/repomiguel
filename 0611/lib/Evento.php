<?php
// importar conex 
class Evento {

    private $db;
    public function __construct($conn)
    {
        $this->db=$conn;
    }
    public function getALL()
        {
        $sql="select * from eventos"; // creamos una consulta 
        $rs=$this->db->query($sql); // ejecutamos la consulta
        return $rs;
        }
    public function getByID($dato) {
        //DELETE FROM `eventos` WHERE `eventos`.`id` = 7
         $sql="SELECT * FROM `eventos` WHERE `eventos`.`id` = ".$dato;
         $rs=$this->db->query($sql);
         return $rs;
     }
     public function validarDatos($datos, $requiereId = false) {
        $errores = [];

        if ($requiereId && empty($datos['id'])) {
            $errores[] = "El id del evento es obligatorio.";
        }

        if (empty($datos['titulo']) || strlen($datos['titulo']) > 100) {
            $errores[] = "El título es obligatorio y no debe superar 100 caracteres.";
        }

        if (empty($datos['fecha'])) {
            $errores[] = "La fecha es obligatoria.";
        } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $datos['fecha'])) {
            $errores[] = "La fecha debe tener formato YYYY-MM-DD.";
        }

        if (!empty($datos['hora']) && !preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $datos['hora'])) {
            $errores[] = "La hora debe tener formato HH:MM o HH:MM:SS.";
        }

        if (!empty($datos['lugar']) && strlen($datos['lugar']) > 191) {
            $errores[] = "El lugar no debe superar 191 caracteres.";
        }

        if (!isset($datos['activo']) || !in_array($datos['activo'], [0, 1, "0", "1"])) {
            $errores[] = "El campo activo debe ser 0 o 1.";
        }

        return $errores;
    }
    public function insert($datos) {
        //INSERT INTO `eventos` (`id`, `titulo`, `fecha`, `hora`, `lugar`, `activo`) VALUES (NULL, 'Charla de FOrmularios', '2026-03-17', '20:45:44', 'Pasillo', '1');
        $sql="INSERT INTO `eventos` (`titulo`, `fecha`, `hora`, `lugar`, `activo`) VALUES ('".$datos['titulo']."', '".$datos['fecha']."', '".$datos['hora']."', '".$datos['lugar']."', ".$datos['activo'].")";
        $rs=$this->db->query($sql);
    }
        public function update($datos) {
        //UPDATE `eventos` SET `titulo` = 'Taller de Introducción a JS', `fecha` = '2026-04-11', `hora` = '09:30:00', `lugar` = 'Aula Central UNAE ', `activo` = '0' WHERE `eventos`.`id` = 1;
        //$sql="INSERT INTO `eventos` (`titulo`, `fecha`, `hora`, `lugar`, `activo`) VALUES ('".$datos['titulo']."', '".$datos['fecha']."', '".$datos['hora']."', '".$datos['lugar']."', ".$datos['activo'].")";
        
        $sql="UPDATE `eventos` SET `titulo` = '".$datos['titulo']."', `fecha` = '".$datos['fecha']."', `hora` = '".$datos['hora']."', `lugar` = '".$datos['lugar']."', `activo` = ".$datos['activo']." WHERE `eventos`.`id` = ".$datos['id'];

        $rs=$this->db->query($sql);
    }    
     public function delete($dato) {
        //DELETE FROM `eventos` WHERE `eventos`.`id` = 7
         $sql="DELETE FROM `eventos` WHERE `eventos`.`id` = ".$dato;
         $rs=$this->db->query($sql);
     }
}
?>