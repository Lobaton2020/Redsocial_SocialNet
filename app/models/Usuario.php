<?php

class Usuario
{
    private $db;

    public function __construct()
    {
        $this->db = new Base();
    }

    public function getUsuario($usuario)
    {
        $this->db->query("SELECT * FROM usuarios WHERE usuario = :usuario");
        $this->db->bind(":usuario", $usuario);
        return $this->db->register();
    }
    public function getUsuarioCorreo($correo)
    {
        $this->db->query("SELECT * FROM usuarios WHERE correo = :correo");
        $this->db->bind(":correo", $correo);
        return $this->db->register();
    }

    public function getPerfil($idUsuario)
    {
        $this->db->query("SELECT * FROM perfil WHERE idusuario = :id");
        $this->db->bind(":id", $idUsuario);
        return $this->db->register();
    }

    public function verificarContrasena($datosUsuario, $contrasena)
    {
        if (password_verify($contrasena, $datosUsuario->contrasena)) {
            return true;
        } else {
            return false;
        }
    }

    public function getHashContrasena($idusuario)
    {
        $this->db->query("SELECT contrasena FROM usuarios WHERE idusuario = :idusuario");
        $this->db->bind(":idusuario", $idusuario);
        return $this->db->register();

    }

    public function updatePassword($datos)
    {
        $this->db->query("UPDATE usuarios SET contrasena = :contrasena  WHERE idusuario = :idusuario");
        $this->db->bind(":contrasena", $datos["clave-nueva"]);
        $this->db->bind(":idusuario", $datos["id-usuario"]);
        $tipo = $this->db->execute() === true ? true : false;
        return $tipo;

    }

    public function insertToken($datos)
    {
        $this->db->query("UPDATE usuarios SET token = :token  WHERE idusuario = :idusuario");
        $this->db->bind(":token", $datos["token"]);
        $this->db->bind(":idusuario", $datos["idusuario"]);
        $tipo = $this->db->execute() === true ? true : false;
        return $tipo;

    }

    public function eliminarToken($idusuario)
    {
        $this->db->query("UPDATE usuarios SET token = :token  WHERE idusuario = :idusuario");
        $this->db->bind(":token", null);
        $this->db->bind(":idusuario", $idusuario);
        $tipo = $this->db->execute() === true ? true : false;
        return $tipo;

    }

    public function verificarToken($token)
    {
        $this->db->query("SELECT * FROM usuarios WHERE token = :token");
        $this->db->bind(":token", $token);
        return $this->db->register();

    }
    public function verificarUsuario($datosUsuario)
    {
        $this->db->query("SELECT usuario FROM usuarios WHERE usuario = :usuario OR correo = :correo");
        $this->db->bind(":usuario", $datosUsuario["usuario"]);
        $this->db->bind(":correo", $datosUsuario["email"]);
        if ($this->db->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function register($datosUsuario)
    {
        $this->db->query("INSERT INTO usuarios(idprivilegio,correo,usuario,sexo,contrasena) VALUES(:privilegio,:correo,:usuario,:sexo,:contrasena)");
        $this->db->bind(":privilegio", $datosUsuario["privilegio"]);
        $this->db->bind(":correo", $datosUsuario["email"]);
        $this->db->bind(":usuario", $datosUsuario["usuario"]);
        $this->db->bind(":sexo", $datosUsuario["sexo"]);
        $this->db->bind(":contrasena", $datosUsuario["contrasena"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function insertarPerfil($datosPerfil)
    {
        $this->db->query("INSERT INTO perfil (idusuario,fotoPerfil,fotoPortada,nombreCompleto)values(:idusuario,:ruta,:portada,:nombrecompleto)");
        $this->db->bind(":idusuario", $datosPerfil["idusuario"]);
        $this->db->bind(":ruta", $datosPerfil["ruta"]);
        $this->db->bind(":portada", $datosPerfil["portada"]);
        $this->db->bind(":nombrecompleto", $datosPerfil["nombrecompleto"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function consultaImgPerfil($idusuario)
    {
        $this->db->query("SELECT fotoPerfil FROM perfil WHERE idusuario = :idusuario");
        $this->db->bind(":idusuario", $idusuario);

        return $this->db->register()->fotoPerfil;

    }

    public function perfilVerify($idusuario)
    {
        $this->db->query("SELECT fotoPerfil FROM perfil WHERE idusuario = :idusuario");
        $this->db->bind(":idusuario", $idusuario);

        return $this->db->rowCount();

    }

    public function verificarCorreo($correo)
    {
        $this->db->query("SELECT correo FROM usuarios WHERE correo = :correo");
        $this->db->bind(":correo", $correo);

        $tipo = $this->db->rowCount() > 0 ? true : false;
        return $tipo;

    }

}
