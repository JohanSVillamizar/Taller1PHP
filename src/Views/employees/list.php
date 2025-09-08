<h2>Empleados</h2>
<a class="btn btn-primary mb-3" href="/employees/create">Crear Empleado</a>

<?php if(empty($employees)): ?>
  <p>No hay empleados.</p>
<?php else: ?>
  <h4>Promedio por departamento</h4>
  <ul>
    <?php foreach($avg as $d => $v): ?>
      <li><?= htmlspecialchars($d) ?>: <?= number_format($v,2) ?></li>
    <?php endforeach; ?>
  </ul>

  <p><strong>Departamento con mayor promedio:</strong> <?= htmlspecialchars($maxDept) ?> (<?= number_format($maxAvg,2) ?>)</p>

  <h4>Empleados por encima del promedio de su departamento</h4>
  <table class="table table-sm">
  <thead>
    <tr><th>Imagen</th><th>Nombre</th><th>Salario</th><th>Departamento</th></tr>
  </thead>
  <tbody>
    <?php foreach($employees as $e): ?>
       <tr>
         <td>
           <?php if($e->image): ?>
             <img src="<?= $e->image ?>" width="50">
           <?php endif; ?>
         </td>
         <td><?=htmlspecialchars($e->name)?></td>
         <td>$<?=number_format($e->salary,2,',','.')?></td>
         <td><?=htmlspecialchars($e->department)?></td>
       </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<?php endif; ?>
