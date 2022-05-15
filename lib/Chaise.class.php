<?php
class Chaise {
    
    const IMG_DIR = 'img/';
    
    private static $compteur = 0;    
	
    private $couleur;

    private $image;
    private $idChaiseBDD;

    protected $hauteur;
    private $unOrdinateurProf;
    
    public static function getCompteur(){
        return self::$compteur;
    }    
    	
    public function __construct($uneCouleur, $uneImage, $uneHauteur, $idChaiseBDD) {
        $this->couleur = $uneCouleur;
        
        // Si le fichier image n'est pas renseigné
        // on construit le nom du fichier à partir de la couleur et de la classe
        //  d'appartenance
    
        if (get_class($this) == "ChaiseBureau") {
            $prefixe = "chaise-bureau_";
        } else {
            $prefixe = "chaise_";
        }
        $uneImage = $prefixe . $uneCouleur . '.jpg';
        
	// Si le fichier image n'est pas trouvé
        // on affecte l'image par défaut
        if (!file_exists(self::IMG_DIR.$uneImage)) {
            $uneImage = 'indeterminee.jpg';
        }
        
        
        $this->image   = $uneImage;
        $this->hauteur = $uneHauteur;
        $this->idChaiseBDD = $idChaiseBDD;
        $this->unOrdinateurProf = array();
		
        // Incrémentation du nombre d'instances créées
		self::$compteur++;		
    }

    public function __destruct() {
        // echo "Une chaise $this->couleur meurt...<br/>";
		self::$compteur--;
    }
	
    public final function getCouleur() {
        return $this->couleur;
    }

    public final function setOrdinateurProf($ordinateurProf){
        $this->unOrdinateurProf = $ordinateurProf;
    }

    public final function getImage() {
        return $this->image;
    }

    public final function getHauteur(){
        return $this->hauteur;
    }

    public function __toString() {
        return get_class($this) . " $this->couleur ($this->image) H=$this->hauteur";	
    }
      
    public function dessiner() {
		echo "<img src='".self::IMG_DIR."$this->image' height='". $this->hauteur * 2 ."' />";
    }	

    public function afficher() {
        echo "Chaise $this->couleur ($this->image) H=$this->hauteur<br/>";	
    }     
    public function getIdChaise(){
        return $this->idChaiseBDD;
    }
}

