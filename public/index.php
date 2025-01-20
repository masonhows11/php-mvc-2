<?php

// dir(__DIR__) its root path
// then vendor /dir then /autoload.php file
// var_dump('hi');
require_once (dirname(__DIR__)."/vendor/autoload.php");

require_once ("../bootstrap/app.php");


// echo "<br/><br/>current_route: " .CURRENT_ROUTE ."<br/><br/>";