<?php
require_once('Chaise.class.php');

class ChaiseBureau extends Chaise {
	private  $hauteurMin;
	private  $hauteurMax;
	private $idChaiseBureauBDD;
	public  function __construct($uneCouleur, $uneImage, $uneHauteur, $uneHauteurMin, $uneHauteurMax, $idChaiseBDD, $idChaiseBureauBDD) {

            if ($uneHauteur < $uneHauteurMin || $uneHauteur > $uneHauteurMax || $uneHauteurMax <= $uneHauteurMin) {
                throw new Exception('Création impossible, hauteurs non valides !');              
            }
            
            parent::__construct($uneCouleur, $uneImage, $uneHauteur, $idChaiseBDD);
            $this->hauteurMax = $uneHauteurMax;
            $this->hauteurMin = $uneHauteurMin;
			$this->idChaiseBureauBDD = $idChaiseBureauBDD;
        }

	public final  function getHauteurMin() {
            return $this->hauteurMin;
	}
	public final  function getHauteurMax() {
            return $this->hauteurMax;
	}

	public  function __toString() {
            return parent::__toString() . " ($this->hauteurMin, $this->hauteurMax)";
	}
	public final  function monter($valCran = 4) {
            if ($this->hauteur + $valCran <= $this->hauteurMax) {
		$this->hauteur+= $valCran;
            } else {
                throw new Exception('Attention, butée haute atteinte !');            
            }
	}

	public final  function descendre($valCran = 4) {
            if ($this->hauteur - $valCran >= $this->hauteurMin) {
		$this->hauteur-= $valCran;
            } else {
                throw new Exception('Attention, butée basse atteinte !');                        
            }
	}

	public final function getidChaiseBureau(){
		return $this->idChaiseBureauBDD;
	}
}