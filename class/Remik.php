<?php

class Remik {

    protected $pdo;
    public function __construct(object $pdo) {
        $this->pdo = $pdo;
    }
    
    public function dodajGracza(string $imie, int $rozgrywka): void {
        $dodaj = $this->pdo -> prepare("INSERT INTO `gracze` VALUES (null, :imie, :data, :id_rozgrywka)");
        $dodaj ->bindValue(":imie",$imie);
        $dodaj ->bindValue(":data",date("Y:m:d"));
        $dodaj ->bindValue(":id_rozgrywka",$rozgrywka);
        $dodaj ->execute();
    }
    
    public function ostaniID_rozgrywki(): ?array {
        $nr = $this->pdo -> query ("SELECT `id_rozgrywka` FROM `gracze` ORDER BY `gracze`.`id_rozgrywka` DESC LIMIT 0 , 1");
        $nrID = $nr ->fetch();
        $nrID == false ? $nrID = null : $nrID;
        return $nrID;
    }
    
    public function getRozgrywka(int $id_rozgrywka): ?array {
        $rozgrywka = $this->pdo -> query ("SELECT * FROM `rozgrywka`R JOIN `gracze`G ON G.`id_gracza` = R.`id_gracza` WHERE R.`id_rozgrywka` = '$id_rozgrywka'");
        return $rozgrywka ->fetchAll();
    }
    
    public function getGracze(int $id_rozgrywka): array {
        $gracze = $this->pdo -> query ("SELECT * FROM `gracze` WHERE `id_rozgrywka` = '$id_rozgrywka'");
        return $gracze ->fetchAll();
    }
    
    public function dodajPunkty(int $id_gracza, $id_rozgrywka, $punkty): void {
        $dodaj = $this->pdo -> prepare("INSERT INTO `rozgrywka`(`id`, `id_gracza`, `id_rozgrywka`, `punkty`, `czas`) VALUES (null, :id_gracza, :id_rozgrywka, :punkty, :czas)");
        $dodaj ->bindValue("id_gracza",$id_gracza);
        $dodaj ->bindValue("id_rozgrywka",$id_rozgrywka);
        $dodaj ->bindValue("punkty",$punkty);
        $dodaj ->bindValue("czas",date("H:i:s"));
        $dodaj ->execute();
    }
    
    public function dataRozgrywek(): array {
        $data = $this->pdo -> query ("SELECT DISTINCT `data`,`id_rozgrywka` FROM `gracze` ORDER BY `data` DESC");
        return $data ->fetchAll();        
    }

}