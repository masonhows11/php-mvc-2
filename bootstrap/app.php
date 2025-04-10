<?php

ob_start();
session_start();

//// ready for save new data for first time
//// or on every request
if (isset($_SESSION['old'])) {
    unset($_SESSION['temporary_old']);
}
if (isset($_SESSION['old']))
{
    $_SESSION['temporary_old'] = $_SESSION['old'];
    unset($_SESSION['old']);
}


//// ready for save new data for first time
//// or on every request
if (isset($_SESSION['temporary_flash'])) {
    unset($_SESSION['temporary_flash']);
}
if (isset($_SESSION['flash']))
{
    $_SESSION['temporary_flash'] = $_SESSION['flash'];
    unset($_SESSION['flash']);
}



$params = [];

$params = !isset($_GET) ? $params : array_merge($params,$_GET);
$params = !isset($_POST) ? $params : array_merge($params,$_POST);
$_SESSION['old'] = $params;
unset($params);

// add helper
require_once("../system/Helpers/helper.php");

// when app initialized below code must be executed
// and place on memory
require_once("../config/app.php");
require_once("../config/database.php");

require_once("../routes/web.php");
require_once("../routes/api.php");


// run routing sys
$routing = new \System\Router\Routing();
$routing->run();