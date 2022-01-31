<?php

define("URL_BASE", "");
define("TOKEN", md5(date("Y-d-M")));

/*DB*/

class DbConnect
{
    private $username = "seuusuariodb";
    private $password = "suasenhadb";
    private $Con;
    public function __construct()
    {
        try 
        {
            $conn = new PDO('mysql:host=seuhost;dbname=seubancodedados', $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->Con = $conn;
        } catch(PDOException $e) {
            return 'ERROR: ' . $e->getMessage();
        }
    }
    public function ReturnCon()
    {
        return $this->Con;
    }
}