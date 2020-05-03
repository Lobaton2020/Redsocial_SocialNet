<?php if ($busqueda->idusuario != $_SESSION["id"]) {?>
    <?php $seguidor = $busqueda;?>
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
							  <?php if (!isset($datos["seguidosEspera"])) {?>
						    	  <span class="float-right ml-1">
							     	  <a class=" btn btn-danger confirm-delete-seguidor" href="<?php echo URL_PROYECTO ?>/perfil/cancelarSolicitud/<?php echo $seguidor->idsigue . "/" . $datos["tipo_redireccion"] ?>">
							    	  <i class="fas fa-ban"></i>
								  </a></span>
								<?php }?>
                              <?php $class = "d-inline";?>
                              <?php if (isset($datos["seguidorSaber"])): ?>
                              <?php foreach ($datos["seguidorSaber"] as $seguidorsaber): ?>
								     <?php if ($seguidorsaber->id_seguido == $_SESSION["id"] && $seguidorsaber->id_seguir == $busqueda->idusuario) {?>
								     	<?php $class = "d-none";?>
								     	<?php if ($seguidorsaber->estado_aprobado == 1) {?>
								     		      <span class="float-right"><a class=" btn btn-success alert-dejar-seguir" href="<?php echo URL_PROYECTO ?>/perfil/cancelarSolicitud/<?php echo $seguidorsaber->idsigue . "/" . $datos["tipo_redireccion"] ?>">Siguiendo</a></span>
								     		      <span  class="float-right small text-muted mr-4 text-bottom"><?php echo time_ago($seguidorsaber->fecha_sigue) ?></span>
				                                  <?php } else {?>
				                                     <span class="float-right"><a class="btn btn-secondary" href="<?php echo URL_PROYECTO ?>/perfil/cancelarSolicitud/<?php echo $seguidorsaber->idsigue . "/" . $datos["tipo_redireccion"] ?>">Esperando..</a></span>
							  	     				<span  class="float-right small text-muted mr-4 text-bottom"><?php echo time_ago($seguidorsaber->fecha_sigue) ?></span>
								     			  <?php }?>
							                      <?php } else {?>
				                           <?php }?>
                                  <?php endforeach;?>
                                   <?php else: ?>
                                                <?php if ($seguidor->id_seguido == $_SESSION["id"] && $seguidor->id_seguir == $busqueda->idusuario) {?>
									               <?php $class = "d-none";?>
									               <?php if ($seguidor->estado_aprobado == 1) {?>
									               	      <span class="float-right"><a class=" btn btn-success alert-dejar-seguir" href="<?php echo URL_PROYECTO ?>/perfil/cancelarSolicitud/<?php echo $seguidor->idsigue . "/" . $datos["tipo_redireccion"] ?>">Siguiendo</a></span>
									               	      <span  class="float-right small text-muted mr-4 text-bottom"><?php echo time_ago($seguidor->fecha_sigue) ?></span>
				                                            <?php } else {?>
				                                               <span class="float-right"><a class="btn btn-secondary" href="<?php echo URL_PROYECTO ?>/perfil/cancelarSolicitud/<?php echo $seguidor->idsigue . "/" . $datos["tipo_redireccion"] ?>">Esperando..</a></span>
							  		               			<span  class="float-right small text-muted mr-4 text-bottom"><?php echo time_ago($seguidor->fecha_sigue) ?></span>
									               		  <?php }?>
							                                <?php } else {?>
				                                     <?php }?>
                                             <?php endif;?>

									  <span class="float-right <?php echo $class; ?>"><a class="text-decoration-none btn btn-primary" href="<?php echo URL_PROYECTO ?>/perfil/seguirUsuario/<?php echo $busqueda->idusuario . "/" . $datos["tipo_redireccion"] ?>">Seguir</a></span>

                      </div>
             </div>
			 <hr>
            <?php $i++;}?>
