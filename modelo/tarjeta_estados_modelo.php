<?php
include 'conexion.php';
$conn = conexion();

$accion = $_GET['accion'];

if($accion == "insertar"){

    $estado = $_POST['estado'];

    $sql="INSERT INTO tarjeta_estados(
          estado
          )VALUE(
          '$estado')";

    echo $consulta = mysqli_query($conn, $sql);
}

elseif($accion == "modificar"){

    $id_estado = $_POST['id_estado'];
    $estado = $_POST['estado'];

    $sql="UPDATE tarjeta_estados SET
          estado = '$estado'
          WHERE id_estado = '$id_estado'";

    echo $consulta = mysqli_query($conn, $sql);
}

elseif($accion == "borrar"){

    $id_estado = $_POST['id_estado'];

    $sql = "DELETE FROM tarjeta_estados
            WHERE id_estado = '$id_estado'";

    echo $consulta = mysqli_query($conn, $sql);
}


?>