<?php
session_start();
if (
	!(
		isset($_SESSION['logueo']) &&
		$_SESSION['logueo'] == "mnybdfmuynb"
	)
) {
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
	<script src="../controlador/funciones_tarjeta_montos.js"></script>
</head>

<body id="body">
	<?php
	include 'header.php';
	?>
	<div class="container">
		<div id="tabla"></div>
	</div>
	<?php
	include './componentes/formularios/tarjetaMontosForms.php';
	include './componentes/eventos/tarjetaMontosEvents.php';
	include './footer.php';
	?>
</body>

</html>