<?php

class TarjetaForms
{
    private $estrategia_id;

    function setData($estrategia_id)
    {
        $this->estrategia_id = $estrategia_id;
    }

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
                        <h4 class="modal-title" id="myModalLabel">Agregar cliente</h4>
                    </div>
                    <div class="modal-body">
                        <label>Seleccione el monto de la tarjeta</label>
                        <select name="monto_id" id="monto_id" class="form-control input-sm" required="">
                        <option value="-">-- selecciene la opcion de su preferencia --</option>
                            <option value="1">15.000</option>
                            <option value="2">20.000</option>
                            <option value="3">30.000</option>
                            <option value="4">50.000</option>
                            <option value="5">60.000</option>
                        </select>
                        <label>Número de tarjetas a crear</label>
                        <input type="text" name="limite_a_crear" id="limite_a_crear" class="form-control input-sm" required="">
                        <label>Número de meses de vigencia</label>
                        <input type="text" name="vigencia_meses" id="vigencia_meses" class="form-control input-sm" required="">
                        <div hidden="">
                            <label>estrategia_id</label>
                            <input type="number" id="estrategia_id" value="<?php echo $this->estrategia_id; ?>">
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
                        <input type="number" hidden="" id="id_tarjetau">
                        <label>¿Qué acción desea realizar?</label>
                        <select name="tar_estado_idu" id="tar_estado_idu" class="form-control input-sm" required="">
                        <option value="-">-- selecciene la opcion de su preferencia --</option>
                            <option value="1">inactivar tarjeta</option>
                            <option value="2">vender tarjeta</option>
                            <option value="3">redimir tarjeta</option>
                            <option value="4">denunciar tarjeta</option>
                            <option value="5">bloquedar tarjeta</option>
                            <option value="7">renovar tarjeta</option>
                        </select>
                        <label>cédula</label>
                        <input type="number" name="cedulau" id="cedulau" class="form-control input-sm" required="">
                        <label>código</label>
                        <input type="text" name="codigou" id="codigou" class="form-control input-sm" required="" disabled>
                        <label>fecha_venc</label>
                        <input type="date" id="fecha_vencu" class="form-control input-sm" required="">
                        <label>fecha_renova</label>
                        <input type="date" id="fecha_renovau" class="form-control input-sm" required="">
                        <div hidden="">
                            <label>estrategia_id</label>
                            <input type="number" id="estrategia_idu" value="<?php echo $this->estrategia_id; ?>">
                        </div>
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
    function saleForm()
    {
    ?>
        <!-- MODAL PARA VENDER TARJETAS -->
        <div class="modal fade" id="modalVender" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Vender tarjeta</h4>
                    </div>
                    <div class="modal-body">
                        <input type="number" hidden="" id="id_tarjetauv">
                        <label>cédula</label>
                        <input type="number" name="cedulauv" id="cedulauv" class="form-control input-sm" required="">
                        <label>código</label>
                        <input type="text" name="codigouv" id="codigouv" class="form-control input-sm" required="" disabled>
                        <label>fecha_venc</label>
                        <input type="date" id="fecha_vencuv" class="form-control input-sm" required="">
                        <label>fecha_renova</label>
                        <input type="date" id="fecha_renovauv" class="form-control input-sm" required="">
                        <div hidden="">
                            <label>estrategia_id</label>
                            <input type="number" id="estrategia_iduv" value="<?php echo $this->estrategia_id; ?>">
                        </div>
                        <label>email_remitente</label>
                        <input type="email" name="email_remitente" id="email_remitenteuv" class="form-control input-sm" required="">
                        <label>email_destinatario</label>
                        <input type="text" name="email_destinatario" id="email_destinatariouv" class="form-control input-sm" required="">
                        <label>asunto</label>
                        <input type="text" name="asuntouv" id="asuntouv" class="form-control input-sm" required="">
                        <label>mensaje</label>
                        <input type="text" name="mensajeuv" id="mensajeuv" class="form-control input-sm" required="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal" id="venderTarjeta">
                            Vender
                        </button>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
