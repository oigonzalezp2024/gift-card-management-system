function aliadoAgregar(nombre, nit, email, celular, estrategia, pedido) {
    cadena = "nombre=" + nombre +
        "&nit=" + nit +
        "&email=" + email +
        "&celular=" + celular +
        "&estrategia=" + estrategia +
        "&pedido="+pedido;

    accion = "insertar";
    mensaje_si = "Aliado agregado con éxito";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no);
}

function agregaform(datos) {
    d = datos.split('||');
    $('#id_aliadou').val(d[0]);
    $('#nombreu').val(d[1]);
    $('#nitu').val(d[2]);
    $('#emailu').val(d[3]);
    $('#celularu').val(d[4]);
}

function aliadoModificar() {
    id_aliado = $('#id_aliadou').val();
    nombre = $('#nombreu').val();
    nit = $('#nitu').val();
    email = $('#emailu').val();
    celular = $('#celularu').val();
    cadena = "id_aliado=" + id_aliado +
        "&nombre=" + nombre +
        "&nit=" + nit +
        "&email=" + email +
        "&celular=" + celular;

    accion = "modificar";
    mensaje_si = "Aliado modificado con éxito";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no);
}

function preguntarSiNo(id_aliado) {
    var opcion = confirm("¿Esta seguro de eliminar el registro?");
    if (opcion == true) {
        alert("El registro será eliminado.");
        eliminarDatos(id_aliado);
    } else {
        alert("El proceso de eliminación del registro ha sido cancelado.");
    }
}

function eliminarDatos(id_aliado) {
    cadena = "id_aliado=" + id_aliado;

    accion = "borrar";
    mensaje_si = "Aliado borrado con éxito";
    mensaje_no = "Error de registro";
    a_ajax(cadena, accion, mensaje_si, mensaje_no);
}

function a_ajax(cadena, accion, mensaje_si, mensaje_no) {
    $.ajax({
        type: "POST",
        url: "../modelo/aliados_modelo.php?accion=" + accion,
        data: cadena,
        success: function (r) {
            if (r == 1) {
                // vacia los campos del formulario insertar
                $('#nombre').val('');
                $('#nit').val('');
                $('#email').val('');
                $('#celular').val('');
                // vacia los campos del formulario modificar
                $('#id_aliadou').val('');
                $('#nombreu').val('');
                $('#nitu').val('');
                $('#emailu').val('');
                $('#celularu').val('');
                // carga datos actualizados a la vista
                $('#tabla').load('../vista/componentes/tablas/vista_aliados.php');
                alert(mensaje_si);
            } else {
                alert(mensaje_no);
            }
        }
    });
}
