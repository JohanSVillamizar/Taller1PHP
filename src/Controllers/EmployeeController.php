<?php
namespace App\Controllers;

use App\Models\Employee;
use App\Models\Calculator;
use Intervention\Image\ImageManagerStatic as Image;


class EmployeeController {
    public function index(){
        $employees = Employee::loadAll();

        //Cálculos
        //promedio por departamento
        $dep = [];
        foreach ($employees as $e) {
            if (!isset($dep[$e->department])) {
                $dep[$e->department] = ['sum'=>0,'count'=>0];
            }
            $dep[$e->department]['sum'] += $e->salary;
            $dep[$e->department]['count'] += 1;
        }
        $avg = [];
        foreach ($dep as $d => $v) {
            $avg[$d] = $v['count'] ? $v['sum'] / $v['count'] : 0;
        }

        //departamento con mayor promedio
        $maxDept = null;
        $maxAvg = -INF;
        foreach ($avg as $d => $av) {
            if ($av > $maxAvg) { $maxAvg = $av; $maxDept = $d; }
        }

        //empleados que ganan por encima del promedio de su depto
        $above = [];
        foreach ($employees as $e) {
            if (isset($avg[$e->department]) && $e->salary > $avg[$e->department]) $above[] = $e;
        }

        $title = 'Empleados';
        ob_start();
        include __DIR__ . '/../Views/employees/list.php';
        $content = ob_get_clean();
        include __DIR__ . '/../Views/layout.php';
    }

    public function create(){
        $title = 'Crear Empleado';
        ob_start();
        include __DIR__ . '/../Views/employees/form.php';
        $content = ob_get_clean();
        include __DIR__ . '/../Views/layout.php';
    }

    public function store(){
    $name = $_POST['name'] ?? '';
    $salary = $_POST['salary'] ?? 0;
    $department = $_POST['department'] ?? '';

    $imagePath = null;
    if (!empty($_FILES['image']['tmp_name'])) {
        $dir = __DIR__ . '/../../public/uploads/employees/';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $filename = uniqid() . '.jpg';
        $imagePath = '/uploads/employees/' . $filename;   // 👈 Ruta pública
        $img = \Intervention\Image\ImageManagerStatic::make($_FILES['image']['tmp_name'])
            ->resize(200, 200);
        $img->save($dir . $filename);
    }

    $employees = \App\Models\Employee::loadAll();
    // 👇 aquí pasamos $imagePath al constructor
    $employee = new \App\Models\Employee($name, $salary, $department, $imagePath);
    $employees[] = $employee;
    \App\Models\Employee::saveAll($employees);

    header('Location: /employees');
    exit;
}


}