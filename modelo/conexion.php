<?php
function conexion(){
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'giftcards';
    $conn = mysqli_connect($host, $user, $password, $database);
    return $conn;
}
