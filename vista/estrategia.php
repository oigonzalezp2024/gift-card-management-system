<?php
if (
	isset($_GET["page"]) && $_GET["page"] !== ""
) {
	$page = $_GET["page"];
} else {
	$page = 1;
}

if (
	isset($_GET["aliado"]) &&
	$_GET["aliado"] !== ""
) {
	$aliado = $_GET["aliado"];
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
					<div hidden="">
						<label>id_estrategia</label>
						<input type="number" id="id_estrategia" class="form-control input-sm" required="">
					</div>
					<label>estrategia</label>
					<input type="text" id="estrategia" class="form-control input-sm" required="">
					<div hidden="">
						<label>aliado_id</label>
						<input type="number" id="aliado_id" class="form-control input-sm" value="<?php echo $aliado; ?>">
					</div>
					<label>est_estado_id</label>
					<select name="est_estado_id" id="est_estado_id" class="form-control input-sm" required="">
						<option value="--">-- selecciona un estado --</option>
						<option value="1">activa</option>
						<option value="2">inactiva</option>
					</select>
					<div class="table-responsive">
						<table id="pedido-table">
							<tr>
								<td><label for="monto_p_0">monto</label></td>
								<td><label for="limite_p_0">cantidad</label></td>
								<td><label for="vigencia_p_0">vigencia</label></td>
							</tr>
							<tr>
								<td>
									<select name="monto_p_0" id="monto_p_0" class="form-control" style="width:85px;">
										<option value="-">-- selecciene la opcion de su preferencia --</option>
										<option value="1">$ 20.000</option>
										<option value="2">$ 50.000</option>
										<option value="3">$ 70.000</option>
										<option value="4">$ 100.000</option>
										<option value="5">$ 150.000</option>
										<option value="6">$ 200.000</option>
										<option value="7">$ 300.000</option>
									</select>
								</td>
								<td>
									<select name="limite_p_0" id="limite_p_0" class="form-control" style="width:70px;">
										<option value="-">-- selecciene la opcion de su preferencia --</option>
										<option value="50">50 tarjetas</option>
										<option value="67">67 tarjetas</option>
										<option value="100">100 tarjetas</option>
										<option value="134">134 tarjetas</option>
										<option value="200">200 tarjetas</option>
										<option value="250">250 tarjetas</option>
										<option value="334">334 tarjetas</option>
										<option value="500">500 tarjetas</option>
										<option value="1000">1000 tarjetas</option>
									</select>
								</td>
								<td>
									<select name="vigencia_p_0" id="vigencia_p_0" class="form-control" style="width:70px;">
										<option value="-">-- selecciene la opcion de su preferencia --</option>
										<option value="1">1 mes</option>
										<option value="2">2 meses</option>
										<option value="3">3 meses</option>
										<option value="4">6 meses</option>
									</select>
								</td>
							</tr>
						</table>
					</div>
					<button type="button" class="btn btn-default btn-xs" id="add-row">
						<span class="glyphicon glyphicon-plus"></span> Agregar otra fila
					</button>
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
					<input type="text" id="estrategiau" class="form-control input-sm" required="">
					<div hidden="">
						<label>aliado_id</label>
						<input type="number" id="aliado_idu" class="form-control input-sm" value="<?php echo $aliado; ?>">
					</div>
					<label>Estado de tarjeta</label>
					<select name="est_estado_idu" id="est_estado_idu" class="form-control input-sm" required="">
						<option value="--">-- selecciona un estado --</option>
						<option value="1">activa</option>
						<option value="2">inactiva</option>
					</select>
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
			$('#tabla').load('componentes/tablas/vista_estrategia.php?aliado=<?php echo $aliado; ?>&page=<?php echo $page; ?>');
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			let rowCounter = 0;

			// Función para agregar una nueva fila a la tabla
			$('#add-row').click(function() {
				rowCounter++;
				let newRow = `
            <tr>
                <td>
                    <select name="monto_p_${rowCounter}" id="monto_p_${rowCounter}" class="form-control">
                        <option value="-">-- selecciene la opcion de su preferencia --</option>
                        <option value="1">$ 20.000</option>
                        <option value="2">$ 50.000</option>
                        <option value="3">$ 70.000</option>
                        <option value="4">$ 100.000</option>
                        <option value="5">$ 150.000</option>
                        <option value="6">$ 200.000</option>
                        <option value="7">$ 300.000</option>
                    </select>
                </td>
                <td>
                    <select name="limite_p_${rowCounter}" id="limite_p_${rowCounter}" class="form-control">
                        <option value="-">-- selecciene la opcion de su preferencia --</option>
                        <option value="50">50 tarjetas</option>
                        <option value="67">67 tarjetas</option>
                        <option value="100">100 tarjetas</option>
                        <option value="134">134 tarjetas</option>
                        <option value="200">200 tarjetas</option>
                        <option value="250">250 tarjetas</option>
                        <option value="334">334 tarjetas</option>
                        <option value="500">500 tarjetas</option>
                        <option value="1000">1000 tarjetas</option>
                    </select>
                </td>
                <td>
                    <select name="vigencia_p_${rowCounter}" id="vigencia_p_${rowCounter}" class="form-control">
                        <option value="-">-- selecciene la opcion de su preferencia --</option>
                        <option value="1">1 mes</option>
                        <option value="2">2 meses</option>
                        <option value="3">3 meses</option>
                        <option value="4">6 meses</option>
                    </select>
                </td>
            </tr>
        `;
				$('#pedido-table').append(newRow);
			});

			$('#guardarnuevo').click(function() {
				let estrategia = $('#estrategia').val();
				let aliado_id = $('#aliado_id').val();
				let est_estado_id = $('#est_estado_id').val();
				let pedido = [];

				// Iterar sobre cada fila de la tabla para construir la matriz
				$('table tr').each(function(index, row) {
					// Se asume que la primera fila es la de encabezados, se omite con index > 0 si fuera el caso.
					// En este caso, la primera fila es de datos, por lo que se itera desde 0.
					let monto = $(row).find('select[id^="monto_p_"]').val();
					let limite = $(row).find('select[id^="limite_p_"]').val();
					let vigencia = $(row).find('select[id^="vigencia_p_"]').val();

					if (monto && limite && vigencia) {
						let filaPedido = [
							parseInt(monto),
							parseInt(limite),
							parseInt(vigencia)
						];
						pedido.push(filaPedido);
					}
				});

				agregardatos(estrategia, aliado_id, est_estado_id, JSON.stringify(pedido));
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