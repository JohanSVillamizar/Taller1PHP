<h2>Ventas</h2>
<a class="btn btn-primary mb-3" href="/sales/create">Crear Venta</a>
<a class="btn btn-secondary mb-3" href="/sales/export/pdf" target="_blank">Exportar PDF</a>

<p>Total ventas (registros): <strong><?= $totalSales ?></strong></p>

<p>Cliente que más gastó: <strong><?= htmlspecialchars($topClient) ?></strong> (<?= number_format($topClientAmount,2) ?>)</p>

<p>Producto más vendido: <strong><?= htmlspecialchars($topProduct) ?></strong> (<?= $topProductQty ?> unidades)</p>

<table class="table table-sm">
<thead><tr><th>ID</th><th>Cliente</th><th>Producto</th><th>Cant</th><th>Precio</th><th>Total</th><th>Fecha</th></tr></thead>
<tbody>
<?php foreach($sales as $s): ?>
  <tr>
    <td><?=htmlspecialchars($s->id)?></td>
    <td><?=htmlspecialchars($s->client)?></td>
    <td><?=htmlspecialchars($s->product)?></td>
    <td><?= $s->quantity ?></td>
    <td><?= number_format($s->unit_price,2) ?></td>
    <td><?= number_format($s->total(),2) ?></td>
    <td><?= htmlspecialchars($s->date) ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>