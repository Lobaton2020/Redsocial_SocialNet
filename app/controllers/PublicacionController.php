<?php

class PublicacionController extends Controller
{
    private $publicacion;
    private $notificacion;

    public function __construct()
    {
        $this->publicacion = $this->model("publicacion");
        $this->notificacion = $this->model("notificacion");
    }

    public function publicar($idUsuario, $redireccion, $usuario = "")
    {

        $num = $this->publicacion->getnumImages($_POST["id_user"]);
        $num = $num == null ? 0 : $num;
        $ruta = "img/imagenesPublicacion/" . $_SESSION["id"] . "_" . $_SESSION["usuario"];
        $ruta_db = (!empty($_FILES["imagenPublicacion"]["name"])) ? $ruta . "/_" . $num . "_" . $_FILES["imagenPublicacion"]["name"] : null;

        $datos = [
            "idusuario" => trim($idUsuario),
            "textoPublicacion" => trim($_POST["textoPublicacion"]),
            "imagenPublicacion" => trim($ruta_db),
        ];
        if ($datos["textoPublicacion"] == "" && $datos["imagenPublicacion"] == "") {
            redirectPublicacion($redireccion = "", $usuario);
            exit();
        }
        if (!is_null($ruta_db)) {

            if (subirImagen($ruta, $_FILES["imagenPublicacion"]["tmp_name"], $ruta_db)) {
                if ($this->publicacion->publicar($datos)) {
                    redirectPublicacion($redireccion, $usuario);
                } else {
                    echo "La publicacion no se almaceno en la BD";
                }
            } else {
                echo "La imagen no se pudo subir";
            }
        } else {
            if ($this->publicacion->publicar($datos)) {
                redirectPublicacion($redireccion, $usuario);
            } else {
                echo "La publicacion no se almaceno en la BD";
            }

        }
    }

    public function eliminar($idpublicacion, $redireccion, $usuario = "")
    {

        $publicacion = $this->publicacion->getPublicacion($idpublicacion);

        if ($publicacion->fotoPublicacion != "") {
            if (unlink($publicacion->fotoPublicacion)) {
                $this->deletePublicacion($idpublicacion, $redireccion, $usuario);
            }
        } else {
            $this->deletePublicacion($idpublicacion, $redireccion, $usuario);
        }

    }

    private function deletePublicacion($idpublicacion, $redireccion, $usuario)
    {
        if ($this->publicacion->deleteLikes($idpublicacion)) {
            if ($this->publicacion->deleteCompartidos($idpublicacion)) {
                if ($this->publicacion->deleteComentarios($idpublicacion)) {
                    if ($this->publicacion->eliminarPublicacion($idpublicacion)) {
                        redirectPublicacion($redireccion, $usuario, $idpublicacion - 1);
                    } else {
                        echo "Hubo un error";
                    }
                } else {
                    echo "Hubo un error";
                }
            } else {
                echo "Hubo un error";
            }
        } else {
            echo "Hubo un error";
        }

    }

    public function megusta($idpublicacion, $idusuario, $idusuarioAnotificar, $redireccion, $usuario = "")
    {
        $datos = [
            "idpublicacion" => $idpublicacion,
            "idusuario" => $idusuario,
            "idusuarioPropietario" => $idusuarioAnotificar,
            "tipo" => 1,
        ];

        if ($this->publicacion->rowLikes($datos)) {
            if ($this->publicacion->deleteLike($datos)) {
                redirectPublicacion($redireccion, $usuario, $datos["idpublicacion"]);
            }
        } else {
            if ($this->publicacion->addLike($datos)) {
                if ($datos["idusuarioPropietario"] != $datos["idusuario"]) {
                    $this->notificacion->addNotificationLike($datos);
                }
                redirectPublicacion($redireccion, $usuario, $datos["idpublicacion"]);

            }
        }
    }

    public function compartir($idpublicacion, $idusuario, $idusuarioAnotificar, $redireccion, $usuario = "")
    {
        $datos = [
            "idpublicacion" => $idpublicacion,
            "idusuario" => $idusuario,
            "idusuarioPropietario" => $idusuarioAnotificar,
            "tipo" => 3,
        ];
        if ($this->publicacion->rowShare($datos)) {
            if ($this->publicacion->deleteShare($datos)) {
                redirectPublicacion($redireccion, $usuario, $datos["idpublicacion"]);
            }
        } else {
            if ($this->publicacion->addShare($datos)) {
                if ($datos["idusuarioPropietario"] != $datos["idusuario"]) {
                    $this->notificacion->addNotificationShare($datos);
                }
                redirectPublicacion($redireccion, $usuario, $datos["idpublicacion"]);
            }
        }

    }

    public function comentar($redireccion, $usuario = "")
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $datos = [
                "iduserPropietario" => trim($_POST["id_userPropietario"]),
                "iduser" => trim($_POST["id_user"]),
                "idpublicacion" => trim($_POST["id_publicacion"]),
                "comentario" => trim($_POST["comentario"]),
                "tipo" => 2,
            ];
            if ($datos["comentario"] == "") {
                redirectPublicacion($redireccion, $usuario, $datos["idpublicacion"]);

            } else {
                if ($this->publicacion->addComentario($datos)) {
                    if ($datos["iduserPropietario"] != $datos["iduser"]) {
                        $this->notificacion->addNotificationComment($datos);
                    }
                    redirectPublicacion($redireccion, $usuario, $datos["idpublicacion"]);

                }
            }

        } else {
            redirect("/home");
        }
    }

    public function eliminarComentario($idcomentario, $idpublicacion, $redireccion, $usuario = "")
    {
        $datos = [
            "idpublicacion" => $idpublicacion,
        ];
        if ($this->publicacion->deleteComentario($idcomentario)) {
            redirectPublicacion($redireccion, $usuario, $datos["idpublicacion"]);
        } else {
            redirectPublicacion($redireccion, $usuario, $datos["idpublicacion"]);
        }
    }

    public function quienesgustan($idpublicacion, $redireccion, $usuario = "")
    {
        $datosLikes = $this->publicacion->getUsersLikes($idpublicacion);
        $datos = [
            "usuarios" => $datosLikes,
            "x" => $redireccion,
        ];
        $this->view("pages/detallesPublicacion/likesListado", $datos);
    }

    public function quienescomparten($idpublicacion, $redireccion, $usuario = "")
    {
        $datosCompartido = $this->publicacion->getUsersShares($idpublicacion);
        $datos = [
            "usuarios" => $datosCompartido,
            "x" => $redireccion,
        ];
        $this->view("pages/detallesPublicacion/compartidoListado", $datos);
    }

    public function redirectTo($tipo_redireccion, $idpublicacion)
    {
        redirectPublicacion($tipo_redireccion, "", $idpublicacion);
    }

    public function actualizarPublicacion()
    {
        $datos = [
            "idpublicacion" => trim($_POST["id-update"]),
            "newcontent" => trim($_POST["publicacion-update"]),
        ];
        if ($this->publicacion->updatePublicacion($datos)) {
            redirectPublicacion("miperfil", "", $datos["idpublicacion"]);
        } else {
            echo "No se actualizó la publicacion.";
        }
    }
}
