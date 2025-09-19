<script type="text/javascript">
	$(document).ready(function() {
		$('#tabla').load('componentes/tablas/vista_estrategia_estados.php');
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#guardarnuevo').click(function() {
			estado_est = $('#estado_est').val();
			estrategiaEstadoAgregar(estado_est);
		});
		$('#actualizadatos').click(function() {
			estrategiaEstadoModificar();
		});
	});
</script>