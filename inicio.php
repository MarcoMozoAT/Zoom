<?php
require_once 'clases/_getToken.php';
require_once 'clases/crudDatabase.php';

if (isset($_SESSION['zoom'])) {
    $objZoom = $_SESSION['zoom'];
    $token = $objZoom->GetToken();
    var_dump($token);
    if ($token) {
        $objZoom->CheckTokenExpiration();
    }
} else {
    var_dump('No he obtenido ningun token');
}

if (isset($_SESSION['id_usuario'])) {
    $id_usuario =  $_SESSION['id_usuario'];
}

$crudbD = new CrudDataBase;
$sessiones = $crudbD->VerReuniones($id_usuario);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <title>V-Learn</title>
</head>

<body>
    <header>
        <h1>Zoom</h1>
       <a href="login/sessionDestroy.php"><i class="fas fa-sign-out-alt salir-icono" aria-hidden="true"></i></a> 
    </header>
    <a id="openModal" class="buttonN" href="#">Nueva Reunión</a>
    <table>
        <thead>
            <tr class="head">
                <th>Id</th>
                <th>Dia</th>
                <th>Hora</th>
                <th>Nombre Reunión</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Verificar si hay datos de reuniones
            if (isset($sessiones) && !empty($sessiones)) {
                foreach ($sessiones as $reunion) {
                    echo '<tr>
                            <td>' .  $reunion['idReunion'] . '</td>
                            <td>' . date("Y-m-d ", strtotime($reunion['dia'])) . '</td>
                            <td>' . date("h:i A", strtotime($reunion['hora']))  . '</td>
                            <td>' . $reunion['nombre']  . '</td>
                            <td><a class="buttonE" href="vistas/editar.php?id=' . $reunion['idReunion'] . '">Editar</a></td>
                            <td><a class="button" href="crud/delete.php?id=' . $reunion['idReunion'] . '">Eliminar</a></td>
                            <td><a class="button" href="vistas/ver.php?id=' . $reunion['idReunion'] . '">Ver</a></td>
                            </tr>';
                }
            } else {
                echo '<tr><td colspan="5">No se encontraron reuniones.</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="TittleModal">
                <h2>Nueva Reunión</h2>
            </div>
            <form id="meetingForm" action="crud/create.php" method="post">

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required><br><br>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required min="<?php echo date('Y-m-d'); ?>"><br><br>

                <label for="hora">Hora:</label>
                <input type="time" id="hora" name="hora" required><br><br>

                <label for="hora">Duración:</label>
                <input type="text" name="duracion" required><br><br>

                <div class="button-container">
                    <input type="submit" value="Guardar">
                    <button type="button" class="cancel-btn">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    <script src="js/index.js"></script>
    
</html>