<?php
class DataBase
{
    private $host = 'localhost';
    private $usuario = 'root';
    private $password = '';
    private $baseDatos = 'zoom';
    protected $conexion;

    //El constructor es un método especial que se ejecuta
    //automáticamente cuando se crea una instancia de la clase
    public function __construct()
    {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->password, $this->baseDatos);

        if ($this->conexion->connect_error) {
            die('Error de conexión: ' . $this->conexion->connect_error);
        }
      
    }

    public function getConexion()
    {
        return $this->conexion;
    }
}
