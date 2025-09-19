<?php

class EstrategiaRepository
{
    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    // Métodos originales
    
    function getEstrategiaByAliadoId($aliado)
    {
        $rows = [];
        $sql = "SELECT
            est.*,
            ali.nombre as aliado_nombre,
            est_est.estado_est estrategia_estado,
            (SELECT COUNT(*) FROM tarjetas WHERE tarjetas.estrategia_id = est.id_estrategia ) as total_tarjetas,
            CASE
                WHEN COUNT(de.tarjeta_codigo) > 0 THEN 'SI'
                ELSE 'NO'
            END AS denuncia
            FROM
            estrategia AS est
            LEFT JOIN
            aliados AS ali ON est.aliado_id = ali.id_aliado
            LEFT JOIN
            estrategia_estados AS est_est ON est_est.id_estrategia_est = est.est_estado_id
            LEFT JOIN
            tarjetas AS tar ON tar.estrategia_id = est.id_estrategia
            LEFT JOIN
            denuncia_tarjeta AS de ON de.tarjeta_codigo = tar.codigo
            GROUP BY
            est.id_estrategia
            HAVING
            est.aliado_id = {$aliado}";
        $result = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    function getEstrategiasSinNovedadByAliadoId($aliado)
    {
        $rows = [];
        $sql = "SELECT
            est.*,
            CASE
                WHEN COUNT(de.tarjeta_codigo) > 0 THEN 'SI'
                ELSE 'NO'
            END AS denuncia
            FROM
            estrategia AS est
            LEFT JOIN
            tarjetas AS tar ON tar.estrategia_id = est.id_estrategia
            LEFT JOIN
            denuncia_tarjeta AS de ON de.tarjeta_codigo = tar.codigo
            GROUP BY
            est.id_estrategia
            HAVING
            est.aliado_id = {$aliado}";
        $result = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            if($row['denuncia'] == 'NO'){
                $rows[] = $row;
            }
        }
        return $rows;
    }

    function getEstrategiaConDenunciasByAliadoId($aliado)
    {
        $rows = [];
        $sql = "SELECT
            est.*,
            CASE
                WHEN COUNT(de.tarjeta_codigo) > 0 THEN 'SI'
                ELSE 'NO'
            END AS denuncia
            FROM
            estrategia AS est
            LEFT JOIN
            tarjetas AS tar ON tar.estrategia_id = est.id_estrategia
            LEFT JOIN
            denuncia_tarjeta AS de ON de.tarjeta_codigo = tar.codigo
            GROUP BY
            est.id_estrategia
            HAVING
            est.aliado_id = {$aliado}";
        $result = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            if($row['denuncia'] == 'SI'){
                $rows[] = $row;
            }
        }
        return $rows;
    }

    // Nuevos métodos para paginación

    /**
     * Obtiene estrategias paginadas por ID de aliado.
     * @param int $aliado El ID del aliado.
     * @param int $page El número de página (empieza en 1).
     * @param int $limit El número de resultados por página.
     * @return array Los resultados paginados.
     */
    public function getEstrategiaPaginadaByAliadoId($aliado, $page, $limit)
    {
        $allResults = $this->getEstrategiaByAliadoId($aliado);
        return $this->paginateArray($allResults, $page, $limit);
    }
    
    /**
     * Obtiene estrategias sin novedad paginadas por ID de aliado.
     * @param int $aliado El ID del aliado.
     * @param int $page El número de página (empieza en 1).
     * @param int $limit El número de resultados por página.
     * @return array Los resultados paginados.
     */
    public function getEstrategiasSinNovedadPaginadaByAliadoId($aliado, $page, $limit)
    {
        $allResults = $this->getEstrategiasSinNovedadByAliadoId($aliado);
        return $this->paginateArray($allResults, $page, $limit);
    }

    /**
     * Obtiene estrategias con denuncias paginadas por ID de aliado.
     * @param int $aliado El ID del aliado.
     * @param int $page El número de página (empieza en 1).
     * @param int $limit El número de resultados por página.
     * @return array Los resultados paginados.
     */
    public function getEstrategiaConDenunciasPaginadaByAliadoId($aliado, $page, $limit)
    {
        $allResults = $this->getEstrategiaConDenunciasByAliadoId($aliado);
        return $this->paginateArray($allResults, $page, $limit);
    }

    /**
     * Helper para paginar un array.
     * @param array $array El array a paginar.
     * @param int $page El número de página (empieza en 1).
     * @param int $limit El número de resultados por página.
     * @return array El subconjunto paginado del array.
     */
    private function paginateArray(array $array, $page, $limit)
    {
        $offset = ($page - 1) * $limit;
        return array_slice($array, $offset, $limit);
    }
}
