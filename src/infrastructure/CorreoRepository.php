<?php

class CorreoRepository{

    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    function getCorreoByTarjetaId($tarjeta)
    {
        $rows = [];
        $sql = "SELECT * FROM envio_correo_tar WHERE tarjeta_id={$tarjeta}";
        $result = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            $rows[] = $row;
        }
        return $rows;    
    }
}
