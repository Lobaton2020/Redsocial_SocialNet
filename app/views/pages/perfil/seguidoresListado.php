<?php include_once URL_APP . "/views/custom/header.php";?>
<?php include_once URL_APP . "/views/custom/navbar.php";?>


<div class="container mt5pc mt-2 mb-3">
   <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
             <div class="card ">
                  <div class="text-center card-header">
                    <?php if (count($datos) > 0) {?>
                      <h4>Tus seguidores</h4>
                    <?php } else {?>
                     <h4>Nadie te sigue.</h4>
                    <?php }?>
                  </div>


                 <?php $i = 1;foreach ($datos["seguidoresAceptados"] as $busqueda): ?>
                         <?php require URL_APP . "/views/pages/perfil/customSeguir.php";?>
                  <?php endforeach;?>


        </div>
        <div class="col-md-1"></div>
   </div>
</div>

<?php include_once URL_APP . "/views/custom/footer.php";?>