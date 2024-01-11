
<?php
require_once '../clases/tokenZoom.php';
require_once '../clases/crudZoom.php';
require_once '../clases/crudDatabase.php';
session_start();

if (isset($_SESSION['zoom'])) {
    $objZoom = $_SESSION['zoom'];
    $token = $objZoom->GetToken();

    if ($token) {
        $objZoom->CheckTokenExpiration();
    }
} else {
    var_dump('No he obtenido ningun token');
}

$ObjZoomCrud = new CrudZoom;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $hora = $_POST['hora'];
    $dia = $_POST['fecha']; 
    $duracion = $_POST['duracion'];
    $fechaHoraISO = $dia . 'T' . $hora . ':00';

    $response =$ObjZoomCrud->crearReunion($token, $nombre, $fechaHoraISO, $duracion);

    $respuesta = json_decode($response, true);

  
    $contrasena = isset($respuesta['password']) ? $respuesta['password'] : '';
    $url = isset($respuesta['start_url']) ? $respuesta['start_url'] : '';
    $id = isset($respuesta['id']) ? $respuesta['id'] : '';
    
    if (isset($_SESSION['id_usuario'])) {

        $id_usuario =  $_SESSION['id_usuario'];
        $ObjCrudDb= new CrudDataBase;
        $ObjCrudDb->insertReunion($id, $url, $contrasena, $nombre, $dia, $duracion, $hora, $id_usuario);
        $correo=$ObjCrudDb->infoUsuario($id_usuario);
        $correoUser=$correo['correo'];
    }

    header("Location: ../correo.php?nombre=".$nombre."&hora=".$hora."&dia=".$dia."&password=".$contrasena."&url=".$url."&correo=".$correoUser);
}
?>
