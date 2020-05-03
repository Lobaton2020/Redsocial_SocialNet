<?php

class Core
{
    protected $currentController = "HomeController";
    protected $currentMethod = "index";
    protected $parameters = [];
    public function __construct()
    {

        $url = $this->getUrl();
        if (isset($url[0])) {
            if (file_exists("../app/controllers/" . ucwords($url[0]) . "Controller.php")) {
                $this->currentController = ucwords($url[0]) . "Controller";
                unset($url[0]);
            }
        }

        require_once "../app/controllers/" . $this->currentController . ".php";
        $this->currentController = new $this->currentController;

        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        $this->parameters = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController, $this->currentMethod], $this->parameters);

    }

    public function getUrl()
    {

        if (isset($_GET["url"])) {
            $url = trim($_GET["url"], "/");
            // $url = rtrim($_GET["url"], "/");
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);

            return $url;
        }
    }

}
