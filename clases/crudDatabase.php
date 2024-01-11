<?php
require_once __DIR__ . '/../config.php';

class CrudDataBase
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insertReunion($idReunion, $link, $passwor, $nombre, $dia, $duracion, $hora, $idusuario)
    {
        $conexion = $this->db->getConexion();
        $consulta = "INSERT INTO reunion (idReunion, link, passwor, nombre, dia, duracion, hora, id_usuario)VALUES ($idReunion,'$link','$passwor', '$nombre', '$dia', $duracion, '$hora',  $idusuario)";
        $result = $conexion->query($consulta);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function VerReuniones($idusuario)
    {

        $conexion = $this->db->getConexion();
        $consulta = "SELECT *FROM reunion WHERE id_usuario=$idusuario";
        $result = $conexion->query($consulta);
        if ($result->num_rows > 0) {
            $reuniones = array();
            while ($row = $result->fetch_assoc()) {
                $reuniones[] = $row; // Guarda cada fila como un elemento en el array $reuniones
            }
            return $reuniones;
        } else {
            return array(); // Retorna un array vacío si no hay resultados
        }
    }

    public function infoUsuario($id)
    {
        $conexion = $this->db->getConexion();
        $consulta = "SELECT * FROM usuario WHERE id_usuario=$id";
        $result = $conexion->query($consulta);

        if ($result->num_rows > 0) {
            $fila = $result->fetch_assoc();
            return $fila; // Devuelve todos los campos como un array asociativo
        } else {
            return null;
        }
    }

    public function ActualizarReunion($id, $nombre, $dia, $duracion, $hora)
    {
        $conexion = $this->db->getConexion();
        $consulta = "UPDATE reunion SET nombre = '$nombre', dia = '$dia', duracion = '$duracion', hora = '$hora' WHERE idReunion = $id";
        $resultado = $conexion->query($consulta);
        return $resultado === TRUE; // Devuelve verdadero si la actualización fue exitosa, falso en caso contrario
    }

    public function eliminarReunion($id)
    {
        $conexion = $this->db->getConexion();
        $consulta = "DELETE FROM reunion WHERE idReunion = $id";
        $resultado = $conexion->query($consulta);
        return $resultado === TRUE; 
    }
}
