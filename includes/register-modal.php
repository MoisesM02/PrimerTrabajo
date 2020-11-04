<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Añadir usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="CrearUsuarios">
      <div class="modal-body">
        
            <div class="form-group">
                <label for="Username">Nombre de usuario</label>
                <input type="text" class="form-control" id="Username" placeholder = "Nombre de usuario">
            </div>
            <div class="form-group">
                <label for="Password">Contraseña</label>
                <input type="password" class="form-control" id="Password" placeholder = "Contraseña">
            </div>
            <div class="form-group">
                <label for="Password">Confirmar contraseña</label>
                <input type="password" class="form-control" id="Password2" placeholder = "Contraseña">
            </div>
            <div class="form-group">
                <select id="UserType" class="form-control">
                    <option value="Administración">Administración</option>
                    <option value="Empleado">Empleado</option>
                </select>
            </div>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger register-button" data-dismiss="modal">Cerrar</button>
        <button type="submit" id ="enviarDatos" class="btn btn-primary register-button">Crear usuario</button>
        
      </div>
      </form>
    </div>
  </div>
</div>