<?php
namespace app\Models;

class Admin {
    private $id;
    private $email;
    private $nom;
    private $prenom;
    private $tel;
    private $admin_profile;

    function __construct($id, $email, $nom, $prenom,
                        $tel, $admin_profile) {
        $this->id = $id;
        $this->email = $email; 
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->tel = $tel;
        $this->admin_profile = $admin_profile;
    }

    function getId() {
        return $this->id;
    }
    function setId($id) {
        $this->id = $id;
    }

    function getEmail() {
        return $this->email;
    }
    function setEmail($email) {
        $this->email = $email;
    }

    function getNom() {
        return $this->nom;
    }
    function setNom($nom) {
        $this->nom = $nom;
    }

    function getPrenom() {
        return $this->prenom;
    }
    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }
    function getTel() {
        return $this->tel;
    }
    function setTel($tel) {
        $this->tel = $tel;
    }

    function getAdminProfile() {
        return $this->admin_profile;
    }
}