<?php
date_default_timezone_set('America/Mexico_City');

require_once '../clases/_getToken.php';
require_once '../clases/CrudZoom.php';

if (isset($_GET['id'])) {
    $meeting = $_GET['id'];
}

if (isset($_SESSION['zoom'])) {
    $zoomAuthenticator = $_SESSION['zoom'];
    $token = $zoomAuthenticator->GetToken();
    if ($token) {
        $zoomAuthenticator->CheckTokenExpiration();
    }
} else {
    var_dump('No he obtenido ningun token');
}

$ObjzoomCrud = new CrudZoom;
$getSession = $ObjzoomCrud->ObtenerReunionPorId($token, $meeting);
$meetingsData = json_decode($getSession, true);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>V-Learn</title>
</head>

<body>
    <header>
        <h1>Zoom</h1>
    </header>
    <br>
    <div class="Cformulario">
        <div class="TittleForm">
            <h2>Datos de la Reunión</h2>
        </div>
        
        <form id="meetingForm" action="#" method="post">
            <label for="nombre">Id:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $meeting ?>" readonly><br><br>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $meetingsData['topic']; ?>" readonly><br><br>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo date("Y-m-d", strtotime($meetingsData['start_time'])); ?>" readonly><br><br>

            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="hora" value="<?php echo date("H:i", strtotime($meetingsData['start_time'])); ?>" readonly><br><br>

            <label for="hora">Duración:</label>
            <input type="text" id="hora" name="duracion" value="<?php echo $meetingsData['duration']; ?>" readonly><br><br>

            <label for="hora">Id Reunión:</label><br>
            <a href="<?php echo $meetingsData['start_url']; ?>">Clic para comenzar la reunión</a>
            <br><br><br>
            <label for="hora">Password:</label><br>
            <input type="text" id="hora" name="duracion" value="<?php echo $meetingsData['password']; ?>" readonly><br><br>

            <div class="button-container">
                <a href="../inicio.php"> <button type="button" class="cancel-btn">Regresar</button></a>
            </div>
        </form>
    </div>
</html>
