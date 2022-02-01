<?php
namespace Source\DataBaseClass;

use DbConnect;
use PDO;
use PDOException;

class cliente extends DbConnect
{

    public function all()
    {
        try
        {
            $Con = $this->ReturnCon();
            $Query = $Con->prepare("SELECT * FROM _Clientes");
            $Query->execute();
        }
        catch(PDOException $e)
        {
            return ['ERRO' => $e->getMessage()];
        }
        return $Query;
    }

    public function create($Dados)
    {
        if(isset($Dados['Nome']) and !empty($Dados['Nome']))
        {
            //Verificar as Colunas
            $Colunas = '';
            foreach($Dados as $chave => $valor)
            {
                if(!empty($valor)){
                    $Colunas .= $chave.",";
                }
            }
            //Verificar os Valores
            $Values = '';
            foreach($Dados as $chave => $valor)
            {
                if(!empty($valor)){
                    $Values .= "'".addslashes($valor)."',";
                }
            }
            //Remover Ultima virgula
            $Colunas = substr($Colunas, 0, -1);
            $Values = substr($Values, 0, -1);
            try
            {

                $SQLCODE = "INSERT INTO _Clientes (".$Colunas.") VALUES (".$Values.")";
                $Query = $this->ReturnCon()->prepare($SQLCODE);
                if($Query->execute())
                {
                    return ['SUCESS' => "Cliente adicionado com Sucesso"];
                }
                else
                {
                    return ['ERROR' => "Não foi possivel adicionar o Cliente"];
                }
            }
            catch(PDOException $e)
            {
                return ['ERROR' => $e->getMessage()];
            }
        }
        else
        {
            return ['ERROR' => "Campo Nome é obrigatorio"];

        }
    }

    public function FindCliente($id)
    {
        try
        {
            $Query = $this->ReturnCon()->prepare("SELECT * FROM _Clientes WHERE id = ? ");
            $Query->bindValue(1,$id);
            $Query->execute();
            if($Query->rowCount()>0)
            {
                return $Query->fetch(PDO::FETCH_ASSOC);
            }
            else
            {
                return ["ERROR" => "Cliente não encontrado"];
            }
        }
        catch(PDOException $e)
        {
            return ["ERROR:" => $e->getMessage()];
        }
    }

    public function FindClienteJSON($id)
    {
        try
        {
            $Query = $this->ReturnCon()->prepare("SELECT * FROM _Clientes WHERE id = ? ");
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

    public function delete($id)
    {
        /*Futuramente*/
    }

}