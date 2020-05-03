
<?php include_once URL_APP . "/views/custom/header.php";?>
<?php include_once URL_APP . "/views/custom/navbar.php";?>

<div class="container mt5pc mt-2 mb-3">
<?php if (count($datos) != 0) {?>
    <div class="card mt-0 py-n2">
     <div class="card-body">
        <h3 class="card-head text-center ">Tus notificaciones</h3>
        <a href="<?php echo URL_PROYECTO; ?>/notificacion/eliminarNotificaciones" class="confirmDelete">Eliminar todo</a>
     </div>
   </div>
<?php }?>
<?php foreach ($datos as $notificacion): ?>
    <div class="card mt-0 py-n5">
     <div class="card-body">
         <span class="float-right">
            <span class="m-n6 ml-2 align-left small mr-3 text-muted" ><?php echo time_ago($notificacion->fechaNotificacion); ?></span>
            <a id="actions_notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i  class="fas fa-ellipsis-v small"></i></a>
	            <div class="dropdown-menu dropdown-menu-right " aria-labelledby="#actions_notification">
	            <h6 class="dropdown-header">Opcion</h6>
                 <a class="dropdown-item small" href="<?php echo URL_PROYECTO; ?>/notificacion/eliminarNotificacion/<?php echo $notificacion->idnotificacion ?>"><i class="fas fa-trash"></i> Eliminar</a>
	              <a class="dropdown-item small" href="<?php echo URL_PROYECTO; ?>/perfil/verificarPublicacion/<?php echo $notificacion->idpublicacion ?>"><i class="far fa-eye"></i> Ver publicacion</a>

	              <!-- <a class="dropdown-item" href="#">Another action</a> -->
               </div>
               </span>
         <div class="float-left">
	         <img style="width:34px;height:34px" src="<?php echo URL_PROYECTO_STATIC . "/" . $notificacion->fotoPerfil; ?>" alt="imagen" class="img-form rounded-circle">
	     </div>
	     <div class="float-left">
	        <div>
                <a href="<?php echo URL_PROYECTO; ?>/perfil/<?php echo $notificacion->usuario ?>" class="ml-2 text-decoration-none"><?php echo $notificacion->usuario ?></a>
                <?php echo $notificacion->mensajeNotificacion ?>
            </div>
        </div>
           <div>
              <p class="card-text"></p>

           </div>
     </div>
   </div>
<?php endforeach;?>
<?php if (count($datos) == 0) {?>
    <div class="card mt-0 p-0">
     <div class="card-body">
        <h2 class="card-head text-center">No hay notificaciones</h2>
     </div>
   </div>

<?php }?>
</div>
<?php include_once URL_APP . "/views/custom/footer.php";?>
