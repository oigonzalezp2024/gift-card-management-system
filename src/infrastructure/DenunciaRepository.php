<?php

class DenunciaRepository
{
    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Obtiene todas las denuncias sin paginación.
     */
    public function getDenuncias()
    {
        $rows = [];
        $sql = 'SELECT * FROM denuncia_tarjeta ORDER BY id_denuncia DESC;';
        $result = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Obtiene denuncias paginadas.
     * @param int $page La página actual, debe ser mayor que 0.
     * @param int $itemsPerPage El número de elementos por página.
     */
    public function getDenunciasPaginated(int $page, int $itemsPerPage)
    {
        if ($page <= 0) {
            $page = 1;
        }

        $offset = ($page - 1) * $itemsPerPage;
        $rows = [];
        // Utiliza LIMIT y OFFSET para paginar los resultados
        $sql = "SELECT * FROM denuncia_tarjeta 
                ORDER BY id_denuncia DESC 
                LIMIT $itemsPerPage OFFSET $offset;";
        $result = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Obtiene denuncias por código de tarjeta sin paginación.
     */
    public function getDenunciaByTarjetaCodigo(string $codigo)
    {
        $rows = [];
        // NOTA: Esta consulta es vulnerable a inyección SQL. ⚠️
        // Se recomienda usar sentencias preparadas en producción.
        $sql = "SELECT * FROM denuncia_tarjeta 
                WHERE tarjeta_codigo='{$codigo}' 
                ORDER BY id_denuncia DESC;";
        $result = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Obtiene denuncias paginadas por código de tarjeta.
     * @param string $codigo El código de la tarjeta a buscar.
     * @param int $page La página actual, debe ser mayor que 0.
     * @param int $itemsPerPage El número de elementos por página.
     */
    public function getDenunciaByTarjetaCodigoPaginated(string $codigo, int $page, int $itemsPerPage)
    {
        if ($page <= 0) {
            $page = 1;
        }
        
        $offset = ($page - 1) * $itemsPerPage;
        $rows = [];
        $sql = "SELECT * FROM denuncia_tarjeta 
                WHERE tarjeta_codigo='{$codigo}' 
                ORDER BY id_denuncia DESC 
                LIMIT $itemsPerPage OFFSET $offset;";
        $result = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    /**
     * Cuenta el número total de denuncias. Esencial para calcular la cantidad de páginas.
     */
    public function getTotalDenunciasCount()
    {
        $sql = 'SELECT COUNT(*) as total FROM denuncia_tarjeta;';
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total'];
    }

    /**
     * Cuenta el número total de denuncias por código de tarjeta.
     */
    public function getTotalDenunciasByCodigoCount(string $codigo)
    {
        $sql = "SELECT COUNT(*) as total FROM denuncia_tarjeta WHERE tarjeta_codigo='{$codigo}';";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total'];
    }
}
