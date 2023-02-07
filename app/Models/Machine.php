<?php

namespace app\Models;

class Machine {
    private $id;
    private $nom;
    private $description;
    private $type_carburant;
    private $hauteur_plate_forme;
    private $capacité_levage;
    private $quantity;
    private $id_category ;

    // id machine (image_machines)
    private $image1;
    private $image2;
    private $image3;
    // id machine (prix_machines)
    private $prix_jour;
    private $prix_semaine;
    private $prix_mois;

    function __construct($id, $nom, $description, $type_carburant, 
                    $hauteur_plate_forme, $capacité_levage,
                    $quantity, $id_category,
                    $image1, $image2, $image3,
                    $prix_jour, $prix_semaine, $prix_mois)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->type_carburant = $type_carburant;
        $this->hauteur_plate_forme = $hauteur_plate_forme;
        $this->capacité_levage = $capacité_levage;
        $this->quantity = $quantity;
        $this->id_category = $id_category;
        $this->image1 = $image1;
        $this->image2 = $image2;
        $this->image3 = $image3;
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

    
    function getNom(){
        return $this->nom;
    }
    function setNom($nom){
        $this->nom = $nom;
    }

    function getDescription(){
        return $this->description;
    }
    function setDescription($description){
        $this->description = $description;
    }

    function getTypeCarburant(){
        return $this->type_carburant;
    }
    function setTypeCarburant($type_carburant){
        $this->type_carburant = $type_carburant;
    }

    function getHauteurPlateForm(){
        return $this->hauteur_plate_forme;
    }
    function setHauteurPlateForm($hauteur_plate_forme){
        $this->hauteur_plate_forme = $hauteur_plate_forme;
    }

    function getCapacitéLevage(){
        return $this->capacité_levage;
    }
    function setCapacitéLevage($capacité_levage){
        $this->capacité_levage = $capacité_levage;
    }

    function getQuantity() {
        return $this->quantity;
    }
    function setQuantity($qty) {
        $this->quantity = $qty;
    }

    function getIdCategory(){
        return $this->id_category;
    }
    function setIdCategory($id_category){
        $this->id_category = $id_category;
    }

    function getImage1(){
        return $this->image1;
    }
    function setImage1($image1){
        $this->image1 = $image1;
    }

    function getImage2(){
        return $this->image2;
    }
    function setImage2($image2){
        $this->image2 = $image2;
    }

    function getImage3(){
        return $this->image3;
    }
    function setImage3($image3){
        $this->image3 = $image3;
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