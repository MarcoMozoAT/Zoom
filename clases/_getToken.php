<?php
require_once 'tokenZoom.php';
session_start();

$objZoom = isset($_SESSION['zoom']) ? $_SESSION['zoom'] : new TokenZoom();

if (!isset($_SESSION['zoom'])) {
    $objZoom->GenerateToken();
    $_SESSION['zoom'] = $objZoom;
}

