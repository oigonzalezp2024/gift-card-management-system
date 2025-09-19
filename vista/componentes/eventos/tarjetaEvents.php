<?php
if (
	isset($_GET['page'])
) {
	$page = $_GET['page'];
?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabla').load('componentes/tablas/vista_tarjetas.php?estrategia=<?php echo $estrategia; ?>&page=<?php echo $page; ?>');
		});
	</script>
<?php
}else{
?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabla').load('componentes/tablas/vista_tarjetas.php?estrategia=<?php echo $estrategia; ?>');
		});
	</script>
<?php
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#guardarnuevo').click(function() {
			cedula = $('#cedula').val();
			estrategia_id = $('#estrategia_id').val();
			monto_id = $('#monto_id').val();
			email_remitente = $('#email_remitente').val();
			email_destinatario = $('#email_destinatario').val();
			asunto = $('#asunto').val();
			mensaje = $('#mensaje').val();
			limite_a_crear = $('#limite_a_crear').val();
			vigencia_meses = $('#vigencia_meses').val();
			agregardatos(estrategia_id, monto_id,
				email_remitente,
				email_destinatario,
				asunto,
				mensaje,
				limite_a_crear,
				vigencia_meses
			);
		});
		$('#actualizadatos').click(function() {
			modificarCliente();
		});
		$('#venderTarjeta').click(function() {
			tarjetaVender();
		});
	});
</script>