
<?php
require_once "../../com/DAO.php";
require_once "../../com/varios.php";

$id = $_REQUEST["id"];
$numero = $_REQUEST["numero"];
$direccion = $_REQUEST["direccion"];
$representante = $_REQUEST["representante"];

$fam = DAO::FamiliaGuardar($id, $numero, $direccion, $representante); //Metodo de guardar los arbitros
?>