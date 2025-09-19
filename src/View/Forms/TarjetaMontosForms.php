<?php

class TarjetaMontosForms
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
                        <h4 class="modal-title" id="myModalLabel">Agregar monto de tarjeta</h4>
                    </div>
                    <div class="modal-body">
                        <label>monto</label>
                        <input type="number" name="monto" id="monto" class="form-control input-sm" required="">
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
        <!-- MODAL PARA EDICION DE DATOS -->
        <!-- 
        Por seguridad del modelo de negocio no esta permitido modificar los montos de las opciones de tarjeta.
        Si se comete un error debe eliminarse el registro y crear otro nuevo. 
        -->
<?php
    }
}
