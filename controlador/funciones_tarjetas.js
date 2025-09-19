function agregardatos(estrategia_id, monto_id,
    email_remitente,
    email_destinatario,
    asunto,
    mensaje,
    limite_a_crear,
    vigencia_meses
) {
    cadena = "estrategia_id=" + estrategia_id +
        "&monto_id=" + monto_id +
        "&email_remitente=" + email_remitente +
        "&email_destinatario=" + email_destinatario +
        "&asunto=" + asunto +
        "&mensaje=" + mensaje +
        "&limite_a_crear=" + limite_a_crear +
        "&vigencia_meses=" + vigencia_meses;

    console.log(cadena);

    accion = "insertar";
    mensaje_si = "Tarjeta agregado con éxito.";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no, estrategia_id);
}
function agregaform(datos) {
    d = datos.split('||');
    $('#id_tarjetau').val(d[0]);
    $('#cedulau').val(d[1]);
    $('#codigou').val(d[2]);
    $('#fecha_creacionu').val(d[3]);
    $('#fecha_vencu').val(d[4]);
    $('#fecha_renovau').val(d[5]);
    $('#estrategia_idu').val(d[6]);
    $('#tar_estado_idu').val(d[7]);
    $('#monto_idu').val(d[8]);
}
function agregaformVender(datos) {
    d = datos.split('||');
    $('#id_tarjetauv').val(d[0]);
    $('#tar_estado_iduv').val(d[7]);
    $('#cedulauv').val(d[1]);
    $('#codigouv').val(d[2]);
    $('#fecha_vencuv').val(d[4]);
    $('#fecha_renovauv').val(d[5]);
    $('#estrategia_iduv').val(d[6]);
}

function modificarCliente() {
    id_tarjeta = $('#id_tarjetau').val();
    cedula = $('#cedulau').val();
    canjeada = $('#canjeadau').val();
    fecha_venc = $('#fecha_vencu').val();
    fecha_renova = $('#fecha_renovau').val();
    tar_estado_id = $('#tar_estado_idu').val();

    estrategia_id = $('#estrategia_idu').val();
    cadena = "id_tarjeta=" + id_tarjeta +
        "&cedula=" + cedula +
        "&canjeada=" + canjeada +
        "&fecha_venc=" + fecha_venc +
        "&fecha_renova=" + fecha_renova +
        "&tar_estado_id=" + tar_estado_id;

    accion = "modificar";
    mensaje_si = "Tarjeta modificado con éxito.";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no, estrategia_id);
}

function tarjetaVender() {
    id_tarjeta = $('#id_tarjetauv').val();
    cedula = $('#cedulauv').val();
    fecha_venc = $('#fecha_vencuv').val();
    fecha_renova = $('#fecha_renovauv').val();
    estrategia_id = $('#estrategia_iduv').val();

    email_remitente = $('#email_remitenteuv').val();
    email_destinatario = $('#email_destinatariouv').val();
    asunto = $('#asuntouv').val();
    mensaje = $('#mensajeuv').val();

    cadena = "id_tarjeta=" + id_tarjeta +
        "&cedula=" + cedula +
        "&fecha_venc=" + fecha_venc +
        "&fecha_renova=" + fecha_renova +
        "&email_remitente=" + email_remitente +
        "&email_destinatario=" + email_destinatario +
        "&asunto=" + asunto +
        "&mensaje=" + mensaje;

    console.log(cadena);

    accion = "vender";
    mensaje_si = "Tarjeta modificado con éxito.";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no, estrategia_id);
}

function preguntarSiNo(id_tarjeta, estrategia_id) {
    var opcion = confirm("¿Esta seguro de eliminar el registro?");
    if (opcion == true) {
        alert("El registro será eliminado.");
        eliminarDatos(id_tarjeta, estrategia_id);
    } else {
        alert("El proceso de eliminación del registro ha sido cancelado.");
    }
}

function eliminarDatos(id_tarjeta, estrategia_id) {
    cadena = "id_tarjeta=" + id_tarjeta;

    accion = "borrar";
    mensaje_si = "Tarjeta borrado con éxito.";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no, estrategia_id);
}

function a_ajax(cadena, accion, mensaje_si, mensaje_no, estrategia_id) {
    $.ajax({
        type: "POST",
        url: "../modelo/tarjetas_modelo.php?accion=" + accion,
        data: cadena,
        success: function (r) {
            if (r == 1) {
                // vacia los campos del formulario insertar
                $('#codigo').val('');
                $('#canjeada').val('');
                $('#estrategia_id').val('');
                $('#tar_estado_id').val('');
                $('#monto_id').val('');
                // vacia los campos del formulario modificar
                $('#id_tarjetau').val('');
                $('#cedulau').val('');
                $('#codigou').val('');
                $('#canjeadau').val('');
                $('#fecha_vencu').val('');
                $('#fecha_renovau').val('');
                $('#estrategia_idu').val('');
                $('#tar_estado_idu').val('');
                $('#monto_idu').val('');
                // carga datos actualizados a la vista
                $('#tabla').load('../vista/componentes/tablas/vista_tarjetas.php?estrategia='+estrategia_id);
                alert(mensaje_si);
            } else {
                alert(mensaje_no);
            }
        }
    });
}
