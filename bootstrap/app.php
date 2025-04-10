<?php

ob_start();
session_start();
// add helper
require_once ("../system/Helpers/helper.php");

// when app initialized below code must be executed
// and place on memory
require_once("../config/app.php");
require_once("../config/database.php");

require_once ("../routes/web.php");
require_once ("../routes/api.php");


// run routing sys
$routing = new \System\Router\Routing();
$routing->run();