<?php
require_once 'dataBase.php';

class Login
{
    private $db;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function verificarCredenciales($user, $password)
    {
        $conexion = $this->db->getConexion();

        $query = "SELECT * FROM usuario WHERE correo = '$user' AND contrasena = '$password'";
        $resultado = $conexion->query($query);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return $fila['id_usuario']; 
        } else {
            return false;
        }
    }
}
?>