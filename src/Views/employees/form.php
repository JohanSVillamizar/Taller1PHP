<h2>Crear Empleado</h2>
<form method="POST" action="/employees/store" enctype="multipart/form-data">
  <div class="mb-3">
    <label class="form-label">Nombre</label>
    <input class="form-control" name="name" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Salario</label>
    <input class="form-control" name="salary" type="number" step="0.01" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Departamento</label>
    <input class="form-control" name="department" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Imagen</label>
    <input class="form-control" type="file" name="image">
  </div>
  <button class="btn btn-success">Guardar</button>
</form>
