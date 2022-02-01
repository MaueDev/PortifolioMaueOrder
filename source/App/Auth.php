<?php
namespace Source\App;

use CoffeeCode\Router\Router;
use DbConnect;
use PDOException;

class Auth
{
    public function __construct()
    {
        session_start();
        require(__DIR__."/Helpers/Validations.php");
        IsLoggedIn("/home");//Verifica se já está logado
    }

    public function to($Link)
    {
        $router = new Router(URL_BASE);
        $router->redirect($Link);
    }

    public function login($data)
    {
        echo ErrorOrSuccess($data);
        require (dirname(1)."/views/login.views.php");
    }

    public function Logar($data)
    {
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
                    $data = ["ERROR" => "Usuario ou Senha não encontrado."];
                    $this->login($data);
                }
            }
            catch(PDOException $e)
            {
                $data = ["ERROR" => $e->getMessage()];
                $this->login($data);
            }
        }
        else
        {
            $data = ["ERROR" => "Preencha os dados"];
            $this->login($data);
        }
    }

    public function Logoff($data)
    {
        if(session_destroy())
        {
            $this->to("/");
        }
    }
}