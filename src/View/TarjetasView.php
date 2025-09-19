<?php

class TarjetasView
{
    private $rows;
    private $tarjeta;
    private $estrategiaId;
    private $paginaActual;
    private $itemsPorPagina;
    private $totalPaginas;

    public function __construct(TarjetaRepository $tarjeta)
    {
        $this->tarjeta = $tarjeta;
    }

    /**
     * @param int $estrategia
     * @return void
     */
    public function setEstrategiaId($estrategia): void
    {
        $this->estrategiaId = $estrategia;
    }

    /**
     * @param int $pagina
     * @return void
     */
    public function setPaginaActual($pagina): void
    {
        $this->paginaActual = $pagina;
    }

    /**
     * @param int $items
     * @return void
     */
    public function setItemsPorPagina($items): void
    {
        $this->itemsPorPagina = $items;
    }

    /**
     * @param int $total
     * @return void
     */
    public function setTotalPaginas($total): void
    {
        $this->totalPaginas = $total;
    }

    /**
     * Función para obtener los datos de la página actual y renderizar la vista.
     * @return void
     */
    public function view()
    {
        $this->rows = $this->tarjeta->getTarjetasPaginadas($this->estrategiaId, $this->paginaActual, $this->itemsPorPagina);

        $rows = $this->rows;
        $estrategia = $this->estrategiaId;
        $paginaActual = $this->paginaActual;
        $totalPaginas = $this->totalPaginas;

        // Lógica de paginación para limitar a 5 enlaces
        $limit = 5;
        $startPage = max(1, $paginaActual - floor($limit / 2));
        $endPage = min($totalPaginas, $startPage + $limit - 1);

        // Ajustar el inicio si estamos cerca del final
        if ($endPage - $startPage < $limit - 1) {
            $startPage = max(1, $endPage - $limit + 1);
        }
?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <title>Arreglos</title>
            <style>
                /* Estilos para replicar el diseño de paginación */
                .pagination {
                    display: flex;
                    list-style: none;
                    padding: 0;
                    border: 1px solid #1abc9c;
                    border-radius: 5px;
                }
                .page-item {
                    margin: 0;
                }
                .page-link {
                    display: block;
                    padding: 8px 16px;
                    text-decoration: none;
                    color: #ffffff;
                    background-color: #000000;
                    border-right: 1px solid #1abc9c;
                    transition: background-color 0.3s, color 0.3s;
                }
                .page-item:last-child .page-link {
                    border-right: none;
                }
                .page-link:hover {
                    background-color: #333333;
                }
                .page-item.active .page-link {
                    background-color: #1abc9c;
                    color: #000000;
                    border-color: #1abc9c;
                }
                .page-item.disabled .page-link {
                    background-color: #333333;
                    color: #888888;
                    cursor: not-allowed;
                }
            </style>
        </head>

        <body>
            <div class="row"><br><br><br><br>
                <div>
                    <center>
                        <h2>Tarjetas</h2>
                    </center>
                    <button class="btn btn-primary navbar-left" data-toggle="modal" data-target="#modalNuevo">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </div>
                <table class="table table-condensed table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>aliado</th>
                            <th>estrategia</th>
                            <th>monto</th>
                            <th>estado</th>
                            <th>código</th>
                            <th>comprador cédula</th>
                            <th>fechas</th>
                            <th>correos</th>
                            <th>denuncias</th>
                            <th>vender</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row) {
                            $datos = $row['id_tarjeta'] . "||" .
                                $row['cedula'] . "||" .
                                $row['codigo'] . "||" .
                                $row['fecha_creacion'] . "||" .
                                $row['fecha_venc'] . "||" .
                                $row['fecha_renova'] . "||" .
                                $row['estrategia_id'] . "||" .
                                $row['tar_estado_id'] . "||" .
                                $row['monto_id'];
                        ?>
                            <tr>
                                <td><?php echo $row['id_tarjeta']; ?></td>
                                <td><?php echo $row['aliado_nombre']; ?></td>
                                <td><?php echo $row['estrategia']; ?></td>
                                <td><?php echo $row['tarjeta_monto']; ?></td>
                                <td><?php echo $row['tarjeta_estado']; ?></td>
                                <td><?php echo $row['codigo']; ?></td>
                                <td><?php echo $row['cedula']; ?></td>
                                <td style="min-width:200px; text-align:right;">
                                    Creación: <?php echo $row['fecha_creacion']; ?> <br>
                                    Vencimiento: <?php echo $row['fecha_venc']; ?> <br>
                                    Renovación: <?php echo $row['fecha_renova']; ?>
                                </td>
                                <td>
                                    <a href="./envio_correo_tar.php?tarjeta=<?php echo $row['id_tarjeta'] ?>" class="btn" style="background-color: #000000; color: #ffffff">envios de correo</a>
                                </td>
                                <td>
                                    <?php if ($row['denuncia'] === 'SI') { ?>
                                        <a href="./denuncia_tarjeta_codigo.php?codigo=<?php echo $row['codigo'] ?>" class="btn" style="background-color: #000000; color: #ffffff">Ver Denuncias</a>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($row['tarjeta_estado'] !== 'vendida') { ?>
                                        <button class="btn" data-toggle="modal" data-target="#modalVender" onclick="agregaformVender('<?php echo $datos; ?>')">vender</button>
                                    <?php } ?>
                                </td>
                                <td>
                                    <button class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos; ?>')"></button>
                                </td>
                                <td>
                                    <button class="btn btn-danger glyphicon glyphicon-remove" onclick="preguntarSiNo('<?php echo $row['id_tarjeta']; ?>', '<?php echo $row['estrategia_id']; ?>')"></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="row text-center">
                <nav>
                    <ul class="pagination">
                        <li class="page-item <?php echo ($paginaActual == 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?estrategia=<?php echo $estrategia; ?>&page=1">Primera</a>
                        </li>
                        <li class="page-item <?php echo ($paginaActual == 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?estrategia=<?php echo $estrategia; ?>&page=<?php echo max(1, $paginaActual - 1); ?>">Anterior</a>
                        </li>

                        <?php for ($i = $startPage; $i <= $endPage; $i++) { ?>
                            <li class="page-item <?php echo ($i === $paginaActual) ? 'active' : ''; ?>">
                                <a class="page-link" href="?estrategia=<?php echo $estrategia; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php } ?>

                        <li class="page-item <?php echo ($paginaActual == $totalPaginas) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?estrategia=<?php echo $estrategia; ?>&page=<?php echo min($totalPaginas, $paginaActual + 1); ?>">Siguiente</a>
                        </li>
                        <li class="page-item <?php echo ($paginaActual == $totalPaginas) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?estrategia=<?php echo $estrategia; ?>&page=<?php echo $totalPaginas; ?>">Última</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </body>

        </html>
<?php
    }
}
