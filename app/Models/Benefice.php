<?php

namespace app\Models;

class Benefice 
{
    private $id;
    private $total_bénéfices;
    private $total_pert;
    private $prix_hors_taxe;
    private $date_bénéfices;

    function __construct($id, $total_bénéfices, $total_pert, $prix_hors_taxe,$date_bénéfices) {
        $this->id = $id;
        $this->total_bénéfices = $total_bénéfices;
        $this->total_pert = $total_pert;
        $this->prix_hors_taxe = $prix_hors_taxe;
        $this->date_bénéfices = $date_bénéfices;
    }

    function getId(){
        return $this->id;
    }
    function setId($id){
        $this->id = $id;
    }

    function getTotalBénéfices() {
        return $this->total_bénéfices;
    }
    function setTotalBénéfices($total_bénéfices) {
        $this->total_bénéfices = $total_bénéfices;
    }

    function getTotalPert() {
        return $this->total_pert;
    }
    function setTotalPert($total_pert) {
        $this->total_pert = $total_pert;
    }

    function getPrixHorsTaxe() {
        return $this->prix_hors_taxe;
    }
    function setPrixHorsTaxe($prix_hors_taxe) {
        $this->prix_hors_taxe = $prix_hors_taxe;
    }

    function getDateBénéfices() {
        return $this->date_bénéfices;
    }
    function setDateBénéfices($date_bénéfices) {
        $this->date_bénéfices = $date_bénéfices;
    }


}