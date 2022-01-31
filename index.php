<?php
require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

//Controllers
$router->namespace("Source\\App");
$router->group(null);

//LOGAR
$router->post("/","Auth:Logar");
$router->get("/","Auth:Login");
$router->get("/sair","Auth:Logoff");

//Home
$router->get("/home","Web:home");

//PRODUTOS
$router->get("/produtos","Produto:Produtos");
$router->get("/produtos/criar","Produto:ProdutosCriar");
$router->post("/produtos/criar","Produto:SendProdutos");

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