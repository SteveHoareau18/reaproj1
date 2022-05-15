<?php
require_once('Ordinateur.class.php');
class OrdinateurProf extends Ordinateur{
    
    const IMG_DIR = 'img/';
    
    private static $compteur = 0;    

    private $image;
    private $idOrdiProfBDD;


    public static function getCompteur(){
        return self::$compteur;
    }    
    	
    public function __construct($uneImage, $OS, $idOrdiBDD, $idOrdiProfBDD) {
        parent::__construct($uneImage,$OS,$idOrdiBDD);
        $this->idOrdiProfBDD = $idOrdiProfBDD;
        $prefixe = "ordi_";
        $this->image = $prefixe. $OS . '.png';
        // Incrémentation du nombre d'instances créées
		self::$compteur++;		
    }

    public function __destruct() {
        // echo "Une chaise $this->couleur meurt...<br/>";
		self::$compteur--;
    }

    public function __toString() {
        return get_class($this) . "($this->image)";	
    }
    
    public function dessiner() {
		echo "<img name='prof' id='tempImg' src='".self::IMG_DIR.$this->image."' height='65px'>";
        echo "<label for='prof'>Admin</label>";
        echo "<style>#tempImg{ border: 2px black solid;}</style>";
    }
    public function getIdOrdiProfBDD(){
        return $this->idOrdiProfBDD;
    }
}