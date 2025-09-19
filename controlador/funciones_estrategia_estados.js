function estrategiaEstadoAgregar(estado_est) {
    cadena = "estado_est=" + estado_est;

    accion = "insertar";
    mensaje_si = "Estrategia estado agregado con éxito.";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no);
}
function agregaform(datos) {
    d = datos.split('||');
    $('#id_estrategia_estu').val(d[0]);
    $('#estado_estu').val(d[1]);
}

function estrategiaEstadoModificar() {
    id_estrategia_est = $('#id_estrategia_estu').val();
    estado_est = $('#estado_estu').val();
    cadena = "id_estrategia_est=" + id_estrategia_est +
        "&estado_est=" + estado_est;

    accion = "modificar";
    mensaje_si = "Estrategia estado modificado con éxito.";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no);
}

function preguntarSiNo(id_estrategia_est) {
    var opcion = confirm("¿Esta seguro de eliminar el registro?");
    if (opcion == true) {
        alert("El registro será eliminado.");
        eliminarDatos(id_estrategia_est);
    } else {
        alert("El proceso de eliminación del registro ha sido cancelado.");
    }
}

function eliminarDatos(id_estrategia_est) {
    cadena = "id_estrategia_est=" + id_estrategia_est;

    accion = "borrar";
    mensaje_si = "Estrategia estado borrado con éxito.";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no);
}

function a_ajax(cadena, accion, mensaje_si, mensaje_no) {
    $.ajax({
        type: "POST",
        url: "../modelo/estrategia_estados_modelo.php?accion=" + accion,
        data: cadena,
        success: function (r) {
            if (r == 1) {
                // vacia los campos del formulario insertar
                $('#id_estrategia_est').val('');
                $('#estado_est').val('');
                // vacia los campos del formulario modificar
                $('#id_estrategia_estu').val('');
                $('#estado_estu').val('');
                // carga datos actualizados a la vista
                $('#tabla').load('../vista/componentes/tablas/vista_estrategia_estados.php');
                alert(mensaje_si);
            } else {
                alert(mensaje_no);
            }
        }
    });
}
