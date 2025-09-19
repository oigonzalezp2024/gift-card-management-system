<?php

class EstrategiaView
{
    private $rows;
    private $estrategia;
    private $totalItems;
    private $currentPage;
    private $limitPerPage;
    private $aliadoId;

    public function __construct(EstrategiaRepository $estrategia)
    {
        $this->estrategia = $estrategia;
    }

    /**
     * Establece los datos paginados de estrategias por ID de aliado.
     *
     * @param int $aliado El ID del aliado.
     * @param int $page El número de página actual.
     * @param int $limit El número de resultados por página.
     */
    public function setEstrategiaPaginadaByAliadoId(int $aliado, int $page, int $limit): void
    {
        $this->aliadoId = $aliado;
        $this->currentPage = $page;
        $this->limitPerPage = $limit;

        // Obtener todas las estrategias para calcular el total de elementos.
        $allResults = $this->estrategia->getEstrategiaByAliadoId($aliado);
        $this->totalItems = count($allResults);

        // Obtener solo la página actual.
        $this->rows = $this->estrategia->getEstrategiaPaginadaByAliadoId($aliado, $page, $limit);
    }

    /**
     * Establece los datos paginados de estrategias sin novedad.
     *
     * @param int $aliado El ID del aliado.
     * @param int $page El número de página actual.
     * @param int $limit El número de resultados por página.
     */
    public function setEstrategiasSinNovedadPaginadas(int $aliado, int $page, int $limit): void
    {
        $this->aliadoId = $aliado;
        $this->currentPage = $page;
        $this->limitPerPage = $limit;

        // Obtener todos los resultados para contar el total.
        $allResults = $this->estrategia->getEstrategiasSinNovedadByAliadoId($aliado);
        $this->totalItems = count($allResults);

        // Obtener la página actual.
        $this->rows = $this->estrategia->getEstrategiasSinNovedadPaginadaByAliadoId($aliado, $page, $limit);
    }

    /**
     * Establece los datos paginados de estrategias con denuncias.
     *
     * @param int $aliado El ID del aliado.
     * @param int $page El número de página actual.
     * @param int $limit El número de resultados por página.
     */
    public function setEstrategiaConDenunciasPaginadas(int $aliado, int $page, int $limit): void
    {
        $this->aliadoId = $aliado;
        $this->currentPage = $page;
        $this->limitPerPage = $limit;

        // Obtener todos los resultados para contar el total.
        $allResults = $this->estrategia->getEstrategiaConDenunciasByAliadoId($aliado);
        $this->totalItems = count($allResults);

        // Obtener la página actual.
        $this->rows = $this->estrategia->getEstrategiaConDenunciasPaginadaByAliadoId($aliado, $page, $limit);
    }

    // Mantener los métodos originales para la compatibilidad, si es necesario.
    function setAliadoId($aliado): void
    {
        $this->rows = $this->estrategia->getEstrategiaByAliadoId($aliado);
    }

    function estrategiasSinNovedad($aliado): void
    {
        $this->rows = $this->estrategia->getEstrategiasSinNovedadByAliadoId($aliado);
    }

    function estrategiasConDenuncias($aliado): void
    {
        $this->rows = $this->estrategia->getEstrategiaConDenunciasByAliadoId($aliado);
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
                    <h2>estrategia</h2>
                </center>
                <button class="btn btn-primary navbar-left"
                    data-toggle="modal"
                    data-target="#modalNuevo">
                    Agregar estrategia
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div>
            <table class="table table-condensed table-bordered table-responsive">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>estrategia</th>
                        <th>aliado_id</th>
                        <th>est_estado_id</th>
                        <th>tarjetas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) {
                        $datos = $row['id_estrategia'] . "||" .
                            $row['estrategia'] . "||" .
                            $row['aliado_id'] . "||" .
                            $row['est_estado_id'];
                    ?>
                        <tr>
                            <td><?php echo $row['id_estrategia']; ?></td>
                            <td><?php echo $row['estrategia']; ?></td>
                            <td><?php echo $row['aliado_id']; ?></td>
                            <td><?php echo $row['est_estado_id']; ?></td>
                            <td><?php echo $row['denuncia']; ?></td>
                            <td>
                                <a href="./tarjetas.php?estrategia=<?php echo $row['id_estrategia'] ?>" class="btn" style="
                                    background-color: #000000; color: #ffffff
                                ">tarjetas</a>
                            </td>
                            <td>
                                <a href="./tarjetas_habilitadas.php?estrategia=<?php echo $row['id_estrategia'] ?>" class="btn" style="
                                    background-color: #000000; color: #ffffff
                                ">habilitadas</a>
                            </td>
                            <td>
                                <?php if ($row['denuncia'] === 'SI'): ?>
                                    <a href="./tarjetas_denunciadas.php?estrategia=<?php echo $row['id_estrategia'] ?>" class="btn" style="
                                        background-color: #000000; color: #ffffff
                                    ">denunciadas</a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="btn btn-warning glyphicon glyphicon-pencil"
                                    data-toggle="modal"
                                    data-target="#modalEdicion"
                                    onclick="agregaform('<?php echo $datos; ?>')">
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-danger glyphicon glyphicon-remove"
                                    onclick="preguntarSiNo('<?php echo $row['id_estrategia']; ?>')">
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        </body>

        </html>
    <?php
    }

    function view_aliado()
    {
        $rows = $this->rows;
        $totalPages = ceil($this->totalItems / $this->limitPerPage);
        $currentPage = $this->currentPage;
        $aliadoId = $this->aliadoId;

        // Lógica de paginación para limitar a 5 enlaces
        $limit = 5;
        $startPage = max(1, $currentPage - floor($limit / 2));
        $endPage = min($totalPages, $startPage + $limit - 1);

        if ($endPage - $startPage < $limit - 1) {
            $startPage = max(1, $endPage - $limit + 1);
        }
    ?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <title>Estrategias</title>
            <style>
                /* Estilos básicos para replicar el diseño de la imagen */
                .pagination {
                    display: flex;
                    list-style: none;
                    padding: 0;
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
                    border: 1px solid #1abc9c;
                    border-left: none;
                }

                .page-link.first-last {
                    border-left: 1px solid #1abc9c;
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
                    color: #888888;
                    cursor: not-allowed;
                }
            </style>
        </head>
        <div class="row"><br><br><br><br>
            <div>
                <center>
                    <h2>Estrategias</h2>
                </center>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <?php foreach ($rows as $row) {
                            $datos = $row['id_estrategia'] . "||" .
                                $row['estrategia'] . "||" .
                                $row['aliado_id'] . "||" .
                                $row['est_estado_id'];
                        ?>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Estrategia</th>
                                <th>Aliado</th>
                                <th>Estado</th>
                                <th>Tarjetas</th>
                                <th>Tarjetas habilitadas</th>
                                <th>Denuncias</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td rowspan="3">
                                    <table>
                                        <tr>
                                            <td>
                                                <button class="btn btn-primary navbar-left"
                                                    data-toggle="modal"
                                                    data-target="#modalNuevo">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button class="btn btn-warning glyphicon glyphicon-pencil"
                                                    data-toggle="modal"
                                                    data-target="#modalEdicion"
                                                    onclick="agregaform('<?php echo $datos; ?>')">
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button class="btn btn-danger glyphicon glyphicon-remove"
                                                    onclick="preguntarSiNo('<?php echo $row['id_estrategia']; ?>')">
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td><?php echo $row['id_estrategia']; ?></td>
                                <td><?php echo $row['estrategia']; ?></td>
                                <td><?php echo $row['aliado_nombre']; ?></td>
                                <td><?php echo $row['estrategia_estado']; ?></td>
                                <td>
                                    <a href="./tarjetas.php?estrategia=<?php echo $row['id_estrategia'] ?>" class="btn" style="
                                    background-color: #000000; color: #ffffff
                                ">tarjetas</a>
                                </td>
                                <td>
                                    <?php if ($row['total_tarjetas'] > 0): ?>
                                        <a href="./tarjetas_habilitadas.php?estrategia=<?php echo $row['id_estrategia'] ?>" class="btn" style="
                                        background-color: #000000; color: #ffffff
                                    ">habilitadas</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($row['denuncia'] === 'SI'): ?>
                                        <a href="./tarjetas_denunciadas.php?estrategia=<?php echo $row['id_estrategia'] ?>" class="btn" style="
                                        background-color: #000000; color: #ffffff
                                    ">denunciadas</a>
                                    <?php endif; ?>
                                </td>
                                <td rowspan="3">
                                    <table>
                                        <tr>
                                            <td>
                                                <button class="btn btn-primary navbar-left"
                                                    data-toggle="modal"
                                                    data-target="#modalNuevo">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button class="btn btn-warning glyphicon glyphicon-pencil"
                                                    data-toggle="modal"
                                                    data-target="#modalEdicion"
                                                    onclick="agregaform('<?php echo $datos; ?>')">
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button class="btn btn-danger glyphicon glyphicon-remove"
                                                    onclick="preguntarSiNo('<?php echo $row['id_estrategia']; ?>')">
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" rowspan="2" style="background-color:#0c1a2c">
                                    <?php

                                    // Asumiendo que $pedidos_cadena contiene el string JSON con la información de los pedidos
                                    $pedidos_cadena = $row['pedido'];
                                    $pedidos = json_decode($pedidos_cadena);

                                    echo "<table>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th>Costo</th>";
                                    echo "<th>Cantidad de Tarjetas</th>";
                                    echo "<th>Duración del Servicio</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";

                                    foreach ($pedidos as $pedido) {
                                        echo "<tr>";

                                        // Columna para el Costo
                                        echo "<td>";
                                        switch ($pedido[0]) {
                                            case 1:
                                                echo "20.000";
                                                break;
                                            case 2:
                                                echo "50.000";
                                                break;
                                            case 3:
                                                echo "70.000";
                                                break;
                                            case 4:
                                                echo "100.000";
                                                break;
                                            case 5:
                                                echo "150.000";
                                                break;
                                            case 6:
                                                echo "200.000";
                                                break;
                                            case 7:
                                                echo "300.000";
                                                break;
                                        }
                                        echo "</td>";

                                        // Columna para la Cantidad de Tarjetas
                                        echo "<td>";
                                        if ($pedido[1] !== 0) {
                                            echo $pedido[1] . " tarjetas";
                                        }
                                        echo "</td>";

                                        // Columna para la Duración del Servicio
                                        echo "<td>";
                                        switch ($pedido[2]) {
                                            case 1:
                                                echo "1 mes";
                                                break;
                                            case 2:
                                                echo "2 meses";
                                                break;
                                            case 3:
                                                echo "3 meses";
                                                break;
                                            case 4:
                                                echo "4 meses";
                                                break;
                                        }
                                        echo "</td>";

                                        echo "</tr>";
                                    }

                                    echo "</tbody>";
                                    echo "</table>";
                                    ?>
                                </td>
                            </tr>

                            <tr style="margin-botton:50px;">
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item <?php echo ($currentPage == 1) ? 'disabled' : ''; ?>">
                        <a class="page-link first-last" href="?aliado=<?php echo $aliadoId; ?>&page=1">Primera</a>
                    </li>
                    <li class="page-item <?php echo ($currentPage == 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?aliado=<?php echo $aliadoId; ?>&page=<?php echo max(1, $currentPage - 1); ?>">Anterior</a>
                    </li>

                    <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                        <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                            <a class="page-link" href="?aliado=<?php echo $aliadoId; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?php echo ($currentPage == $totalPages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?aliado=<?php echo $aliadoId; ?>&page=<?php echo min($totalPages, $currentPage + 1); ?>">Siguiente</a>
                    </li>
                    <li class="page-item <?php echo ($currentPage == $totalPages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?aliado=<?php echo $aliadoId; ?>&page=<?php echo $totalPages; ?>">Última</a>
                    </li>
                </ul>
            </nav>
        </div>
        </body>

        </html>
<?php
    }
}
