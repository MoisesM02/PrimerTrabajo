<div class="modal fade" id="formulario" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Añadir registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form id="addToRegisterBook">
        <input type="hidden" id="idServicio" value="">
            <div class="form-group">
                <label for="nombreProducto">Empleada</label>
                <select class="form-control Empleadas" id="nombreEmpleada">
                </select>
            </div>
            <label>Fecha Y hora</label>
            <div id="dateRange" class="my-3" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
            <i class="fa fa-calendar"></i>&nbsp;
            <span></span> <i class="fa fa-caret-down"></i>
            </div>
            <div class="form-group">
                <label for="Codigo">Servicio Prestado</label>
                <select class="form-control" id="servicioPrestado" >
                </select>
            </div>
            <div class="form-group">
                <label for="Codigo">Limpieza</label>
                <input type="text" class="form-control" id="descuentos" value="5" placeholder="Descuentos" readonly>
            </div>
            <div class="form-group">
                <label for="Codigo">Habitación</label>
                <div class="row">
                <div class="col-md-8">
                <select class="form-control" id="habitacion" >
                </select>
                </div>
                <div class="col-md-4">
                <input type="checkbox" class="mt-3" id="habitacionesDisponibles"> <span>Disponibles</span>
                </div>
                </div>
            </div>
            <div class="form-group">
                <label for="Codigo">Duración de servicio</label>
                <input type="text" class="form-control" id="duracion">
            </div>
            <div class="form-group">
                    <label for="precioEmpleado">Tipo de servicio</label>
                    <input type="text" class="form-control porcentaje" id="tipoServicio">
            </div>
        
            <div class="form-group">
                    <label for="precioEmpleado">Precio del servicio</label>
                    <input type="text" class="form-control porcentaje" id="precioServicio" >
            </div>
            
            
            <div class="row">
            <div class="col-md-5">
                    <div class="form-group">
                    <label for="precioCliente">Ganancia de casa</label>
                    <input type="text" class="form-control" id="gananciaCasa" >
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="form-group">
                    <label for="precioEmpleado">Ganancia empleado</label>
                    <input type="text" class="form-control" id="gananciaEmpleado">
                    </div>
                </div>
            </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" id="cerrarModal" class="btn btn-danger register-button" data-dismiss="modal">Cerrar</button>
        <!-- <button type="button" id ="editarProducto" class="btn btn-secondary register-button">Editar producto</button> -->
        <button type="button" id ="addService" class="btn btn-primary register-button">Añadir al registro</button>
      </form>
      </div>
      
    </div>
  </div>
</div>
