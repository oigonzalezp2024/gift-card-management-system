<?php
session_start();
if (
	isset($_SESSION['logueo']) &&
	(
		$_SESSION['logueo'] == "mnbvnmguyfntrvn" ||
		$_SESSION['logueo'] == "mnybdfmuynb"
	)
) {
	$_SESSION['logueo'] = "mnybdfmuynb";
} else {
	header('location: ../');
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Clientes</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php
	include('librerias.php');
	?>
	<script src="../controlador/funciones_aliados.js"></script>
</head>

<body id="body">
	<?php
	include 'header.php';
	?>
	<div class="container">
		<div id="tabla"></div>
	</div>
	<?php
	include './componentes/formularios/aliadoForms.php';
	include './componentes/eventos/aliadoEvents.php';
	include './footer.php';
	?>
</body>

</html>