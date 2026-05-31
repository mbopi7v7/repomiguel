<?php
final class Conex
{
    private $host="mariadb";
    private $usuario="root";
    private $password="root";
    private $db="dw2_agenda";
    public $conexion;

    public function conectar() 
    {
        $this->conexion= new mysqli(
            $this->host,
            $this->usuario,
            $this->password,
            $this->db
        );
        if ($this->conexion->connect_error) {
            die("Error de conexion");
        }
        return  $this->conexion;
    }
    
}
