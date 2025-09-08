<?php
namespace App\Controllers;

class HomeController {
    public function index(){
        $title = 'Inicio';
        ob_start();
        include __DIR__ . '/../Views/home.php';
        $content = ob_get_clean();
        include __DIR__ . '/../Views/layout.php';
    }
}