<?php

class NotificacionController extends Controller
{

    private $notificacion;
    public function __construct()
    {
        $this->notificacion = $this->model("notificacion");

        if (!isset($_SESSION["logueado"]) || empty($_SESSION["logueado"])) {
            redirect("/auth");
        }
    }

    public function index()
    {
        $datos = $this->notificacion->getNotificaciones($_SESSION["id"]);
        $this->view("/pages/notificacion/notificacionListado", $datos);
    }

    public function resetSatusNotificaciones()
    {
        if ($this->notificacion->resetSatusNotificaciones($_SESSION["id"])) {
            echo "true";
        }
    }
    public function eliminarNotificaciones()
    {
        if ($this->notificacion->deleteNotificaciones($_SESSION["id"])) {
            redirect("/notificacion");
        } else {
            redirect("/notificacion");

        }
    }

    public function eliminarNotificacion($idnotificacion)
    {
        if ($this->notificacion->deleteNotificacion($idnotificacion)) {
            redirect("/notificacion");
        } else {
            redirect("/notificacion");

        }
    }

    // obteniendo numero de notificaciones con ajax
    public function getnumNotificaciones()
    {
        if ($this->notificacion->getnumNotificaciones($_SESSION["id"])) {
            echo $this->notificacion->getnumNotificaciones($_SESSION["id"]);
        }
    }
}
