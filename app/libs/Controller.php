<?php

class Controller
{

    public function model($model)
    {
        $model = ucwords($model);
        require_once "../app/models/" . $model . ".php";

        return new $model;
    }

    public function view($view, $datos = [])
    {

        if (file_exists("../app/views/" . $view . ".php")) {
            require_once "../app/views/" . $view . ".php";

        } else {
            echo "Esta vista no se encuentra disponible";

        }
    }

}
