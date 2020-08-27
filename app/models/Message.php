<?php

class Message extends Base
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function getUsuarios($stringUsuario)
    {
        $this->db->query("SELECT u.idusuario,u.usuario,p.fotoPerfil,p.nombrecompleto FROM usuarios as u
                inner join perfil as p on p.idusuario = u.idusuario
                WHERE u.usuario LIKE :stringusuario OR p.nombrecompleto  LIKE :stringusuario;");
        $this->db->bind(":stringusuario", "%$stringUsuario%");
        return $this->db->registers();
    }

    public function addMessage($datos)
    {
        $this->db->query("INSERT INTO mensajes(usuarios_idusuario,usuarioMando,contenido)VALUES(:idusuariorecibe,:idusuariomanda,:contenido)");
        $this->db->bind(":idusuariorecibe", $datos["idusuariorecibe"]);
        $this->db->bind(":idusuariomanda", $datos["idusuariomanda"]);
        $this->db->bind(":contenido", $datos["contenido"]);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }

    public function getMessages($datos, $limit = 200)
    {
        $this->db->query("SELECT * FROM mensajes WHERE usuarioMando = :idusuariomanda AND  usuarios_idusuario = :idusuariorecibe
                       OR usuarios_idusuario = :idusuariomanda AND  usuarioMando = :idusuariorecibe ORDER BY idmensaje DESC limit {$limit}");
        $this->db->bind(":idusuariorecibe", $datos["idusuariorecibe"]);
        $this->db->bind(":idusuariomanda", $datos["idusuariomanda"]);

        return $this->db->registers();
    }

    public function getLastMessages($datos, $limit = 200)
    {
        $this->db->query("SELECT * FROM mensajes WHERE (usuarioMando = :idusuariomanda AND  usuarios_idusuario = :idusuariorecibe
                       OR usuarios_idusuario = :idusuariomanda AND  usuarioMando = :idusuariorecibe) AND idmensaje > :idlastmessage ORDER BY idmensaje DESC limit {$limit}");
        $this->db->bind(":idusuariorecibe", $datos["idusuariorecibe"]);
        $this->db->bind(":idusuariomanda", $datos["idusuariomanda"]);
        $this->db->bind(":idlastmessage", $datos["idlastmessage"]);

        return $this->db->registers();
    }

    public function getChats($idusuario)
    {
        $this->db->query("CALL consulta_chats(:idusuario)");
        $this->db->bind(":idusuario", $idusuario);
        return $this->db->registers();
    }
    public function deleteMessages($datos)
    {
        $this->db->query("DELETE FROM mensajes WHERE (usuarioMando = :idusuariomanda AND  usuarios_idusuario = :idusuariorecibe)
                       OR (usuarios_idusuario = :idusuariomanda AND  usuarioMando = :idusuariorecibe)");
        $this->db->bind(":idusuariorecibe", $datos["idusuariorecibe"]);
        $this->db->bind(":idusuariomanda", $datos["idusuariomanda"]);
        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }

    public function deleteMessage($idmensaje)
    {
        $this->db->query("DELETE FROM mensajes WHERE idmensaje = :idmensaje");
        $this->db->bind(":idmensaje", $idmensaje);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }
}
