<?php

class AuthController extends Controller
{

    private $usuario;

    public function __construct()
    {
        error_reporting(0);
        $this->usuario = $this->model("usuario");
        if (isset($_SESSION["logueado"])) {
            redirect("/home");
        }

    }

    public function index()
    {
        $this->view("pages/auth/login");
        session_destroy();
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $datosLogin = [
                "usuario" => trim($_POST["usuario"]),
                "contrasena" => trim($_POST["contrasena"]),
            ];
            if ($datosUsuario = $this->usuario->getUsuario($datosLogin["usuario"])) {
                if ($this->usuario->verificarContrasena($datosUsuario, $datosLogin["contrasena"])) {
                    $_SESSION["logueado"] = true;
                    $_SESSION["privilegio"] = $datosUsuario->idPrivilegio;
                    $_SESSION["usuario"] = $datosUsuario->usuario;
                    $_SESSION["id"] = $datosUsuario->idusuario;
                    if ($this->usuario->perfilVerify($_SESSION["id"]) != null) {
                        $_SESSION["url_img"] = $this->usuario->consultaImgPerfil($_SESSION["id"]);
                    }
                    redirect("/home");

                } else {
                    $_SESSION["errorLogin"] = "Error de auntenticacion";
                    $_SESSION["usuarioe"] = $datosLogin["usuario"];

                    redirect("/auth/login");
                }
            } else {
                $_SESSION["errorLogin"] = "Error de auntenticacion";
                $_SESSION["usuarioe"] = $datosLogin["usuario"];
                redirect("/auth/login");
            }
        } else {
            $this->view("pages/auth/login");
            session_destroy();
        }

    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $datosRegister = [
                "privilegio" => "2",
                "email" => trim($_POST["email"]),
                "usuario" => trim($_POST["usuario"]),
                "sexo" => trim($_POST["sexo"]),
                "contrasena" => password_hash(trim($_POST["pass"]), PASSWORD_BCRYPT),
            ];

            if ($this->usuario->verificarUsuario($datosRegister)) {
                if ($this->usuario->register($datosRegister)) {
                    $_SESSION["successRegister"] = "¡Hurra! " . $datosRegister["usuario"] . " bienvenido a SocialNet.";
                    redirect("/auth/login");
                } else {
                    $_SESSION["usuarioe"] = $datosRegister["email"];
                    $_SESSION["nombree"] = $datosRegister["usuario"];
                    $_SESSION["sexoe"] = $datosRegister["sexo"];
                    $_SESSION["errorRegister"] = "Lo sentimos, no se pudo registrar el usuario.";
                    $this->view("pages/auth/register");
                    session_destroy();

                }
            } else {
                $_SESSION["usuarioe"] = $datosRegister["email"];
                $_SESSION["nombree"] = $datosRegister["usuario"];
                $_SESSION["sexoe"] = $datosRegister["sexo"];
                $_SESSION["errorRegister"] = "Lo sentimos, este usuario no esta disponible.";
                $this->view("pages/auth/register");
                session_destroy();

            }
        } else {
            $this->view("pages/auth/register");
            session_destroy();
        }

    }
    public function recibirToken($token)
    {
        if ($this->usuario->verificarToken($token)) {

            $datosUsuario = $this->usuario->verificarToken($token);
            $_SESSION["logueado"] = true;
            $_SESSION["privilegio"] = $datosUsuario->idPrivilegio;
            $_SESSION["usuario"] = $datosUsuario->usuario;
            $_SESSION["id"] = $datosUsuario->idusuario;
            if ($this->usuario->perfilVerify($_SESSION["id"]) != null) {
                $_SESSION["url_img"] = $this->usuario->consultaImgPerfil($_SESSION["id"]);
            }
            $this->usuario->eliminarToken($datosUsuario->idusuario);
            // $_SESSION["success-email"] = "Cambia la contraseña inmediatamente por favor.";
            redirect("/home/cambioPassword");

        } else {
            $_SESSION["error-email"] = "El tiempo de espera se vencio.";
            redirect("/auth/recuperarContrasena");
        }
    }
    public function recuperarContrasena()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($this->usuario->verificarCorreo(trim($_POST["correo"]))) {

                $usuario = $this->usuario->getUsuarioCorreo(trim($_POST["correo"]));

                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $token = substr(str_shuffle($permitted_chars), 0, 50);
                $url_proyecto = URL_PROYECTO;

                $contenido = '<!DOCTYPE html>';
                $contenido .= '<html lang="en">';
                $contenido .= '<head>';
                $contenido .= '	<meta charset="UTF-8">';
                $contenido .= '	<title>Recuperacion Contraseña | SocialNet</title>';
                $contenido .= '	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>';
                $contenido .= '    <meta name="viewport" content="width=device-width, user-scalable=no" />';
                $contenido .= '    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> ';
                $contenido .= '	   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />';
                $contenido .= '</head>';
                $contenido .= '<body>';
                $contenido .= '<div class="container">';
                $contenido .= '  <p>Hola <b>' . $usuario->usuario . '.</b></p>';
                $contenido .= '  <p>Usted solicitó un restablecimiento de contraseña para su cuenta en SOCIALNET.</p>';
                $contenido .= '<h4>Click en el siguiente link:</h4>';
                $contenido .= "<a href='{$url_proyecto}/auth/recibirToken/{$token}'  >>Entrar a mi cuenta</a>";
                $contenido .= '   ';
                $contenido .= '     <div class="container-fluid nav navbar navbar-default fixed-bottom  bg-primary ">';
                $contenido .= '         <div class="container text-light">';
                $contenido .= '         	<p class="parrafo">&#169; ' . date("Y") . ' SocialNet </p>   ';
                $contenido .= '        </div>';
                $contenido .= '    </div>';
                $contenido .= '</div>';
                $contenido .= '  </body></html>';

                $cabeceras = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $titulo = "Recuperacion de contraseña | SocialNet ";

                if (mail($usuario->correo, $titulo, $contenido, $cabeceras)) {
                    $datos = [
                        "idusuario" => $usuario->idusuario,
                        "token" => $token,
                    ];
                    if ($this->usuario->insertToken($datos)) {
                        $_SESSION["success-email"] = "Revisa tu correo y dale click al enlace.";
                        redirect("/auth/recuperarContrasena");
                    } else {
                        $_SESSION["error-email"] = "Error del token vuelve a intentar.";
                        redirect("/auth/recuperarContrasena");
                    }
                } else {
                    $_SESSION["error-email"] = "El correo no se pudo enviar.";
                    redirect("/auth/recuperarContrasena");
                }
            } else {
                $_SESSION["error-email"] = "El correo ingresado no existe";
                redirect("/auth/recuperarContrasena");
            }
        } else {

            $this->view("pages/auth/recuperarContrasena");
            session_destroy();
        }
    }
}
