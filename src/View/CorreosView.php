<?php

class CorreosView
{
    private $rows;
    private $correo;

    public function __construct(CorreoRepository $correo)
    {
        $this->correo = $correo;
    }

    function setTarjetaId($tarjeta): void
    {
        $this->rows = $this->correo->getCorreoByTarjetaId($tarjeta);
    }

    function view()
    {
        $rows = $this->rows;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>arreglos</title>
</head>
<div class="row"><br><br><br><br>
    <div>
<center>
<h2>envio_correo_tar</h2>
</center>
<button class="btn btn-primary navbar-left"
               data-toggle="modal"
               data-target="#modalNuevo">
    Agregar envio_correo_tar
    <span class="glyphicon glyphicon-plus"></span>
</button></div>
    <table class="table table-condensed table-bordered table-responsive">
    <thead>
        <tr>
            <th>id_envio</th>
            <th>email_remitente</th>
            <th>email_destinatario</th>
            <th>asunto</th>
            <th>mensaje</th>
            <th>tarjeta_id</th>
        </tr>
   </thead>
    <tbody>
    <?php

    foreach ($rows as $row) {
        $datos = $row['id_envio'] . "||" .
                  $row['email_remitente'] . "||" .
                  $row['email_destinatario'] . "||" .
                  $row['asunto'] . "||" .
                  $row['mensaje'] . "||" .
                  $row['tarjeta_id'];
    ?>
        <tr>
            <td><?php echo $row['id_envio']; ?></td>
            <td><?php echo $row['email_remitente']; ?></td>
            <td><?php echo $row['email_destinatario']; ?></td>
            <td><?php echo $row['asunto']; ?></td>
            <td><?php echo $row['mensaje']; ?></td>
            <td><?php echo $row['tarjeta_id']; ?></td>
            <td>
                <button class="btn btn-warning glyphicon glyphicon-pencil"
                               data-toggle="modal"
                               data-target="#modalEdicion"
                               onclick="agregaform('<?php echo $datos; ?>')">
                </button></td>
            <td>
                <button class="btn btn-danger glyphicon glyphicon-remove"
                           onclick="preguntarSiNo('<?php echo $row['id_envio']; ?>')">
                </button>
            </td>
        </tr>
    <?php
    }
    ?>
    </tbody>
    </table>
</div>
</body>
</html>
<?php
    }
}
