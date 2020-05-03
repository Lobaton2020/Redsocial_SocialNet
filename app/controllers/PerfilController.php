<?php

class PerfilController extends Controller
{
    private $perfil;
    private $usuario;

    public function __construct()
    {
        $this->perfil = $this->model("perfil");
        $this->usuario = $this->model("usuario");
        $this->message = $this->model("message");
        $this->publicacion = $this->model("publicacion");

        if (!isset($_SESSION["logueado"]) || empty($_SESSION["logueado"])) {
            redirect("/auth");
        }
    }

    public function index($usuario = 0)
    {
        $usuario = ($usuario === 0) ? $_SESSION["usuario"] : $usuario;
        $usuario = $this->usuario->getUsuario($usuario) == true ? $usuario : $_SESSION["usuario"];
        $datosUsuario = $this->usuario->getUsuario($usuario);
        $datosPerfil = $this->usuario->getPerfil($datosUsuario->idusuario);
        $datosSeguido = $this->perfil->getSeguido($_SESSION["id"], $datosUsuario->idusuario);
        $datosCompartir = $this->publicacion->getShares($_SESSION["id"]);
        //el 1 es parametro para ver quienes si me aceptaron y ver su contenido
        $datosPublicacionesUsuario = $this->perfil->getPublicacionesUsuario($datosUsuario->idusuario);
        $numSeguidores = count($this->perfil->getSeguidoresMesiguen($datosUsuario->idusuario, 1));
        $numSeguidos = count($this->perfil->getSeguidoresYosigo($datosUsuario->idusuario, 1));

        $datosLikes = $this->publicacion->getLikes($_SESSION["id"]);
        $datosComentarios = $this->publicacion->getComentarios();

        $totalLikes = null;
        $newDatosPublicacionesUsuario = [];
        foreach ($datosPublicacionesUsuario as $publicacion) {
            $elemento = new stdClass;
            $elemento->idpublicacion = $publicacion->idpublicacion;
            $elemento->idusuario = $publicacion->idusuario;
            $elemento->usuario = $publicacion->usuario;
            $elemento->contenidopublicacion = $publicacion->contenidopublicacion;
            $elemento->fotopublicacion = $publicacion->fotopublicacion;
            $elemento->fechapublicacion = $publicacion->fechapublicacion;
            $elemento->idperfil = $publicacion->idperfil;
            $elemento->fotoperfil = $publicacion->fotoperfil;
            $elemento->nombrecompleto = $publicacion->nombrecompleto;
            $elemento->num_likes = $this->publicacion->rowLikesPublicacion($datos = ["idpublicacion" => $publicacion->idpublicacion]);
            $elemento->num_comentarios = $this->publicacion->rowComentsPublicacion($datos = ["idpublicacion" => $publicacion->idpublicacion]);
            $elemento->num_compartido = $this->publicacion->rowCompartidoPublicacion($datos = ["idpublicacion" => $publicacion->idpublicacion]);

            $totalLikes += $elemento->num_likes;
            array_push($newDatosPublicacionesUsuario, $elemento);
        }

        $datos = [
            "usuario" => $datosUsuario,
            "perfil" => $datosPerfil,
            "seguido" => $datosSeguido,
            "seguidores" => $numSeguidores,
            "seguidos" => $numSeguidos,
            "publicaciones" => $newDatosPublicacionesUsuario,
            "totalLikes" => $totalLikes,
            "comentarios" => $datosComentarios,
            "likes" => $datosLikes,
            "compartir" => $datosCompartir,
            "x" => "miperfil",

        ];
        $this->view("pages/perfil/verPerfil", $datos);
    }

    public function busquedaUsuario()
    {
        $usuario = isset($_POST["busquedaUsuario"]) ? trim($_POST["busquedaUsuario"]) : "";
        $datosBusqueda = $this->message->getUsuarios($usuario);
        $datosSeguidores = $this->perfil->getSeguidores();

        $datos = [
            "usuario" => $datosBusqueda,
            "seguidores" => $datosSeguidores,
        ];

        $this->view("pages/perfil/buscarUsuario", $datos);

    }

    public function seguidoresSolicitudes()
    {
        $datosSeguidoresSolicitudes = $this->perfil->seguidoresSolicitudes($_SESSION["id"]);
        $datos = [
            "solicitudes" => $datosSeguidoresSolicitudes,
        ];

        $this->view("pages/perfil/seguidoresSolicitudes", $datos);
    }

    public function cambiarImagen($tipo = "home")
    {

        $ruta = "img/imagenesPerfil/" . $_SESSION["id"] . "_" . $_SESSION["usuario"];
        $ruta_db = $ruta . "/" . $_FILES["imagen"]["name"];
        $datos = [
            "idusuario" => intval(trim($_POST["id_user"])),
            "img_anterior" => trim($_POST["img_anterior"]),
            "ruta" => $ruta_db,
        ];
        unlink($datos["img_anterior"]);

        if (subirImagen($ruta, $_FILES["imagen"]["tmp_name"], $ruta_db)) {
            if ($this->perfil->editarFoto($datos)) {
                $_SESSION["url_img"] = $datos["ruta"];
                redirect("/{$tipo}");
            } else {
                echo "el perfil no se guardo";
            }
        } else {
            echo "el perfil no se guardo..";
        }
    }

    public function cambiarPortada($tipo = "home")
    {
        $ruta = "img/imagenesPortada/" . $_SESSION["id"] . "_" . $_SESSION["usuario"];
        $ruta_db = $ruta . "/" . $_FILES["portada"]["name"];
        $datos = [
            "idusuario" => intval(trim($_POST["id_user"])),
            "img_anterior" => trim($_POST["img_anterior"]),
            "ruta" => $ruta_db,
        ];
        if ($datos["img_anterior"] != "img/imagenesCustom/fondo_portada.jpg") {
            unlink($datos["img_anterior"]);
        }

        if (subirImagen($ruta, $_FILES["portada"]["tmp_name"], $ruta_db)) {
            if ($this->perfil->cambiarPortada($datos)) {
                redirect("/{$tipo}");
            } else {
                echo "la portada no se guardo";
            }
        } else {
            echo "la portada no se guardo..";
        }
    }

    public function seguirUsuario($idusuario, $recibida = "busquedaUsuario", $usuario = "")
    {
        $datos = [
            "idusuarioseguido" => trim($_SESSION["id"]),
            "idusuarioseguir" => trim($idusuario),

        ];

        if ($datos["idusuarioseguido"] != $datos["idusuarioseguir"]) {
            if ($this->perfil->verificaraquienSeguir($datos) > 0) {
                redirectPublicacion($recibida, $usuario);
            } else {

                if ($this->perfil->seguirUsuario($datos)) {
                    redirectPublicacion($recibida, $usuario);
                } else {
                    redirectPublicacion($recibida, $usuario);

                }
            }
        } else {
            redirectPublicacion($recibida, $$usuario);

        }
    }

    public function cancelarSolicitud($idseguir, $recibida = "busquedaUsuario", $usuario = "")
    {
        if ($this->perfil->cancelarSolicitud($idseguir)) {
            redirectPublicacion($recibida, $usuario);

        } else {
            redirectPublicacion($recibida, $usuario);
        }

    }

    public function aceptarSolicitud($idseguir)
    {
        if ($this->perfil->aceptarSolicitud($idseguir)) {
            redirect("/perfil/seguidoresSolicitudes");
        } else {
            redirect("/perfil/seguidoresSolicitudes");
        }

    }

    public function getNumSolicitudes()
    {
        if ($numero = $this->perfil->getNumSolicitudes($_SESSION["id"])) {
            echo json_encode($numero);
        } else {
            echo "false";
        }
    }

    public function getSeguidores()
    {

        $datosSeguidoresAceptado = $this->perfil->getSeguidoresMeSiguen($_SESSION["id"], 1);
        // $datosSeguidoresEspera = $this->perfil->getSeguidoresMeSiguen($_SESSION["id"], 0);
        $datosSeguidores = $this->perfil->getSeguidores();
        $datos = [
            "seguidoresAceptados" => $datosSeguidoresAceptado,
            // "seguidoresEspera" => $datosSeguidoresEspera,
            "tipo_redireccion" => "seguidores",
            "seguidorSaber" => $datosSeguidores,
        ];

        $this->view("pages/perfil/seguidoresListado", $datos);

    }

    public function getSeguidos()
    {
        $datosSeguidosAceptado = $this->perfil->getSeguidoresYosigo($_SESSION["id"], 1);
        $datosSeguidosEspera = $this->perfil->getSeguidoresYosigo($_SESSION["id"], 0);

        $datos = [
            "seguidosAceptados" => $datosSeguidosAceptado,
            "seguidosEspera" => $datosSeguidosEspera,
            "tipo_redireccion" => "seguidos",

        ];

        $this->view("pages/perfil/seguidosListado", $datos);

    }

    public function getPerfil()
    {
        $datosUsuario = $this->perfil->getUsuario($_SESSION["id"]);
        $datos = [
            "usuario" => $datosUsuario,
        ];
        $this->view("pages/perfil/editarPerfil", $datos);

    }

    public function updatePerfil()
    {
        $datos = [
            "idusuario" => trim($_POST["idusuario"]),
            "nombrecompleto" => trim($_POST["nombre-completo"]),
            "usuario" => trim($_POST["usuario"]),
            "email" => trim($_POST["correo"]),
            "sexo" => trim($_POST["sexo"]),
        ];

        if ($this->perfil->updatePerfil($datos)) {
            if ($this->perfil->updateUsuario($datos)) {
                $_SESSION["success-update-data"] = "Tu perfil se ha actualizado correctamente";
                redirect("/perfil/getPerfil");
            } else {
                $_SESSION["error-update-data"] = "Lo sentimos. No se actualizó tu perfil";
                redirect("/perfil/getPerfil");
            }
        } else {
            $_SESSION["error-update-data"] = "Lo sentimos. No se actualizó tu perfil";
            redirect("/perfil/getPerfil");
        }

    }

    public function updatePassword()
    {
        $datos = [
            "clave-anterior" => trim($_POST["clave-anterior"]),
            "clave-nueva" => trim($_POST["clave-nueva"]),
            "clave-nueva-repetida" => trim($_POST["clave-nueva-repetida"]),
            "id-usuario" => trim($_SESSION["id"]),
        ];
        if ($datos["clave-nueva"] === $datos["clave-nueva-repetida"]) {
            if (password_verify($datos["clave-anterior"], $this->usuario->getHashContrasena($datos["id-usuario"])->contrasena)) {
                $datos["clave-nueva"] = password_hash($datos["clave-nueva"], PASSWORD_BCRYPT);
                if ($this->usuario->updatePassword($datos)) {
                    $_SESSION["success-update-pass"] = "Contraseña actualizada correctamente";
                    redirect("/perfil/getPerfil");
                } else {
                    $_SESSION["error-update-pass"] = "La contraseña no se pudo actualizar";
                    redirect("/perfil/getPerfil");
                }
            } else {
                $_SESSION["error-update-pass"] = "Tu contraseña actual es incorrecta";
                redirect("/perfil/getPerfil");
            }
        } else {
            $_SESSION["error-update-pass"] = "Las contraseñas no coinciden";
            redirect("/perfil/getPerfil");
        }

    }

    public function updatePasswordRecovered()
    {
        $datos = [
            "clave-nueva" => trim($_POST["clave-nueva"]),
            "clave-nueva-repetida" => trim($_POST["clave-nueva-repetida"]),
            "id-usuario" => trim($_SESSION["id"]),
        ];
        if ($datos["clave-nueva"] === $datos["clave-nueva-repetida"]) {

            $datos["clave-nueva"] = password_hash($datos["clave-nueva"], PASSWORD_BCRYPT);
            if ($this->usuario->updatePassword($datos)) {
                $_SESSION["view-text"] = '<a class="btn btn-danger btn-block" href="' . URL_PROYECTO . '/home" class="mb-n5 ">Continuar</a>';
                $_SESSION["success-update-pass"] = "Contraseña actualizada correctamente";
                redirect("/home/cambioPassword");
            } else {
                $_SESSION["error-update-pass"] = "La contraseña no se pudo actualizar";
                redirect("/home/cambioPassword");
            }
        } else {
            $_SESSION["error-update-pass"] = "Las contraseñas no coinciden";
            redirect("/home/cambioPassword");
        }

    }

    public function verificarPublicacion($idpulicacion)
    {
        if ($this->publicacion->verificarPublicacion($idpulicacion)) {
            redirect("/perfil/#" . $idpulicacion);
        } else {
            redirect("/perfil");
            $_SESSION["unknow-post"] = "La publicacion se ha eliminado";
        }
    }
}
