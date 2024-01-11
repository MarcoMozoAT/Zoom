
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

// Manejo de las diferentes acciones CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $hora = $_POST['hora'];
    $dia = $_POST['fecha']; 
    $idMetting = $_POST['id_metting'];
    $duracion = $_POST['duracion'];

    $fechaHoraISO = $dia . 'T' . $hora . ':00Z';

    $response = $ObjZoomCrud ->actualizarReunion($token, $idMetting, $nombre, $fechaHoraISO, $duracion);

    $respuesta = json_decode($response, true);

    

    if (isset($_SESSION['id_usuario'])) {

        $id_usuario =  $_SESSION['id_usuario'];
        $ObjCrudDb= new CrudDataBase;
        $ObjCrudDb->ActualizarReunion($idMetting, $nombre, $dia, $duracion, $hora);
    }
    header('location: ../inicio.php?exito=true');
}



?>
