function agregardatos(estrategia, aliado_id, est_estado_id, pedido) {
    cadena = "estrategia=" + estrategia +
        "&aliado_id=" + aliado_id +
        "&est_estado_id=" + est_estado_id +
        "&pedido="+ pedido;

    accion = "insertar";
    mensaje_si = "Cliente agregado con exito";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no, aliado_id);
}
function agregaform(datos) {
    d = datos.split('||');
    $('#id_estrategiau').val(d[0]);
    $('#estrategiau').val(d[1]);
    $('#aliado_idu').val(d[2]);
    $('#est_estado_idu').val(d[3]);
}

function modificarCliente() {
    id_estrategia = $('#id_estrategiau').val();
    estrategia = $('#estrategiau').val();
    aliado_id = $('#aliado_idu').val();
    est_estado_id = $('#est_estado_idu').val();
    cadena = "id_estrategia=" + id_estrategia +
        "&estrategia=" + estrategia +
        "&aliado_id=" + aliado_id +
        "&est_estado_id=" + est_estado_id;

    accion = "modificar";
    mensaje_si = "Cliente modificado con exito";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no, aliado_id);
}

function preguntarSiNo(id_estrategia, aliado_id) {
    var opcion = confirm("¿Esta seguro de eliminar el registro?");
    if (opcion == true) {
        alert("El registro será eliminado.");
        eliminarDatos(id_estrategia, aliado_id);
    } else {
        alert("El proceso de eliminación del registro ha sido cancelado.");
    }
}

function eliminarDatos(id_estrategia, aliado_id) {
    cadena = "id_estrategia=" + id_estrategia;

    accion = "borrar";
    mensaje_si = "Cliente borrado con exito";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no, aliado_id);
}

function a_ajax(cadena, accion, mensaje_si, mensaje_no, aliado_id) {
    $.ajax({
        type: "POST",
        url: "../modelo/estrategia_modelo.php?accion=" + accion,
        data: cadena,
        success: function (r) {
            if (r == 1) {
                // vacia los campos del formulario insertar
                $('#estrategia').val('');
                $('#aliado_id').val('');
                $('#est_estado_id').val('');
                // vacia los campos del formulario modificar
                $('#id_estrategiau').val('');
                $('#estrategiau').val('');
                $('#aliado_idu').val('');
                $('#est_estado_idu').val('');
                // carga datos actualizados a la vista
                $('#tabla').load('../vista/componentes/tablas/vista_estrategia.php?aliado=' + aliado_id);
                alert(mensaje_si);
            } else {
                alert(mensaje_no);
            }
        }
    });
}
