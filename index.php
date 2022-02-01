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
$router->get("/produtos","Web:Produtos");
$router->get("/produtos/criar","Web:ProdutosCriar");
$router->post("/produtos/criar","Web:SendProdutos");

//CLIENTES
$router->get("/clientes/{id}","Web:BuscarClientes");
$router->get("/clientes","Web:Clientes");
$router->get("/clientes/create","Web:CriarClientes");
$router->post("/clientes/create","Web:SendClientes");

//PEDIDO
$router->get("/newpedido/{id}","Web:aguardopedido");
$router->get("/newpedido","Web:NovoPedido");
$router->post("/newpedido/{id}","Web:SetPedidos");
$router->post("/newpedido","Web:NovoPedido");

//HISTORICO
$router->get("/historico","Web:Historico");


$router->dispatch();

if ($router->error()) {
    $router->redirect("/error/{$router->error()}");
}