<?php
session_start();

// Destruir todas las sesiones
session_destroy();

// Redirigir al index.php
header("Location: ../index.php");
exit();
?>
