function tarjetaMontoInsertar(monto) {
    cadena = "monto=" + monto;

    accion = "insertar";
    mensaje_si = "Monto agregado con éxito.";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no);
}
function agregaform(datos) {
    d = datos.split('||');
    $('#id_montou').val(d[0]);
    $('#montou').val(d[1]);
}

function preguntarSiNo(id_monto) {
    var opcion = confirm("¿Esta seguro de eliminar el registro?");
    if (opcion == true) {
        alert("El registro será eliminado.");
        eliminarDatos(id_monto);
    } else {
        alert("El proceso de eliminación del registro ha sido cancelado.");
    }
}

function eliminarDatos(id_monto) {
    cadena = "id_monto=" + id_monto;

    accion = "borrar";
    mensaje_si = "Monto borrado con éxito.";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no);
}

function a_ajax(cadena, accion, mensaje_si, mensaje_no) {
    $.ajax({
        type: "POST",
        url: "../modelo/tarjeta_montos_modelo.php?accion=" + accion,
        data: cadena,
        success: function (r) {
            if (r == 1) {
                // vacia los campos del formulario insertar
                $('#monto').val('');
                // vacia los campos del formulario modificar
                $('#id_montou').val('');
                $('#montou').val('');
                // carga datos actualizados a la vista
                $('#tabla').load('../vista/componentes/tablas/vista_tarjeta_montos.php');
                alert(mensaje_si);
            } else {
                alert(mensaje_no);
            }
        }
    });
}
