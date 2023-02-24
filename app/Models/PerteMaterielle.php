<?php

namespace app\Models;

class PerteMaterielle 
{
    private $id;
    private $description_mat;
    private $prix_perte;
    private $date_perte;

    function __construct( $id, $description_mat, $prix_perte, $date_perte )
    {
        $this->id = $id;
        $this->description_mat = $description_mat;
        $this->prix_perte = $prix_perte;
        $this->date_perte = $date_perte;
    }

    function getId() {
        return $this->id;
    }
    function setId($id) {
        $this->id = $id;
    }

    function getDescriptionMat() {
        return $this->description_mat;
    }
    function setDescriptionMat($description_mat) {
        $this->description_mat = $description_mat;
    }

    function getPrixPerte() {
        return $this->prix_perte;
    }
    function setPrixPerte($prix_perte) {
        $this->prix_perte = $prix_perte;
    }

    function getDatePerte() {
        return $this->date_perte;
    }
    function setDatePerte($date_perte) {
        $this->date_perte = $date_perte;
    }
}