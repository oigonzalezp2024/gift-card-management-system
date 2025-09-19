<?php
require_once "../src/View/Forms/TarjetaForms.php";

if (
	isset($_GET["estrategia"]) &&
	$_GET["estrategia"] !== ""
) {
	$estrategia = $_GET["estrategia"];
} else {
	header("location: ../");
	die;
}

$AliadoInsertForm = new TarjetaForms();
$AliadoInsertForm->setData($estrategia);
$AliadoInsertForm->insertForm();
$AliadoInsertForm->updateForm();
$AliadoInsertForm->saleForm();
