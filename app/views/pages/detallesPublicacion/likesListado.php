<?php include_once URL_APP . "/views/custom/header.php";?>
<?php include_once URL_APP . "/views/custom/navbar.php";?>
<div class="container-fluid mt5pc mt-2 mb-3">
   <div class="row">
        <div class="col-md-3 text-right">
        <?php if (count($datos["usuarios"]) > 0): ?>
            <a class="btn btn-secondary btn-block mb-2" href="<?php echo URL_PROYECTO; ?>/publicacion/redirectTo/<?php echo $datos["x"] . "/" . $datos["usuarios"][0]->idpublicacion ?>">Regresar a la Publicacion</a>
              <?php else: ?>
            <a class="btn btn-secondary btn-block mb-2" href="<?php echo URL_PROYECTO; ?>/publicacion/redirectTo/<?php echo $datos["x"] . "/" . "0" ?>">Regresar a la Publicacion</a>
              <?php endif;?>
        </div>
        <div class="col-md-6">
             <div class="card ">
                  <div class="text-center card-header">
                    <?php if (count($datos["usuarios"]) > 0) {?>
                      <h5>Listado de usuarios que han dado Me gusta</h5>
                    <?php } else {?>
                     <h5>Esta publicacion no tiene Me gustas.</h5>
                    <?php }?>
                  </div>
                  <?php $i = 0;foreach ($datos["usuarios"] as $usuario): ?>
			            <div class="card-body">
			                <div class="card-title">
			                  <div class="float-left d-inline">
			                  <a class="text-decoration-none" href="<?php echo URL_PROYECTO; ?>/perfil/<?php echo $usuario->usuario; ?>">
			                  <img style="width:50px;height:50px" src="<?php echo URL_PROYECTO_STATIC . "/" . $usuario->fotoPerfil; ?>" alt="imagen" class=" rounded-circle">
			                      </a>
		            				<span class="bold-size">
                                        <?php if ($usuario->idUser == $_SESSION["id"]): ?>
                                         Tú
                                        <?php else: ?>
                                        <?php echo $usuario->nombrecompleto; ?>
                                        <?php endif;?>
                                    </span>
                                </div>
                                <span class="float-right ">
                                    <?php if ($usuario->idUser != $_SESSION["id"]): ?>
                                       <a class=" btn btn-primary" href="<?php echo URL_PROYECTO ?>/perfil/<?php echo $usuario->usuario; ?>">
                                           Ver Perfil
                                       </a>
                                    <?php else: ?>
                                       <a class=" btn btn-warning" href="<?php echo URL_PROYECTO ?>/perfil/<?php echo $usuario->usuario; ?>">
                                           Ver mi perfil
                                       </a>
                                    <?php endif;?>
                                   </span>
			         </div>
			 </div>
			 <?php echo (count($datos["usuarios"]) - 1 == $i) ? "" : "<hr>"; ?>
			 <?php $i++;?>
             <?php endforeach;?>

        </div>
        <div class="col-md-6"></div>
   </div>
</div>

<?php include_once URL_APP . "/views/custom/footer.php";?>