<?php
include_once '../../../modelo/conexion.php';
require_once '../../../src/infrastructure/TarjetaMontosRepository.php';
require_once '../../../src/View/TarjetaMontosView.php';

$conn = conexion();
$aliados = new TarjetaMontosRepository($conn);
$aliadosView = new TarjetaMontosView($aliados);
$aliadosView->view();
mysqli_close($conn);
