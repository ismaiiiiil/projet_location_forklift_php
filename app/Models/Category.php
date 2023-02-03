<?php

namespace app\Models;

class Category {
    private $id;
    private $nom;
    private $image;

    function __construct($id, $nom, $image) 
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->image = $image;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getNom() {
        return $this->nom;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function getImage() {
        return $this->image;
    }

    function setImage($image) {
        $this->image = $image;
    }


}