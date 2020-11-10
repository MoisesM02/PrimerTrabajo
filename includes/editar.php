<div class="modal fade" id="formularioEditar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                <label for="nombreProducto" id="Nombre2"></label>
                <select class="form-control" id="selectNombre"></select>
            </div>
            <div class="form-group">
                <label for="estadoActual">Estado actual</label>
               <span id="estadoActual"></span>
            </div>
            <div class="form-group">
                <label for="selectEstado">Estado</label>
                <select class="form-control" id="selectEstado"></select>
            </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger register-button" data-dismiss="modal">Cerrar</button>
        <button type="button" id ="editar" class="btn btn-primary register-button">Aceptar</button>
        <button type="button" id ="eliminar" class="btn btn-danger register-button">Eliminar</button>
      </form>
      </div>
      
    </div>
  </div>
</div>
