<?php
include 'conexion.php';
$conn = conexion();

$accion = $_GET['accion'];

if ($accion == "insertar") {

    if (
        isset($_POST['monto']) &&
        is_numeric($_POST['monto'])
    ) {
        $monto = $_POST['monto'];
        $sql = "INSERT INTO tarjeta_montos(
          monto
          )VALUE(
          '$monto')";
        echo $consulta = mysqli_query($conn, $sql);
    }
} elseif ($accion == "borrar") {

    $id_monto = $_POST['id_monto'];

    $sql = "DELETE FROM tarjeta_montos
            WHERE id_monto = '$id_monto'";

    echo $consulta = mysqli_query($conn, $sql);
}
