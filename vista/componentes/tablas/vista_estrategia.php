<?php
include_once '../../../modelo/conexion.php';
require_once '../../../src/infrastructure/EstrategiaRepository.php';
require_once '../../../src/View/EstrategiaView.php';

// Validar si el ID del aliado existe en la URL
if (!isset($_GET["aliado"]) || $_GET["aliado"] === "") {
    header("location: ../../");
    die;
}

$aliado = $_GET["aliado"];

// Obtener los parámetros de paginación de la URL
// La página actual, por defecto es 1 si no está definida
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// El límite de resultados por página, puedes ajustarlo a tu necesidad
$limit = 3; 

// Conexión a la base de datos
$conn = conexion();
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Instanciar el repositorio y la vista
$estrategia = new EstrategiaRepository($conn);
$estrategiaView = new EstrategiaView($estrategia);

// Llamar al método de paginación con todos los parámetros
$estrategiaView->setEstrategiaPaginadaByAliadoId($aliado, $page, $limit);

// Renderizar la vista
$estrategiaView->view_aliado();

// Cerrar la conexión a la base de datos
mysqli_close($conn);