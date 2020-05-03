<?php include_once URL_APP . "/views/custom/header.php";?>
<?php include_once URL_APP . "/views/custom/navbar.php";?>
<div class="container mt5pc mt-2 mb-3">
   <div class="row">
   <div class="col-md-3"></div>
        <div class="col-md-6">
             <div class="card ">
                  <div class="text-center card-header">
                    <h5>Editar mi perfil</h5>
                  </div>
                  <div class="card-body">
                    <?php showMessage("error-update-pass", "danger");?>
                    <?php showMessage("success-update-pass", "success");?>
                    <?php showMessage("success-update-data", "success");?>
                    <?php showMessage("error-update-data", "danger");?>
                          <form action="<?php echo URL_PROYECTO; ?>/perfil/updatePerfil" method="post">
                           <input type="hidden" name="idusuario" value="<?php echo $_SESSION['id']; ?>">

                           <div class="form-group">
                             <label for="formGroupExampleInput">Nombre completo</label>
                             <input type="text" name="nombre-completo" class="form-control" id="formGroupExampleInput"  value="<?php echo $datos["usuario"]->nombrecompleto ?>" required>
                           </div>
                           <div class="form-group">
                             <label for="formGroupExampleInput2">Usuario</label>
                             <input type="text" class="form-control" name="usuario" id="formGroupExampleInput2" value="<?php echo $datos["usuario"]->usuario ?>" required>
                           </div>
                           <div class="form-group">
                             <label for="formGroupExampleInput3">Correo</label>
                             <input type="email" class="form-control" name="correo" id="formGroupExampleInput3"  value="<?php echo $datos["usuario"]->correo ?>" required>
                           </div>
                           <div class="form-group">
                              <label for="inputState">Sexo</label>
                              <select id="inputState" name="sexo" class="form-control" required>
                                <option value="hombre" <?php echo ($datos["usuario"]->sexo == "hombre") ? "selected" : ""; ?>>Hombre</option>
                                <option value="mujer" <?php echo ($datos["usuario"]->sexo == "mujer") ? "selected" : ""; ?>>Mujer</option>
                              </select>
                            </div>
                            <div class="form-group">
                             <a href="" data-toggle="modal" data-target="#editar-contrasena" class="text-decoration-none text-info"><i> Cambiar contraseña </i></a>
                           </div>
                            <button class="btn btn-primary btn-block mb-4" type="submit">Actualizar Datos</button>
                         </form>
                  </div>
              </div>
         </div>
        <div class="col-md-3"></div>
   </div>
</div>
<!-- editar perfil -->
<!-- Modal -->
<div class="modal fade" id="editar-contrasena" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambia tu contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form id="post-update" method="post" action="<?php echo URL_PROYECTO ?>/perfil/updatePassword">
        <input type="hidden" name="idusuario" value="<?php echo $_SESSION["id"] ?>">
        <div class="form-group">
           <label for="formGroupExampleInput3">Tu Contraseña</label>
           <input type="password" class="form-control" name="clave-anterior" id="formGroupExampleInput3" placeholder="Tu contraseña de ahora" required>
         </div>
         <div class="form-group">
           <label for="formGroupExampleInput3">Tu nueva contraseña</label>
           <input type="password" class="form-control" name="clave-nueva" id="formGroupExampleInput3" placeholder="Tu nueva contraseña" required>
         </div>
         <div class="form-group">
           <label for="formGroupExampleInput3">Repitela</label>
           <input type="password" class="form-control" name="clave-nueva-repetida" id="formGroupExampleInput3" placeholder="Repite la contraseña" required>
         </div>
      </form>
      </div>
      <div class="modal-footer py-1">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" form="post-update" class="btn btn-primary">Cambiar contraseña</button>
      </div>
    </div>
  </div>
</div>
<?php include_once URL_APP . "/views/custom/footer.php";?>