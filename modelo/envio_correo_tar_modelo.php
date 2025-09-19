<?php
include 'conexion.php';
$conn = conexion();

$accion = $_GET['accion'];

if($accion == "insertar"){

    $email_remitente = $_POST['email_remitente'];
    $email_destinatario = $_POST['email_destinatario'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];
    $tarjeta_id = $_POST['tarjeta_id'];

    $sql="INSERT INTO envio_correo_tar(
          email_remitente, email_destinatario, asunto, mensaje, tarjeta_id
          )VALUE(
          '$email_remitente', '$email_destinatario', '$asunto', '$mensaje', '$tarjeta_id')";

    echo $consulta = mysqli_query($conn, $sql);
}

elseif($accion == "modificar"){

    $id_envio = $_POST['id_envio'];
    $email_remitente = $_POST['email_remitente'];
    $email_destinatario = $_POST['email_destinatario'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];
    $tarjeta_id = $_POST['tarjeta_id'];

    $sql="UPDATE envio_correo_tar SET
          email_remitente = '$email_remitente', 
          email_destinatario = '$email_destinatario', 
          asunto = '$asunto', 
          mensaje = '$mensaje', 
          tarjeta_id = '$tarjeta_id'
          WHERE id_envio = '$id_envio'";

    echo $consulta = mysqli_query($conn, $sql);
}

elseif($accion == "borrar"){

    $id_envio = $_POST['id_envio'];

    $sql = "DELETE FROM envio_correo_tar
            WHERE id_envio = '$id_envio'";

    echo $consulta = mysqli_query($conn, $sql);
}


?>