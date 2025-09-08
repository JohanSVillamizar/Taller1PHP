<?php
namespace App\Controllers;

use App\Models\Sale;
use Dompdf\Dompdf;
use Intervention\Image\ImageManagerStatic as Image;

class SalesController {
    public function index(){
        $sales = Sale::loadAll();

        //total de ventas (cantidad de ventas)
        $totalSales = count($sales);

        //cliente que ha gastado más
        $byClient = [];
        foreach ($sales as $s) {
            $byClient[$s->client] = ($byClient[$s->client] ?? 0) + $s->total();
        }
        arsort($byClient);
        $topClient = key($byClient);
        $topClientAmount = reset($byClient);

        //producto más vendido (por cantidad)
        $byProduct = [];
        foreach ($sales as $s) {
            $byProduct[$s->product] = ($byProduct[$s->product] ?? 0) + $s->quantity;
        }
        arsort($byProduct);
        $topProduct = key($byProduct);
        $topProductQty = reset($byProduct);

        $title = 'Ventas';
        ob_start();
        include __DIR__ . '/../Views/sales/list.php';
        $content = ob_get_clean();
        include __DIR__ . '/../Views/layout.php';
    }

    public function create(){
        $title = 'Crear Venta';
        ob_start();
        include __DIR__ . '/../Views/sales/form.php';
        $content = ob_get_clean();
        include __DIR__ . '/../Views/layout.php';
    }

    public function store(){
        $id = uniqid();
        $client = $_POST['client'] ?? '';
        $product = $_POST['product'] ?? '';
        $quantity = $_POST['quantity'] ?? 1;
        $unit_price = $_POST['unit_price'] ?? 0;
        $date = $_POST['date'] ?? date('Y-m-d');

        $sales = Sale::loadAll();
        $sales[] = new Sale($id, $client, $product, $quantity, $unit_price, $date);
        Sale::saveAll($sales);

        header('Location: /sales');
        exit;
    }
public function exportPdf(){
    $sales = \App\Models\Sale::loadAll();

    // Cargar CSS externo
    $css = file_get_contents(__DIR__ . '/../../public/assets/css/pdf.css');

    // Convertir icono a base64 para evitar error "Image not found"
    $iconPath = __DIR__ . '/../../public/assets/images/chart.png';
    $iconBase64 = '';
    if (file_exists($iconPath)) {
        $iconBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($iconPath));
    }

    // Calcular productos más vendidos
    $counts = [];
    foreach ($sales as $s) {
        $counts[$s->product] = ($counts[$s->product] ?? 0) + $s->quantity;
    }

    // Ruta donde se guardará el gráfico
    $graphPath = __DIR__.'/../../public/uploads/graphs/products.png';
    if (!is_dir(dirname($graphPath))) {
        mkdir(dirname($graphPath), 0777, true);
    }
    if (file_exists($graphPath)) {
        unlink($graphPath);
    }

    // Generar gráfico con JpGraph
    \App\Helpers\GraphHelper::topProductsChart($counts, $graphPath);

    // Convertir imagen a base64 para meterla en el PDF
    $graphBase64 = base64_encode(file_get_contents($graphPath));

    // === Ventas semanales del mes actual ===
    $now = new \DateTime();
    $currentMonth = $now->format('m');
    $currentYear = $now->format('Y');

    // Encontrar la última fecha de venta en el mes actual
    $maxDay = 0;
    foreach ($sales as $s) {
        $saleDate = new \DateTime($s->date);
        if ($saleDate->format('m') == $currentMonth && $saleDate->format('Y') == $currentYear) {
            $day = (int)$saleDate->format('d');
            if ($day > $maxDay) {
                $maxDay = $day;
            }
        }
    }

    if ($maxDay === 0) {
        $weekRanges = [];
    } else {
        $lastDay = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
        $weekRanges = [];

        for ($start = 1; $start <= $maxDay; $start += 7) {
            $end = min($start + 6, $lastDay, $maxDay);
            $label = $start.'-'.$end;
            $weekRanges[$label] = 0;
        }

        foreach ($sales as $s) {
            $saleDate = new \DateTime($s->date);
            if ($saleDate->format('m') == $currentMonth && $saleDate->format('Y') == $currentYear) {
                $day = (int)$saleDate->format('d');
                foreach ($weekRanges as $label => $_) {
                    list($start, $end) = explode('-', $label);
                    if ($day >= (int)$start && $day <= (int)$end) {
                        $weekRanges[$label]++;
                        break;
                    }
                }
            }
        }
    }

    // Generar gráfico semanal
    $weeklyGraphPath = __DIR__.'/../../public/uploads/graphs/weekly.png';
    if (!is_dir(dirname($weeklyGraphPath))) {
        mkdir(dirname($weeklyGraphPath), 0777, true);
    }
    if (file_exists($weeklyGraphPath)) {
        unlink($weeklyGraphPath);
    }

    \App\Helpers\GraphHelper::weeklySalesChart($weekRanges, $weeklyGraphPath);

    // Convertir a base64
    $weeklyGraphBase64 = base64_encode(file_get_contents($weeklyGraphPath));

    // Construir HTML
    $html = '
    <html>
    <head>
      <style>'.$css.'</style>
    </head>
    <body>
      <h1>
        '.($iconBase64 ? '<img src="'.$iconBase64.'" width="40" style="vertical-align:middle;margin-right:10px;">' : '').'
        Informe de Ventas
      </h1>
      <table>
        <tr>
          <th>Fecha</th><th>Cliente</th><th>Producto</th><th>Cant</th>
          <th>Precio</th><th>Total</th>
        </tr>';
    foreach ($sales as $s) {
        $html .= "<tr>
            <td>{$s->date}</td>
            <td>{$s->client}</td>
            <td>{$s->product}</td>
            <td>{$s->quantity}</td>
            <td>$".number_format($s->unit_price,0,',','.')."</td>
            <td>$".number_format($s->total(),0,',','.')."</td>
        </tr>";
    }

    $html .= '</table>';

    $html .= '<h3>Productos más vendidos</h3>';
    $html .= '<div class="graph-container">
            <img src="data:image/png;base64,'.$graphBase64.'" width="500">
          </div>';

    $html .= '<h3>Ventas por Semana (Mes Actual)</h3>';
    $html .= '<div class="graph-container">
            <img src="data:image/png;base64,'.$weeklyGraphBase64.'" width="500">
          </div>';

    $html .= '
    <footer>
        Generado el '.date('d/m/Y').'
    </footer>
    </body></html>';

    // Configurar Dompdf con soporte para imágenes remotas/base64
    $options = new \Dompdf\Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new \Dompdf\Dompdf($options);

    $dompdf->loadHtml($html);
    $dompdf->setPaper('legal','portrait');
    $dompdf->render();

    // Mostrar PDF en el navegador
    $dompdf->stream("ventas.pdf", ["Attachment" => 0]);
}

}