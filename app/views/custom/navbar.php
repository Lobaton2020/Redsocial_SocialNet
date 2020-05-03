<!-- navbar para el pc  -->
  <div class="bg-purple  celular-d-none fixed-top-local mt-50 animated fadeIn">
     <div class="col-md-1 "></div>
        <div class="col-md-10 ">
          <nav class="navbar navbar-expand-lg py-0 navbar-dark bg-dar">
             <div class="container">
               <a class="navbar-brand ml-4" href="<?php echo URL_PROYECTO ?>"><b>SocialNet</b></a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="true" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
               </button>

               <div class="navbar-collapse collapse show" id="navbarsExample07" >
                 <ul class="navbar-nav mr-auto">
                 <li class="nav-item">
                     <form class="form-inline my-custom" method="post" action="<?php echo URL_PROYECTO ?>/perfil/busquedaUsuario">
                       <input class="form-control new_style_form" style="width:200px" name="busquedaUsuario" type="search" placeholder="Buscar por nombre ó usuario" aria-label="Search">
                     </form>
                   </li>
                   </ul>

                   <ul class="navbar-nav ml-auto mr-0 type-text">
                   <li class="nav-item">
                   <form class=" nav-link d-md-inline-block form-inline ml-auto mr-0 ">
                     <div class="input-group">
                         <a class="text-decoration-none" href="<?php echo URL_PROYECTO ?>/perfil/<?php echo $_SESSION["usuario"] ?>"><img style="width:26px;height:26px" src="<?php echo URL_PROYECTO_STATIC . "" . $_SESSION["url_img"]; ?>" alt="..." class="rounded-circle">
                          <span class="text-light ml-2"><?php echo $_SESSION["usuario"]; ?></span>
                        </a>
                       </div>
                    </form>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link" href="<?php echo URL_PROYECTO ?>/home">Inicio<span class="sr-only">(current)</span></a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link" href="<?php echo URL_PROYECTO ?>/perfil/busquedaUsuario"><i class="fas fa-plus"></i></a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link" href="<?php echo URL_PROYECTO ?>/perfil/seguidoresSolicitudes"><i class="fas fa-users size-icon"></i><span class="numSolicitud badge_notification badge badge-pill badge-danger"></span></a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link" href="<?php echo URL_PROYECTO ?>/message"><i class="fas fa-inbox size-icon"></i><span class="numChats badge_notification badge badge-pill badge-danger"></span></a>
                   </li>
                   <li class="nav-item ">
                     <a class="nav-link numNotificacion_a"  href="<?php echo URL_PROYECTO ?>/notificacion"><i class="fas fa-bell size-icon"></i><span class="numNotificacion badge_notification badge badge-pill badge-danger"></span></a>

                   </li>
                   <li class="nav-item dropdown mr-4">
                     <a class="nav-link dropdown-toggle" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                     <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdown07">
                       <!-- <a class="dropdown-item" href="#">Action</a>
                       <a class="dropdown-item" href="#">Another action</a> -->
                       <a class="dropdown-item" href="<?php echo URL_PROYECTO; ?>/home/logout""><i class="fas fa-sign-out-alt"></i> Cerrar sesion</a>
                     </div>
                   </li>

                 </ul>
                </div>
              </div>
          </nav>
        </div>
     <div class="col-md-1 "></div>
  </div>
<!-- --------------------------------------------------------------------------------------------- -->
<!-- navbar para el celular -->
<nav class="navbar navbar-dark bg-purple  animated fadeIn pc-d-none">
      <a class="navbar-brand" href="<?php echo URL_PROYECTO ?>/home"><i class="fas fa-home"></i><span class="badge_notification badge badge-pill badge-danger"></span></a></a>
      <a class="navbar-brand" href="<?php echo URL_PROYECTO ?>/perfil/seguidoresSolicitudes"><i class="fas fa-users size-icon"></i><span  class="numSolicitud badge_notification badge badge-pill badge-danger"></span></a>
      <a class="navbar-brand" href="<?php echo URL_PROYECTO ?>/message"><i class="fas fa-inbox size-icon"></i><span class="numChats badge_notification badge badge-pill badge-danger"></span></a>
      <a class="navbar-brand" href="<?php echo URL_PROYECTO ?>/notificacion"><i class="fas fa-bell size-icon"></i><span class="numNotificacion badge_notification badge badge-pill badge-danger"></span></a>
      <a class="navbar-brand" href="#" data-toggle="collapse" data-target="#search"><i class="fas fa-search"></i></a>
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse collapse" id="search">
      <form class="form-inline my-2 my-md-0"  method="post" action="<?php echo URL_PROYECTO ?>/perfil/busquedaUsuario">
             <input class="form-control new_style_form"  aria-label="Search"  name="busquedaUsuario" type="search" placeholder="Buscar por nombre ó usuario" aria-label="Search">
        </form>
      </div>

      <div class="navbar-collapse collapse" id="navbarsExample01">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item pl-3 my-2">
          <div class="input-group">
               <a class="text-decoration-none" href="<?php echo URL_PROYECTO ?>/perfil/<?php echo $_SESSION["usuario"] ?>"><img style="width:26px;height:26px" src="<?php echo URL_PROYECTO_STATIC . "/" . $_SESSION["url_img"] ?>" alt="..." class="rounded-circle">
                 <span class="text-light ml-2"><?php echo $_SESSION["usuario"]; ?></span>
              </a>
             </div>
          </li>
          <li class="nav-item pl-3 my-2">
          <a class="text-decoration-none" href="<?php echo URL_PROYECTO ?>/perfil/busquedaUsuario">
                 <span class="text-light ml-2">Buscar amigos</span>
              </a>
          </li>
          <li class="nav-item text-right">
               <a class="nav-link text-dark mt-3 btn btn-light" href="<?php echo URL_PROYECTO ?>/home/logout">Cerrar Sesion</a>
           </li>
        </ul>
      </div>
    </nav>