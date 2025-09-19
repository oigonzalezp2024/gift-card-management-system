<?php
// Incluye la clase de conexión y los modelos/vistas necesarios.
include_once '../../../modelo/conexion.php';
require_once '../../../src/infrastructure/DenunciaRepository.php';
require_once '../../../src/View/DenunciaTarjetaCodigoView.php';

// Establece la conexión a la base de datos.
$conn = conexion();
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Crea una instancia del repositorio de denuncias.
$denunciaRepo = new DenunciaRepository($conn);

// Obtiene la página actual de la URL, por defecto es 1.
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Define la cantidad de elementos a mostrar por página.
$itemsPerPage = 10; // Puedes ajustar este valor según tu necesidad.

// Crea una instancia de la vista con el repositorio y los parámetros de paginación.
$estrategiaView = new DenunciaTarjetaCodigoView($denunciaRepo, $itemsPerPage, $currentPage);

// Si se recibe un código de tarjeta en la URL, se actualiza la vista para filtrar por él.
if (isset($_GET['codigo']) && !empty($_GET['codigo'])) {
    $codigo = $_GET['codigo'];
    $estrategiaView->setTarjetaCodigo($codigo, $currentPage);
}

// Llama al método view() para renderizar la tabla con los datos paginados.
$estrategiaView->view();

// Cierra la conexión a la base de datos.
mysqli_close($conn);
