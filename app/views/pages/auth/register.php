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
                    <h3>Registrarse</h3>
                  </div>
                  <div class="card-body">
                    <?php showMessage("errorRegister", "danger");?>
                    <form action="<?php echo URL_PROYECTO; ?>/auth/register" method="post">
                       <div class="form-group">
                         <input type="email" class="form-control" value="<?php echo isset($_SESSION["usuarioe"]) ? $_SESSION["usuarioe"] : ""; ?>"  name="email" placeholder="Email" required>
                       </div>
                       <div class="form-group">
                         <input type="text" class="form-control" value="<?php echo isset($_SESSION["nombree"]) ? $_SESSION["nombree"] : ""; ?>" name="usuario" placeholder="Usuario" required>
                       </div>
                       <div class="form-group">
                           <div class="custom-control custom-radio custom-control-inline">
                             <input type="radio" id="customRadioInline1" <?php echo isset($_SESSION["sexoe"]) ? ($_SESSION["sexoe"] == "hombre") ? "checked" : "" : ""; ?> name="sexo" value="hombre" class="custom-control-input">
                             <label class="custom-control-label" for="customRadioInline1">Hombre</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="customRadioInline2" <?php echo isset($_SESSION["sexoe"]) ? ($_SESSION["sexoe"] == "mujer") ? "checked" : "" : ""; ?> name="sexo" value="mujer" class="custom-control-input">
                              <label class="custom-control-label"  for="customRadioInline2">Mujer</label>
                            </div>
                        </div>
                        <div class="form-group">
                         <input type="password" class="form-control" name="pass"  placeholder="Tu contraseña" minlength=5 required>
                       </div>

                       <button type="submit" class="btn btn-primary mb-2 btn-block">Registrarme</button>
                        <div class="form-group text-center">
                           <a href="<?php echo URL_PROYECTO; ?>/auth/login" class="mb-n5 ">Iniciar sesion</a>
                        </div>
                   </form>
             </div>
        </div>
   </div>
</div>

<?php include_once URL_APP . "/views/custom/footer.php";?>