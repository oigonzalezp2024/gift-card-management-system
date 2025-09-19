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

    $estrategia = $_POST['estrategia'];
    $aliado_id = $_POST['aliado_id'];
    $est_estado_id = $_POST['est_estado_id'];
    $tar_estado_id = 1; // todas las tarjetas inicialmente son inactivas
    $pedido = $_POST['pedido']; // ej: [[2,2,3],[2,2,6],[2,2,12]]

    // 1. Validar que el pedido es JSON válido
    $jsonDecoded = json_decode($pedido, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        // Si hay un error, no es un JSON válido.
        echo "Error: El formato no es un JSON válido.";
        exit;
    }

    // 2. Validar la estructura y el tipo de datos
    if (!is_array($jsonDecoded)) {
        // Si la decodificación no resulta en un array, el formato es incorrecto.
        echo "Error: El formato JSON no es una matriz (array).";
        exit;
    }

    foreach ($jsonDecoded as $subArray) {
        if (!is_array($subArray)) {
            // Si un elemento de la matriz principal no es una matriz, el formato es incorrecto.
            echo "Error: Cada elemento de la matriz principal debe ser una matriz.";
            exit;
        }

        foreach ($subArray as $value) {
            if (!is_numeric($value)) {
                // Si un elemento de la sub-matriz no es un número, el formato es incorrecto.
                echo "Error: Todos los valores dentro de las sub-matrices deben ser números.";
                exit;
            }
        }
    }

    $lotes_tarjetas = json_decode($pedido);
    $tarjetas = [];
    foreach ($lotes_tarjetas as $lote_tarjeta) {
        $monto_id = (int) $lote_tarjeta[0];
        $limite_a_crear = (int) $lote_tarjeta[1];
        $vigencia_meses = (int) $lote_tarjeta[2];
        $tarjeta = [
            ["monto_id", $monto_id],
            ["limite_a_crear", $limite_a_crear],
            ["vigencia_meses", $vigencia_meses]
        ];
        $tarjetas[] = $tarjeta;
    }

    $sql = "INSERT INTO estrategia(
          estrategia, aliado_id, pedido, est_estado_id
          )VALUE(
          '$estrategia', '$aliado_id', '$pedido', '$est_estado_id')";

    $consulta = mysqli_query($conn, $sql);

    $estrategia_id = mysqli_insert_id($conn);

    // consulta los 4 ultimos digitos del nit id del aliado por la estrategia_id
    $sql = "SELECT RIGHT(ali.nit, 4) as cuatro_digitos
    FROM `estrategia` est
    JOIN aliados ali on ali.id_aliado = est.aliado_id
    WHERE est.id_estrategia = $estrategia_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $cuatro_digitos = $row['cuatro_digitos'];
    // RECORRE LA MATRIZ
    foreach ($tarjetas as $tarjeta) {
        if (
            isset($tarjeta[0][0]) && $tarjeta[0][0] == 'monto_id' &&
            isset($tarjeta[1][0]) && $tarjeta[1][0] == 'limite_a_crear' &&
            isset($tarjeta[2][0]) && $tarjeta[2][0] == 'vigencia_meses'
        ) {
            $monto_id = $tarjeta[0][1];
            $limite_a_crear = $tarjeta[1][1];
            $vigencia_meses = $tarjeta[2][1];
        }
        // consulta la opcion del monto de la tarjeta por su el monto_id
        $sql = "SELECT
        mon.opcion as opcion
        FROM `tarjeta_montos` mon
        where mon.id_monto = $monto_id;";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $opcion = $row['opcion'];
        // toma el valor mas alto de los consecutivos
        $consecutivo_mas_alto = -1; // Valor predeterminado si el array está vacío
        if (!empty($consecutivos)) {
            // Primero, convierte los caracteres a números
            $numeros = array_map('intval', $consecutivos);
            // Luego, encuentra el valor máximo en el nuevo array de números
            $consecutivo_mas_alto = max($numeros);
        }
        // solo continua el proceso si respeta los limites de creacion de tarjetas limite de 999
        if ($consecutivo_mas_alto < 999) {
            $valores_por_lote = 200;
            $valores_lote = [];

            $cuatro_digitos_formateado = sprintf('%04d', $cuatro_digitos);
            $opcion_formateado = sprintf('%01d', $opcion);
            $consecutivo_final = $consecutivo_mas_alto + $limite_a_crear;

            // Se establece un nuevo límite para el bucle for
            // para no sobrepasar el límite de 999 tarjetas
            $consecutivo_final = min($consecutivo_final, 999);

            // ✅ AQUI ES DONDE DEBES INICIALIZAR LAS FECHAS
            $fecha_creacion = new DateTime();
            $fecha_vencimiento = new DateTime();

            // Agrega los meses de vigencia
            $fecha_vencimiento->add(new DateInterval('P' . $vigencia_meses . 'M'));

            // Formatea los objetos DateTime a un formato de cadena que la base de datos entienda
            $fecha_creacion_sql = $fecha_creacion->format('Y-m-d H:i:s');
            $fecha_vencimiento_sql = $fecha_vencimiento->format('Y-m-d H:i:s');

            for ($i = $consecutivo_mas_alto + 1; $i <= $consecutivo_final; $i++) {
                $consecutivo_formateado = sprintf('%03d', $i);
                $codigo = $cuatro_digitos_formateado . $opcion_formateado . $consecutivo_formateado;

                // Usa las nuevas variables formateadas en la consulta SQL
                $valores_lote[] = "('$codigo', '$consecutivo_formateado', '$fecha_creacion_sql', '$fecha_vencimiento_sql', '$estrategia_id', '$tar_estado_id', '$monto_id')";

                // ... (Tu código existente para insertar en lotes)
                if (count($valores_lote) === $valores_por_lote || $i === $consecutivo_final) {
                    $sql = "INSERT INTO tarjetas (
                    codigo, consecutivo, fecha_creacion, fecha_venc, estrategia_id, tar_estado_id, monto_id
                    ) VALUES " . implode(", ", $valores_lote);

                    if (!mysqli_query($conn, $sql)) {
                        echo "Error al insertar el lote: " . mysqli_error($conn);
                        break;
                    }
                    $valores_lote = [];
                }
            }
        }
    }
    echo 1;
} elseif ($accion == "modificar") {

    $id_estrategia = $_POST['id_estrategia'];
    $estrategia = $_POST['estrategia'];
    $aliado_id = $_POST['aliado_id'];
    $est_estado_id = $_POST['est_estado_id'];

    $sql = "UPDATE estrategia SET
          estrategia = '$estrategia', 
          aliado_id = '$aliado_id', 
          est_estado_id = '$est_estado_id'
          WHERE id_estrategia = '$id_estrategia'";

    echo $consulta = mysqli_query($conn, $sql);
} elseif ($accion == "borrar") {

    $id_estrategia = $_POST['id_estrategia'];

    $sql = "DELETE FROM estrategia
            WHERE id_estrategia = '$id_estrategia'";

    echo $consulta = mysqli_query($conn, $sql);
}
