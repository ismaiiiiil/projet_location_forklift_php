<?php
namespace app\Models;


class User {
    private $id;
    private $email;
    private $nom;
    private $prenom;
    private $tel;
    private $is_entreprise;
    private $nom_entreprise;
    private $email_entreprise;
    private $password;

    function __construct($id, $email, $nom, $prenom,
                        $tel, $is_entreprise, $nom_entreprise,
                        $email_entreprise,$password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->tel = $tel;
        $this->is_entreprise = $is_entreprise;
        $this->nom_entreprise = $nom_entreprise;
        $this->email_entreprise = $email_entreprise;
        $this->password = $password;
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

    function getIsEntreprise() {
        return $this->is_entreprise;
    }
    function setIsEntreprise($is_entreprise) {
        $this->is_entreprise = $is_entreprise;
    }

    function getNomEntreprise() {
        return $this->nom_entreprise;
    }
    function setNomEntreprise($nom_entreprise) {
        $this->nom_entreprise = $nom_entreprise;
    }

    function getEmailEntreprise() {
        return $this->email_entreprise;
    }
    function setEmailEntreprise($email_entreprise) {
        $this->email_entreprise = $email_entreprise;
    }
    function getPassword() {
        return $this->password;
    }
    function setPassword($password) {
        $this->password = $password;
    }
}
