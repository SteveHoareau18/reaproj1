<?php

require_once('ChaiseBureau.class.php');

class Salle {

	private  $nomSalle;
	private  $capaciteSalle;
	private  $mesChaises;    
	private $unOrdiProf;
	private $estSalleInfo;

	public  function __construct($unNom, $uneCapacite, $estSalleInfo = false) {
            $this->nomSalle = $unNom;
            $this->capaciteSalle = $uneCapacite;
            $this->mesChaises = new ArrayObject();
			$this->estSalleInfo = $estSalleInfo;
            $this->unOrdiProf = array();
	}

	public final function estSalleInfo(){
		return $this->estSalleInfo;
	}

	public final  function getNom() {
            return $this->nomSalle;
	}

	public final  function getCapacite() {
            return $this->capaciteSalle;
	}

	public final  function getNbChaise() {
            return $this->mesChaises->count();
	}

	public final  function getNbChaiseSimple() {
            $nbSimple = 0;
            foreach ($this->mesChaises as $uneChaise) {
                if (get_class($uneChaise) == 'Chaise') {
                    $nbSimple++;
                }
            }
            return $nbSimple;
        }

	public final  function getNbChaiseBureau() {
            $nbBureau = 0;
            foreach ($this->mesChaises as $uneChaise) {
                if (get_class($uneChaise) == 'ChaiseBureau') {
                    $nbBureau++;
                }
            }
            return $nbBureau;
        }  

	public final  function getChaiseAt($unIndexChaise) {
            if ($this->mesChaises->offsetExists($unIndexChaise)) {
                return $this->mesChaises->offsetGet($unIndexChaise);
            } else {
                throw new Exception('Cet index n\'est pas valide !'); 
            }			
	}   

	public final  function getChaiseAtPos($unePosition) {

            if ($unePosition >= 1 && $unePosition <= $this->getNbChaise()) {
                $pos = 0;
                foreach ($this->mesChaises as $uneChaise) {
                    $pos++;
                    if ($pos == $unePosition) {
                        return $uneChaise;
                    }
                }
            } else {
                throw new Exception('Cette position n\'est pas valide !'); 
            }
	}    

	public final  function dessiner() {
            foreach ($this->mesChaises as $uneChaise) {
                $uneChaise->dessiner();
            }
	}

	public final  function ajouter($uneChaise) {
            $this->mesChaises->append($uneChaise);
	}

	public final  function enlever($unIndexChaise) {
            $this->mesChaises->offsetUnset($unIndexChaise);
	}

    public final function getMesChaises(){
        return $this->mesChaises;
    }

    public final function getNbOrdiProf(){
        if(empty($this->unOrdiProf)){
            return 0;
        }
        return 1;
    }

    public final function setOrdiProf($unOrdiProf){
        $this->unOrdiProf = $unOrdiProf;
    }

    public final function getOrdiProf(){
        return $this->unOrdiProf;
    }

	public final  function __toString() {
            return "Salle " . $this->nomSalle . ", capacité " . $this->capaciteSalle .
                    " (" . $this->getNbChaise() . " chaise(s) présente(s))" ;
	}
}