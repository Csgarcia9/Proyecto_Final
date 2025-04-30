<form method="POST" action="<?= URL ?>/ProductosCrear/crearProducto">
  <div class="row g-3">
    <div class="col-md-6">
      <label for="productoID" class="form-label">ID del Producto</label>
      <input type="text" class="form-control" id="productoID" name="productoID" required placeholder = "TN001">
    </div>
    <div class="col-md-6">
      <label for="nombreProducto" class="form-label">Nombre del Producto</label>
      <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required placeholder = "Nike Air Max">
    </div>
    <div class="w-100"></div> <div class="col-md-6">
      <label for="productoDescripcion" class="form-label">Descripción del Producto</label>
      <textarea class="form-control" id="productoDescripcion" name="productoDescripcion" rows="3" required placeholder = "Describa el producto"></textarea>
    </div>
    <div class="col-md-6">
      <label for="precio" class="form-label">Precio</label>
      <input type="number" class="form-control" id="precio" name="precio" step="0.01" required placeholder = "9.99">
    </div>
    <div class="w-100"></div> <div class="col-md-6">
      <label for="Stock" class="form-label">Stock</label>
      <input type="number" class="form-control" id="Stock" name="Stock" required placeholder = "1 - 1000">
    </div>
    <div class="col-md-6">
      <label for="imageURL" class="form-label">URL de la Imagen</label>
      <input type="url" class="form-control" id="imageURL" name="imageURL" required placeholder = "https://ejemplo.com/imagen.jpg">
    </div>
    <div class="w-100"></div> <div class="col-md-6">
      <label for="fechaCreacion" class="form-label">Fecha de Creación</label>
      <input type="date" class="form-control" id="fechaCreacion" name="fechaCreacion">
    </div>
    <div class="col-md-6">
      </div>
  </div>
  <div class="mt-3"> <button type="submit" class="btn btn-primary">Guardar Producto</button>
  </div>
</form>