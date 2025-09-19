function tarjetaEstadoAgregar(estado) {
    cadena = "estado=" + estado;

    accion = "insertar";
    mensaje_si = "Tarjeta estado agregado con éxito.";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no);
}
function agregaform(datos) {
    d = datos.split('||');
    $('#id_estadou').val(d[0]);
    $('#estadou').val(d[1]);
}

function tarjetaEstadoModificar() {
    id_estado = $('#id_estadou').val();
    estado = $('#estadou').val();
    cadena = "id_estado=" + id_estado +
        "&estado=" + estado;

    accion = "modificar";
    mensaje_si = "Tarjeta estado modificado con éxito.";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no);
}

function preguntarSiNo(id_estado) {
    var opcion = confirm("¿Esta seguro de eliminar el registro?");
    if (opcion == true) {
        alert("El registro será eliminado.");
        eliminarDatos(id_estado);
    } else {
        alert("El proceso de eliminación del registro ha sido cancelado.");
    }
}

function eliminarDatos(id_estado) {
    cadena = "id_estado=" + id_estado;

    accion = "borrar";
    mensaje_si = "Tarjeta estado borrado con éxito.";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no);
}

function a_ajax(cadena, accion, mensaje_si, mensaje_no) {
    $.ajax({
        type: "POST",
        url: "../modelo/tarjeta_estados_modelo.php?accion=" + accion,
        data: cadena,
        success: function (r) {
            if (r == 1) {
                // vacia los campos del formulario insertar
                $('#estado').val('');
                // vacia los campos del formulario modificar
                $('#id_estadou').val('');
                $('#estadou').val('');
                // carga datos actualizados a la vista
                $('#tabla').load('../vista/componentes/tablas/vista_tarjeta_estados.php');
                alert(mensaje_si);
            } else {
                alert(mensaje_no);
            }
        }
    });
}
