<?php
session_start();
// llamamos las librerias
spl_autoload_register(function ($files) {
    require_once "libs/" . $files . ".php";
	    
});
// llamando al config
require_once "config/config.php";

// llamandao a la url herper
require_once "helpers/url_helper.php";
