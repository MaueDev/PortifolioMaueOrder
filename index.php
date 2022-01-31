<?php
require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

//Controllers
$router->namespace("Source\\App");
$router->group(null);

//LOGAR
$router->get("/","Auth:Login");
$router->get("/logoff","Web:produtos");
$router->post("/","Auth:Logar");
//Home
$router->get("/home","Web:home");

//PRODUTOS
$router->get("/produtos","Web:produtos");
$router->get("/produtos/criar","Web:produtoscriar");
$router->post("/produtos/criar","Web:sendprodutos");

//CLIENTES
$router->get("/clientes/{id}","Web:buscarclientes");
$router->get("/clientes","Web:clientes");
$router->get("/clientes/create","Web:criarclientes");
$router->post("/clientes/create","Web:sendclientes");

//PEDIDO
$router->get("/newpedido/{id}","Web:aguardopedido");
$router->get("/newpedido","Web:novopedido");
$router->post("/newpedido/{id}","Web:setpedidos");
$router->post("/newpedido","Web:novopedido");

//HISTORICO
$router->get("/historico","Web:historico");


$router->dispatch();

if ($router->error()) {
    $router->redirect("/error/{$router->error()}");
}