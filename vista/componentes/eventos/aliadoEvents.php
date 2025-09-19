<?php
if (isset($_GET['page'])) {
	$page = $_GET['page'];
?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabla').load('componentes/tablas/vista_aliados.php?page=<?php echo $page; ?>');
		});
	</script>
<?php
} else {
?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabla').load('componentes/tablas/vista_aliados.php');
		});
	</script>
<?php
}
?>
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
			nombre = $('#nombre').val();
			nit = $('#nit').val();
			email = $('#email').val();
			celular = $('#celular').val();
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

			aliadoAgregar(nombre, nit, email, celular, estrategia, JSON.stringify(pedido));
		});

		$('#actualizadatos').click(function() {
			aliadoModificar();
		});
	});
</script>