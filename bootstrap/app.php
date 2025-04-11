<?php
$params = [];

$params = !isset($_GET) ? $params : array_merge($params,$_GET);
$params = !isset($_POST) ? $params : array_merge($params,$_POST);
$_SESSION['old'] = $params;
unset($params);

// add helper
// require_once("../system/Helpers/helper.php");

// when app initialized below code must be executed
// and place on memory
require_once("../config/app.php");
require_once("../config/database.php");

global $routes;
$routes = [
    'get' => [],
    'post' => [],
    'put' => [],
    'delete' => [],
];

require_once("../routes/web.php");
require_once("../routes/api.php");


// run routing sys
$routing = new \System\Router\Routing();
$routing->run();