<form method="POST" action="<?= URL ?>/ProductosEditar/editarProducto">
  <div class="row g-3">
    <div class="col-md-6">
      <label for="editarProductoID" class="form-label">ID del Producto</label>
      <input type="text" class="form-control" id="editarProductoID" name="productoID" required placeholder="TN001" required>
      <small class="text-muted">Este ID no se puede modificar.</small>
    </div>
    <div class="col-md-6">
      <label for="editarNombreProducto" class="form-label">Nombre del Producto</label>
      <input type="text" class="form-control" id="editarNombreProducto" name="nombreProducto" placeholder="Nike Air Max">
    </div>
    <div class="w-100"></div>
    <div class="col-md-6">
      <label for="editarProductoDescripcion" class="form-label">Descripción del Producto</label>
      <textarea class="form-control" id="editarProductoDescripcion" name="productoDescripcion" rows="3" placeholder="Describa el producto"></textarea>
    </div>
    <div class="col-md-6">
      <label for="editarPrecio" class="form-label">Precio</label>
      <input type="number" class="form-control" id="editarPrecio" name="precio" step="0.01" placeholder="9.99">
    </div>
    <div class="w-100"></div>
    <div class="col-md-6">
      <label for="editarStock" class="form-label">Stock</label>
      <input type="number" class="form-control" id="editarStock" name="Stock"placeholder="1 - 1000">
    </div>
    <div class="col-md-6">
      <label for="editarImageURL" class="form-label">URL de la Imagen</label>
      <input type="url" class="form-control" id="editarImageURL" name="imageURL" placeholder="https://ejemplo.com/imagen.jpg">
    </div>
    <div class="w-100"></div>
    <div class="col-md-6">
      <label for="fechaEdicion" class="form-label">Fecha de Edicion</label>
      <input type="date" class="form-control" id="fechaEdicion" name="fechaedicion">
    </div>
    <div class="col-md-6">
    </div>
  </div>
  <div class="mt-3">
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
  </div>
</form>