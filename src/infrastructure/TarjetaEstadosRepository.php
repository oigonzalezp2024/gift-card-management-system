<?php

class TarjetaEstadosRepository{

    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    function getTarjetaEstados()
    {
        $rows = [];
        $sql = 'SELECT * FROM tarjeta_estados';
        $result = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            $rows[] = $row;
        }
        return $rows;    
    }
}
