<?php

class Perfil
{
    private $db;

    public function __construct()
    {
        $this->db = new Base();
    }

    public function editarFoto($datos)
    {
        $this->db->query("UPDATE perfil SET fotoPerfil = :ruta WHERE idusuario = :id");
        $this->db->bind(":ruta", $datos["ruta"]);
        $this->db->bind(":id", $datos["idusuario"]);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }

    public function seguirUsuario($datos)
    {
        $this->db->query("INSERT INTO seguidores (id_seguido,id_seguir) VALUES(:id_seguido,:id_seguir)");
        $this->db->bind(":id_seguido", $datos["idusuarioseguido"]);
        $this->db->bind(":id_seguir", $datos["idusuarioseguir"]);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;

    }
    public function getSeguidores()
    {
        $this->db->query("SELECT * FROM seguidores");
        return $this->db->registers();

    }

    public function verificaraquienSeguir($datos)
    {
        $this->db->query("SELECT * FROM seguidores WHERE id_seguido = :id_seguido AND id_seguir = :id_seguir");
        $this->db->bind(":id_seguido", $datos["idusuarioseguido"]);
        $this->db->bind(":id_seguir", $datos["idusuarioseguir"]);

        return $this->db->rowCount();

    }

    public function seguidoresSolicitudes($idusuario)
    {
        $this->db->query("CALL consulta_aceptar_seguidores(:id_seguir)");
        $this->db->bind(":id_seguir", $idusuario);

        return $this->db->registers();

    }

    public function getNumSolicitudes($idusuario)
    {
        $this->db->query("CALL consulta_aceptar_seguidores(:id_seguir)");
        $this->db->bind(":id_seguir", $idusuario);

        return $this->db->rowCount();

    }

    public function cancelarSolicitud($idseguir)
    {
        $this->db->query("DELETE FROM seguidores WHERE idsigue = :idseguir");
        $this->db->bind(":idseguir", $idseguir);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;

    }

    public function aceptarSolicitud($idseguir)
    {
        $this->db->query("UPDATE seguidores SET estado_aprobado = 1 WHERE idsigue = :idseguir");
        $this->db->bind(":idseguir", $idseguir);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;

    }

    public function getSeguidoresYosigo($idseguir, $estado_aprobado)
    {
        $this->db->query("CALL consulta_seguidores(:idusuario,:estado)");
        $this->db->bind(":idusuario", $idseguir);
        $this->db->bind(":estado", $estado_aprobado);

        return $this->db->registers();
    }

    public function getSeguidoresMesiguen($idseguido, $estado_aprobado)
    {
        $this->db->query("CALL consulta_seguidos(:idusuario,:estado)");
        $this->db->bind(":idusuario", $idseguido);
        $this->db->bind(":estado", $estado_aprobado);

        return $this->db->registers();
    }

    public function getPublicacionesUsuario($idusuario)
    {
        $this->db->query("CALL consulta_publicaciones_usuario(:idusuario)");
        $this->db->bind(":idusuario", $idusuario);

        return $this->db->registers();
    }

    public function getSeguido($idseguido, $idseguir)
    {
        $this->db->query("SELECT * FROM seguidores WHERE id_seguido = :id_seguido and id_seguir = :id_seguir");
        $this->db->bind(":id_seguido", $idseguido);
        $this->db->bind(":id_seguir", $idseguir);

        return $this->db->register();

    }

    public function getUsuario($idusuario)
    {
        $this->db->query("CALL consulta_usuario(:idusuario)");
        $this->db->bind(":idusuario", $idusuario);
        return $this->db->register();

    }
    public function updatePerfil($datos)
    {
        $this->db->query("UPDATE perfil SET nombreCompleto = :nombrecompleto WHERE idUsuario = :idusuario");
        $this->db->bind(":nombrecompleto", $datos["nombrecompleto"]);
        $this->db->bind(":idusuario", $datos["idusuario"]);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;

    }

    public function updateUsuario($datos)
    {
        $this->db->query("UPDATE usuarios SET usuario = :usuario,
                                             correo = :correo,
                                             sexo = :sexo WHERE idusuario = :idusuario");
        $this->db->bind(":usuario", $datos["usuario"]);
        $this->db->bind(":correo", $datos["email"]);
        $this->db->bind(":sexo", $datos["sexo"]);
        $this->db->bind(":idusuario", $datos["idusuario"]);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;

    }

    public function cambiarPortada($datos)
    {
        $this->db->query("UPDATE perfil SET fotoPortada = :ruta WHERE idusuario = :id");
        $this->db->bind(":ruta", $datos["ruta"]);
        $this->db->bind(":id", $datos["idusuario"]);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }

}
