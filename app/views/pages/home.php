<?php include_once URL_APP . "/views/custom/header.php";?>
<?php include_once URL_APP . "/views/custom/navbar.php";?>


<div class="container mt-2 mt5pc animated fadeIn">
<?php showMessage("success-email", "success");?>
   <div class="row ">
      <div class="col-md-3 mb-3 p-0 celular-d-none"  >
         <div style="position:fixed;right:71%;left:7.5%;">
          <div class="mostrar-perfil m-0" >
           <h5 class="text-center">Informacion</h5>
             <div class="celular-d-none">
                <label class="centrar-elemento" for="cambiarImagenPerfil"><img src="<?php echo URL_PROYECTO_STATIC . "/" . $datos["perfil"]->fotoPerfil; ?>" alt="imagen" class="mostrar-perfil-img align-center rounded-circle"></label>
                <hr class="efect-img">
                <?php if ($datos["usuario"]->idusuario === $_SESSION["id"]) {?>
                <form action="<?php echo URL_PROYECTO; ?>/perfil/cambiarImagen" method="post" enctype="multipart/form-data">
                 <input type="hidden" name="id_user" value="<?php echo $_SESSION["id"] ?>">
                 <input type="hidden" name="img_anterior" value="<?php echo $datos["perfil"]->fotoPerfil ?>">
                   <input type="file" name="imagen" class="d-none" id="cambiarImagenPerfil">
                   <button id="btncambiarImagen" class="btn btn-info btn-sm centrar-elemento" disabled>Cambiar avatar</button>
                </form>

                <?php }?>
                <h5 class="text-center"><a class="text-decoration-none " href="<?php echo URL_PROYECTO ?>/perfil/<?php echo $datos["usuario"]->usuario ?>"><?php echo $datos["perfil"]->nombreCompleto ?></a></h5>
                <p class="text-center"><?php echo $datos["usuario"]->usuario ?></p>

             </div>
             <div class="row">
               <div class="col-md-12 text-justify mt-1"><span class="h6"> <a class="text-decoration-none" href="<?php echo URL_PROYECTO ?>/perfil/getSeguidores">Seguidores</a>:</span> <span><?php echo $datos["seguidores"] ?></span></div>
               <div class="col-md-12 text-justify mt-1"><span class="h6"> <a class="text-decoration-none" href="<?php echo URL_PROYECTO ?>/perfil/getSeguidos">Seguidos</a>:</span> <span><?php echo $datos["seguidos"] ?></span></div>
              <div class="col-md-12 text-center pt-2">

                   <div class="col-md-12 text-center mb-3 mt-2"><a class="text-decoration-none btn btn-primary btn-block" href="<?php echo URL_PROYECTO ?>/perfil/busquedaUsuario">Buscar amigos</a></div>

                   </div>
             </div>
            </div>
          </div>
      </div>
      <div class="col-md-6 ">
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
        <?php include_once URL_APP . "/views/pages/mostrarpublicacion.php";?>
      </div>
        <div class="col-md-3" >
           <div style="position:fixed;right:7.4%;left:71%;">
                <a class="btn btn-warning btn-block celular-d-none"  href="<?php echo URL_PROYECTO ?>/message">Chatea!</a>
            </div>
        </div>
   </div>
</div>

<?php include_once URL_APP . "/views/custom/footer.php";?>
