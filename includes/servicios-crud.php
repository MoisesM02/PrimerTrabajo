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
        <form id="crearActualizarServicios">
        <input type="hidden" id="idServicio" value="">
            <div class="form-group">
                <label for="nombreProducto">Nombre de servicio</label>
                <input type="text" class="form-control" id="nombreServicio" placeholder = "Nombre de servicio">
            </div>
            <div class="form-group">
                <label for="Codigo">Tipo de servicio</label>
                <input type="text" class="form-control" id="tipo" placeholder = "Tipo de servicio">
            </div>
            <div class="form-group">
                <label for="Codigo">Duración de servicio</label>
                <input type="text" class="form-control" id="duracion" placeholder = "Duración del servicio">
            </div>
            <div class="form-group">
                    <label for="precioEmpleado">Precio del servicio</label>
                    <input type="text" class="form-control porcentaje" id="precioServicio" placeholder = "Precio del servicio">
                    </div>
            <div class="form-group">
            <div class="form-group">
                    <label for="precioEmpleado">Porcentaje de empleado</label>
                    <input type="text" class="form-control porcentaje" id="porcentajeEmpleado" placeholder = "Porcentaje de empleado">
                    </div>
            <div class="form-group">
            <div class="form-group">
                    <label for="precioEmpleado">Porcentaje de la casa</label>
                    <input type="text" class="form-control porcentaje" id="porcentajeCasa" placeholder = "Porcentaje de casa">
                    </div>
           
            <div class="row">
            <div class="col-md-5">
                    <div class="form-group">
                    <label for="precioCliente">Ganancia de casa</label>
                    <input type="text" class="form-control" id="gananciaCasa" placeholder = "Ganancia Casa">
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="form-group">
                    <label for="precioEmpleado">Ganancia empleado</label>
                    <input type="text" class="form-control" id="gananciaEmpleado" placeholder = "Ganancia Empleado">
                    </div>
                </div>
            </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" id="cerrarModal" class="btn btn-danger register-button" data-dismiss="modal">Cerrar</button>
        <button type="button" id ="editarProducto" class="btn btn-secondary register-button">Editar producto</button>
        <button type="button" id ="crearProducto" class="btn btn-primary register-button">Crear producto</button>
      </form>
      </div>
      
    </div>
  </div>
</div>
