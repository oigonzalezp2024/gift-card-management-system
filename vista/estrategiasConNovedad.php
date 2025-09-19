<?php

if (
	isset($_GET["aliado"]) &&
	$_GET["aliado"] !== ""
) {
	$aliado =$_GET["aliado"];
} else {
	header("location: ../");
	die;
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
	<script src="../controlador/funciones_estrategia.js"></script>
</head>

<body id="body">
	<?php
	include 'header.php';
	?>
	<div class="container">
		<div id="tabla"></div>
	</div>
	<!-- MODAL PARA INSERTAR REGISTROS -->
	<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Agregar cliente</h4>
				</div>
				<div class="modal-body">
					<label>id_estrategia</label>
					<input type="number" id="id_estrategia" class="form-control input-sm" required="">
					<label>estrategia</label>
					<textarea id="estrategia" rows="4" cols="50" class="form-control input-sm" required=""></textarea>
					<label>aliado_id</label>
					<input type="number" id="aliado_id" class="form-control input-sm" required="">
					<label>est_estado_id</label>
					<input type="number" id="est_estado_id" class="form-control input-sm" required="">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarnuevo">
						Agregar
					</button>
				</div>
			</div>
		</div>
	</div>
	<!-- MODAL PARA EDICION DE DATOS-->
	<div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
				</div>
				<div class="modal-body">
					<input type="number" hidden="" id="id_estrategiau">
					<label>estrategia</label>
					<textarea id="estrategiau" rows="4" cols="50" class="form-control input-sm" required=""></textarea>
					<label>aliado_id</label>
					<input type="number" id="aliado_idu" class="form-control input-sm" required="">
					<label>est_estado_id</label>
					<input type="number" id="est_estado_idu" class="form-control input-sm" required="">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal" id="actualizadatos">
						Actualizar
					</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabla').load('componentes/tablas/vista_estrategia_con_novedad.php?aliado=<?php echo $aliado; ?>');
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#guardarnuevo').click(function() {
				id_estrategia = $('#id_estrategia').val();
				estrategia = $('#estrategia').val();
				aliado_id = $('#aliado_id').val();
				est_estado_id = $('#est_estado_id').val();
				agregardatos(id_estrategia, estrategia, aliado_id, est_estado_id);
			});
			$('#actualizadatos').click(function() {
				modificarCliente();
			});
		});
	</script>
	<?php
	include './footer.php';
	?>
</body>

</html>