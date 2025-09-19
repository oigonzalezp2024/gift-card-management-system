<?php
include 'conexion.php';
$conn = conexion();

$accion = $_GET['accion'];

if ($accion == "insertar") {
    if (
        isset($_POST['cedula']) &&
        is_numeric($_POST['cedula']) &&
        isset($_POST['tarjeta_codigo']) &&
        is_numeric($_POST['tarjeta_codigo'])
    ) {
        $nombre = $_POST['nombre'];
        $cedula = $_POST['cedula'];
        $tarjeta_codigo = $_POST['tarjeta_codigo'];

        $sql = "INSERT INTO denuncia_tarjeta(
          nombre, cedula, tarjeta_codigo
          )VALUE(
          '$nombre', '$cedula', '$tarjeta_codigo')";

        echo $consulta = mysqli_query($conn, $sql);
    }
} elseif ($accion == "modificar") {
    if (
        isset($_POST['cedula']) &&
        is_numeric($_POST['cedula']) &&
        isset($_POST['tarjeta_codigo']) &&
        is_numeric($_POST['tarjeta_codigo'])
    ) {
        $id_denuncia = $_POST['id_denuncia'];
        $nombre = $_POST['nombre'];
        $cedula = $_POST['cedula'];
        $tarjeta_codigo = $_POST['tarjeta_codigo'];

        $sql = "UPDATE denuncia_tarjeta SET
          nombre = '$nombre', 
          cedula = '$cedula', 
          tarjeta_codigo = '$tarjeta_codigo'
          WHERE id_denuncia = '$id_denuncia'";

        echo $consulta = mysqli_query($conn, $sql);
    }
} elseif ($accion == "borrar") {

    $id_denuncia = $_POST['id_denuncia'];

    $sql = "DELETE FROM denuncia_tarjeta
            WHERE id_denuncia = '$id_denuncia'";

    echo $consulta = mysqli_query($conn, $sql);
}
