<?php

class TarjetaEstadosView
{
    private array $rows;

    public function __construct(TarjetaEstadosRepository $estados)
    {
        $this->rows = $estados->getTarjetaEstados();
    }

    function view()
    {
        $rows = $this->rows;
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>

        <body>
            <div style="margin-top: 100px;">
                <center>
                    <h2>tarjeta - estados</h2>
                </center>
            </div>
            <div class="table-responsive" style="max-width:250px; margin:auto;">
                <table class="table">
                    <button class="btn btn-primary navbar-left"
                        data-toggle="modal"
                        data-target="#modalNuevo">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                    <thead>
                        <tr>
                            <th></th>
                            <th>id</th>
                            <th>estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rows as $row) {
                            $datos = $row['id_estado'] . "||" .
                                $row['estado'];
                        ?>
                            <tr>
                                <td>
                                    <button class="btn btn-danger glyphicon glyphicon-remove"
                                        onclick="preguntarSiNo('<?php echo $row['id_estado']; ?>')">
                                    </button>
                                </td>
                                <td><?php echo $row['id_estado']; ?></td>
                                <td><?php echo $row['estado']; ?></td>
                                <td>
                                    <button class="btn btn-warning glyphicon glyphicon-pencil"
                                        data-toggle="modal"
                                        data-target="#modalEdicion"
                                        onclick="agregaform('<?php echo $datos; ?>')">
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
