<?php

namespace Source\App;

use Source\DataBaseClass\produtos;
use Source\DataBaseClass\cliente;
use CoffeeCode\Router\Router;
use Source\DataBaseClass\pedidos;

class Web
{
    public function __construct()
    {
        session_start();
        require(__DIR__."/Helpers/Validations.php");
        IsNotLoggedIn();//Verifica se já está logado
    }

    public function to($Link)
    {
        $router = new Router(URL_BASE);
        $router->redirect($Link);
    }
    public function home($data)
    {
        $STATUS = ErrorOrSuccess($data);
        require (dirname(1)."/views/home.views.php");
    }

    /*Produtos */

    public function Produtos($data)
    {
        $STATUS = ErrorOrSuccess($data);
        $Produtos = new produtos;
        $allProdutos = $Produtos->all();
        require (dirname(1)."/views/produtos..views.php");
    }

    public function ProdutosCriar($data)
    { 
        $STATUS = ErrorOrSuccess($data);
        require (dirname(1)."/views/produtoscriar.views.php");
    }

    public function SendProdutos($data)
    { 
        if(!empty($data))
        {
            $Produtos = new produtos;
            $allProdutos = $Produtos->create($data["nome"],$data["vr_produto"]);
            if(!isset($allProdutos["ERROR"]) and isset($allProdutos['SUCCESS']))
            {
                $this->to("/produtos");
            }
            else
            {
                $this->produtoscriar($allProdutos); 
            }
        }
    }

    /*Cliente */

    public function Clientes($data)
    {
        $Cliente = new cliente;
        $Clientes = $Cliente->all();
        require (dirname(1)."/views/clientes.views.php");
    }

    public function BuscarClientes($data)
    {
        $FindCliente = new cliente;
        $Cliente = $FindCliente->FindCliente($data["id"]);
        $STATUS = ErrorOrSuccess($Cliente);
        require (dirname(1)."/views/buscarclientes.views.php");
    }

    public function CriarClientes($data)
    {
        $STATUS = ErrorOrSuccess($data);
        require (dirname(1)."/views/createCliente.views.php");
    }

    public function SendClientes($data)
    {
        if($data)
        {
            $Cliente = new cliente;
            $NewCliente = $Cliente->create($data);
            if(isset($NewCliente["ERROR"]) and !isset($NewCliente['SUCESS']))
            {
                $STATUS = ErrorOrSuccess($NewCliente);
                $this->criarclientes($data);
            }
            elseif(!isset($NewCliente["ERROR"]) and isset($NewCliente['SUCESS']))
            {
                $STATUS = ErrorOrSuccess($NewCliente);
                $this->to("/clientes");
            }
        }
        else
        {
            $STATUS = ErrorOrSuccess($data);
            $this->criarclientes($data);
        }
    }

    /*Clientes */

    public function NovoPedido($data)
    {
        if(isset($data['NewVenda']))
        {
            /*Iniciar Pedido*/
            $Pedido = new pedidos;
            $Pedido = $Pedido->create();
            $this->to("/newpedido/".$Pedido['id']);
        }
        require (dirname(1)."/views/pedido.views.php");
    }

    public function AguardoPedido($data)
    {
        if(isset($data['id']))
        {
            /*Iniciar Pedido*/
            $Pedido = new pedidos;
            $Pedido = $Pedido->FindVenda($data['id']);
            if($Pedido[0]['Status'] == 1)
            {
                $this->to("/newpedido");
            }

            /*Buscar Produtos*/
            $Produtos = new produtos;
            $Produtos = $Produtos->all();

            /*Buscar Cliente */
            $Clientes = new cliente;
            $Clientes = $Clientes->all();
            $STATUS = ErrorOrSuccess($data);
            echo $STATUS;
            require (dirname(1)."/views/pedidoiniciada.views.php");
        }
        else
        {
            $this->to("/newpedido");
        }
    }

    public function SetPedidos($data)
    {
        $Pedido = new pedidos;
        if(isset($data['cliente']))
        {
            $Pedido = $Pedido->SetClient($data['cliente'],$data["id"]);
            if($Pedido)
            {
                $this->aguardopedido($data);
            }
        }
        elseif(isset($data['idProduto']) and $data['idProduto'] != null and !empty($data['idProduto']))
        {
            $Pedido = $Pedido->SetProduto($data['idProduto'],$data["id"],$data["qtdProduto"]);
            if($Pedido)
            {
                $this->aguardopedido($data);
            }
        }
        elseif(isset($data['FinalizarVenda']))
        {
            $Pedido = $Pedido->FinalizeOrder($data['id']);
            if($Pedido and !isset($Pedido['ERROR']))
            {
                $this->to("/historico");
            }
            else
            {
                $Pedido['id'] = $data['id'];
                $this->aguardopedido($Pedido);
            }
        }
        else
        {
            $this->aguardopedido($data);
        }
    }
    
    public function Historico($data)
    {
        //Caso Ocorrer Erro
        $STATUS = ErrorOrSuccess($data);
        $Pedido = new pedidos;
        $Pedido = $Pedido->all();
        require (dirname(1)."/views/historicovenda.views.php");
    }
}