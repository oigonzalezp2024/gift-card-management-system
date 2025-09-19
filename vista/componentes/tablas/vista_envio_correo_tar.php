<?php
include_once '../../../modelo/conexion.php';
require_once '../../../src/infrastructure/CorreoRepository.php';
require_once '../../../src/View/CorreosView.php';

if (
	isset($_GET["tarjeta"]) &&
	$_GET["tarjeta"] !== ""
) {
	$tarjeta = $_GET["tarjeta"];
} else {
	header("location: ../../");
	die;
}

$conn = conexion();
$correo = new CorreoRepository($conn);
$correoView = new CorreosView($correo);
$correoView->setTarjetaId($tarjeta);
$correoView->view();
mysqli_close($conn);
