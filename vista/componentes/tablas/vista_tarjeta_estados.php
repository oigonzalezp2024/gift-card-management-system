<?php
include_once '../../../modelo/conexion.php';
require_once '../../../src/infrastructure/TarjetaEstadosRepository.php';
require_once '../../../src/View/TarjetaEstadosView.php';

$conn = conexion();
$estados = new TarjetaEstadosRepository($conn);
$estadosView = new TarjetaEstadosView($estados);
$estadosView->view();
mysqli_close($conn);
