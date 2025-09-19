<?php

class TarjetaRepository
{

    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    /**
     * @param int $estrategia El ID de la estrategia.
     * @return array
     */
    public function getTarjetaByEstrategiaId($estrategia)
    {
        $rows = [];
        $sql = "SELECT
            tar.*,
            ali.nombre aliado_nombre,
            est.estrategia estrategia,
            mon.monto tarjeta_monto,
            esta.estado tarjeta_estado,
            CASE
            WHEN de.tarjeta_codigo IS NOT NULL THEN 'SI'
            ELSE NULL
            END AS denuncia
            FROM
            `tarjetas` tar
            LEFT JOIN
            estrategia est ON est.id_estrategia = tar.estrategia_id
            LEFT JOIN
            aliados ali ON ali.id_aliado = est.aliado_id
            LEFT JOIN
            tarjeta_montos mon ON mon.id_monto = tar.monto_id
            LEFT JOIN
            tarjeta_estados esta ON esta.id_estado = tar.tar_estado_id
            LEFT JOIN
            denuncia_tarjeta de ON de.tarjeta_codigo = tar.codigo
            WHERE estrategia_id={$estrategia}
        ";
        $result = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * @param int $estrategia El ID de la estrategia.
     * @return array
     */
    public function getTarjetasDenunciadas($estrategia)
    {
        $rows = [];
        $sql = "SELECT
            tar.*,
            CASE
            WHEN de.tarjeta_codigo IS NOT NULL THEN 'SI'
            ELSE NULL
            END AS denuncia
            FROM
            `tarjetas` tar
            LEFT JOIN
            denuncia_tarjeta de ON de.tarjeta_codigo = tar.codigo
            WHERE estrategia_id={$estrategia} AND de.tarjeta_codigo IS NOT NULL";
        $result = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * @param int $estrategia El ID de la estrategia.
     * @return array
     */
    public function getTarjetasHabilitadas($estrategia)
    {
        $rows = [];
        $sql = "SELECT
            tar.*,
            CASE
            WHEN de.tarjeta_codigo IS NOT NULL THEN 'SI'
            ELSE NULL
            END AS denuncia
            FROM
            `tarjetas` tar
            LEFT JOIN
            denuncia_tarjeta de ON de.tarjeta_codigo = tar.codigo
            WHERE estrategia_id={$estrategia} AND de.tarjeta_codigo IS NULL";
        $result = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    // --- Métodos de paginación ---

    /**
     * Obtiene un conjunto de tarjetas para la paginación.
     *
     * @param int $estrategia El ID de la estrategia.
     * @param int $pagina La página actual (ej. 1, 2, 3).
     * @param int $itemsPorPagina El número de elementos por página.
     * @param bool|null $filtrarDenunciadas true para denunciadas, false para habilitadas, null para todas.
     * @return array
     */
    public function getTarjetasPaginadas($estrategia, $pagina, $itemsPorPagina, $filtrarDenunciadas = null)
    {
        $rows = [];
        // Calcular el desplazamiento (OFFSET)
        $offset = ($pagina - 1) * $itemsPorPagina;

        $sql = "SELECT
            tar.*,
            ali.nombre aliado_nombre,
            est.estrategia estrategia,
            mon.monto tarjeta_monto,
            esta.estado tarjeta_estado,
            CASE
            WHEN de.tarjeta_codigo IS NOT NULL THEN 'SI'
            ELSE NULL
            END AS denuncia
            FROM
            `tarjetas` tar
            LEFT JOIN
            estrategia est ON est.id_estrategia = tar.estrategia_id
            LEFT JOIN
            aliados ali ON ali.id_aliado = est.aliado_id
            LEFT JOIN
            tarjeta_montos mon ON mon.id_monto = tar.monto_id
            LEFT JOIN
            tarjeta_estados esta ON esta.id_estado = tar.tar_estado_id
            LEFT JOIN
            denuncia_tarjeta de ON de.tarjeta_codigo = tar.codigo
            WHERE estrategia_id={$estrategia}
        ";

        // Añadir el filtro de denuncias si se especifica
        if ($filtrarDenunciadas === true) {
            $sql .= " AND de.tarjeta_codigo IS NOT NULL";
        } elseif ($filtrarDenunciadas === false) {
            $sql .= " AND de.tarjeta_codigo IS NULL";
        }
        
        // Agregar LIMIT y OFFSET para la paginación
        $sql .= " LIMIT {$itemsPorPagina} OFFSET {$offset}";

        $result = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Obtiene el conteo total de tarjetas para una estrategia, con o sin filtro.
     *
     * @param int $estrategia El ID de la estrategia.
     * @param bool|null $filtrarDenunciadas true para denunciadas, false para habilitadas, null para todas.
     * @return int
     */
    public function getCountTarjetasByEstrategiaId($estrategia, $filtrarDenunciadas = null)
    {
        $sql = "SELECT COUNT(*) AS total
            FROM
            `tarjetas` tar
            LEFT JOIN
            denuncia_tarjeta de ON de.tarjeta_codigo = tar.codigo
            WHERE estrategia_id={$estrategia}
        ";

        // Añadir el filtro de denuncias si se especifica
        if ($filtrarDenunciadas === true) {
            $sql .= " AND de.tarjeta_codigo IS NOT NULL";
        } elseif ($filtrarDenunciadas === false) {
            $sql .= " AND de.tarjeta_codigo IS NULL";
        }

        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
}
