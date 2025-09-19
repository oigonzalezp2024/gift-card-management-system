<?php

if (
	isset($_GET["tarjeta"]) &&
	$_GET["tarjeta"] !== ""
) {
	$tarjeta = $_GET["tarjeta"];
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
	<script src="../controlador/funciones_envio_correo_tar.js"></script>
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
			<label>id_envio</label>
			<input type="number" id="id_envio" class="form-control input-sm" required="">
			<label>email_remitente</label>
			<textarea id="email_remitente" rows="4" cols="50"class="form-control input-sm" required=""></textarea>
			<label>email_destinatario</label>
			<textarea id="email_destinatario" rows="4" cols="50"class="form-control input-sm" required=""></textarea>
			<label>asunto</label>
			<textarea id="asunto" rows="4" cols="50"class="form-control input-sm" required=""></textarea>
			<label>mensaje</label>
			<textarea id="mensaje" rows="4" cols="50"class="form-control input-sm" required=""></textarea>
			<label>tarjeta_id</label>
			<input type="number" id="tarjeta_id" class="form-control input-sm" required="">
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
			<input type="number" hidden="" id="id_enviou">
			<label>email_remitente</label>
			<textarea id="email_remitenteu" rows="4" cols="50" class="form-control input-sm" required=""></textarea>
			<label>email_destinatario</label>
			<textarea id="email_destinatariou" rows="4" cols="50" class="form-control input-sm" required=""></textarea>
			<label>asunto</label>
			<textarea id="asuntou" rows="4" cols="50" class="form-control input-sm" required=""></textarea>
			<label>mensaje</label>
			<textarea id="mensajeu" rows="4" cols="50" class="form-control input-sm" required=""></textarea>
			<label>tarjeta_id</label>
			<input type="number" id="tarjeta_idu" class="form-control input-sm" required="">
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
	    $(document).ready(function () {
		$('#tabla').load('componentes/tablas/vista_envio_correo_tar.php?tarjeta=<?php echo $tarjeta; ?>');
	    });
	</script>
	<script type="text/javascript">
	    $(document).ready(function () {
		$('#guardarnuevo').click(function () {
		    email_remitente = $('#email_remitente').val();
		    email_destinatario = $('#email_destinatario').val();
		    asunto = $('#asunto').val();
		    mensaje = $('#mensaje').val();
		    tarjeta_id = $('#tarjeta_id').val();
		    agregardatos(email_remitente, email_destinatario, asunto, mensaje, tarjeta_id);
		});
		$('#actualizadatos').click(function () {
		    modificarCliente();
		});
	    });
	</script>
	<?php
	include './footer.php';
	?>
    </body>
</html>
