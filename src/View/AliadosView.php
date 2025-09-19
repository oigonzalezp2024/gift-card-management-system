<?php

class AliadosView
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    function view()
    {
        // Extract data from the array
        $aliados = $this->data['aliados'];
        $page = $this->data['page'];
        $limit = $this->data['limit'];
        $total_pages = $this->data['total_pages'];

        // Logic for pagination range (5 pages)
        $limit_links = 5;
        $start_page = max(1, $page - floor($limit_links / 2));
        $end_page = min($total_pages, $start_page + $limit_links - 1);

        // Adjust start page if we are at the end
        if ($end_page - $start_page < $limit_links - 1) {
            $start_page = max(1, $end_page - $limit_links + 1);
        }

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Aliados</title>
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
            <div style="margin-top: 100px;">
                <center>
                    <h2>Aliados</h2>
                </center>
            </div>
            <div class="table-responsive">
                <button class="btn btn-primary navbar-left"
                        data-toggle="modal"
                        data-target="#modalNuevo">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>nombre</th>
                            <th>nit</th>
                            <th>email</th>
                            <th>celular</th>
                            <th>estrategia</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($aliados as $row) {
                            $datos = $row['id_aliado'] . "||" .
                                     $row['nombre'] . "||" .
                                     $row['nit'] . "||" .
                                     $row['email'] . "||" .
                                     $row['celular'];
                        ?>
                            <tr>
                                <td><?php echo $row['id_aliado']; ?></td>
                                <td><?php echo $row['nombre']; ?></td>
                                <td><?php echo $row['nit']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['celular']; ?></td>
                                <td>
                                    <a href="./estrategia.php?aliado=<?php echo $row['id_aliado'] ?>" class="btn" style="
                                        background-color: #000000; color: #ffffff
                                    ">estrategias</a>
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
                                            onclick="preguntarSiNo('<?php echo $row['id_aliado']; ?>')">
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=1">Primera</a>
                        </li>
                        <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo max(1, $page - 1); ?>">Anterior</a>
                        </li>
                        
                        <?php for ($i = $start_page; $i <= $end_page; $i++) { ?>
                            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php } ?>

                        <li class="page-item <?php echo ($page == $total_pages) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo min($total_pages, $page + 1); ?>">Siguiente</a>
                        </li>
                        <li class="page-item <?php echo ($page == $total_pages) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $total_pages; ?>">Última</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </body>

        </html>
    <?php
    }
}