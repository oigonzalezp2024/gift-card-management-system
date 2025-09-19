<?php
include_once '../../../modelo/conexion.php';
require_once '../../../src/infrastructure/DenunciaRepository.php';
require_once '../../../src/View/DenunciaTarjetaCodigoView.php';

if (
    isset($_GET["codigo"]) &&
    $_GET["codigo"] !== ""
) {
    $codigo = $_GET["codigo"];
} else {
    header("location: ../../");
    die;
}

$conn = conexion();
$denuncia = new DenunciaRepository($conn);
$estrategiaView = new DenunciaTarjetaCodigoView($denuncia);
$estrategiaView->setTarjetaCodigo($codigo);
$estrategiaView->view();
mysqli_close($conn);

