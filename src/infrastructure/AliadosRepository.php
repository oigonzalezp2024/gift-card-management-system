<?php

class AliadosRepository{

    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    function getAliados()
    {
        $rows = [];
        $sql = 'SELECT * FROM aliados 
        ORDER BY id_aliado DESC';
        $result = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            $rows[] = $row;
        }
        return $rows;    
    }
    
    function getAliadosPaginated(int $page, int $limit)
    {
        $rows = [];
        $offset = ($page - 1) * $limit;
        
        $sql = "SELECT * FROM aliados ORDER BY id_aliado DESC LIMIT $limit OFFSET $offset";
        
        $result = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            $rows[] = $row;
        }
        return $rows;
    }
    
    function getTotalCount()
    {
        $sql = "SELECT COUNT(*) as total FROM aliados";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
}
