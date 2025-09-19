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
	<title>Clientes</title>
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
					<label>id_tarjeta</label>
					<input type="number" id="id_tarjeta" class="form-control input-sm" required="">
					<label>cedula</label>
					<textarea id="cedula" rows="4" cols="50" class="form-control input-sm" required=""></textarea>
					<label>codigo</label>
					<textarea id="codigo" rows="4" cols="50" class="form-control input-sm" required=""></textarea>
					<label>canjeada</label>
					<input type="" id="canjeada" class="form-control input-sm" required="">
					<label>fecha_creacion</label>
					<input type="" id="fecha_creacion" class="form-control input-sm" required="">
					<label>fecha_venc</label>
					<input type="date" id="fecha_venc" class="form-control input-sm" required="">
					<label>fecha_renova</label>
					<input type="date" id="fecha_renova" class="form-control input-sm" required="">
					<label>estrategia_id</label>
					<input type="number" id="estrategia_id" class="form-control input-sm" required="">
					<label>tar_estado_id</label>
					<input type="number" id="tar_estado_id" class="form-control input-sm" required="">
					<label>monto_id</label>
					<input type="number" id="monto_id" class="form-control input-sm" required="">


					<label>email_remitente</label>
					<textarea id="email_remitente" rows="4" cols="50" class="form-control input-sm" required=""></textarea>
					<label>email_destinatario</label>
					<textarea id="email_destinatario" rows="4" cols="50" class="form-control input-sm" required=""></textarea>
					<label>asunto</label>
					<textarea id="asunto" rows="4" cols="50" class="form-control input-sm" required=""></textarea>
					<label>mensaje</label>
					<textarea id="mensaje" rows="4" cols="50" class="form-control input-sm" required=""></textarea>




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
					<input type="number" hidden="" id="id_tarjetau">
					<label>cedula</label>
					<textarea id="cedulau" rows="4" cols="50" class="form-control input-sm" required=""></textarea>
					<label>codigo</label>
					<textarea id="codigou" rows="4" cols="50" class="form-control input-sm" required=""></textarea>
					<label>canjeada</label>
					<input type="" id="canjeadau" class="form-control input-sm" required="">
					<label>fecha_creacion</label>
					<input type="" id="fecha_creacionu" class="form-control input-sm" required="">
					<label>fecha_venc</label>
					<input type="date" id="fecha_vencu" class="form-control input-sm" required="">
					<label>fecha_renova</label>
					<input type="date" id="fecha_renovau" class="form-control input-sm" required="">
					<label>estrategia_id</label>
					<input type="number" id="estrategia_idu" class="form-control input-sm" required="">
					<label>tar_estado_id</label>
					<input type="number" id="tar_estado_idu" class="form-control input-sm" required="">
					<label>monto_id</label>
					<input type="number" id="monto_idu" class="form-control input-sm" required="">
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
			$('#tabla').load('componentes/tablas/vista_tarjetas.php?estrategia=<?php echo $estrategia; ?>');
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#guardarnuevo').click(function() {
				cedula = $('#cedula').val();
				codigo = $('#codigo').val();
				canjeada = $('#canjeada').val();
				fecha_creacion = $('#fecha_creacion').val();
				fecha_venc = $('#fecha_venc').val();
				fecha_renova = $('#fecha_renova').val();
				estrategia_id = $('#estrategia_id').val();
				tar_estado_id = $('#tar_estado_id').val();
				monto_id = $('#monto_id').val();
				email_remitente = $('#email_remitente').val();
				email_destinatario = $('#email_destinatario').val();
				asunto = $('#asunto').val();
				mensaje = $('#mensaje').val();
				agregardatos(cedula, codigo, canjeada, fecha_creacion, fecha_venc, fecha_renova, estrategia_id, tar_estado_id, monto_id,
					email_remitente,
					email_destinatario,
					asunto,
					mensaje
				);
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