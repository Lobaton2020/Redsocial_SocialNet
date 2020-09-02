<div class="" id="<?php echo $publicacion->idpublicacion ?>"></div>
<div class="publicacion mb-2 ">
	<div class="row">
		<div class="col-md-12  ajuste-margin-left-right">
			<div class="float-left">
				<img src="<?php echo URL_PROYECTO_STATIC . "/" . $publicacion->fotoperfil; ?>" alt="imagen" class="img-form rounded-circle">
			</div>
			<div class="float-left">
				<div>
					<a href="<?php echo URL_PROYECTO . "/perfil/" . $publicacion->usuario ?>" class="ml-2"><b><?php echo $publicacion->nombrecompleto ?></b></a>
				</div>
				<div>
					<span class="m-n6 ml-2 text-muted small"><?php echo time_ago($publicacion->fechapublicacion); ?></span>
				</div>
			</div>
			<?php if ($publicacion->idusuario === $_SESSION["id"]) { ?>
				<div class="float-right margen-celular margen-pc">
					<a class="nav-link " id="actions_publication" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-ellipsis-h"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right " aria-labelledby="#actions_publication">
						<h6 class="dropdown-header">Opciones</h6>
						<textarea class="d-none" id="texto<?php echo $publicacion->idpublicacion ?>"><?php echo $publicacion->contenidopublicacion ?></textarea>
						<a class="dropdown-item small update-post" id="<?php echo $publicacion->idpublicacion ?>" href="#"><i class="fas fa-edit"></i> Editar </a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item small" href="<?php echo URL_PROYECTO; ?>/publicacion/eliminar/<?php echo $publicacion->idpublicacion . "/" . $datos["x"] . "/" . $datos["usuario"]->usuario ?>"><i class="fas fa-trash"></i> Eliminar</a>

					</div>
				</div>
			<?php } ?>
		</div>
		<?php if (empty($publicacion->contenidopublicacion)) {
			$var = "d-none";
		} else {
			$var = "";
		} ?>
		<div class="col-md-12 mt-2 ">
			<textarea class="form-control ver-publicacion <?php echo $var ?>" data-resizable="true" id="texto-publicacion<?php echo $i ?>" disabled> <?php echo $publicacion->contenidopublicacion ?></textarea>
		</div>
		<?php if (!empty($publicacion->fotopublicacion)) : ?>
			<div class="col-md-12 ">
				<img class="img-auto img-post d-none" src="<?php echo URL_PROYECTO_STATIC . "/" . $publicacion->fotopublicacion ?>" alt="">
				<div id="divimgpost<?php echo $o ?>" class="containera img-post-c mt-3" style="min-height:500px;width:100%;border-radius:4px;display:block;margin:auto">
					<img id="imgpost<?php echo $o ?>" class="crop imgpost<?php echo $o ?>" style="width:100%;height:100%" src="<?php echo URL_PROYECTO_STATIC . "/" . $publicacion->fotopublicacion ?>" />
				</div>
			</div>
		<?php endif; ?>
		<div class="col-md-12 mb-n3 text-center mt-2 ">
			<div class="row ">
				<div class="col-md-4 " style="width:30%"> <a href="<?php echo URL_PROYECTO ?>/publicacion/quienesgustan/<?php echo $publicacion->idpublicacion . "/" . $datos["x"] ?>"><span class="small text-muted"><?php echo $publicacion->num_likes > 1 ? $publicacion->num_likes . " likes" : $publicacion->num_likes . " like" ?></span></a></div>
				<div class="col-md-4 " style="width:30%"><span class="small text-muted"> <?php echo $publicacion->num_comentarios > 1 ? $publicacion->num_comentarios . " comentarios" : $publicacion->num_comentarios . " comentario" ?></span></div>
				<div class="col-md-4 " style="width:39%"><a href="<?php echo URL_PROYECTO ?>/publicacion/quienescomparten/<?php echo $publicacion->idpublicacion . "/" . $datos["x"] ?>"><span class="small text-muted"><?php echo $publicacion->num_compartido != 1 ? $publicacion->num_compartido . " veces compartido" : $publicacion->num_compartido . " vez compartido" ?></span></a></div>
			</div>
		</div>
		<hr>
		<div class="col-md-12 mt-1 text-center  ">
			<div class="row ">
				<div class="col-md-4 " style="width:33%">
					<a class="text-decoration-none " href="<?php echo URL_PROYECTO ?>/publicacion/megusta/<?php echo $publicacion->idpublicacion . "/" . $_SESSION["id"] . "/" . $publicacion->idusuario . "/" . $datos["x"] ?>">
						<?php
						$varlike = "text-dark";
						$varshare = "text-dark";

						foreach ($datos["likes"] as $likes) {
							if ($likes->idPublicacion == $publicacion->idpublicacion) {
								$varlike = 'text-danger';
							}
						}

						foreach ($datos["compartir"] as $compartir) {
							if ($compartir->idpublicacion == $publicacion->idpublicacion) {
								$varshare = 'text-primary';
							}
						}
						?>
						<i class="<?php echo $varlike; ?> fas fa-heart fontsize-accion "></i> Me gusta

					</a></div>
				<div class="col-md-4 " style="width:33%"><i class="fas fa-comment fontsize-accion"></i><a id="comentar<?php echo $i; ?>" class=" cm text-decoration-none" href="#"> Comentar</a></div>
				<div class="col-md-4 " style="width:33%"><i class="<?php echo $varshare; ?> fas fa-share fontsize-accion"></i> <a class="text-decoration-none " href="<?php echo URL_PROYECTO ?>/publicacion/compartir/<?php echo $publicacion->idpublicacion . "/" . $_SESSION["id"] . "/" . $publicacion->idusuario . "/" . $datos["x"] ?>"> Compartir</a></div>
			</div>
			<hr>
		</div>
		<div id="caja-comentario<?php echo $i; ?>" class=" col-md-12 px-5 mt-2 mb-3 " style="display:none">
			<form action="<?php echo URL_PROYECTO ?>/publicacion/comentar<?php echo "/" . $datos["x"] . "/" . $datos["usuario"]->usuario ?>" method="post" class="d-inline">
				<input type="hidden" name="id_userPropietario" value="<?php echo $publicacion->idusuario; ?>">
				<input type="hidden" name="id_user" value="<?php echo $datos["usuario"]->idusuario; ?>">
				<input type="hidden" name="id_publicacion" value="<?php echo $publicacion->idpublicacion; ?>">
				<img src="<?php echo URL_PROYECTO_STATIC . "/" . $datos["perfil"]->fotoPerfil; ?>" alt="..." class="img-form rounded-circle">
				<input class="comment ml-2" type="text" name="comentario" placeholder="Agregar un comentario..">
				<button type="submit" class="btn btn-primary round float-right"><i class="fas fa-paper-plane"></i></button>
			</form>
		</div>

		<?php foreach ($datos["comentarios"] as $comentario) : ?>
			<?php if ($comentario->idpublicacion == $publicacion->idpublicacion) { ?>
				<div class="col-md-12 pl-4 ajuste-margin-left-right ">
					<div class="float-left">
						<img style="width:34px;height:34px" src="<?php echo URL_PROYECTO_STATIC . "/" . $comentario->fotoperfil; ?>" alt="imagen" class="img-form rounded-circle">
					</div>
					<div class="float-left">
						<div>
							<a href="<?php echo URL_PROYECTO; ?>/perfil/<?php echo $comentario->usuario ?>" class="ml-2 text-decoration-none"><?php echo $comentario->usuario ?></a> <span class="m-n6 ml-2  small text-muted"><?php echo time_ago($comentario->fechacomentario); ?></span>
						</div>
					</div>
					<?php if ($comentario->iduser == $_SESSION["id"]) { ?>
						<div class="float-right margen-celular margen-pc">
							<a class="nav-link " id="actions_publication" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-ellipsis-v small"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right " aria-labelledby="#actions_publication">
								<h6 class="dropdown-header">Opcion</h6>
								<a class="dropdown-item small" href="<?php echo URL_PROYECTO; ?>/publicacion/eliminarComentario/<?php echo $comentario->idcomentario . "/" . $publicacion->idpublicacion . "/" . $datos["x"] . "/" . $datos["usuario"]->usuario ?>"><i class="fas fa-trash"></i> Eliminar</a>
								<!-- <a class="dropdown-item" href="#">Another action</a> -->
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="col-md-12 mt-n3 text-justify mb-3 ml-5 mr-5" style="word-wrap: break-word;">
					<span class="mr-2 ml-5 mr-5 small w-50 text-justify"><?php echo $comentario->contenidoComentario; ?></span>
				</div>
			<?php } ?>
		<?php endforeach; ?>
	</div>
</div>

<?php $i++; ?>