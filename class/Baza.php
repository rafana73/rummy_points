<?php

class Baza {
    
    private $host;
    private $dbname;
    private $user;
    private $pass;
    
    public function __construct($host, $dbname, $user, $pass) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->pass = $pass;
    }
    
    public function polacz(): object {
        try {
            return $db = new PDO ("mysql: host=$this->host; dbname=$this->dbname; charset=utf8", $this->user, $this->pass, [
                PDO::ATTR_EMULATE_PREPARES => false, 
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $ex) {
            exit ("brak połączenia z bazą");
            //echo $ex->getTraceAsString();
        }
    }
}