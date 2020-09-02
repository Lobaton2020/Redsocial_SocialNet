
<?php
// || $_SESSION["id"] == $publicacion->idusuario
$i = 1;
foreach ($datos["publicaciones"] as $publicacion) :
    if (count($datos["aquienyosigo"]) > 0) {
        foreach ($datos["aquienyosigo"] as $seguido) :
            if ($seguido->id_seguir == $publicacion->idusuario) {
                require URL_APP . "/views/pages/publicacion.php";
            }
        endforeach;
    } else {
        // HABILITAR VER  PUBLICACIONES diferentes de las mias
        if ($_SESSION["id"] != $publicacion->idusuario) {
            require URL_APP . "/views/pages/publicacion.php";
        }
        // HABILITAR VER MIS PUBLICACIONES
        // require URL_APP . "/views/pages/publicacion.php";
    }
endforeach;
?>