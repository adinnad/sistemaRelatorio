<?php

spl_autoload_register(function($instancia){
    if(file_exists("controller/".$instancia.".php"))
    {
        require_once "controller/".$instancia.".php";

    }elseif(file_exists("model/".$instancia.".php"))
    {
        require_once "model/".$instancia.".php";

    }elseif(file_exists("rota/".$instancia.".php"))
    {
        require_once "rota/".$instancia.".php";
    }
});