<?php

namespace Source\App;

use DbConnect;
use PDOException;
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

    public function login($data)
    {
        if(isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN)
        {
            $this->to('/home');    
        }
        if(isset($data["erro"]))
        {
            echo "<div class=\"Error\"><small>".$data["erro"]."</small></div> ";
            $data = null;
        }
        require (dirname(1)."/views/login.php");
    }

    public function logar($data)
    {
       
        if(isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN)
        {
            $this->to('/home');    
        }
        if(!empty($data))
        {
            try
            {
                $Con = new DbConnect();
                $Con = $Con->ReturnCon();
                $SQL = "select id from _login where user = ? and password = ?";
                $query = $Con->prepare($SQL);
                $query->bindValue(1, $data["User"]);
                $query->bindValue(2, md5($data["Password"]));
                $query->execute();
                if($query->rowCount() > 0)
                {
                    $_SESSION["LOGADO"] = TOKEN;
                    header("Location: ./home");
                    die();
                }
                else
                {
                    $data = ["erro" => "Usuario ou Senha não encontrado."];
                    $this->login($data);
                }
            }
            catch(PDOException $e)
            {
                $data = ["erro" => $e->getMessage()];
                $this->login($data);
            }
        }
        else
        {
            $data = ["erro" => "Preencha os dados"];
            $this->login($data);
        }
    }

    public function home($data)
    {
        if(isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN)
        {
            require (dirname(1)."/views/home.php");
        }
    }

    public function produtos($data)
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
            require (dirname(1)."/views/produtos.php");
        }
    }

    public function produtoscriar($data)
    {
        if(isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN)
        {   
            //Caso Ocorrer Erro
            if(isset($data["ERRO"]))
            {
                echo "<div class=\"Error\" style=\"margin-top:70px\"><small>".$data["ERRO"]."</small></div> ";
                $data = "";
            }


            require (dirname(1)."/views/produtoscriar.php");
        }
    }

    public function sendprodutos($data)
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

    public function clientes($data)
    {
        if (isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN) 
        {
            $Cliente = new cliente;
            $Clientes = $Cliente->all();
            require (dirname(1)."/views/clientes.php");
        }
    }

    public function buscarclientes($data)
    {
        if (isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN) 
        {
            $FindCliente = new cliente;
            $Cliente = $FindCliente->FindCliente($data["id"]);
            require (dirname(1)."/views/buscarclientes.php");
        }
    }

    public function criarclientes($data)
    {
        if (isset($_SESSION["LOGADO"]) and $_SESSION["LOGADO"] == TOKEN) 
        {

                require (dirname(1)."/views/createCliente.php");
        }
    }

    public function sendclientes($data)
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

    public function novopedido($data)
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
  
            require (dirname(1)."/views/pedido.php");
        }
    }

    public function aguardopedido($data)
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
            require (dirname(1)."/views/pedidoiniciada.php");
            }
            else
            {
                
                $this->to("/newpedido");
            }
        }
    }

    public function setpedidos($data)
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
            elseif(isset($data['idProduto']))
            {
                $Pedido = $Pedido->SetProduto($data['idProduto'],$data["id"],$data["qtdProduto"]);
                if($Pedido)
                {
                    $this->aguardopedido($data);
                }
            }
            elseif($data['FinalizarVenda'])
            {
                $Pedido = $Pedido->FinalizeOrder($data['id']);
                if($Pedido)
                {
                    
                    $this->to("/historico");
                }
            }
        }
    }
    
    public function historico($data)
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
            require (dirname(1)."/views/historicovenda.php");
        }
    }
}