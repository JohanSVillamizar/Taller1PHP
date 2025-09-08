<?php
namespace App\Helpers;

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

class GraphHelper {
    public static function topProductsChart($data, $filePath) {
        $products = array_keys($data);
        $values = array_values($data);

        $graph = new Graph\Graph(600,400);
        $graph->SetScale('textlin');

        $graph->xaxis->SetTickLabels($products);

        $barplot = new Plot\BarPlot($values);
        $barplot->SetFillColor('orange');
        $barplot->value->Show();

        $graph->Add($barplot);

        $graph->Stroke($filePath); // Guarda como PNG
    }

    public static function weeklySalesChart($data, $filePath) {
    $weeks = array_keys($data);
    $values = array_values($data);

    $graph = new Graph\Graph(600,400);
    $graph->SetScale('textlin');

    // Estilo fondo
    $graph->SetMarginColor('white');
    $graph->SetFrame(false);
    $graph->SetBox(false);

    // Ejes
    $graph->xaxis->SetTickLabels($weeks);
    $graph->xaxis->SetFont(FF_ARIAL, FS_NORMAL, 10);
    $graph->xaxis->SetColor('black');
    $graph->xaxis->SetLabelAngle(0);

    $graph->yaxis->SetFont(FF_ARIAL, FS_NORMAL, 10);
    $graph->yaxis->SetColor('black');
    $graph->ygrid->SetColor('lightgray');

    // Línea
    $lineplot = new Plot\LinePlot($values);
    $lineplot->SetColor('navy');
    $lineplot->SetWeight(3);

    // Puntos
    $lineplot->mark->SetType(MARK_FILLEDCIRCLE);
    $lineplot->mark->SetColor('white');
    $lineplot->mark->SetFillColor('orange');
    $lineplot->mark->SetSize(8);

    // Mostrar valores encima de los puntos
    $lineplot->value->Show();
    $lineplot->value->SetFormat('%d');
    $lineplot->value->SetColor('black');
    $lineplot->value->SetFont(FF_ARIAL, FS_BOLD, 10);

// Alinear un poco hacia la derecha
$lineplot->value->SetAlign('left','bottom'); //texto se dibuja a la izquierda/derecha del punto

// Subir el texto
$lineplot->value->SetMargin(10, -5); // 15 px arriba

    $graph->Add($lineplot);

    $graph->Stroke($filePath);
}

}
