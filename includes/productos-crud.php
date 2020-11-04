<div class="modal fade" id="formulario" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Añadir o editar producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form id="crearActualizarProductos">
        <input type="hidden" id="idProducto" value="">
            <div class="form-group">
                <label for="nombreProducto">Nombre de producto</label>
                <input type="text" class="form-control" id="nombreProducto" placeholder = "Nombre de producto">
            </div>
            <div class="form-group">
                <label for="Codigo">Código de producto</label>
                <input type="text" class="form-control" id="Codigo" placeholder = "Código de producto">
            </div>
            <div class="form-group">
                    <label for="precioEmpleado">Categoría</label>
                    <input type="text" class="form-control" id="categoriaProducto" placeholder = "Categoría del producto">
                    </div>
            <div class="form-group">
                    <label for="precioEmpleado">Precio de compra por unidad</label>
                    <input type="text" class="form-control" id="precioCompra" placeholder = "Precio de compra">
                    </div>
            <div class="row">
            <div class="col-md-5">
                    <div class="form-group">
                    <label for="precioCliente">Precio cliente</label>
                    <input type="text" class="form-control" id="precioCliente" placeholder = "Precio cliente">
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-5">
                    <div class="form-group">
                    <label for="precioEmpleado">Precio empleado</label>
                    <input type="text" class="form-control" id="precioEmpleado" placeholder = "Precio empleado">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="stock">En inventario: </label>
                <span id="stock"></span>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger register-button" data-dismiss="modal">Cerrar</button>
        <button type="button" id ="editarProducto" class="btn btn-secondary register-button">Editar producto</button>
        <button type="button" id ="crearProducto" class="btn btn-primary register-button">Crear producto</button>
      </form>
      </div>
      
    </div>
  </div>
</div>
