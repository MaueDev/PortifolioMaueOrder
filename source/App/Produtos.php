<?php 

namespace Source\App;

use CoffeeCode\Router\Router;
use DbConnect;
use PDOException;
use Source\DataBaseClass\produtos;

class Produto 
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
            require (dirname(1)."/views/produtos.php");
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


            require (dirname(1)."/views/produtoscriar.php");
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
}