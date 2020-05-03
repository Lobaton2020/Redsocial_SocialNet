<?php include_once URL_APP . "/views/custom/header.php";?>

<nav class="navbar pl-5 navbar-expand-lg navbar-light ">
  <a class="navbar-brand ml-5" href="#">Bienvenid@ a SocialNet</a>
</nav>
<div class="container p-md-5 pt-5 ">
   <div class="row">
        <div class="col-md-7 celular-d-none">
          <img class="" style="width:425px;height:425px" src="<?php echo URL_PROYECTO_STATIC ?>/img/imagenesCustom/icono_principal.png" alt="">
        </div>
        <div class="col-md-5">
             <div class="card ">
                  <div class="text-center card-header">
                    <h5>Iniciar Sesion</h5>
                  </div>
                  <div class="card-body">
                  <?php showMessage("successRegister", "success");?>
                  <?php showMessage("errorLogin", "danger");?>
                    <form action="<?php echo URL_PROYECTO; ?>/auth/login" method="post">
                       <div class="form-group">
                         <label for="exampleInputEmail1">Usuario</label>
                         <input type="text" class="form-control" value="<?php echo isset($_SESSION["usuarioe"]) ? $_SESSION["usuarioe"] : ""; ?>" name="usuario" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa tu Usuario">
                         <small id="emailHelp" class="form-text text-muted"></small>
                       </div>
                       <div class="form-group">
                         <label for="exampleInputPassword1">Contraseña</label>
                         <input type="password" class="form-control" name="contrasena" id="exampleInputPassword1" placeholder="Contraseña">
                       </div>
                       <div class="form-group ">
                         <!-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> -->
                         <!-- <label class="form-check-label" for="exampleCheck1">Check me out</label> -->
                         <a href="<?php echo URL_PROYECTO; ?>/auth/recuperarContrasena">Olvidate tu contraseña?</a>
                       </div>
                       <button type="submit" class="btn btn-primary mb-2 btn-block">Iniciar Sesion</button>
                        <div class="form-group text-center">
                           <a href="<?php echo URL_PROYECTO; ?>/auth/register" class="mb-n5 ">Registrarme</a>
                        </div>
                   </form>
             </div>
        </div>
        <!-- <div class="col-md-3"></div> -->
   </div>
</div>

<?php include_once URL_APP . "/views/custom/footer.php";?>