<?php
namespace Source\DataBaseClass;

use DateTime;
use DateTimeZone;
use DbConnect;
use PDO;
use PDOException;

class pedidos extends DbConnect
{
    public function all()
    {
        try
        {
            $SQL = "SELECT cp.*, c.Nome FROM `_cad_Pedidos` cp LEFT JOIN `_Clientes` c on cp.idCliente = c.id";
            $Query = $this->ReturnCon()->prepare($SQL);
            $Query->execute();
            while($Pedidos = $Query->fetch(PDO::FETCH_ASSOC))
            {
                //Somar Valor do Pedido
                $ValorPedido = $this->ValuePedido($Pedidos['id']);
                $Pedidos['VrPedido'] = $ValorPedido;
                $Pedido[] = $Pedidos;

            }
            return $Pedido;
        }
        catch(PDOException $e)
        {
            return false;
        }
    }

    public function FindVenda($id)
    {
        try
        {
            $SQL = "SELECT cp.*, c.Nome FROM `_cad_Pedidos` cp LEFT JOIN `_Clientes` c on cp.idCliente = c.id WHERE cp.id = ?";
            $Query = $this->ReturnCon()->prepare($SQL);
            $Query->bindValue(1, $id);
            $Query->execute();
            $Pedido = [];
            while($Pedidos = $Query->fetch(PDO::FETCH_ASSOC))
            {
                //Somar Valor do Pedido
                $ValorPedido = $this->ValuePedido($Pedidos['id']);
                $Pedidos['VrPedido'] = $ValorPedido;
                //Vai Buscar Produtos da Venda
                $Produtos = $this->FindMovProd($Pedidos['id']);
                $Pedidos['Produtos'] = $Produtos;
                $Pedido[] = $Pedidos;

            }
            return  $Pedido;
        }
        catch(PDOException $e)
        {
            http_response_code(505);
            echo json_encode(array('status' => 'ERROR', 'ERRO' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function create()
    {
        try
        {
            $NewData = $this->DataCurrent();
            $SQL = "INSERT INTO `_cad_Pedidos`(DataInicioPedido, DataConclusao, idCliente, VrPedido)VALUES('".$NewData."', NULL, NULL, NULL);";
            $Query = $this->ReturnCon()->prepare($SQL);
            if($Query->execute())
            {
                return ["id" => $this->ReturnCon()->lastInsertId(),"Data" => $NewData];
            }
        }
        catch(PDOException $e)
        {
            http_response_code(505);
            echo 'ERRO: '.$e->getMessage();
            die();
        }
    }

    public function SetClient($idcliente,$idvenda)
    {
        if(isset($idcliente) and isset($idvenda))
        {
            try
            {
                $SQL = "UPDATE _cad_Pedidos SET idCliente= ? WHERE id = ?";
                $Query = $this->ReturnCon()->prepare($SQL);
                $Query->bindValue(1, $idcliente);
                $Query->bindValue(2, $idvenda);
                if($Query->execute())
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            catch(PDOException $e)
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function SetProduto($idProduto,$idVenda,$qtdProduto)
    {
        if(isset($idProduto) and isset($idVenda) and isset($qtdProduto) and $idProduto != null)
        {
            //Buscar dados do produto para completo
            $Produto = new produtos();
            $Produto = $Produto->FindProduto($idProduto);

            try
            {
                $SQL = "INSERT INTO _mv_Pedidos (idVenda, idProduto, VrProduto, qtdProduto, DataAdc) VALUES (?, ?, ?, ?, ?);";
                $Query = $this->ReturnCon()->prepare($SQL);
                $Query->bindValue(1, $idVenda);
                $Query->bindValue(2, $idProduto);
                $Query->bindValue(3, $Produto['vr_produto']);
                $Query->bindValue(4, $qtdProduto);
                $Query->bindValue(5, $this->DataCurrent());

                if($Query->execute())
                {
                    //Somar Valor do Pedido
                    $ValorPedido = $this->ValuePedido($idVenda);
                    $Pedidos['VrPedido'] = $ValorPedido;
                    //Vai Buscar Produtos da Venda

                    $Produtos = $this->FindMovProd($idVenda);
                    $Pedidos['Produtos'] = $Produtos;
                    $Pedido[] = $Pedidos;
                    return true;
                }
                else
                {
                    return false;
                }
            }
            catch(PDOException $e)
            {
               return false;
            }    
        }
        else
        {
            return false;
        }
    }

    public function FinalizeOrder($idVenda)
    {
        if(isset($idVenda))
        {
            try
            {
                $SQL = "UPDATE _cad_Pedidos SET Status = 1 WHERE id = ?";
                $Query = $this->ReturnCon()->prepare($SQL);
                $Query->bindValue(1, $idVenda);
                if($Query->execute())
                {
                    return true;
                }
                else
                {
                    return false;
                }

            }
            catch(PDOException $e)
            {
                return false;
            }
        }
        else
        {
          return false;
        }
    }

    //Se caso eu fosse usar API
    public function DeletarProduto()
    {
        if (isset($_POST['idMvProduto']) and isset($_POST['idVenda'])) 
        {
            try
            {
                $SQL = "DELETE FROM _mv_Pedidos WHERE id = ? and idVenda = ?";
                $Query = $this->ReturnCon()->prepare($SQL);
                $Query->bindValue(1, $_POST['idMvProduto']);
                $Query->bindValue(2, $_POST['idVenda']);
                if($Query->execute())
                {
                    http_response_code(201);
                    echo json_encode(array('status' => 'sucess', 'response' => "Produto Excluido com sucesso"), JSON_UNESCAPED_UNICODE);
                    die();
                }
                else
                {
                    http_response_code(505);
                    echo json_encode(array('status' => 'ERROR', 'ERRO' => 'Nao foi possivel Excluir o produto'), JSON_UNESCAPED_UNICODE);
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
        else
        {
           http_response_code(505);
           echo json_encode(array('status' => 'ERROR', 'ERRO' => "Não foi setado o id do produto ou venda"), JSON_UNESCAPED_UNICODE);
           die();
        }
    }

    private function FindMovProd($idVenda)
    {
        try
        {
            $SQL = "SELECT p.Nome,mp.* FROM `_mv_Pedidos` mp LEFT JOIN `_Produtos` p on mp.idProduto = p.id WHERE mp.idVenda = ?";
            $Query = $this->ReturnCon()->prepare($SQL);
            $Query->bindValue(1, $idVenda);
            $Query->execute();
    
            $Dados = [];
            while($Dado = $Query->fetch(PDO::FETCH_ASSOC))
            {
                $Dados[] = $Dado;
            }
            return $Dados;
            die();

        }
        catch(PDOException $e)
        {
            http_response_code(505);
            echo json_encode(array('status' => 'ERROR', 'ERRO' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    private function ValuePedido($Pedido)
    {
        try
        {
            $SQL = "SELECT SUM(qtdProduto * VrProduto) as valor FROM `_mv_Pedidos` mp  WHERE mp.idVenda = ?";
            $Query = $this->ReturnCon()->prepare($SQL);
            $Query->bindValue(1, $Pedido);
            $Query->execute();
            $Valor = $Query->fetch(PDO::FETCH_ASSOC);
            $this->SetValuePedido($Pedido,$Valor['valor']);
            return $Valor['valor'];

        }
        catch(PDOException $e)
        {
            http_response_code(505);
            echo json_encode(array('status' => 'ERROR', 'ERRO' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    private function SetValuePedido($idPedido,$Value)
    {
        try
        {
            $SQL = "UPDATE _cad_Pedidos SET VrPedido = ? WHERE id = ?";
            $Query = $this->ReturnCon()->prepare($SQL);
            $Query->bindValue(1, $Value);
            $Query->bindValue(2, $idPedido);
            if($Query->execute())
            {
                return true;
            }
            else
            {
                return false;
            }

        }
        catch(PDOException $e)
        {
            http_response_code(505);
            echo json_encode(array('status' => 'ERROR', 'ERRO' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
            die();
        }

    }

    private function DataCurrent($format = 'Y-m-d H:i:s')
    {
        $timezone = new DateTimeZone('America/Sao_Paulo');
        $agora = new DateTime('now', $timezone);
        return $agora->format($format);
    }
}