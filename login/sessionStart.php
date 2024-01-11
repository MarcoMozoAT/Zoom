<?php
require_once '../clases/login.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $login = new Login();
    $user=$login->verificarCredenciales($correo, $password);

    if ($user) {
        $_SESSION['id_usuario'] = $user;
        header('location: ../inicio.php');
    } else {

        echo 'CREDENCIALES INCORRECTAS';
    }
}
