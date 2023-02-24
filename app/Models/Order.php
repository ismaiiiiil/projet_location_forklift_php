<?php

namespace app\Models;

class Order {
    private $id;
    private $nom_user;
    private $email_user;
    private $id_machine;
    private $number_jours;
    private $qte;
    private $prix;
    private $date_order;
    private $date_fin;
    private $delivrer;
    private $payer;
    private $machine_revenir;

    function __construct( $id,$nom_user, $email_user,$id_machine,$number_jours,
                        $qte,$prix,$date_order,$date_fin ,$delivrer,
                        $payer,$machine_revenir)
    {
        $this->id = $id;
        $this->nom_user = $nom_user;
        $this->email_user = $email_user;
        $this->id_machine = $id_machine;
        $this->number_jours = $number_jours;
        $this->qte = $qte;
        $this->prix = $prix;
        $this->date_order = $date_order;
        $this->date_fin = $date_fin;
        $this->delivrer = $delivrer;
        $this->payer = $payer;
        $this->machine_revenir = $machine_revenir;
    }

    function getId() {
        return $this->id;
    }
    function setId($id) {
        $this->id = $id;
    }

// 
    function getNomUser() {
        return $this->nom_user;
    }
    function setNomUser($nom_user) {
        $this->nom_user = $nom_user;
    }
    function getEmailUser() {
        return $this->email_user;
    }
    function setEmailUser($email_user) {
        $this->email_user = $email_user;
    }

    function getIdMachine() {
        return $this->id_machine;
    }
    function setIdMachine($id_machine) {
        $this->id_machine = $id_machine;
    }

    function getNumberJours() {
        return $this->number_jours;
    }
    function setNumberJours($number_jours) {
        $this->number_jours = $number_jours;
    }


    function getQte() {
        return $this->qte;
    }
    function setQte($qte) {
        $this->qte = $qte;
    }


    function getPrix() {
        return $this->prix;
    }
    function setPrix($prix) {
        $this->prix = $prix;
    }


    function getDateOrder() {
        return $this->date_order;
    }
    function setDateOrder($date_order) {
        $this->date_order = $date_order;
    }
    function getDateFin() {
        return $this->date_fin;
    }
    function setDateFin($date_fin) {
        $this->date_fin = $date_fin;
    }

    
    function getDelivrer() {
        return $this->delivrer;
    }
    function setDelivrer($delivrer) {
        $this->delivrer = $delivrer;
    }

    
    function getPayer() {
        return $this->payer;
    }
    function setPayer($payer) {
        $this->payer = $payer;
    }

    
    function getMachineRevenir() {
        return $this->machine_revenir;
    }
    function setMachineRevenir($machine_revenir) {
        $this->machine_revenir = $machine_revenir;
    }
}
