<?php
if (isset($_GET['page'])) {
	$page = $_GET['page'];
?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabla').load('componentes/tablas/vista_denuncia_tarjeta.php?page=<?php echo $page; ?>');
		});
	</script>
<?php
} else {
?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabla').load('componentes/tablas/vista_denuncia_tarjeta.php');
		});
		console.log("ojoooooooo");
	</script>
<?php
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#guardarnuevo').click(function() {
			nombre = $('#nombre').val();
			cedula = $('#cedula').val();
			tarjeta_codigo = $('#tarjeta_codigo').val();
			tarjetaDenunciaAgregar(nombre, cedula, tarjeta_codigo);
		});
		$('#actualizadatos').click(function() {
			tarjetaDenunciaModificar();
		});
	});
</script>