<?php

class TarjetaMontosView
{
    private array $rows;

    public function __construct(TarjetaMontosRepository $montos)
    {
        $this->rows = $montos->getMontos();
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
                    <h2>tarjeta - montos</h2>
                </center>
            </div>
            <div class="table-responsive" style="max-width:250px; margin:auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <button class="btn btn-primary navbar-left"
                                    data-toggle="modal"
                                    data-target="#modalNuevo">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </th>
                            <th>id</th>
                            <th>monto</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rows as $rows) {
                            $datos = $rows['id_monto'] . "||" .
                                $rows['monto'];
                        ?>
                            <tr>
                                <td></td>
                                <td><?php echo $rows['id_monto']; ?></td>
                                <td><?php echo $rows['monto']; ?></td>
                                <td>
                                    <button class="btn btn-danger glyphicon glyphicon-remove"
                                        onclick="preguntarSiNo('<?php echo $rows['id_monto']; ?>')">
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










        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <title>arreglos</title>
        </head>
        <div class="row"><br><br><br><br>


        </div>
        </body>

        </html>
<?php
    }
}
