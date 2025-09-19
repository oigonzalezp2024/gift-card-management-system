<?php
include_once '../../../modelo/conexion.php';
require_once '../../../src/infrastructure/TarjetasRepository.php';
require_once '../../../src/View/TarjetasView.php';

// Paso 1: Validar y sanitizar los parámetros de la URL
if (!isset($_GET["estrategia"]) || $_GET["estrategia"] === "" || !is_numeric($_GET["estrategia"])) {
    header("location: ../../");
    die;
}

$estrategia = (int)$_GET["estrategia"];
$pagina = isset($_GET["page"]) ? (int)$_GET["page"] : 1; // Obtiene la página actual, por defecto es 1
$itemsPorPagina = 12; // Define el número de tarjetas por página

// Paso 2: Conectar a la base de datos
$conn = conexion();
if ($conn === false) {
    die("Error de conexión a la base de datos.");
}

// Paso 3: Instanciar el Repository y la View
$tarjetaRepository = new TarjetaRepository($conn);
$tarjetaView = new TarjetasView($tarjetaRepository);

// Paso 4: Obtener el total de registros para la paginación
$totalTarjetas = $tarjetaRepository->getCountTarjetasByEstrategiaId($estrategia);

// Paso 5: Calcular el total de páginas
$totalPaginas = ceil($totalTarjetas / $itemsPorPagina);

// Paso 6: Pasar los datos de paginación a la vista
$tarjetaView->setEstrategiaId($estrategia);
$tarjetaView->setPaginaActual($pagina);
$tarjetaView->setItemsPorPagina($itemsPorPagina);
$tarjetaView->setTotalPaginas($totalPaginas);

// Paso 7: Renderizar la vista con los datos de la página actual
$tarjetaView->view();

// Paso 8: Cerrar la conexión
mysqli_close($conn);
