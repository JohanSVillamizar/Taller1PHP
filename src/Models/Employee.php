<?php
namespace App\Models;

class Employee {
    public $name;
    public $salary;
    public $department;
    public $image;

    public function __construct($name, $salary, $department, $image = null) {
        $this->name = $name;
        $this->salary = (float)$salary;
        $this->department = $department;
        $this->image = $image;
    }

public static function loadAll() {
    $file = __DIR__ . '/../../storage/employees.json';
    if (!file_exists($file)) return [];
    $content = file_get_contents($file);
    if (trim($content) === '') return []; // si está vacío
    $data = json_decode($content, true);
    if (!is_array($data)) return []; // si el json está dañado
    $list = [];
    foreach ($data as $item) {
        $list[] = new Employee(
            $item['name'],
            $item['salary'],
            $item['department'],
            $item['image'] ?? null
        );
    }
    return $list;
}

public static function saveAll(array $employees) {
        $file = __DIR__ . '/../../storage/employees.json';
        $arr = array_map(function($e){ 
            return [
              'name' => $e->name,
              'salary' => $e->salary,
              'department' => $e->department,
              'image' => $e->image
            ]; 
        }, $employees);
        file_put_contents($file, json_encode($arr, JSON_PRETTY_PRINT));
    }
}