<?php
require __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set('America/Bogota');


use App\Controllers\HomeController;
use App\Controllers\EmployeeController;
use App\Controllers\SalesController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

session_start();

// Simple router (rutas mínimas)
if ($uri === '/' || $uri === '/index.php') {
    (new HomeController())->index();
} elseif ($uri === '/employees') {
    (new EmployeeController())->index();
} elseif ($uri === '/employees/create' && $method === 'GET') {
    (new EmployeeController())->create();
} elseif ($uri === '/employees/store' && $method === 'POST') {
    (new EmployeeController())->store();
} elseif ($uri === '/sales') {
    (new SalesController())->index();
} elseif ($uri === '/sales/create' && $method === 'GET') {
    (new SalesController())->create();
} elseif ($uri === '/sales/store' && $method === 'POST') {
    (new SalesController())->store();
} elseif ($uri === '/sales/export/pdf') {
    (new SalesController())->exportPdf();
} else {
    http_response_code(404);
    echo "404 Not Found";
}