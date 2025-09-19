<?php

class TarjetaEstadosForms
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
                        <h4 class="modal-title" id="myModalLabel">Agregar estado de tarjeta</h4>
                    </div>
                    <div class="modal-body">
                        <label>estado</label>
                        <input type="text" name="estado" id="estado" class="form-control input-sm" required="">
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
                        <h4 class="modal-title" id="myModalLabel">Actualizar estado de tarjeta</h4>
                    </div>
                    <div class="modal-body">
                        <input type="number" hidden="" id="id_estadou">
                        <label>estado</label>
                        <input type="text" name="estadou" id="estadou" class="form-control input-sm" required="">
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
