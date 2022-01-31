<?php

namespace Source\DataBaseClass;

use DbConnect;
use PDO;
use PDOException;

class produtos extends DbConnect{
    
    public function all()
    {
        try
        {
            $SQL = "SELECT id, Nome, vr_produto FROM _Produtos";
            $Query = $this->ReturnCon()->prepare($SQL);
            $Query->execute();
        }
        catch(PDOException $e)
        {
           
            echo "ERRO".$e->getMessage();
            die();
        }

        return $Query;
        die();
    }

    public function create($Nome,$vrproduto)
    {
        if(isset($Nome) and isset($vrproduto) and $Nome != null and $vrproduto != null)
        {
            try
            {
                $Nome = $Nome;
                $VrProduto = $vrproduto;
                $SQL = "INSERT INTO _Produtos(Nome, vr_produto) VALUES (?, ?)";
                $Query = $this->ReturnCon()->prepare($SQL);
                $Query->bindValue(1, $Nome);
                $Query->bindValue(2, $VrProduto);
                if($Query->execute())
                {
                    return ["SUCESS" => "Criado Produto ".$Nome." com sucesso"];
                }
                else
                {
             
                    return ['ERRO' =>  "Não foi possivel adicionar o Produto"];
                 
                }
    
            }
            catch(PDOException $e)
            {
                return ['ERRO' => $e->getMessage()];
            }

        }
        else
        {
            return ['ERRO' => "Está faltando parametros"];
        }
    }

    public function FindProduto($id)
    {
        try
        {
            $Query = $this->ReturnCon()->prepare("SELECT id, Nome, vr_produto FROM _Produtos WHERE id = ? ");
            $Query->bindValue(1,$id);
            $Query->execute();
            if($Query->rowCount()>0)
            {
                return $Query->fetch(PDO::FETCH_ASSOC);
            }
            else
            {
                return "ERROR: Produto não encontrado";
            }
        }
        catch(PDOException $e)
        {
            return "Error: ".$e->getMessage();
        }
    }

    //Se caso for utilizar API
    public function FindProdutoJSON($id)
    {
        if(isset($_POST['idproduto']))
        try
        {
            $Query = $this->ReturnCon()->prepare("SELECT id, Nome, vr_produto FROM _Produtos WHERE id = ? ");
            $Query->bindValue(1,$id);
            $Query->execute();
            if($Query->rowCount()>0)
            {
                $Dados = [];

                //Colocando dados dentro de um array
                while($result = $Query->fetch(PDO::FETCH_ASSOC))
                {
                    $Dados[$result['id']] = $result;
                }

                http_response_code(200);
                echo json_encode(array('status' => 'sucess', 'data' => $Dados), JSON_UNESCAPED_UNICODE);
                die();
            }
            else
            {
                http_response_code(505);
                echo json_encode(array('status' => 'ERROR', 'ERRO' => "Nao Possue dados"), JSON_UNESCAPED_UNICODE);
                die();
            }
        }
        catch(PDOException $e)
        {
            http_response_code(505);
            echo json_encode(array('status' => 'ERROR', 'ERRO' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}