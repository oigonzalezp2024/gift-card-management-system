<?php
include 'conexion.php';
$conn = conexion();

// Set the default timezone to Colombia
date_default_timezone_set('America/Bogota');

// Crea un objeto de fecha a partir de la fecha actual
$fecha_creacion = new DateTime();
// Clona el objeto para no modificar la fecha de creación original
$fecha_vencimiento = clone $fecha_creacion;

$accion = $_GET['accion'];

if ($accion == "insertar") {

    // Validaciones iniciales
    if (
        !isset($_POST['limite_a_crear'], $_POST['estrategia_id'], $_POST['monto_id'], $_POST['vigencia_meses']) ||
        !is_numeric($_POST['limite_a_crear'])
    ) {
        echo "Solicitud no bien diligenciada.";
        exit;
    }

    $limite_a_crear = (int) $_POST['limite_a_crear'];
    $estrategia_id = (int) $_POST['estrategia_id'];
    $monto_id = (int) $_POST['monto_id'];
    $vigencia_meses = (int) $_POST['vigencia_meses'];
    $tar_estado_id = 1;

    // Consolidar validaciones de límites
    if ($limite_a_crear <= 0) {
        echo "El número de tarjetas a crear debe ser un valor positivo.";
        exit;
    }
    if ($limite_a_crear > 200) {
        echo "No puede solicitar más de 200 tarjetas por orden de producción.";
        exit;
    }
    // El límite de 1000 se manejará con la consulta de la base de datos

    // Consulta consolidada para obtener datos necesarios en una sola llamada
    $sql = "SELECT
    MAX(CAST(tar.consecutivo AS SIGNED)) AS consecutivo_mas_alto,
    mon.monto,
    mon.opcion,
    RIGHT(ali.nit, 4) AS cuatro_digitos
FROM tarjetas tar
JOIN tarjeta_montos mon ON mon.id_monto = tar.monto_id
JOIN estrategia estr ON estr.id_estrategia = tar.estrategia_id
JOIN aliados ali ON ali.id_aliado = estr.aliado_id
WHERE tar.estrategia_id = ? AND tar.monto_id = ?;";

    // Usar sentencias preparadas para seguridad
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $estrategia_id, $monto_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    // Si no hay resultados, inicializar los valores
    $consecutivo_mas_alto = $row['consecutivo_mas_alto'] ?? -1;
    $monto = $row['monto'] ?? '';
    $opcion = $row['opcion'] ?? '';
    $cuatro_digitos = $row['cuatro_digitos'] ?? '';

    // Validar el límite de 1000 tarjetas y el consecutivo
    if ($consecutivo_mas_alto >= 999 || ($limite_a_crear + $consecutivo_mas_alto) >= 999) {
        echo "No se debe superar el límite de 1000 tarjetas por tipo para cada estrategia. consecutivo_mas_alto: {$consecutivo_mas_alto}";
        exit;
    }

    // Lógica de creación de tarjetas
    $fecha_creacion = new DateTime();
    $fecha_vencimiento = clone $fecha_creacion;
    $fecha_vencimiento->add(new DateInterval('P' . $vigencia_meses . 'M'));

    $fecha_creacion_sql = $fecha_creacion->format('Y-m-d H:i:s');
    $fecha_vencimiento_sql = $fecha_vencimiento->format('Y-m-d H:i:s');

    $valores_lote = [];
    $consecutivo_final = $consecutivo_mas_alto + $limite_a_crear;

    // Preparar la sentencia de inserción fuera del bucle
    $sql_insert = "INSERT INTO tarjetas (
    codigo, consecutivo, fecha_creacion, fecha_venc, estrategia_id, tar_estado_id, monto_id
) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($conn, $sql_insert);

    for ($i = $consecutivo_mas_alto + 1; $i <= $consecutivo_final; $i++) {
        $consecutivo_formateado = sprintf('%03d', $i);
        $cuatro_digitos_formateado = sprintf('%04d', $cuatro_digitos);
        $opcion_formateado = sprintf('%01d', $opcion);
        $codigo = $cuatro_digitos_formateado . $opcion_formateado . $consecutivo_formateado;

        // Ejecutar la inserción
        mysqli_stmt_bind_param($stmt_insert, "ssssiii", $codigo, $consecutivo_formateado, $fecha_creacion_sql, $fecha_vencimiento_sql, $estrategia_id, $tar_estado_id, $monto_id);
        if (!mysqli_stmt_execute($stmt_insert)) {
            echo "Error al insertar la tarjeta: " . mysqli_stmt_error($stmt_insert);
            break;
        }
    }

    // ----------------------------------------------------
    // Liberación de recursos y cierre de conexiones
    // ----------------------------------------------------
    // Cierra la sentencia preparada de la consulta SELECT
    mysqli_stmt_close($stmt);

    // Cierra la sentencia preparada de la inserción
    mysqli_stmt_close($stmt_insert);

    // Cierra la conexión a la base de datos
    mysqli_close($conn);

    echo "1";
} elseif ($accion == "modificar") {

    $id_tarjeta = $_POST['id_tarjeta'];
    $cedula = $_POST['cedula'];
    $fecha_venc = $_POST['fecha_venc'];
    $fecha_renova = $_POST['fecha_renova'];
    $tar_estado_id = $_POST['tar_estado_id'];

    $sql = "UPDATE tarjetas SET
          cedula = '$cedula', 
          fecha_venc = '$fecha_venc', 
          fecha_renova = '$fecha_renova',
          tar_estado_id = '$tar_estado_id'
          WHERE id_tarjeta = '$id_tarjeta'";

    echo $consulta = mysqli_query($conn, $sql);
} elseif ($accion == "vender") {

    $id_tarjeta = $_POST['id_tarjeta'];
    $cedula = $_POST['cedula'];
    $fecha_venc = $_POST['fecha_venc'];
    $fecha_renova = $_POST['fecha_renova'];
    $tar_estado_id = 2; // vendida

    $sql = "UPDATE tarjetas SET
          cedula = '$cedula', 
          fecha_venc = '$fecha_venc', 
          fecha_renova = '$fecha_renova',
          tar_estado_id = '$tar_estado_id'
          WHERE id_tarjeta = '$id_tarjeta'";

    $consulta = mysqli_query($conn, $sql);

    $email_remitente = $_POST['email_remitente'];
    $email_destinatario = $_POST['email_destinatario'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    $sql = "INSERT INTO envio_correo_tar(
           email_remitente, email_destinatario, asunto, mensaje, tarjeta_id
          )VALUE(
           '$email_remitente', '$email_destinatario', '$asunto', '$mensaje', '$id_tarjeta')";

    echo $consulta = mysqli_query($conn, $sql);
} elseif ($accion == "borrar") {

    $id_tarjeta = $_POST['id_tarjeta'];

    $sql = "DELETE FROM tarjetas
            WHERE id_tarjeta = '$id_tarjeta'";

    echo $consulta = mysqli_query($conn, $sql);
}
