<?php
include_once '../../../modelo/conexion.php';
require_once '../../../src/infrastructure/TarjetasRepository.php';
require_once '../../../src/View/TarjetasView.php';

if (
	isset($_GET["estrategia"]) &&
	$_GET["estrategia"] !== ""
) {
	$estrategia = $_GET["estrategia"];
} else {
	header("location: ../../");
	die;
}

$conn = conexion();
$tarjeta = new TarjetaRepository($conn);
$tarjetaView = new TarjetasView($tarjeta);
$tarjetaView->tarjetasHabilitadasEstrategiaId($estrategia);
$tarjetaView->view();
mysqli_close($conn);
