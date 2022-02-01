<?php

use CoffeeCode\Router\Router;


function ErrorOrSuccess($Or)
{
    if(array_key_exists('ERROR', $Or))
    {
        return "<div class=\"Error\"><small>".$Or["ERROR"]."</small></div> ";
        exit();
    }elseif(array_key_exists("SUCESS", $Or))
    {
        return "<div class=\"SUCESS\" style=\"margin-top:70px\"><small>".$Or["SUCESS"]."</small></div>";
        exit();
    }
}
function IsLoggedIn($location)
{
    if(isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN)
    {
        $router = new Router(URL_BASE);
        $router->redirect($location); 
    }
}