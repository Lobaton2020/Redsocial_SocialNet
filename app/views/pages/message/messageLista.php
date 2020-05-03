
<?php include_once URL_APP . "/views/custom/header.php";?>
<?php include_once URL_APP . "/views/custom/navbar.php";?>

<div class="container mt5pc  ">
    <div class="row ">
        <div class="hidden-chat-celular col-md-4 mx2 p-2 bg-white" >
            <div class="">
                <div class="px-3 py-2">
                      <div class="mb-1    ">
                          <img style="width:34px;height:34px" src="<?php echo URL_PROYECTO_STATIC . $_SESSION["url_img"] ?>" alt="imagen" class="img-form rounded-circle">
                          <span class="h6 ml-2"><?php echo $_SESSION["usuario"] ?></span>
                          <span class="float-right mr-2"> <i class="fas fa-ellipsis-v small"></i></span>
                      </div>
                  </div>
                  <div class="form-group">
                      <input id="buscar_chat" type="search" class="form-control" placeholder="Buscar amigo" ">
                          <div id="show-chats"></div>

                  </div>
                  <?php if (count($datos["chats"]) == 0): ?>
                    <div class="">
                         <hr>
                         <h5 class="text-center text-muted my-4"> No hay chats disponibles</h5>
                    </div>
                  <?php endif;?>
                  <?php if (count($datos["chats"]) > 0): ?>
                    <?php $classhiddenImg = "d-none";?>
                    <div class="">
                         <hr>
                         <h6 class="text-center text-muted my-2"> Listado de chats</h6>
                    </div>
                    <?php endif;?>
                  <?php foreach ($datos["chats"] as $chat): ?>
                    <div class="simulacion-option simulacion-option-chat py-2 mt-2" value="<?php echo $chat->idusuario ?>">
                          <a class="text-decoration-none" href="#">
                              <img style="width:34px;height:34px" src="<?php echo URL_PROYECTO_STATIC . $chat->fotoPerfil ?>" alt="imagen" class="img-form rounded-circle">
                              <span class="h6 ml-2"><?php echo $chat->nombrecompleto ?></span>
                          </a>
                  </div>
                  <?php endforeach;?>
                </div>
           </div>
           <div class="col-md-8  h-chat-pc h-chat-celular p-0 bg-white" >
            <div class="hidden-chat <?php echo (!isset($classhiddenImg)) ?: "celular-d-none"; ?>">
                <img style="width:200px;height:200px" src="<?php echo URL_PROYECTO_STATIC ?>img/imagenesCustom/new_chat.png" alt="imagen" class="img-new-chat ">
                <div class="text-center">Agréga o continúa un chat.</div>
            </div>
            <div class="show-chat">

             <div class="px-3 py-2 show-chat" style="background:#ccc">
                <div class="ml-2">
                    <a href="<?php echo URL_PROYECTO ?>/message" style="font-size:16px"><i class="fas fa-chevron-left"></i></a>
                    <img id="imgchat" style="width:34px;height:34px"  src="" alt="imagen" class="img-form rounded-circle">
                    <span id="namechat" class="h6 ml-2"> </span>
                    <span class="float-right mr-2">
                     <i class="fas fa-ellipsis-v small"></i>
	                 <!-- <a class="nav-link " id="actions_publication" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	               </a>
	                  <div class="dropdown-menu dropdown-menu-right " aria-labelledby="#actions_publication">
	                     <h6 class="dropdown-header">Opcion</h6>
	                     <a class="dropdown-item small" id="eliminar-chat" href=""><i class="fas fa-trash"></i> Eliminar chat</a>
	                 </div> -->

                     </span>
                </div>
            </div>
            <div id="conversacion" value="" class="px-4" style="position:absolute;bottom:12%;left:0;right:0;top:10%;overflow: auto;">
                 <div id="text-chat"></div>
            </div>
            <div style="position:absolute;bottom:3%;right:3%;left:3%" >
            <div class=" p-auto float-left w-chat-pc w-chat-celular">
                <input id="content-message" type="text" class="form-control  " placeholder="Escribe un mensaje" >
            </div>
             <div class=" p-auto float-right">
                 <button id="send-message" class="btn btn-success w-10">Enviar</button>
             </div>
             </div>
           </div>
        </div>
    </div>
</div>
<?php include_once URL_APP . "/views/custom/footer.php";?>
