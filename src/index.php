<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json;charset=utf-8');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_name("sistema-clase4");
session_start();

error_reporting(E_ERROR | E_PARSE );

date_default_timezone_set('America/Bogota');
setlocale(LC_ALL, "esm", "es_CO.utf8");

require_once './controllers/index.php';

// Recibir por GET
$action = $_GET['action'];
$res = new ApiController();
$res->$action();
