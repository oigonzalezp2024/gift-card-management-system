<?php

class TarjetaMontosRepository{

    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    function getMontos()
    {
        $rows = [];
        $sql = 'SELECT * FROM tarjeta_montos';
        $result = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            $rows[] = $row;
        }
        return $rows;    
    }
}
