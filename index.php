<?php
// 1. Inicia la sesión para acceder a las variables de sesión del usuario.
session_start();

// 2. Define la ruta de destino.
$destino = './vista/';
$archivo_a_validar = $destino . 'index.php';

// 3. logueo
if (
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['orden'])
) {
    if (
        $_POST['email'] == "oigonzalezp2024@gmail.com" &&
        $_POST['password'] == "1234" &&
        $_POST['orden'] == "logueo"
    ) {
        $_SESSION['logueo'] = "mnbvnmguyfntrvn";
        header('location: ./vista/');
    } else {
        header('location: ./error.php');
    }
    exit;
}

// 3. Primer control de seguridad: ¿el usuario está autenticado?
if (!isset($_SESSION['user_id'])) {
    // Si no está autenticado, redirige al inicio de sesión.
    header('location: ./login.php');
    exit;
}

// 4. Segundo control de robustez: ¿el archivo de destino existe?
if (file_exists($archivo_a_validar)) {
    // Si el usuario está autenticado y el archivo existe, realiza la redirección.
    header('location: ' . $destino);
    exit;
} else {
    // Si el usuario está autenticado, pero el archivo no existe,
    // redirige a una página de error o a un lugar seguro.
    header('location: ./error.php');
    exit;
}
