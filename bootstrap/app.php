<?php

function dd($var)
{
    echo "<pre/>";
    print_r($var);
    exit();

}



// when app initialized below code must be executed
// and place on memory
require_once('../config/app.php');
require_once('../config/database.php');

require_once ('../routes/web.php');
require_once ('../routes/api.php');


$categories = \App\Models\Category::all();
dd($categories);

// run routing sys
$routing = new \System\Router\Routing();
$routing->run();