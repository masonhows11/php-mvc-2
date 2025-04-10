<?php
// rewrite config
const APP_TITLE = 'mvc project';
// const BASE_URL = 'http://phpmvc.test';
const BASE_URL = 'http://localhost:8000';

define("BASE_DIR", realpath(__DIR__ . "/../"));


// get current route name
// $raw_uri = explode('?', $_SERVER['REQUEST_URI'][0]);

$temporary_url = str_replace(BASE_URL, '', explode('?', $_SERVER['REQUEST_URI'])[0]);

$temporary_url === "/" ? $temporary_url = "" : $temporary_url = substr($temporary_url, 1);

define("CURRENT_ROUTE",$temporary_url);


global $routes;

$routes = [
    'get' => [],
    'post' => [],
    'put' => [],
    'delete' => [],
];
