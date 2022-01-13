<?php

spl_autoload_register(function($new){
    if(file_exists("Controller/".$new.".php"))
    {
        require_once "Controller/".$new.".php";
    }
    elseif(file_exists("Rota/".$new.".php"))
    {
        require_once "Rota/".$new.".php";
    }elseif(file_exists("Model/".$new.".php"))
    {
        require_once "Model/".$new.".php";
    }elseif(file_exists("Model/DAO/".$new.".php"))
    {
        require_once "Model/DAO/".$new.".php";
    }
});
?>