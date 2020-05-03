<?php include_once URL_APP . "/views/custom/header.php";?>
<?php include_once URL_APP . "/views/custom/navbar.php";?>
<div class="container-fluid mt5pc mt-2 mb-3">
   <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
             <div class="card ">
                  <div class="text-center card-header">
                    <?php if (count($datos["solicitudes"]) > 0) {?>
                      <h5>Listado de solicitudes</h5>
                    <?php } else {?>
                     <h5>No se encontraron solicitudes</h5>
                    <?php }?>
                  </div>
                  <?php $i = 0;foreach ($datos["solicitudes"] as $solicitud): ?>
									      <div class="card-body">
									          <div class="card-title">
									            <div class="float-left d-inline">
									            <a class="text-decoration-none" href="<?php echo URL_PROYECTO; ?>/perfil/<?php echo $solicitud->usuario; ?>">
									            <img style="width:50px;height:50px" src="<?php echo URL_PROYECTO_STATIC . "/" . $solicitud->fotoPerfil; ?>" alt="imagen" class=" rounded-circle">
									                </a>
									                  <span class="">
														<span class="bold-size"><?php echo $solicitud->nombrecompleto; ?></span>
														&bull;
							                            <span>
							                             <a class="text-decoration-none" href="<?php echo URL_PROYECTO; ?>/perfil/<?php echo $solicitud->usuario; ?>"><?php echo $solicitud->usuario; ?></a>
							                            </span>
									                    <span>
														</span>

													  </span>

													</div>
													<span class="float-right ml-2">
														<a class=" btn btn-secondary" href="<?php echo URL_PROYECTO ?>/perfil/cancelarSolicitud/<?php echo $solicitud->idsigue; ?>">
														Cancelar
													</a>
												</span>
												<span class="float-right ">
													<a class="e btn btn-primary" href="<?php echo URL_PROYECTO ?>/perfil/aceptarSolicitud/<?php echo $solicitud->idsigue; ?>">
													Aceptar
												</a>
											</span>
											<span  class="float-right small text-muted mr-4 text-bottom"><?php echo time_ago($solicitud->fecha_sigue) ?></span>
                      </div>
			 </div>
			 <?php echo (count($datos["solicitudes"]) - 1 == $i) ? "" : "<hr>"; ?>
			 <?php $i++;?>
             <?php endforeach;?>

        </div>
        <div class="col-md-6"></div>
   </div>
</div>

<?php include_once URL_APP . "/views/custom/footer.php";?>