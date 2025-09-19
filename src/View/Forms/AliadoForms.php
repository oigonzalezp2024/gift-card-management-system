<?php

class AliadoForms
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
                        <h4 class="modal-title" id="myModalLabel">Agregar Aliado</h4>
                    </div>
                    <div class="modal-body">
                        <label>nombre</label>
                        <input type="text" id="nombre" class="form-control input-sm" required="">
                        <label>nit</label>
                        <input type="text" id="nit" class="form-control input-sm" required="">
                        <label>email</label>
                        <input type="email" id="email" class="form-control input-sm" required="">
                        <label>celular</label>
                        <input type="number" id="celular" class="form-control input-sm" required="">
                        <label>Estrategia</label>
                        <input type="text" id="estrategia" class="form-control input-sm" required="">
                        <div class="table-responsive">
                            <table id="pedido-table">
                                <tr>
                                    <td><label for="monto_p_0">monto</label></td>
                                    <td><label for="limite_p_0">cantidad</label></td>
                                    <td><label for="vigencia_p_0">vigencia</label></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="monto_p_0" id="monto_p_0" class="form-control" style="width:85px;">
                                            <option value="-">-- selecciene la opcion de su preferencia --</option>
                                            <option value="1">$ 20.000</option>
                                            <option value="2">$ 50.000</option>
                                            <option value="3">$ 70.000</option>
                                            <option value="4">$ 100.000</option>
                                            <option value="5">$ 150.000</option>
                                            <option value="6">$ 200.000</option>
                                            <option value="7">$ 300.000</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="limite_p_0" id="limite_p_0" class="form-control" style="width:70px;">
                                            <option value="-">-- selecciene la opcion de su preferencia --</option>
                                            <option value="50">50 tarjetas</option>
                                            <option value="67">67 tarjetas</option>
                                            <option value="100">100 tarjetas</option>
                                            <option value="134">134 tarjetas</option>
                                            <option value="200">200 tarjetas</option>
                                            <option value="250">250 tarjetas</option>
                                            <option value="334">334 tarjetas</option>
                                            <option value="500">500 tarjetas</option>
                                            <option value="1000">1000 tarjetas</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="vigencia_p_0" id="vigencia_p_0" class="form-control" style="width:70px;">
                                            <option value="-">-- selecciene la opcion de su preferencia --</option>
                                            <option value="1">1 mes</option>
                                            <option value="2">2 meses</option>
                                            <option value="3">3 meses</option>
                                            <option value="4">6 meses</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <button type="button" class="btn btn-default btn-xs" id="add-row">
                                <span class="glyphicon glyphicon-plus"></span> Agregar otra fila
                            </button>
                        </div>
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
        <!-- MODAL PARA INSERTAR REGISTROS -->
        <div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Actualizar datos del aliado</h4>
                    </div>
                    <div class="modal-body">
                        <input type="number" hidden="" id="id_aliadou">
                        <label>nombre</label>
                        <input type="text" id="nombreu" class="form-control input-sm" required="">
                        <label>nit</label>
                        <input type="text" id="nitu" class="form-control input-sm" required="">
                        <label>email</label>
                        <input type="text" id="emailu" class="form-control input-sm" required="">
                        <label>celular</label>
                        <input type="number" id="celularu" class="form-control input-sm" required="">
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
