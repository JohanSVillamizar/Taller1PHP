Taller PHP 
Aplicación web PHP con patrón MVC, autoloading por Composer, operaciones matemáticas, gestión de empleados y ventas, uso de librerías externas y diseño con Bootstrap.
Descripción
Este proyecto es una aplicación PHP desarrollada individualmente que implementa el patrón de diseño MVC y autoloading PSR-4 mediante Composer. Permite:
•	Gestionar empleados y ventas vía formularios.
•	Realizar cálculos matemáticos y operaciones sobre los datos.
•	Integrar y utilizar librerías externas recomendadas por Packagist.
•	Ofrecer una interfaz con diseño moderno usando Bootstrap.
Funcionalidades Principales
•	Cálculo de salarios promedio por departamento y empleados con salario superior al promedio.
•	Analítica de ventas: total de ventas, cliente que más ha gastado, producto más vendido.
•	Dos métodos matemáticos: interés compuesto, conversión de unidades, cálculo de salario neto después de deducciones legales colombianas.
•	Captura y procesamiento de datos del usuario (formularios HTML).
•	Uso de Composer para autoload y gestión de librerías.
•	Integración de librerías externas dompdf/dompdf, intervention/image.
•	Estructura modular y fácil de escalar con MVC.
Estructura del Proyecto
/mi-app/
│  composer.json
│  public/
│    index.php
│    assets/ (css/js/images)
│  src/
│    Controllers/
│       HomeController.php
│       EmployeeController.php
│       SalesController.php
│    Helpers/
│       GraphHelper.php
│    Models/
│       Employee.php
│       Sale.php
│       Calculator.php
│    Views/
│       layout.php
│       home.php
│       employees/
│         list.php
│         form.php
│       sales/
│         list.php
│         form.php
│  storage/
│    employees.json
│    sales.json
│  vendor/ # Librerías externas (autogeneradas por Composer)
│  .gitignore           # Exclusión de archivos innecesarios en git
└── composer.json        # Configuración de dependencias y autoload

Instalación
1.	Clonar el repositorio:
https://github.com/JohanSVillamizar/Taller1PHP.git
2.	Instalar dependencias con Composer:
composer install
composer dump-autoload
composer require amenadiel/jpgraph
3.	Ejecutar el servidor local:
php -S localhost:8000 -t public

Uso
•	Accede a la aplicación en http://localhost:8000
•	Ingresa y procesa datos de empleados/ventas desde formularios HTML.
•	Visualiza reportes calculados y resultados en la interfaz.
Requisitos mínimos
•	PHP = 8
•	Composer instalado
•	Servidor web local
