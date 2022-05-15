<?php

class Connexion{

    private $cnx;

    public function __construct($login,$mdp,$hote,$name){
        $this->cnx = new PDO('mysql:host='.$hote.';dbname='.$name, $login, $mdp);
    }

    public function getConnexion(){
        return $this->cnx;
    }
}

?>