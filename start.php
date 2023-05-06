<?php

define("HOST", "localhost");
define("DB_NAME","ikdmeu67_ldl_pet");
define("DB_USER","root");
define("DB_PASS", "root");

define('PL_BASE', 'http://'.$_SERVER['HTTP_HOST']);
define('PROJECT', '');
define('PL_PATH_ADMIN', PL_BASE.PROJECT);

include 'database.php';
$bd = new Banco();
session_start();

// $pdo = $bd->conectar();