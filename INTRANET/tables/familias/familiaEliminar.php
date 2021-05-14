<?php
require_once "../../com/DAO.php";
require_once "../../com/varios.php";
$id = $_REQUEST["id"]; //Recojo el id del arbitro
$eliminacion = DAO::familiaEliminarPorID($id);//metodo de eliminacion del arbitro por id
