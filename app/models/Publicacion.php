<?php

class Publicacion
{

    private $db;

    public function __construct()
    {
        $this->db = new Base();
    }
    public function publicar($datos)
    {
        $this->db->query("INSERT INTO publicaciones (idUserPublico,contenidoPublicacion,fotoPublicacion) VALUES(:iduser,:contenido,:rutafoto)");
        $this->db->bind(":iduser", intval($datos["idusuario"]));
        $this->db->bind(":contenido", $datos["textoPublicacion"]);
        $this->db->bind(":rutafoto", $datos["imagenPublicacion"]);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }

    public function getPublicaciones()
    {
        $this->db->query("SELECT * FROM consulta_todas_publicaciones ORDER BY idpublicacion DESC");
        return $this->db->registers();
    }
// para darle nombre al fichero de la imagen y evitar repeticion
    public function getnumImages($idusuario)
    {
        $this->db->query("SELECT *  FROM publicaciones WHERE iduserpublico = :id");
        $this->db->bind(":id", $idusuario);
        return $this->db->rowCount();

    }

    public function getPublicacion($idpublicacion)
    {
        $this->db->query("SELECT * FROM publicaciones WHERE idpublicacion = :id");
        $this->db->bind(":id", $idpublicacion);
        return $this->db->register();
    }

    public function rowLikes($datos)
    {
        $this->db->query("SELECT * FROM likes WHERE iduser = :iduser AND idpublicacion = :idpublicacion");
        $this->db->bind(":iduser", $datos["idusuario"]);
        $this->db->bind(":idpublicacion", $datos["idpublicacion"]);

        return $this->db->rowCount();

    }

    public function rowLikesPublicacion($datos)
    {

        $this->db->query("SELECT * FROM likes WHERE  idpublicacion = :idpublicacion");
        $this->db->bind(":idpublicacion", $datos["idpublicacion"]);

        return $this->db->rowCount();

    }

    public function rowComentsPublicacion($datos)
    {
        $this->db->query("SELECT * FROM comentarios WHERE  idpublicacion = :idpublicacion");
        $this->db->bind(":idpublicacion", $datos["idpublicacion"]);

        return $this->db->rowCount();
    }

    public function rowCompartidoPublicacion($datos)
    {
        $this->db->query("SELECT * FROM compartir WHERE  idpublicacion = :idpublicacion");
        $this->db->bind(":idpublicacion", $datos["idpublicacion"]);

        return $this->db->rowCount();
    }
    public function addLike($datos)
    {
        $this->db->query("INSERT INTO likes (idpublicacion,iduser) VALUES(:idpublicacion,:iduser)");
        $this->db->bind(":idpublicacion", $datos["idpublicacion"]);
        $this->db->bind(":iduser", $datos["idusuario"]);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }

    public function addShare($datos)
    {
        $this->db->query("INSERT INTO compartir (idpublicacion,idusuario) VALUES(:idpublicacion,:iduser)");
        $this->db->bind(":idpublicacion", $datos["idpublicacion"]);
        $this->db->bind(":iduser", $datos["idusuario"]);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }
    public function rowShare($datos)
    {
        $this->db->query("SELECT * FROM compartir WHERE idusuario = :idusuario AND idpublicacion = :idpublicacion");
        $this->db->bind(":idusuario", $datos["idusuario"]);
        $this->db->bind(":idpublicacion", $datos["idpublicacion"]);

        $tipo = $this->db->rowCount() > 0 ? true : false;
        return $tipo;

    }

    public function deleteShare($datos)
    {
        $this->db->query("DELETE FROM compartir WHERE idpublicacion = :idpublicacion AND idusuario = :idusuario");
        $this->db->bind(":idpublicacion", $datos["idpublicacion"]);
        $this->db->bind(":idusuario", $datos["idusuario"]);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }

    public function deleteLike($datos)
    {
        $this->db->query("DELETE FROM likes WHERE idpublicacion = :idpublicacion AND iduser = :iduser");
        $this->db->bind(":idpublicacion", $datos["idpublicacion"]);
        $this->db->bind(":iduser", $datos["idusuario"]);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }

    public function addComentario($datos)
    {
        $this->db->query("INSERT INTO comentarios (idpublicacion,iduser,contenidoComentario)VALUES(:idpublicacion,:iduser,:contenido)");
        $this->db->bind(":idpublicacion", $datos["idpublicacion"]);
        $this->db->bind(":iduser", $datos["iduser"]);
        $this->db->bind(":contenido", $datos["comentario"]);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;

    }

    public function getComentarios()
    {
        $this->db->query("SELECT * FROM consulta_comentarios ORDER BY idcomentario DESC");
        return $this->db->registers();
    }

    public function getShares($idusuario)
    {
        $this->db->query("SELECT * FROM compartir WHERE idusuario = :id");
        $this->db->bind(":id", $idusuario);
        return $this->db->registers();
    }

    public function getLikes($idusuario)
    {
        $this->db->query("SELECT * FROM likes WHERE iduser = :id");
        $this->db->bind(":id", $idusuario);
        return $this->db->registers();
    }

    public function deleteComentario($idcomentario)
    {
        $this->db->query("DELETE FROM comentarios WHERE idcomentario = :idcomentario");
        $this->db->bind(":idcomentario", $idcomentario);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;

    }

    public function getUsersShares($idpublicacion)
    {
        $this->db->query("CALL consulta_publicacion_compartida(:id)");
        $this->db->bind(":id", $idpublicacion);
        return $this->db->registers();
    }

    public function getUsersLikes($idpublicacion)
    {
        $this->db->query("CALL consulta_publicacion_megusta(:id)");
        $this->db->bind(":id", $idpublicacion);
        return $this->db->registers();
    }

    // Eliminar publicacion y registros subyacentes
    public function eliminarPublicacion($idpublicacion)
    {
        $this->db->query("DELETE  FROM publicaciones WHERE idpublicacion = :id");
        $this->db->bind(":id", $idpublicacion);

        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;

    }
    public function deleteCompartidos($idpublicacion)
    {
        $this->db->query("DELETE FROM compartir where idpublicacion = :idpublicacion");
        $this->db->bind(":idpublicacion", $idpublicacion);
        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }

    public function deleteComentarios($idpublicacion)
    {
        $this->db->query("DELETE FROM comentarios where idpublicacion = :idpublicacion");
        $this->db->bind(":idpublicacion", $idpublicacion);
        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }

    public function deleteLikes($idpublicacion)
    {
        $this->db->query("DELETE FROM likes where idPublicacion = :idpublicacion");
        $this->db->bind(":idpublicacion", $idpublicacion);
        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }

    // actualizar publicacion
    public function updatePublicacion($datos)
    {
        $this->db->query("UPDATE publicaciones SET contenidoPublicacion = :newcontent where idpublicacion = :idpublicacion");
        $this->db->bind(":newcontent", $datos["newcontent"]);
        $this->db->bind(":idpublicacion", $datos["idpublicacion"]);
        $tipo = $this->db->execute() == true ? true : false;
        return $tipo;
    }
    public function verificarPublicacion($idpublicacion)
    {
        $this->db->query("SELECT * FROM publicaciones WHERE idpublicacion = :idpublicacion");
        $this->db->bind(":idpublicacion", $idpublicacion);
        $this->db->execute();
        $tipo = $this->db->rowCount() > 0 ? true : false;
        return $tipo;
    }
}
