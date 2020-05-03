<?php

class Notificacion extends Base
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function addNotificationLike($datos)
    {
        $this->db->query("INSERT INTO notificaciones (idpublicacion,idusuario,usuarioAccion,tipoNotificacion)VALUES(:idpublicacion,:idusuario,:idusuarioAccion,:tipo)");
        $this->db->bind(":idpublicacion", $datos["idpublicacion"]);
        $this->db->bind(":idusuario", $datos["idusuarioPropietario"]);
        $this->db->bind(":idusuarioAccion", $datos["idusuario"]);
        $this->db->bind(":tipo", $datos["tipo"]);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }

    public function addNotificationShare($datos)
    {
        $this->db->query("INSERT INTO notificaciones (idpublicacion,idusuario,usuarioAccion,tipoNotificacion)VALUES(:idpublicacion,:idusuario,:idusuarioAccion,:tipo)");
        $this->db->bind(":idpublicacion", $datos["idpublicacion"]);
        $this->db->bind(":idusuario", $datos["idusuarioPropietario"]);
        $this->db->bind(":idusuarioAccion", $datos["idusuario"]);
        $this->db->bind(":tipo", $datos["tipo"]);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }

    public function addNotificationComment($datos)
    {
        $this->db->query("INSERT INTO notificaciones (idpublicacion,idusuario,usuarioAccion,tipoNotificacion)VALUES(:idpublicacion,:idusuario,:idusuarioAccion,:tipo)");
        $this->db->bind(":idpublicacion", $datos["idpublicacion"]);
        $this->db->bind(":idusuario", $datos["iduserPropietario"]);
        $this->db->bind(":idusuarioAccion", $datos["iduser"]);
        $this->db->bind(":tipo", $datos["tipo"]);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }

    public function getNotificaciones($idusuario)
    {
        $this->db->query("CALL consulta_notificaciones(:id)");
        $this->db->bind(":id", $idusuario);
        return $this->db->registers();

    }

    public function getnumNotificaciones($idusuario)
    {
        $this->db->query("SELECT estado FROM notificaciones WHERE idusuario = :id AND estado = 1");
        $this->db->bind(":id", $idusuario);
        return $this->db->rowCount();

    }

    public function deleteNotificaciones($idusuario)
    {
        $this->db->query("DELETE FROM notificaciones WHERE idusuario = :idusuario");
        $this->db->bind(":idusuario", $idusuario);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;

    }

    public function deleteNotificacion($idnotificacion)
    {
        $this->db->query("DELETE FROM notificaciones WHERE idnotificacion = :idnotificacion");
        $this->db->bind(":idnotificacion", $idnotificacion);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;

    }

    public function resetSatusNotificaciones($idusuario)
    {

        $this->db->query("UPDATE notificaciones SET estado = 0 WHERE idusuario = :idusuario");
        $this->db->bind(":idusuario", $idusuario);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }
}
