<?php

namespace app\Controllers;

use PDO;
use Exception;
use database\DB;
use PDOException;
use RuntimeException;

class WebSiteController 
{
    private $postData;

    public $errors = [];
    public $valid = [];

    function __construct($post) 
    {
        $this->postData = $post;
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function getInfoWebSite() 
    {
        try {
            $db = new DB();
            $sql = "SELECT * FROM website WHERE id = 1";
            $res = $db::connection()->query($sql);
            return current($res->fetchAll(PDO::FETCH_OBJ));
        } catch (PDOException $e) {
            echo "Error fetching" . $e->getMessage();
        }
        
    }

    public function uploadPhoto($imagePoste , $oldImage = null)
    {
        $dir = "./public/images/website"; // dossier fin timchiw
        $time = time(); // heur
        $name = str_replace(' ', '-', strtolower($imagePoste["name"])); // espace => '-'  , name="image" ->"image" 
        $type = $imagePoste["type"]; // png , jpg .. ?

        $ext = substr($name, strpos($name, '.')); // mnin i9d3 -> image.jpg -> (.jpg)
        $ext = str_replace('.', '', $ext);  // (.jpg) => (jpg)
        $name = preg_replace("/\.[^.\s]{3,4}$/", "", $name); // -,/. -> "" vide
        $imageName = $name . '-' . $time . '.' . $ext; // le nom finale image
        if (move_uploaded_file($imagePoste["tmp_name"], $dir . "/" . $imageName)) { // shemain/public/uploads/image-time.png
            $this->deletePhoto($oldImage);
            return $imageName;
        } //ila mabdlch image tanjibo image l9dima
        return $oldImage;
    }
    public function deletePhoto($name = null)
    {
        $filename = "public/images/website/$name";
        if (file_exists($filename)) {
            unlink($filename);
            return true;
        }
        return false;
    }

    function validateAll() 
    {
        $this->validateNomWebSite();
        $this->validateAdresse1();
        $this->validateAdresse2();
        $this->validateTel1();
        $this->validateTel2();
        $this->validateVille();
        $this->validateLocalisation();
        $this->validateCodePostal();
        $this->validatePays();
        // $this->validateImage('logo');
        // $this->validateImage('favicon');
    }

    function updateWebsite() 
    {
        $nom_website = $this->test_input($this->postData["nom_website"]);$adresse1 = $this->test_input($this->postData["adresse1"]);$adresse2 = $this->test_input($this->postData["adresse2"]);$tel1 = $this->test_input($this->postData["tel1"]);$tel2 = $this->test_input($this->postData["tel2"]);$ville = $this->test_input($this->postData["ville"]);$localisation = $this->test_input($this->postData["localisation"]);$code_postal = $this->test_input($this->postData["code_postal"]);$pays = $this->test_input($this->postData["pays"]);
        $this->validateAll();
        if(
            $this->validateNomWebSite() !== false && $this->validateAdresse1() !== false && $this->validateAdresse2() !== false && $this->validateTel1() !== false && $this->validateTel2() !== false && $this->validateVille() !== false && $this->validateLocalisation() !== false && $this->validateCodePostal() !== false && $this->validatePays() !== false
            // && $this->validateImage('logo') !== false && $this->validateImage('favicon') !== false
        ) 
        {
            try {
                $db = new DB();
                $sql = "UPDATE website 
                        SET nom_website = ? ,logo = ? ,favicon = ? ,adresse1 = ? ,
                        adresse2 = ? ,tel1 = ? ,tel2 = ? ,ville = ? ,localisation = ? ,
                        code_postal = ? ,pays = ?  WHERE id = 1";
                $stmt = $db::connection()->prepare($sql);
                
                $oldFavicon = $this->postData['current_favicon'];
                $oldLogo = $this->postData['current_logo'];
                $faviconFile = $this->uploadPhoto($_FILES["favicon"], $oldFavicon);
                $logoFile = $this->uploadPhoto($_FILES["logo"], $oldLogo);
                
                $stmt->execute([$nom_website, $logoFile, $faviconFile, $adresse1, $adresse2, 
                                $tel1, $tel2, $ville, $localisation, $code_postal, $pays ]);
                BaseController::set('success', "Setting modifier avec success");
                BaseController::redirect("settings");
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    function contactEntreprise() {
        $nom = $this->test_input($this->postData["nom"]);
        $email = $this->test_input($this->postData["email"]);
        $numero = $this->test_input($this->postData["numero"]);
        $message = $this->test_input($this->postData["message"]);

        if(!empty($nom) && !empty($email) && !empty($numero) && !empty($message) )
        {
            $to = "laineis294@gmail.com";
            $subject = 'Un client envoyer un message';

            $headers = "From : <$email>";
            $txt = "you have received an e-mail from : " . $nom 
                        .".\n\n". $message;
            if (mail($to, $subject, $txt, $headers)) {
                BaseController::redirect('contact');
                BaseController::set('success' , "message envoyé avec succès");
            } else {
                BaseController::redirect('contact');
                BaseController::set('warning' , "Failed while sending code!");
            }
        }else {
            BaseController::redirect('contact');
            BaseController::set('error' , "Tous les champs est obligatoire!");
        }
     // ---------------------------

    }
    
    // ---------------------------
    // function Validation
    // ---------------------------

    private function validateNomWebSite()
    {
        $val = $this->test_input($this->postData['nom_website']);
        if (empty($val)) {
            $this->addError('nom_website', 'nom website cannot be empty');
            $result = false;
        } elseif (!preg_match('/^[a-zA-Z0-9\s]{3,20}$/', $val)) {
            $this->addError('nom_website', 'nom website must be 3-20 chars');
            $result = false;
        } else {
            $this->addValid('nom_website', true);
            $result = true;
        }
        return $result;
    }

    private function validateAdresse1()
    {
        $val = $this->test_input($this->postData['adresse1']);
        if (empty($val)) {
            $this->addError('adresse1', 'adresse 1 cannot be empty');
            $result = false;
        } else {
            $this->addValid('adresse1', true);
            $result = true;
        }
        return $result;
    }

    private function validateAdresse2()
    {
        $val = $this->test_input($this->postData['adresse2']);
        if (empty($val)) {
            $this->addError('adresse2', 'adresse 2 cannot be empty');
            $result = false;
        } else {
            $this->addValid('adresse2', true);
            $result = true;
        }
        return $result;
    }

    private function validateTel1()
    {
        $val = $this->test_input($this->postData['tel1']);
        if (empty($val)) {
            $this->addError('tel1', 'Tel 1 cannot be empty');
            $result = false;
        } else {
            $this->addValid('tel1', true);
            $result = true;
        }
        return $result;
    }

    private function validateTel2()
    {
        $val = $this->test_input($this->postData['tel2']);
        if (empty($val)) {
            $this->addError('tel2', 'Tel 2 cannot be empty');
            $result = false;
        } else {
            $this->addValid('tel2', true);
            $result = true;
        }
        return $result;
    }

    private function validateVille()
    {
        $val = $this->test_input($this->postData['ville']);
        if (empty($val)) {
            $this->addError('ville', 'Ville cannot be empty');
            $result = false;
        } else {
            $this->addValid('ville', true);
            $result = true;
        }
        return $result;
    }

    private function validateLocalisation()
    {
        $val = $this->test_input($this->postData['localisation']);
        if (empty($val)) {
            $this->addError('localisation', 'Localisation cannot be empty');
            $result = false;
        } else {
            $this->addValid('localisation', true);
            $result = true;
        }
        return $result;
    }
    // code_postal
    private function validateCodePostal()
    {
        $val = $this->test_input($this->postData['code_postal']);
        if (empty($val)) {
            $this->addError('code_postal', 'Code de postal cannot be empty');
            $result = false;
        } else {
            $this->addValid('code_postal', true);
            $result = true;
        }
        return $result;
    }
    private function validatePays()
    {
        $val = $this->test_input($this->postData['pays']);
        if (empty($val)) {
            $this->addError('pays', 'Pays cannot be empty');
            $result = false;
        } else {
            $this->addValid('pays', true);
            $result = true;
        }
        return $result;
    }

    function validateImage($nameImg)
    { 
        
        $file = $_FILES["$nameImg"];

        // type file 
        $file_extension = explode('.', $file['name']);
        $file_extension = strtolower(end($file_extension));
        $accepted_formate = array('jpeg', 'jpg', 'png');

        $result = "";
        if ($file['size'] == 0) {
            $this->addError("$nameImg", "$nameImg is obligatory");
            $result = false;
        } else {
            $size = $file['size']; // size in byte
            $mb_2 = 2000000;

            if ($size > $mb_2) {
                $this->addError("$nameImg", 'File is too large, Upload less than or equal 2MB');
                $result = false;
            } elseif (in_array($file_extension, $accepted_formate)) {
                $this->addValid("$nameImg", true);
                return true;
            } else {
                $this->addError("$nameImg", $file_extension . ' This is file not allowed !!');
                $result = false;
            }
        }
        return $result;
    }




    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }

    private function addValid($key, $val)
    {
        $this->valid[$key] = $val;
    }
}