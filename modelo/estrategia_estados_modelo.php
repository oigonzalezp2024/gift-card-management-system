<?php
include 'conexion.php';
$conn = conexion();

$accion = $_GET['accion'];

if($accion == "insertar"){

    $estado_est = $_POST['estado_est'];

    $sql="INSERT INTO estrategia_estados(
          estado_est
          )VALUE(
          '$estado_est')";

    echo $consulta = mysqli_query($conn, $sql);
}

elseif($accion == "modificar"){

    $id_estrategia_est = $_POST['id_estrategia_est'];
    $estado_est = $_POST['estado_est'];

    $sql="UPDATE estrategia_estados SET
          estado_est = '$estado_est'
          WHERE id_estrategia_est = '$id_estrategia_est'";

    echo $consulta = mysqli_query($conn, $sql);
}

elseif($accion == "borrar"){

    $id_estrategia_est = $_POST['id_estrategia_est'];

    $sql = "DELETE FROM estrategia_estados
            WHERE id_estrategia_est = '$id_estrategia_est'";

    echo $consulta = mysqli_query($conn, $sql);
}


?>