function agregardatos(email_remitente, email_destinatario, asunto, mensaje, tarjeta_id) {
    cadena = "email_remitente=" + email_remitente +
        "&email_destinatario=" + email_destinatario +
        "&asunto=" + asunto +
        "&mensaje=" + mensaje +
        "&tarjeta_id=" + tarjeta_id;

    accion = "insertar";
    mensaje_si = "Cliente agregado con exito";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no);
}
function agregaform(datos) {
    d = datos.split('||');
    $('#id_enviou').val(d[0]);
    $('#email_remitenteu').val(d[1]);
    $('#email_destinatariou').val(d[2]);
    $('#asuntou').val(d[3]);
    $('#mensajeu').val(d[4]);
    $('#tarjeta_idu').val(d[5]);
}

function modificarCliente() {
    id_envio = $('#id_enviou').val();
    email_remitente = $('#email_remitenteu').val();
    email_destinatario = $('#email_destinatariou').val();
    asunto = $('#asuntou').val();
    mensaje = $('#mensajeu').val();
    tarjeta_id = $('#tarjeta_idu').val();
    cadena = "id_envio=" + id_envio +
        "&email_remitente=" + email_remitente +
        "&email_destinatario=" + email_destinatario +
        "&asunto=" + asunto +
        "&mensaje=" + mensaje +
        "&tarjeta_id=" + tarjeta_id;

    accion = "modificar";
    mensaje_si = "Cliente modificado con exito";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no);
}

function preguntarSiNo(id_envio) {
    var opcion = confirm("¿Esta seguro de eliminar el registro?");
    if (opcion == true) {
        alert("El registro será eliminado.");
        eliminarDatos(id_envio);
    } else {
        alert("El proceso de eliminación del registro ha sido cancelado.");
    }
}

function eliminarDatos(id_envio) {
    cadena = "id_envio=" + id_envio;

    accion = "borrar";
    mensaje_si = "Cliente borrado con exito";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no);
}

function a_ajax(cadena, accion, mensaje_si, mensaje_no) {
    $.ajax({
        type: "POST",
        url: "../modelo/envio_correo_tar_modelo.php?accion=" + accion,
        data: cadena,
        success: function (r) {
            if (r == 1) {
                // vacia los campos del formulario insertar
                $('#email_remitente').val('');
                $('#email_destinatario').val('');
                $('#asunto').val('');
                $('#mensaje').val('');
                $('#tarjeta_id').val('');
                // vacia los campos del formulario modificar
                $('#id_enviou').val('');
                $('#email_remitenteu').val('');
                $('#email_destinatariou').val('');
                $('#asuntou').val('');
                $('#mensajeu').val('');
                $('#tarjeta_idu').val('');
                // carga datos actualizados a la vista
                $('#tabla').load('../vista/componentes/tablas/vista_envio_correo_tar.php');
                alert(mensaje_si);
            } else {
                alert(mensaje_no);
            }
        }
    });
}
