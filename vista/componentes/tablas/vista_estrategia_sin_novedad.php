<?php
include_once '../../../modelo/conexion.php';
require_once '../../../src/infrastructure/EstrategiaRepository.php';
require_once '../../../src/View/EstrategiaView.php';

if (
    isset($_GET["aliado"]) &&
    $_GET["aliado"] !== ""
) {
    $aliado = $_GET["aliado"];
} else {
    header("location: ../../");
    die;
}

$conn = conexion();
$estrategia = new EstrategiaRepository($conn);
$estrategiaView = new EstrategiaView($estrategia);
$estrategiaView->estrategiasSinNovedad($aliado);
$estrategiaView->view();
mysqli_close($conn);
