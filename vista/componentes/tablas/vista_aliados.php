<?php
// Incluye las clases y la conexión necesarias
include_once '../../../modelo/conexion.php';
require_once '../../../src/infrastructure/AliadosRepository.php';
require_once '../../../src/View/AliadosView.php';

// Establecer la conexión
$conn = conexion();
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Crear una instancia del repositorio
$aliadosRepository = new AliadosRepository($conn);

// --- Lógica de paginación ---
// Obtener el número de página actual desde la URL, por defecto es 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 15; // Definir el límite de registros por página

// Obtener el conteo total de aliados
$totalAliados = $aliadosRepository->getTotalCount();

// Calcular el número total de páginas
$totalPages = ceil($totalAliados / $limit);

// Obtener los datos de los aliados para la página actual
$aliadosData = $aliadosRepository->getAliadosPaginated($page, $limit);

// --- Preparar los datos para la vista ---
$dataForView = [
    'aliados' => $aliadosData,
    'page' => $page,
    'limit' => $limit,
    'total_pages' => $totalPages,
];

// Crear una instancia de la vista y renderizarla
$aliadosView = new AliadosView($dataForView);
$aliadosView->view();

// Cerrar la conexión
mysqli_close($conn);
