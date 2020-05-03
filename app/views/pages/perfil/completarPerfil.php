<?php include_once URL_APP . "/views/custom/header.php";?>

<div class="container p-md-5 pt-5">
   <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
             <div class="card ">
                  <div class="text-center card-header">
                    <h3>Completa tu perfil</h3>
                  </div>
                  <div class="card-body">
                      <div class="card-title">
                        <h5 class="float-left">Antes de continuar completa tu perfil</h5>
                        <span class="float-right"><a class="text-decoration-none" href="<?php echo URL_PROYECTO ?>/home/logout">Cerrar sesion</a></span>
                      </div>
                    <form action="<?php echo URL_PROYECTO; ?>/home/insertarRegistroPerfil" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
                       <div class="form-group">
                         <input type="text" class="form-control" name="nombrecompleto"  placeholder="Tu nombre completo" required>
                       </div>
                       <div class="input-group mb-3">
                        <div class="custom-file">
                          <input type="file" id="profileFile" name="imagen" class="custom-file-input" id="inputGroupFile02" required>
                          <label class="custom-file-label" id="file">Choose file</label>
                        </div>
                      </div>
                       <button type="submit" class="btn btn-primary mb-2 btn-block">Completar Perfil</button>
                   </form>
             </div>
        </div>
        <div class="col-md-2"></div>
   </div>
</div>

<?php include_once URL_APP . "/views/custom/footer.php";?>