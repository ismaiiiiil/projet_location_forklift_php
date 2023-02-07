<?php
namespace app\Models;


class PrixMachine {
    private $id;
    private $prix_jour;
    private $prix_semaine;
    private $prix_mois;

    function __construct($id, $prix_jour, $prix_semaine, $prix_mois)
    {
        $this->id = $id;
        $this->prix_jour = $prix_jour;
        $this->prix_semaine = $prix_semaine;
        $this->prix_mois = $prix_mois;
    }

    function getId(){
        return $this->id;
    }
    function setId($id){
        $this->id = $id;
    }
    
    function getPrixJour(){
        return $this->prix_jour;
    }
    function setPrixJour($prix_jour){
        $this->prix_jour = $prix_jour;
    }

    function getPrixSemaine(){
        return $this->prix_semaine;
    }
    function setPrixSemaine($prix_semaine){
        $this->prix_semaine = $prix_semaine;
    }

    function getPrixMois(){
        return $this->prix_mois;
    }
    function setPrixMois($prix_mois){
        $this->prix_mois = $prix_mois;
    }

}