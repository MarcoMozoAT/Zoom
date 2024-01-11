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

if(isset($_GET['id'])) {
        $meeting = $_GET['id'];
        $ObjZoomCrud->eliminarReunion($token, $meeting);
        $ObjCrudDb= new CrudDataBase;
        $ObjCrudDb->eliminarReunion($meeting);

        header('location: ../inicio.php?exito=true');
}