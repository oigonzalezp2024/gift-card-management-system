<?php
include_once '../../../modelo/conexion.php';
$conn = conexion();
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
            <h2>Estrategia estados</h2>
        </center>
    </div>
    <div class="table-responsive" style="max-width:250px; margin:auto;">
        <button class="btn btn-primary navbar-left"
            data-toggle="modal"
            data-target="#modalNuevo">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
        <table class="table">
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
                $sql = 'SELECT * FROM estrategia_estados';
                $result = mysqli_query($conn, $sql);
                while ($fila = mysqli_fetch_assoc($result)) {
                    $datos = $fila['id_estrategia_est'] . "||" .
                        $fila['estado_est'];
                ?>
                    <tr>
                        <td>
                            <button class="btn btn-danger glyphicon glyphicon-remove"
                                onclick="preguntarSiNo('<?php echo $fila['id_estrategia_est']; ?>')">
                            </button>
                        </td>
                        <td><?php echo $fila['id_estrategia_est']; ?></td>
                        <td><?php echo $fila['estado_est']; ?></td>
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