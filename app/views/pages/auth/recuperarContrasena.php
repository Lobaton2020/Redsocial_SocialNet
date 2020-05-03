<?php include_once URL_APP . "/views/custom/header.php";?>

<nav class="navbar pl-5 navbar-expand-lg navbar-light ">
  <a class="navbar-brand ml-5" href="#">Bienvenid@ a SocialNet</a>
</nav>
<div class="container p-md-5 pt-5">
   <div class="row">
   <div class="col-md-7 celular-d-none">
          <img class="" style="width:425px;height:425px" src="<?php echo URL_PROYECTO_STATIC ?>/img/imagenesCustom/icono_principal.png" alt="">
        </div>
        <div class="col-md-5">
             <div class="card ">
                  <div class="text-center card-header">
                    <h3>Recuperar Contraseña</h3>
                  </div>
                  <div class="card-body">
                  <?php showMessage("success-email", "success");?>
                  <?php showMessage("error-email", "danger");?>
                    <form action="<?php echo URL_PROYECTO; ?>/auth/recuperarContrasena" method="post">
                       <div class="form-group">
                         <label for="exampleInputEmail1">Email</label>
                         <input type="email" class="form-control" name="correo" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa tu email">
                         <small id="emailHelp" class="form-text text-muted"></small>
                       </div>

                       <button type="submit" class="btn btn-primary mb-2 btn-block">Recuperar Contraseña</button>
                        <div class="form-group text-center">
                           <a href="<?php echo URL_PROYECTO; ?>/auth/login" class="mb-n5 ">Iniciar Sesion</a>
                        </div>
                   </form>
             </div>
        </div>
   </div>
</div>


<?php include_once URL_APP . "/views/custom/footer.php";?>