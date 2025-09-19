<?php

class DenunciaTarjetaCodigoView
{
    private $rows;
    private $denuncia;
    private $totalPages;
    private $currentPage;
    private $itemsPerPage;
    private $totalItems;
    private $currentUrl;

    public function __construct(DenunciaRepository $denuncia, int $itemsPerPage = 10, int $page = 1)
    {
        $this->denuncia = $denuncia;
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPage = $page;
        $this->currentUrl = strtok($_SERVER["REQUEST_URI"], '?');

        $this->rows = $this->denuncia->getDenunciasPaginated($this->currentPage, $this->itemsPerPage);
        $this->totalItems = $this->denuncia->getTotalDenunciasCount();
        $this->totalPages = ceil($this->totalItems / $this->itemsPerPage);
    }

    public function setTarjetaCodigo(string $codigo, int $page = 1): void
    {
        $this->currentPage = $page;
        $this->rows = $this->denuncia->getDenunciaByTarjetaCodigoPaginated($codigo, $this->currentPage, $this->itemsPerPage);
        $this->totalItems = $this->denuncia->getTotalDenunciasByCodigoCount($codigo);
        $this->totalPages = ceil($this->totalItems / $this->itemsPerPage);

        $this->currentUrl = $this->currentUrl . '?codigo=' . urlencode($codigo);
    }

    public function view()
    {
        $rows = $this->rows;
        $totalPages = $this->totalPages;
        $currentPage = $this->currentPage;
        $baseUrl = $this->currentUrl;
        $visiblePages = 5;

        $startPage = max(1, $currentPage - floor($visiblePages / 2));
        $endPage = min($totalPages, $startPage + $visiblePages - 1);

        if ($endPage - $startPage + 1 < $visiblePages) {
            $startPage = max(1, $endPage - $visiblePages + 1);
        }
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
                    <h2>denuncia_tarjeta</h2>
                </center>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <button class="btn btn-primary navbar-left"
                        data-toggle="modal"
                        data-target="#modalNuevo">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>id</th>
                            <th>nombre</th>
                            <th>cedula</th>
                            <th>tarjeta_codigo</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (empty($rows)) {
                            echo '<tr><td colspan="8" style="text-align: center;">No hay denuncias para mostrar.</td></tr>';
                        } else {
                            foreach ($rows as $row) {
                                $datos = $row['id_denuncia'] . "||" .
                                    $row['nombre'] . "||" .
                                    $row['cedula'] . "||" .
                                    $row['tarjeta_codigo'];
                        ?>
                                <tr>
                                    <td>
                                        <button class="btn btn-warning glyphicon glyphicon-pencil"
                                            data-toggle="modal"
                                            data-target="#modalEdicion"
                                            onclick="agregaform('<?php echo htmlspecialchars($datos); ?>')">
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger glyphicon glyphicon-remove"
                                            onclick="preguntarSiNo('<?php echo htmlspecialchars($row['id_denuncia']); ?>')">
                                        </button>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['id_denuncia']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($row['cedula']); ?></td>
                                    <td><?php echo htmlspecialchars($row['tarjeta_codigo']); ?></td>
                                    <td>
                                        <button class="btn btn-warning glyphicon glyphicon-pencil"
                                            data-toggle="modal"
                                            data-target="#modalEdicion"
                                            onclick="agregaform('<?php echo htmlspecialchars($datos); ?>')">
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger glyphicon glyphicon-remove"
                                            onclick="preguntarSiNo('<?php echo htmlspecialchars($row['id_denuncia']); ?>')">
                                        </button>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item <?php echo ($currentPage <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=1">Primera</a>
                    </li>
                    <li class="page-item <?php echo ($currentPage <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>">Anterior</a>
                    </li>

                    <?php for ($i = $startPage; $i <= $endPage; $i++) { ?>
                        <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php } ?>

                    <li class="page-item <?php echo ($currentPage >= $totalPages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">Siguiente</a>
                    </li>
                    <li class="page-item <?php echo ($currentPage >= $totalPages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $totalPages; ?>">Última</a>
                    </li>
                </ul>
            </nav>

        </body>

        </html>
<?php
    }
}
