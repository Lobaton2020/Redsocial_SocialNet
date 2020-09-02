  <?php

    function redirect($url)
    {
        echo "<script> window.location.href= '" . URL_PROYECTO . $url . "'; </script>";
    }

    function showMessage($message, $type)
    {
        if (isset($_SESSION[$message])) :
            echo '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">';
            echo $_SESSION[$message];
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span>';
            echo '</button>';
            echo '</div>';

            unset($_SESSION[$message]);
        endif;
    }

    function arrayDetalle($array)
    {
        echo "<pre>";
        echo var_dump($array);
        echo "</pre>";
    }

    function subirImagen($ruta, $tmp, $rutaCompleta)
    {

        if (!file_exists($ruta)) {
            mkdir($ruta, 0777, true);
            if (file_exists($ruta)) {
                if (move_uploaded_file($tmp, $rutaCompleta)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            if (file_exists($ruta)) {
                if (move_uploaded_file($tmp, $rutaCompleta)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
    // ver hace cuanto se hizo la publicacionn
    function time_ago($timestamp)
    {
        date_default_timezone_set('America/Los_Angeles');
        $time_ago = strtotime($timestamp);
        $current_time = time();
        $time_difference = $current_time - $time_ago;
        $seconds = $time_difference;
        $minutes = round($seconds / 60); // value 60 is seconds
        $hours = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
        $days = round($seconds / 86400); //86400 = 24 * 60 * 60;
        $weeks = round($seconds / 604800); // 7*24*60*60;
        $months = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
        $years = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60
        if ($seconds <= 60) {
            return 'Hace un momento';
        } else if ($minutes <= 60) {
            if ($minutes == 1) {
                return 'Hace un minuto';
            } else {
                return "Hace $minutes minutos";
            }
        } else if ($hours <= 24) {
            if ($hours == 1) {
                return "Hace una hora";
            } else {
                return "Hace $hours horas";
            }
        } else if ($days <= 7) {
            if ($days == 1) {
                return "Ayer";
            } else {
                return "hace $days días";
            }
        } else if ($weeks <= 4.3) //4.3 == 52/12
        {
            if ($weeks == 1) {
                return "Hace una semana";
            } else {
                return "Hace $weeks semanas";
            }
        } else if ($months <= 12) {
            if ($months == 1) {
                return "Hace un mes";
            } else {
                return "Hace $months meses";
            }
        } else {
            if ($years == 1) {
                return "Hace un año";
            } else {
                return "Hace $years años";
            }
        }
    }

    function redirectPublicacion($tipo_redireccion = "", $usuario = "", $numeral = "")
    {
        switch ($tipo_redireccion) {
            case "miperfil":
            case "perfil":

                redirect("/perfil/" . $usuario . "#" . $numeral);
                break;
            case "seguidores":
                redirect("/perfil/getSeguidores/" . $usuario . "#" . $numeral);
                break;
            case "seguidos":
                redirect("/perfil/getSeguidos/" . $usuario . "#" . $numeral);
                break;
            case "busquedaUsuario":
            case "searchuser":
                redirect("/perfil/busquedaUsuario/" . $usuario . "#" . $numeral);
                break;
            default;
                redirect("/home/" . $usuario . "#" . $numeral);
        }
    }

    ?>