<?php

class TarjetaDenunciasForms
{
    function insertForm()
    {
?>
        <!-- MODAL PARA INSERTAR REGISTROS -->
        <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Agregar denuncia de tarjeta</h4>
                    </div>
                    <div class="modal-body">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control input-sm" required="">
                        <label>Cédula:</label>
                        <input type="text" name="cedula" id="cedula" class="form-control input-sm" required="">
                        <label>Tarjeta código:</label>
                        <input type="number" name="tarjeta_codigo" id="tarjeta_codigo" class="form-control input-sm" required="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarnuevo">
                            Agregar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    function updateForm()
    {
    ?>
        <!-- MODAL PARA EDICION DE DATOS-->
        <div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
                    </div>
                    <div class="modal-body">
                        <input type="number" hidden="" id="id_denunciau">
                        <label>Nombre:</label>
                        <input type="text" name="nombreu" id="nombreu" class="form-control input-sm" required="">
                        <label>Cédula:</label>
                        <input type="text" name="cedulau" id="cedulau" class="form-control input-sm" required="">
                        <label>Tarjeta código:</label>
                        <input type="number" name="tarjeta_codigou" id="tarjeta_codigou" class="form-control input-sm" required="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal" id="actualizadatos">
                            Actualizar
                        </button>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
