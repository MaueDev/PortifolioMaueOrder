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
    }

    public function to($Link)
    {
        $router = new Router(URL_BASE);
        $router->redirect($Link);
    }
    public function home($data)
    {
        if(isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN)
        {
            require (dirname(1)."/views/home.views.php");
        }
    }

    /*Produtos */

    public function Produtos($data)
    {
        if(isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN)
        {
            if(isset($data["SUCESS"]))
            {
                echo "<div class=\"SUCESS\" style=\"margin-top:70px\"><small>".$data["SUCESS"]."</small></div> ";
                $data = "";
            }
            $Produtos = new produtos;
            $allProdutos = $Produtos->all();
            require (dirname(1)."/views/produtos..views.php");
        }
    }

    public function ProdutosCriar($data)
    {
        if(isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN)
        {   
            //Caso Ocorrer Erro
            if(isset($data["ERRO"]))
            {
                echo "<div class=\"Error\" style=\"margin-top:70px\"><small>".$data["ERRO"]."</small></div> ";
                $data = "";
            }
            require (dirname(1)."/views/produtoscriar.views.php");
        }
    }

    public function SendProdutos($data)
    {
        if(isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN)
        { 
            if(!empty($data))
            {
                $Produtos = new produtos;
                $allProdutos = $Produtos->create($data["nome"],$data["vr_produto"]);
                if(!isset($allProdutos["ERRO"]) and isset($allProdutos['SUCESS']))
                {
                    $this->to("/produtos");
                }
                else
                {
                   $this->produtoscriar($allProdutos); 
                }
            }
        }
    }

    /*Cliente */

    public function Clientes($data)
    {
        if (isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN) 
        {
            $Cliente = new cliente;
            $Clientes = $Cliente->all();
            require (dirname(1)."/views/clientes.views.php");
        }
    }

    public function BuscarClientes($data)
    {
        if (isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN) 
        {
            $FindCliente = new cliente;
            $Cliente = $FindCliente->FindCliente($data["id"]);
            require (dirname(1)."/views/buscarclientes.views.php");
        }
    }

    public function CriarClientes($data)
    {
        if (isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN) 
        {
                require (dirname(1)."/views/createCliente.views.php");
        }
    }

    public function SendClientes($data)
    {
        if (isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN) 
        {
            if($data)
            {
                $Cliente = new cliente;
                $NewCliente = $Cliente->create($data);
                if(isset($NewCliente["ERROR"]) and !isset($NewCliente['SUCESS']))
                {
                    echo "<div class=\"Error\" style=\"margin-top:70px\"><small>".$NewCliente["ERROR"]."</small></div> ";
                    $this->criarclientes($data);
                }
                elseif(!isset($NewCliente["ERROR"]) and isset($NewCliente['SUCESS']))
                {
                    echo "<div class=\"SUCESS\" style=\"margin-top:70px\"><small>".$NewCliente['SUCESS']."</small></div> ";
                    $this->to("/clientes");
                }
            }
            else
            {
                echo "<div class=\"Error\" style=\"margin-top:70px\"><small>Preencha os Campos</small></div> ";
                $this->criarclientes($data);
            }
        } 
    }

    /*Clientes */

    public function NovoPedido($data)
    {
        if (isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN) 
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
    }

    public function AguardoPedido($data)
    {
        if (isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN) 
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
            require (dirname(1)."/views/pedidoiniciada.views.php");
            }
            else
            {
                $this->to("/newpedido");
            }
        }
    }

    public function SetPedidos($data)
    {
        if (isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN) 
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
                if($Pedido)
                {
                    $this->to("/historico");
                }
            }
            else
            {
                $this->aguardopedido($data);
            }
        }
    }
    
    public function Historico($data)
    {
        if(isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN)
        {   
            //Caso Ocorrer Erro
            if(isset($data["ERRO"]))
            {
                echo "<div class=\"Error\" style=\"margin-top:70px\"><small>".$data["ERRO"]."</small></div> ";
                $data = "";
            }
            if(isset($data["SUCESS"]))
            {
                echo "<div class=\"SUCESS\" style=\"margin-top:70px\"><small>".$data["SUCESS"]."</small></div> ";
                $data = "";
            }
            $Pedido = new pedidos;
            $Pedido = $Pedido->all();
            require (dirname(1)."/views/historicovenda.views.php");
        }
    }
}