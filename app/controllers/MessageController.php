<?php

class MessageController extends Controller
{

    private $message;
    private $usuario;
    public function __construct()
    {
        $this->message = $this->model("message");
        $this->usuario = $this->model("usuario");

        if (!isset($_SESSION["logueado"]) || empty($_SESSION["logueado"])) {
            redirect("/auth");
        }
    }

    public function index()
    {
        $datosChats = $this->message->getChats($_SESSION["id"]);
        $datos = [
            "chats" => $datosChats,
        ];
        $this->view("/pages/message/messageLista", $datos);
    }

    //funcionamiento ajax

    public function getUsuarios($stringUsuario = null)
    {
        if ($this->message->getUsuarios($stringUsuario)) {
            $newData = [];
            foreach ($this->message->getUsuarios($stringUsuario) as $usuario) {
                if ($usuario->idusuario != $_SESSION["id"]) {
                    $datos = new stdClass;
                    $datos->fotoPerfil = $usuario->fotoPerfil;
                    $datos->idusuario = $usuario->idusuario;
                    $datos->nombreCompleto = $usuario->nombrecompleto;
                    $datos->url_proyecto = URL_PROYECTO;
                    $datos->url_proyecto_static = URL_PROYECTO_STATIC;

                    array_push($newData, $datos);
                }
            }
            echo json_encode($newData);
        } else {
            echo "false ";
        }
    }

    public function getUsuario($idusuario)
    {
        if ($perfil = $this->usuario->getPerfil($idusuario)) {
            $datos = new stdClass;
            $datos->idusuario = $perfil->idUsuario;
            $datos->nombre = $perfil->nombreCompleto;
            $datos->foto = $perfil->fotoPerfil;
            $datos->url_proyecto = URL_PROYECTO;
            $datos->url_proyecto_static = URL_PROYECTO_STATIC;
            echo json_encode($datos);
        } else {
            echo "false";
        }
    }

    public function addMessage()
    {
        if (isset($_POST["idusuario"])) {
            $datos = [
                "idusuariomanda" => trim($_SESSION["id"]),
                "idusuariorecibe" => trim($_POST["idusuario"]),
                "contenido" => trim($_POST["message"]),

            ];

            if ($this->message->addMessage($datos)) {
                echo "true";
            }
        } else {
            echo "false";
        }
    }

    public function getMessages($idusuario)
    {
        $datos = [
            "idusuariorecibe" => trim($idusuario),
            "idusuariomanda" => trim($_SESSION["id"]),

        ];
        if ($datos = $this->message->getMessages($datos)) {
            echo json_encode($datos);
        } else {
            echo "false";
        }
    }

    public function getChats()
    {
        if ($datos = $this->message->getChats($_SESSION["id"])) {
            echo count($datos);

        } else {
            echo "false";
        }
    }
    public function getURL_PROYECTO()
    {
        echo json_encode(["url" => URL_PROYECTO]);
    }
    public function deleteMessages($idusuario)
    {
        $datos = [
            "idusuariorecibe" => trim($idusuario),
            "idusuariomanda" => trim($_SESSION["id"]),

        ];
        if ($this->message->deleteMessages($datos)) {
            redirect("/message");
        } else {
            redirect("/message/error");
        }
    }

    public function deleteMessage($idmensaje)
    {
        if ($this->message->deleteMessage($idmensaje)) {
            echo "true";
        } else {
            echo "false";
        }
    }
}
