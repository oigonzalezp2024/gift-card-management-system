<?php
if (
	isset($_GET["estrategia"]) &&
	$_GET["estrategia"] !== ""
) {
	$estrategia = $_GET["estrategia"];
} else {
	header("location: ../");
	die;
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Tarjetas</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php
	include('librerias.php');
	?>
	<script src="../controlador/funciones_tarjetas.js"></script>
</head>

<body id="body">
	<?php
	include 'header.php';
	?>
	<div class="container">
		<div id="tabla"></div>
	</div>
	<?php
	include './componentes/formularios/tarjetaForms.php';
	include './componentes/eventos/tarjetaEvents.php';
	include './footer.php';
	?>
</body>

</html>