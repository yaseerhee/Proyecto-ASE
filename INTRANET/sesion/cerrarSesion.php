<?php

require_once "../com/DAO.php";
require_once "../com/varios.php";

//ESTE PHP SIRVE PARA CERRAR LA SESIÓN INICIADA. 
//LE LLAMAMOS DESDE LOS LIK QUE HAY EN CADA PHP.

DAO::CerrarSesion();

redireccionar("../");
