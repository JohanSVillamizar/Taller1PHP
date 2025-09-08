# 🖥️ Taller PHP - Aplicación Web MVC

![PHP](https://img.shields.io/badge/PHP-8.0-blue?logo=php) 
![Composer](https://img.shields.io/badge/Composer-OK-lightgrey?logo=composer) 
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple?logo=bootstrap) 
![License](https://img.shields.io/badge/License-Educativa-green)

Una aplicación web desarrollada en **PHP** siguiendo el patrón **MVC**, con **autoloading PSR-4 mediante Composer**, que permite gestionar empleados, ventas y realizar operaciones matemáticas, integrando librerías externas y utilizando **Bootstrap** para un diseño moderno.

---

## 📌 Descripción

Esta aplicación individual permite:

- Gestionar empleados y ventas mediante formularios HTML.
- Realizar cálculos matemáticos y operaciones sobre los datos.
- Integrar librerías externas recomendadas por Packagist.
- Ofrecer una interfaz moderna usando Bootstrap.

---

## ⚙️ Funcionalidades Principales

### Gestión de Empleados y Ventas
- Registro y edición de empleados y ventas.
- Visualización de listas con información relevante.

### Analítica y Cálculos
- Cálculo de **salarios promedio por departamento**.
- Identificación de empleados con **salario superior al promedio**.
- Analítica de ventas:
  - Total de ventas.
  - Cliente que más ha gastado.
  - Producto más vendido.

### Funciones Matemáticas
- Cálculo de **interés compuesto**.
- **Conversión de unidades**.
- Cálculo de **salario neto** después de deducciones legales colombianas.

### Integración con Librerías Externas
- `dompdf/dompdf` → generación de PDFs.
- `intervention/image` → manipulación de imágenes.
- `amenadiel/jpgraph` → gráficos y visualizaciones.

---

## 🚀 Instalación

1. **Clonar el repositorio**
https://github.com/JohanSVillamizar/Taller1PHP.git

---

## 🚀 Instalación y Configuración

### 1️⃣ Instalar dependencias con Composer

composer install
composer dump-autoload
composer require amenadiel/jpgraph

🖱️ Uso

- Ingresa y procesa datos de empleados y ventas desde los formularios HTML.
- Visualiza reportes y resultados en la interfaz.
- Genera gráficos y PDFs usando las funcionalidades integradas.

🛠️ Requisitos

- PHP ≥ 8
- Composer instalado
- Servidor web local (PHP built-in server o XAMPP/WAMP)
