function tarjetaDenunciaAgregar(nombre, cedula, tarjeta_codigo) {
    cadena = "nombre=" + nombre +
        "&cedula=" + cedula +
        "&tarjeta_codigo=" + tarjeta_codigo;

    accion = "insertar";
    mensaje_si = "Denuncia agregada con éxito.";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no);
}
function agregaform(datos) {
    d = datos.split('||');
    $('#id_denunciau').val(d[0]);
    $('#nombreu').val(d[1]);
    $('#cedulau').val(d[2]);
    $('#tarjeta_codigou').val(d[3]);
}

function tarjetaDenunciaModificar() {
    id_denuncia = $('#id_denunciau').val();
    nombre = $('#nombreu').val();
    cedula = $('#cedulau').val();
    tarjeta_codigo = $('#tarjeta_codigou').val();
    cadena = "id_denuncia=" + id_denuncia +
        "&nombre=" + nombre +
        "&cedula=" + cedula +
        "&tarjeta_codigo=" + tarjeta_codigo;

    accion = "modificar";
    mensaje_si = "Denuncia modificada con éxito.";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no);
}

function preguntarSiNo(id_denuncia) {
    var opcion = confirm("¿Esta seguro de eliminar el registro?");
    if (opcion == true) {
        alert("El registro será eliminado.");
        eliminarDatos(id_denuncia);
    } else {
        alert("El proceso de eliminación del registro ha sido cancelado.");
    }
}

function eliminarDatos(id_denuncia) {
    cadena = "id_denuncia=" + id_denuncia;

    accion = "borrar";
    mensaje_si = "Denuncia borrada con éxito.";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no);
}

function a_ajax(cadena, accion, mensaje_si, mensaje_no) {
    $.ajax({
        type: "POST",
        url: "../modelo/denuncia_tarjeta_modelo.php?accion=" + accion,
        data: cadena,
        success: function (r) {
            if (r == 1) {
                // vacia los campos del formulario insertar
                $('#nombre').val('');
                $('#cedula').val('');
                $('#tarjeta_codigo').val('');
                // vacia los campos del formulario modificar
                $('#id_denunciau').val('');
                $('#nombreu').val('');
                $('#cedulau').val('');
                $('#tarjeta_codigou').val('');
                // carga datos actualizados a la vista
                $('#tabla').load('../vista/componentes/tablas/vista_denuncia_tarjeta.php');
                alert(mensaje_si);
            } else {
                alert(mensaje_no);
            }
        }
    });
}
