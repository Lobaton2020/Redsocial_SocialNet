<?php include_once URL_APP . "/views/custom/header.php";?>
<?php include_once URL_APP . "/views/custom/navbar.php";?>


<div class="container mt5pc mt-2 mb-3">
   <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
             <div class="card ">
                  <div class="text-center card-header">
                    <?php if (count($datos) > 0) {?>
                      <h4>Usuarios encontrados</h4>
                    <?php } else {?>
                     <h4>No se encontraron usuarios</h4>
                    <?php }?>
                  </div>
                  <?php $i = 1;foreach ($datos["usuario"] as $busqueda): ?>
				  <?php if ($busqueda->idusuario != $_SESSION["id"]) {?>
							      <div class="card-body">
							          <div class="card-title">
							            <div class="float-left d-inline">
							            <a class="text-decoration-none" href="<?php echo URL_PROYECTO; ?>/perfil/<?php echo $busqueda->usuario; ?>">
							            <img style="width:50px;height:50px" src="<?php echo URL_PROYECTO_STATIC . "/" . $busqueda->fotoPerfil; ?>" alt="imagen" class=" rounded-circle">
							                </a>
							                  <span class="d-">
							                    <span class="bold-size"><?php echo $busqueda->nombrecompleto; ?></span>
							                    &bull;
							                    <span>
							                     <a class="text-decoration-none" href="<?php echo URL_PROYECTO; ?>/perfil/<?php echo $busqueda->usuario; ?>"><?php echo $busqueda->usuario; ?></a>
							                    </span>
							                  </span>
							  </div>
				              <?php $class = "d-inline";?>
							  <?php foreach ($datos["seguidores"] as $seguidor): ?>
								<?php if ($seguidor->id_seguido == $_SESSION["id"] && $seguidor->id_seguir == $busqueda->idusuario) {?>
									<?php $class = "d-none";?>
									<?php if ($seguidor->estado_aprobado == 1) {?>
										      <span class="float-right alert-dejar-seguir"><a class=" btn btn-success" href="<?php echo URL_PROYECTO ?>/perfil/cancelarSolicitud/<?php echo $seguidor->idsigue; ?>/searchuser">Siguiendo</a></span>
										      <span  class="float-right small text-muted mr-4 text-bottom"><?php echo time_ago($seguidor->fecha_sigue) ?></span>
				                             <?php } else {?>
				                                <span class="float-right"><a class="btn btn-secondary" href="<?php echo URL_PROYECTO ?>/perfil/cancelarSolicitud/<?php echo $seguidor->idsigue; ?>/searchuser">Esperando..</a></span>
							  					<span  class="float-right small text-muted mr-4 text-bottom"><?php echo time_ago($seguidor->fecha_sigue) ?></span>
											  <?php }?>
							                 <?php } else {?>
				                      <?php }?>
				                      <?php endforeach?>
									  <span class="float-right <?php echo $class; ?>"><a class="text-decoration-none btn btn-primary" href="<?php echo URL_PROYECTO ?>/perfil/seguirUsuario/<?php echo $busqueda->idusuario; ?>">Seguir</a></span>

                      </div>
             </div>
			 <?php echo (count($datos["usuario"]) - 1 == $i) ? "" : "<hr>"; ?>
            <?php $i++;}?>
             <?php endforeach;?>

        </div>
        <div class="col-md-1"></div>
   </div>
</div>

<?php include_once URL_APP . "/views/custom/footer.php";?>