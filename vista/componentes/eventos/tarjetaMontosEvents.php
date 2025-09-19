<script type="text/javascript">
	$(document).ready(function() {
		$('#tabla').load('componentes/tablas/vista_tarjeta_montos.php');
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#guardarnuevo').click(function() {
			monto = $('#monto').val();
			tarjetaMontoInsertar(monto);
		});
		$('#actualizadatos').click(function() {
			tarjetaMontoModificar();
		});
	});
</script>