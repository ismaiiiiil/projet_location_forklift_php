<?php

namespace app\Controllers;

use PDO;
use Exception;
use database\DB;
use PDOException;
use app\Models\Machine;

class MachineController
{
    private $cpt = 0;
    public $t = [];
    private $postData;
    public $errors = [];
    public $valid = [];

    public function __construct($post_data)
    {
        $this->postData = $post_data;
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function getMachineParCategory($id)
    {
        $db = new DB();
        $sql = 'SELECT * FROM machines
        JOIN image_machines on machines.id_image = image_machines.id
        JOIN prix_machines on prix_machines.id = machines.id_prix
                WHERE id_category =?';

        $result = $db::connection()->prepare($sql);
        $result->execute([$id]);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }
    function getAllMachinSelect() {
        $db = new DB();
        $sql = 'SELECT DISTINCT nom FROM machines
        JOIN image_machines on machines.id_image = image_machines.id
        JOIN prix_machines on prix_machines.id = machines.id_prix';

        $result = $db::connection()->query($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_OBJ);
    }


    function getMachineParId($id)
    {
        try {
            $db = new DB();
            $sql = 'SELECT * FROM machines
            JOIN image_machines on machines.id_image = image_machines.id
            JOIN prix_machines on prix_machines.id = machines.id_prix
                    WHERE machines.id =?';

            $result = $db::connection()->prepare($sql);
            $result->execute([$id]);
            return current($result->fetchAll(PDO::FETCH_OBJ));
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }


    // get Prix Machine Par Id
    function getAllMachinesByName($nom)
    {
        try {
            if(!empty($nom)){
                $db = new DB();
                $sql = 'SELECT *,machines.id as idm FROM machines
                JOIN image_machines on machines.id_image = image_machines.id
                JOIN prix_machines on prix_machines.id = machines.id_prix
                WHERE machines.nom LIKE ?
                ';
    
                $result = $db::connection()->prepare($sql);
                $result->execute(["%". $nom ."%"]);
                while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                    $machine = new Machine(
                        $row->idm,
                        $row->nom,
                        $row->description,
                        $row->type_carburant,
                        $row->hauteur_plate_forme,
                        $row->capacité_levage,
                        $row->quantity,
                        $row->id_category,
                        $row->image1,
                        $row->image2,
                        $row->image3,
                        $row->prix_jour,
                        $row->prix_semaine,
                        $row->prix_mois
                    );
                    $this->t[$this->cpt] = $machine;
                    $this->cpt++;
                }
            }else {
                $this->getAllMachines();
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }



    // get Prix Machine Par Id
    function getAllMachines()
    {
        try {
            $db = new DB();
            $sql = 'SELECT *,machines.id as idm FROM machines
            JOIN image_machines on machines.id_image = image_machines.id
            JOIN prix_machines on prix_machines.id = machines.id_prix
            ';

            $result = $db::connection()->query($sql);
            while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                $machine = new Machine(
                    $row->idm,
                    $row->nom,
                    $row->description,
                    $row->type_carburant,
                    $row->hauteur_plate_forme,
                    $row->capacité_levage,
                    $row->quantity,
                    $row->id_category,
                    $row->image1,
                    $row->image2,
                    $row->image3,
                    $row->prix_jour,
                    $row->prix_semaine,
                    $row->prix_mois
                );
                $this->t[$this->cpt] = $machine;
                $this->cpt++;
            }
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }


    public function uploadPhoto($imagePoste, $oldImage = null)
    {
        $dir = "./../../../public/images"; // dossier fin timchiw
        $time = time(); // heur
        $name = str_replace(' ', '-', strtolower($imagePoste["name"])); // espace => '-'  , name="image" ->"image" 
        $type = $imagePoste["type"]; // png , jpg .. ?

        $ext = substr($name, strpos($name, '.')); // mnin i9d3 -> image.jpg -> (.jpg)
        $ext = str_replace('.', '', $ext);  // (.jpg) => (jpg)
        $name = preg_replace("/\.[^.\s]{3,4}$/", "", $name); // -,/. -> "" vide
        $imageName = $name . '-' . $time . '.' . $ext; // le nom finale image
        if (move_uploaded_file($imagePoste["tmp_name"], $dir . "/" . $imageName)) { // shemain/public/uploads/image-time.png
            return $imageName;
        } //ila mabdlch image tanjibo image l9dima
        return $oldImage;
    }

    public function deletePhoto($name = null)
    {
        $filename = " ../../../public/images/$name";
        if (file_exists($filename)) {
            unlink($filename);
            return true;
        }
        return false;
    }

    function lastIdImageMachine()
    {
        $db = new DB();
        $sql = "SELECT max(id)+1 FROM image_machines";
        return $db::connection()->query($sql)->fetchAll();
    }
    function lastIdPrixMachine()
    {
        $db = new DB();
        $sql = "SELECT max(id)+1 FROM prix_machines";
        return $db::connection()->query($sql)->fetchAll();
    }
    function validateChamps()
    {
        $this->validateNom();
        $this->validateDescription();
        $this->validateTypeCarburant();
        $this->validateHauteurPlateForme();
        $this->validateCapacitéLevage();
        $this->validateQuantity();
        $this->validateIdCategory();
        $this->validatePrixJour();
        $this->validatePrixSemaine();
        $this->validatePrixMois();
    }
    function addMachine()
    {
        $nom = $this->test_input($this->postData['nom']);
        $description = $this->test_input($this->postData['description']);
        $type_carburant = $this->test_input($this->postData['type_carburant']);
        $hauteur_plate_forme = $this->test_input($this->postData['hauteur_plate_forme']);
        $capacité_levage = $this->test_input($this->postData['capacité_levage']);
        $quantity = $this->test_input($this->postData['quantity']);
        $id_category  = $this->test_input($this->postData['id_category']);
        $prix_jour = $this->test_input($this->postData['prix_jour']);
        $prix_semaine = $this->test_input($this->postData['prix_semaine']);
        $prix_mois = $this->test_input($this->postData['prix_mois']);
        
        $this->validateChamps();
        $this->validateImage("image1");
        $this->validateImage("image2");
        $this->validateImage("image3");

        if (
            $this->validateQuantity()!==false && $this->validateNom() !== false && $this->validateDescription() !== false && $this->validateTypeCarburant() !== false && $this->validateHauteurPlateForme() !== false && $this->validateHauteurPlateForme() !== false && $this->validateCapacitéLevage() !== false && $this->validateIdCategory() !== false && $this->validateImage("image1") !== false && $this->validateImage("image2") !== false && $this->validateImage("image3") !== false && $this->validatePrixJour() !== false && $this->validatePrixSemaine() !== false && $this->validatePrixMois() !== false
        ) {
            $db = new DB();
            $id_image = $this->lastIdImageMachine();
            $id_prix = $this->lastIdPrixMachine();
            if ($id_prix[0][0] == NULL) {
                $id_prix[0][0] = 1;
            }
            if ($id_image[0][0] == NULL) {
                $id_image[0][0] = 1;
            }
            //Add Prix Machine
            $sql = "INSERT INTO prix_machines VALUES (?,?,?,?)";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$id_prix[0][0], $prix_jour, $prix_semaine, $prix_mois]);

            // Add Image Machine
            $sql = "INSERT INTO image_machines VALUES (?,?,?,?)";
            $stmt = $db::connection()->prepare($sql);

            $file1 = $this->uploadPhoto($_FILES["image1"]);
            $file2 = $this->uploadPhoto($_FILES["image2"]);
            $file3 = $this->uploadPhoto($_FILES["image3"]);
            $stmt->execute([$id_image[0][0], $file1, $file2, $file3]);

            //   Add Machine
            $sql = "INSERT INTO machines VALUES (NULL,?,?,?,?,?,?,?,?,? )";
            $stmt = $db::connection()->prepare($sql);

            $stmt->execute([
                $nom, $description, $type_carburant, $hauteur_plate_forme, $capacité_levage,$quantity, $id_category,
                $id_image[0][0], $id_prix[0][0]
            ]);
            if ($stmt) {
                BaseController::set('success', "Machine Added successfully");
                BaseController::redirect("machine");
            }
        }
    }

    function updateMachine()
    {
        $id = $this->test_input($this->postData['id_edit']);
        $nom = $this->test_input($this->postData['nom']);
        $description = $this->test_input($this->postData['description']);
        $type_carburant = $this->test_input($this->postData['type_carburant']);
        $hauteur_plate_forme = $this->test_input($this->postData['hauteur_plate_forme']);
        $capacité_levage = $this->test_input($this->postData['capacité_levage']);
        $quantity = $this->test_input($this->postData['quantity']);
        $id_category  = $this->test_input($this->postData['id_category']);
        $prix_jour = $this->test_input($this->postData['prix_jour']);
        $prix_semaine = $this->test_input($this->postData['prix_semaine']);
        $prix_mois = $this->test_input($this->postData['prix_mois']);
        
        $this->validateChamps();

        if (
            $this->validateNom() !== false && $this->validateDescription() !== false && $this->validateTypeCarburant() !== false && $this->validateHauteurPlateForme() !== false && $this->validateHauteurPlateForme() !== false && $this->validateCapacitéLevage() !== false && $this->validateIdCategory() !== false && $this->validatePrixJour() !== false && $this->validatePrixSemaine() !== false && $this->validatePrixMois() !== false
        ) {
            $db = new DB();

            $sql = " UPDATE machines  JOIN image_machines on image_machines.id = machines.id_image
                    JOIN prix_machines on prix_machines.id = machines.id_prix
                    SET machines.nom = ?,
                        machines.description = ?,
                        machines.type_carburant = ?,
                        machines.hauteur_plate_forme= ?,
                        machines.capacité_levage= ?,
                        machines.quantity= ?,
                        machines.id_category =?,
                        image_machines.image1 = ?,
                        image_machines.image2 = ?,
                        image_machines.image3 = ?,
                        prix_machines.prix_jour =?,
                        prix_machines.prix_semaine =?,
                        prix_machines.prix_mois =?
                    WHERE machines.id =?";
            $stmt = $db::connection()->prepare($sql);
            $oldImage1 = $this->postData['current_image1'];
            $oldImage2 = $this->postData['current_image2'];
            $oldImage3 = $this->postData['current_image3'];

            $file1 = $this->uploadPhoto($_FILES["image1"], $oldImage1);
            $file2 = $this->uploadPhoto($_FILES["image2"], $oldImage2);
            $file3 = $this->uploadPhoto($_FILES["image3"], $oldImage3);
            $stmt->execute([
                $nom,
                $description,
                $type_carburant,
                $hauteur_plate_forme,
                $capacité_levage,
                $quantity,
                $id_category,
                $file1,
                $file2,
                $file3,
                $prix_jour,
                $prix_semaine,
                $prix_mois,
                $id
            ]);
            if ($stmt) {
                BaseController::set('success', "Machine Updated successfully");
                BaseController::redirect("machine");
            }
        }
    }

    // function deletePrixMachine($id) {
    //     $db = new DB();

    //     $stmt = $db::connection()->prepare("DELETE prix_machines FROM prix_machines 
    //                                             JOIN machines on prix_machines.id = machines.id
    //                                             WHERE machines.id = :id") ;
    //     $stmt->execute([":id" => $id]);
    // }
    // function deleteImageMachine($id) {
    //     $db = new DB();
    //     $stmt = $db::connection()->prepare("DELETE image_machines FROM image_machines
    //                 JOIN machines on image_machines.id = machines.id
    //                 WHERE machines.id = :id") ;
    //     $stmt->execute([":id" => $id]);
    // }

    function deleteMachine($id)
    {
        try {
            if (!empty($id)) {
                $db = new DB();
                $id = $this->test_input($id);
                $stmt = $db::connection()->prepare("DELETE FROM machines WHERE id = :id");
                $stmt->execute([":id" => $id]);
                BaseController::set('success', "Machine successfully deleted");
                BaseController::redirect("machine");
            }
        } catch (Exception $e) {
            echo "Error deleting" . $e->getMessage();
        }
    }

    // -------------------------------------
    // -- Validation --
    // -------------------------------------



    private function validateNom()
    {
        $val = $this->test_input($this->postData['nom']);
        if (empty($val)) {
            $this->addError('nom', 'Nom cannot be empty');
            $result = false;
        } elseif (!preg_match('/^[a-zA-Z\s]{3,12}$/', $val)) {
            $this->addError('nom', 'Nom must be 3-8 chars');
            $result = false;
        } else {
            $this->addValid('nom', true);
            $result = true;
        }
        return $result;
    }
    private function validateDescription()
    {
        $val = $this->test_input($this->postData['description']);
        if (empty($val)) {
            $this->addError('description', 'description cannot be empty');
            $result = false;
        // } elseif (!preg_match('/^[a-zA-Z0-9\s.]{3,500}$/', $val)) {
        //     $this->addError('description', 'description must be 10-500 chars');
        //     $result = false;
        } else {
            $this->addValid('description', true);
            $result = true;
        }
        return $result;
    }

    function validateTypeCarburant()
    {
        $val = $this->test_input($this->postData['type_carburant']);
        if (empty($val)) {
            $this->addError('type_carburant', 'type de carburant cannot be empty');
            $result = false;
        } elseif (!preg_match('/^[a-zA-Z0-9\s]{3,10}$/', $val)) {
            $this->addError('type_carburant', 'type de carburant must be 3-10 chars');
            $result = false;
        } else {
            $this->addValid('type_carburant', true);
            $result = true;
        }
        return $result;
    }
    function validateHauteurPlateForme()
    {
        $val = $this->test_input($this->postData['hauteur_plate_forme']);
        if (empty($val)) {
            $this->addError('hauteur_plate_forme', 'hauteur de plate forme cannot be empty');
            $result = false;
        // } elseif (!preg_match('/^[a-zA-Z0-9\s.]{3,20}$/', $val)) {
        //     $this->addError('hauteur_plate_forme', 'hauteur de plate forme must be 3-20 chars');
        //     $result = false;
        } else {
            $this->addValid('hauteur_plate_forme', true);
            $result = true;
        }
        return $result;
    }
    function validateCapacitéLevage()
    {
        $val = $this->test_input($this->postData['capacité_levage']);
        if (empty($val)) {
            $this->addError('capacité_levage', 'capacité de lévage cannot be empty');
            $result = false;
        // } elseif (!preg_match('/^[a-zA-Z0-9\s.]{3,20}$/', $val)) {
        //     $this->addError('capacité_levage', 'capacité de lévage must be 3-10 chars');
        //     $result = false;
        } else {
            $this->addValid('capacité_levage', true);
            $result = true;
        }
        return $result;
    }
    function validateIdCategory()
    {
        $val = $this->test_input($this->postData['id_category']);
        if (empty($val)) {
            $this->addError('id_category', 'Category cannot be empty');
            $result = false;
        } else {
            $this->addValid('id_category', true);
            $result = true;
        }
        return $result;
    }

    function validatePrixJour()
    {
        $val = $this->test_input($this->postData['prix_jour']);
        if (empty($val)) {
            $this->addError('prix_jour', 'Prix de jour cannot be empty');
            $result = false;
        } elseif (!preg_match('/^[0-9]+[.,]?[0-9]*$/', $val)) {
            $this->addError('prix_jour', 'Prix de jour must be 3-10 numbers');
            $result = false;
        } else {
            $this->addValid('prix_jour', true);
            $result = true;
        }
        return $result;
    }

    function validatePrixMois()
    {
        $val = $this->test_input($this->postData['prix_mois']);
        if (empty($val)) {
            $this->addError('prix_mois', 'Prix de mois cannot be empty');
            $result = false;
        } elseif (!preg_match('/^[0-9]+[.,]?[0-9]*$/', $val)) {
            $this->addError('prix_mois', 'Prix de mois must be 3-10 numbers');
            $result = false;
        } else {
            $this->addValid('prix_mois', true);
            $result = true;
        }
        return $result;
    }
    function validatePrixSemaine()
    {
        $val = $this->test_input($this->postData['prix_semaine']);
        if (empty($val)) {
            $this->addError('prix_semaine', 'Prix de semaine cannot be empty');
            $result = false;
        } elseif (!preg_match('/^[0-9]+[.,]?[0-9]*$/', $val)) {
            $this->addError('prix_semaine', 'Prix de semaine must be 3-10 numbers');
            $result = false;
        } else {
            $this->addValid('prix_semaine', true);
            $result = true;
        }
        return $result;
    }
    function validateQuantity()
    {
        $val = $this->test_input($this->postData['quantity']);
        if (empty($val)) {
            $this->addError('quantity', 'Quantity cannot be empty');
            $result = false;
        } elseif (!preg_match('/^[0-9]*$/', $val)) {
            $this->addError('quantity', 'Quantity must be 3-10 numbers');
            $result = false;
        } else {
            $this->addValid('quantity', true);
            $result = true;
        }
        return $result;
    }
    function validateImage($nameImg)
    { //$file => $_FILES['name']
        $file = $_FILES["$nameImg"];
        $name = $file['name'];

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
