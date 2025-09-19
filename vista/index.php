<?php
session_start();
if(
    isset($_SESSION['logueo']) &&
    $_SESSION['logueo'] == "mnbvnmguyfntrvn"
){
header('location: ./aliados.php');
}else{
header('location: ../');
}
