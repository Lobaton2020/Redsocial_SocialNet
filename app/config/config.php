<?php

// definicion de constantes del  la base de datos

define("DB_HOST", "localhost");
define("DB_NAME", "redsocial");
define("DB_USER", "root");
define("DB_PASSWORD", "12345");

// definicion de contantes del proyecto
define("URL_APP", dirname(__DIR__));
define("URL_PROYECTO", $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"] . dirname(str_replace(basename($_SERVER["PHP_SELF"]), "", $_SERVER["PHP_SELF"])));
define("URL_PROYECTO_STATIC", URL_PROYECTO . "/");
define("NAME_PROYECTO", "Red Social");
