<?php

class HomeController extends Controller
{
    private $model;
    private $publicacion;

    public function __construct()
    {
        $this->model = $this->model("usuario");
        $this->publicacion = $this->model("publicacion");
        $this->perfil = $this->model("perfil");

        if (!isset($_SESSION["logueado"]) || empty($_SESSION["logueado"])) {
            redirect("/auth");
        }

    }

    public function index()
    {
        $datosUsuario = $this->model->getUsuario($_SESSION["usuario"]);
        $datosPerfil = $this->model->getPerfil($datosUsuario->idusuario);
        $datosPublicaciones = $this->publicacion->getPublicaciones();
        $datosLikes = $this->publicacion->getLikes($_SESSION["id"]);
        $datosCompartir = $this->publicacion->getShares($_SESSION["id"]);
        $datosComentarios = $this->publicacion->getComentarios();
        //el 1 es parametro para ver quienes si me aceptaron y ver su contenido
        $datosSeguidoresYoSigo = $this->perfil->getSeguidoresYosigo($_SESSION["id"], 1);
        $numSeguidores = count($this->perfil->getSeguidoresMesiguen($datosUsuario->idusuario, 1));
        $numSeguidos = count($this->perfil->getSeguidoresYosigo($datosUsuario->idusuario, 1));

        $newDatosPublicaciones = [];
        foreach ($datosPublicaciones as $publicacion) {
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

            array_push($newDatosPublicaciones, $elemento);
        }

        $datosRed = [
            "usuario" => $datosUsuario,
            "perfil" => $datosPerfil,
            "publicaciones" => $newDatosPublicaciones,
            "likes" => $datosLikes,
            "compartir" => $datosCompartir,
            "comentarios" => $datosComentarios,
            "aquienyosigo" => $datosSeguidoresYoSigo,
            "x" => "x",
            "seguidores" => $numSeguidores,
            "seguidos" => $numSeguidos,

        ];
        if ($datosPerfil) {
            $this->view("pages/home", $datosRed);

        } else {
            $this->view("pages/perfil/completarPerfil");
        }
    }

    public function insertarRegistroPerfil()
    {
        $ruta = "img/imagenesPerfil/" . $_SESSION["id"] . "_" . $_SESSION["usuario"];
        $ruta_db = $ruta . "/" . $_FILES["imagen"]["name"];
        $datos = [
            "idusuario" => intval(trim($_POST["id_user"])),
            "nombrecompleto" => trim($_POST["nombrecompleto"]),
            "ruta" => $ruta_db,
            "portada" => "img/imagenesCustom/fondo_portada.jpg",
        ];
        if (subirImagen($ruta, $_FILES["imagen"]["tmp_name"], $ruta_db)) {
            if ($this->model->insertarPerfil($datos)) {
                $_SESSION["url_img"] = $datos["ruta"];
                redirect("/home");
            } else {
                echo "el perfil no se guardo.";
            }
        } else {
            echo "el perfil no se guardo";
        }
    }

    public function cambioPassword()
    {
        $this->view("pages/perfil/editarPassword");
    }
    public function logout()
    {
        session_destroy();
        redirect("/auth");
    }
}
