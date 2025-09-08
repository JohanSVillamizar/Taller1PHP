<h2>Crear Venta</h2>
<form method="POST" action="/sales/store">
  <div class="mb-3">
    <label class="form-label">Cliente</label>
    <input class="form-control" name="client" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Producto</label>
    <input class="form-control" name="product" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Cantidad</label>
    <input class="form-control" name="quantity" type="number" value="1" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Precio unitario</label>
    <input class="form-control" name="unit_price" type="number" step="0.01" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Fecha</label>
    <input class="form-control" name="date" type="date" value="<?=date('Y-m-d')?>" required>
  </div>
  <button class="btn btn-success">Guardar</button>
</form>