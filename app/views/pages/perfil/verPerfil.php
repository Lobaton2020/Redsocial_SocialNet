<?php include_once URL_APP . "/views/custom/header.php";?>
<?php include_once URL_APP . "/views/custom/navbar.php";?>

<div class="container  mt5pc mt-2 ">
  <div class="containera mt-2 text-center" style="height:250px;width:100%;border-radius:12px">
      <img class="crop"  src="<?php echo URL_PROYECTO_STATIC . "/" . $datos["perfil"]->fotoPortada ?>" />
      <label id="img-portada-label" for="img-portada" class="btn btn-secondary disabled "  style="position:absolute;top:0;right:0;opacity:0.9"><i class="fas fa-camera"></i> Escojer foto</label>
      <label id="img-portada-label2" for="envio-formulario" class="btn btn-success"  style="display:none;position:absolute;top:0;right:0;opacity:0.9"><i class="fas fa-camera"></i> Editar Imagen</label>
      <label class="centrar-elemento" for="cambiarImagenPerfil" style="position:absolute;left:-50%;right:-50%;top:34%;opacity:1.0" href="<?php echo URL_PROYECTO ?>/perfil/<?php echo $datos["usuario"]->usuario ?>"><img src="<?php echo URL_PROYECTO_STATIC . "/" . $datos["perfil"]->fotoPerfil; ?>" alt="imagen" class="mostrar-perfil-img rounded-circle pc-d-none"></label>
      <a class="text-center text-decoration-none text-dark pc-d-none"  style="position:absolute;left:-50%;right:-50%;top:75%;opacity:1.0"  href="<?php echo URL_PROYECTO ?>/perfil/<?php echo $datos["usuario"]->usuario ?>"><?php echo $datos["perfil"]->nombreCompleto ?></a>
      <label for="btncambiarImagen" class="btn btn-info btn-sm centrar-elemento pc-d-none disabled"  style="position:absolute;left:-50%;right:-50%;top:85%;opacity:1.0;width:30% " >Cambiar Avatar</label>
  </div>
</div>
<?php showMessage("error-update-portada", "danger");?>
<form action="<?php echo URL_PROYECTO; ?>/perfil/cambiarPortada/perfil" method="post" enctype="multipart/form-data">
   <input type="hidden" name="id_user" value="<?php echo $_SESSION["id"] ?>">
   <input type="hidden" name="img_anterior" value="<?php echo $datos["perfil"]->fotoPortada ?>">
   <input type="file" id="img-portada" name="portada" class="d-none">
   <input type="submit" id="envio-formulario" class="d-none">
</form>
<div class="container">
   <div class="row mt-3">
      <div class="col-md-3 mb-3 celular-d-n">
          <div class="mostrar-perfil m-0">
           <h5 class="text-center">Informacion</h5>
             <div class="celular-d-none  text-center">
                <label class="centrar-elemento" for="cambiarImagenPerfil"><img src="<?php echo URL_PROYECTO_STATIC . "/" . $datos["perfil"]->fotoPerfil; ?>" alt="imagen" class="mostrar-perfil-img align-center rounded-circle"></label>
                <hr class="efect-img">

                <?php if ($datos["usuario"]->idusuario === $_SESSION["id"]) {?>
                <form action="<?php echo URL_PROYECTO; ?>/perfil/cambiarImagen/perfil" method="post" enctype="multipart/form-data">
                 <input type="hidden" name="id_user" value="<?php echo $_SESSION["id"] ?>">
                 <input type="hidden" name="img_anterior" value="<?php echo $datos["perfil"]->fotoPerfil ?>">
                   <input type="file" name="imagen" class="d-none" id="cambiarImagenPerfil">
                   <button id="btncambiarImagen" type="submit" class="btn btn-info btn-sm centrar-elemento" disabled>Cambiar Avatar</button>
                   <a href="<?php echo URL_PROYECTO; ?>/perfil/getPerfil" class="btn btn-secondary btn-sm my-2 " >Editar Perfil</a>
                </form>

                <?php }?>
                <h5 class="text-center"><a class="text-decoration-none text-dark" href="<?php echo URL_PROYECTO ?>/perfil/<?php echo $datos["usuario"]->usuario ?>"><?php echo $datos["perfil"]->nombreCompleto ?></a></h5>
                <p class="text-center"><?php echo $datos["usuario"]->usuario ?></p>

             </div>
             <div class="row">
               <div class="col-md-12 text-justify mt-1"><span class="h6"> <a class="text-decoration-none" href="<?php echo URL_PROYECTO ?>/perfil/getSeguidores">Seguidores</a>:</span> <span><?php echo $datos["seguidores"] ?></span></div>
               <div class="col-md-12 text-justify mt-1"><span class="h6"> <a class="text-decoration-none" href="<?php echo URL_PROYECTO ?>/perfil/getSeguidos">Seguidos</a>:</span> <span><?php echo $datos["seguidos"] ?></span></div>
               <div class="col-md-12 text-justify mt-1"><span class="h6"> Publicaciones:</span> <span><?php echo count($datos["publicaciones"]) ?></span></div>
               <div class="col-md-12 text-justify mt-1"><span class="h6"> Likes recibidos:</span> <span><?php echo (!empty($datos["totalLikes"])) ? $datos["totalLikes"] : 0; ?></span></div>
                 <div class="col-md-12 text-center pt-2">
                 <?php if ($datos["usuario"]->idusuario == $_SESSION["id"]): ?>
                   <div class="col-md-12 text-center mb-3 mt-2"><a class="text-decoration-none" href="<?php echo URL_PROYECTO ?>/perfil/busquedaUsuario">Buscar amigos</a></div>
                 <?php endif;?>
                 <?php if ($datos["seguido"]): ?>
                  <?php $class = "d-none";?>
                  <?php if ($datos["seguido"]->id_seguir != $_SESSION["id"]): ?>
                          <?php if ($datos["seguido"]->estado_aprobado == 1): ?>
                            <a  href="<?php echo URL_PROYECTO ?>/perfil/cancelarSolicitud/<?php echo $datos["seguido"]->idsigue ?>/perfil/<?php echo $datos["usuario"]->usuario ?>" class="btn btn-success alert-dejar-seguir  btn-block">Siguiendo</a>
                            <?php else: ?>
                              <a href="<?php echo URL_PROYECTO ?>/perfil/cancelarSolicitud/<?php echo $datos["seguido"]->idsigue ?>/perfil/<?php echo $datos["usuario"]->usuario ?>" class="btn btn-secondary  btn-block">En espera..</a>
                              <?php endif;?>
                           <?php endif;?>
                     <?php endif;?>
                              <?php if ($datos["usuario"]->idusuario != $_SESSION["id"]): ?>
                                <a href="<?php echo URL_PROYECTO ?>/perfil/seguirUsuario/<?php echo $datos["usuario"]->idusuario ?>/perfil/<?php echo $datos["usuario"]->usuario ?>" class="btn btn-primary btn-block <?php echo isset($class) ? $class : ""; ?>">Seguir</a>
                              <?php endif;?>
                   </div>

             </div>
            </div>
          </div>
          <div class="col-md-6  celular_perfl">
            <?php showMessage("unknow-post", "danger");?>
            <?php if ($datos["usuario"]->idusuario === $_SESSION["id"]) {?>
          <div class="form-post mb-2">
           <div class="form-group">
               <h6 class="mb-n1">Crear publicación</h6>
               <hr>
               <div class="row">
                    <div class=" col-md-1">
                    <a class="text-decoration-none" href="<?php echo URL_PROYECTO ?>/perfil">
                         <img src="<?php echo URL_PROYECTO_STATIC . "/" . $datos["perfil"]->fotoPerfil; ?>" alt="imagen" class="img-form rounded-circle">
                         <span class="pc-d-none  m-3"><?php echo $datos["usuario"]->usuario ?></span>
                       </a>
                    </div>
                    <div class="col-md-11">

                     <form id="form-publicacion" action="<?php echo URL_PROYECTO ?>/publicacion/publicar/<?php echo $datos["usuario"]->idusuario . "/" . $datos["redireccion"] = "miperfil" . "/" . $datos["usuario"]->usuario ?>" method="post"  enctype="multipart/form-data">
                     <input type="hidden" name="id_user" value="<?php echo $datos["usuario"]->idusuario ?>">
                        <textarea  id="post" class="input-post" name="textoPublicacion" placeholder="¿Que estas pensando?" rows="auto"></textarea></form>
                    </div>
               </div>
           <div class="">
                   <label id="subirfoto" class=" btn btn-outline-secondary " for="imagenPublicacion"><i class="fas fa-camera"></i> Subir foto</label>
                   <button type="submit" form="form-publicacion" class=" btn btn-primary float-right">Publicar</button>
                   <input type="file" name="imagenPublicacion" form="form-publicacion" id="imagenPublicacion" class="d-none">
           </div>
            </div>
            </div>
        <?php }?>
        <?php $i = 1;foreach ($datos["publicaciones"] as $publicacion): ?>
          <?php require URL_APP . "/views/pages/publicacion.php";?>
          <?php endforeach;?>

          <?php if (empty($datos["publicaciones"])): ?>
               <div class="publicacion mb-2 ">
                  <h5 class="m-5">El usuario aun no ha hecho publicaciones...</h5>
               </div>
          <?php endif;?>

          </div>
      <div class="col-md-3">
      <?php if ($datos["usuario"]->idusuario != $_SESSION["id"]): ?>
          <a class="btn btn-warning btn-block" href="<?php echo URL_PROYECTO ?>/message">Enviar mensaje</a>
          <div class="publicacion mb-2 pl-3  pr-2 mt-2">
                <p>Dale click al boton y luego busca el usuario por su nombre en el buscador de chats.</p>
          </div>
      <?php endif;?>
       </div>
   </div>
</div>

<!-- muestra datos para editar texto de la publicacion -->
<!-- Modal -->
<div class="modal fade" id="update-perfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Publicacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="post-update" method="post" action="<?php echo URL_PROYECTO ?>/publicacion/actualizarPublicacion">
        <input type="hidden" name="id-update" id="id-update">
        <textarea name="publicacion-update" id="publicacion-update" class="form-control"  rows="5"></textarea>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" form="post-update" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>
<?php include_once URL_APP . "/views/custom/footer.php";?>
