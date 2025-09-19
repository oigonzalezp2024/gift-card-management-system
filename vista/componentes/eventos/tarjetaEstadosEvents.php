<script type="text/javascript">
	$(document).ready(function() {
		$('#tabla').load('componentes/tablas/vista_tarjeta_estados.php');
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#guardarnuevo').click(function() {
			estado = $('#estado').val();
			tarjetaEstadoAgregar(estado);
		});
		$('#actualizadatos').click(function() {
			tarjetaEstadoModificar();
		});
	});
</script>