<?php
class Ordinateur {
    
    const IMG_DIR = 'img/';
    
    private static $compteur = 0;    

    private $image;
    private $idOrdiBDD;
    private $OS;
    
    public static function getCompteur(){
        return self::$compteur;
    }    
    	
    public function __construct($uneImage, $OS, $idOrdiBDD) {
        
        // Si le fichier image n'est pas renseigné
        // on construit le nom du fichier à partir de la couleur et de la classe
        //  d'appartenance
    
        
        $prefixe = "ordi_";
        $uneImage = $prefixe. $OS . '.png';
        $this->OS = $OS;
        
	// Si le fichier image n'est pas trouvé
        // on affecte l'image par défaut
        if (!file_exists(self::IMG_DIR.$uneImage)) {
            $uneImage = 'indeterminee.jpg';
        }
        
        
        $this->image   = $uneImage;
        $this->idOrdiBDD = $idOrdiBDD;
        $this->unOrdinateurProf = array();
		
        // Incrémentation du nombre d'instances créées
		self::$compteur++;		
    }

    public function __destruct() {
        // echo "Une chaise $this->couleur meurt...<br/>";
		self::$compteur--;
    }

    public final function setOrdinateurProf($ordinateurProf){
        $this->unOrdinateurProf = $ordinateurProf;
    }

    public function getImage() {
        return $this->image;
    }

    public function __toString() {
        return get_class($this) . "($this->image)";	
    }
      
    public function dessiner() {
		echo "<img src='".self::IMG_DIR."$this->image' height='65px' />";
    }	

    public function afficher() {
        echo "Ordinateur ($this->image)<br/>";	
    }     
    public function getIdOrdiBDD(){
        return $this->idOrdiBDD;
    }
}

