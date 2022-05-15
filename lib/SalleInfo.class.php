<?php

require_once('Salle.class.php');

class SalleInfo extends Salle{

	private  $capaciteOrdi;
	private  $mesOrdinateurs;    

	public  function __construct($unNom, $uneCapacite, $capaciteOrdi) {
            $this->mesOrdinateurs = new ArrayObject();
            $this->capaciteOrdi = $capaciteOrdi;
            parent::__construct($unNom, $uneCapacite, true);
	}

    public final function getCapaciteOrdi(){
        return $this->capaciteOrdi;
    }

    public final  function getOrdiAt($unIndexOrdi) {
        if ($this->mesOrdinateurs->offsetExists($unIndexOrdi)) {
            return $this->mesOrdinateurs->offsetGet($unIndexOrdi);
        } else {
            throw new Exception('Cet index n\'est pas valide !'); 
        }			
    }   

    public final function getMesOrdinateurs(){
        return $this->mesOrdinateurs;
    }

    public final  function getOrdiAtPos($unePosition) {

            if ($unePosition >= 1 && $unePosition <= $this->getCapaciteOrdi()) {
                $pos = 0;
                foreach ($this->mesOrdinateurs as $unOrdi) {
                    $pos++;
                    if ($pos == $unePosition) {
                        return $unOrdi;
                    }
                }
            } else {
                throw new Exception('Cette position n\'est pas valide !'); 
            }
    }    

    public final function getNbOrdinateurs(){
        return $this->mesOrdinateurs->count();
    }

    public final  function ajouterOrdi($unOrdi) {
        if($this->mesOrdinateurs->count() == $this->capaciteOrdi){
            throw new Exception("La capacité des ordinateurs est atteintes!");
        }
        $this->mesOrdinateurs->append($unOrdi);
    }

    public final  function enleverOrdi($unOrdi) {
            $this->mesOrdinateurs->offsetUnset($unOrdi);
    }
}