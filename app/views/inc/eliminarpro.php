
<p>¿Estás seguro de que deseas eliminar el producto con el siguiente ID?</p>
<form method="POST" action="<?= URL ?>/ProductosEliminar/eliminarProducto">
    <div class="mb-3">
        <label for="productoEliminarID" class="form-label">ID del Producto a Eliminar</label>
         <input type="text" class="form-control" id="productoEliminarID" name="productoEliminarID" placeholder="TN001" required>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </div>                  
</form>