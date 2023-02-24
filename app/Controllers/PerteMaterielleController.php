<?php

namespace app\Controllers;

use PDO;
use database\DB;
use PDOException;
use app\Models\PerteMaterielle;

class PerteMaterielleController
{
    private $postData;
    public $t = [];
    public $cpt = 0;
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

    function getAllPerteMaterielle()
    {
        try {
            $db = new DB();
            $sql = "SELECT * FROM pertes_matérielles";
            $res = $db::connection()->query($sql);
            while($row = $res->fetch()) {
                $pertmat = new PerteMaterielle($row[0], $row[1], $row[2], $row[3]);
                $this->t[$this->cpt] = $pertmat;
                $this->cpt++;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function validateAll() 
    {
        $this->validateDescriptionMat();
        $this->validatePrixPerte();
        $this->validateDatePerte();
    }
    function addPerteMaterielle()
    {
        $description_mat = $this->test_input($this->postData['description_mat']);
        $prix_perte = $this->test_input($this->postData['prix_perte']);
        $date_perte = $this->test_input($this->postData['date_perte']);

        $this->validateAll();
        if($this->validateDescriptionMat() !==false && $this->validatePrixPerte() !== false && $this->validateDatePerte() !== false  ) 
        {
            try {
                $db = new DB();
                $sql = "INSERT INTO pertes_matérielles VALUES(NULL, ?, ?, ?)";
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([$description_mat, $prix_perte, $date_perte]);
                if ($stmt) {
                    BaseController::set('success', "Perte materielles Ajouter avec success");
                    BaseController::redirect("perte_materielles");
                }
            }catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    function updatePerteMaterielleParId($id)
    {
        $description_mat = $this->test_input($this->postData['description_mat']);
        $prix_perte = $this->test_input($this->postData['prix_perte']);
        $date_perte = $this->test_input($this->postData['date_perte']);

        $this->validateAll();
        if($this->validateDescriptionMat() !== false && $this->validatePrixPerte() !== false && $this->validateDatePerte() !== false  ) 
        {
            try {
                $db = new DB();
                $sql = "UPDATE pertes_matérielles SET
                        description_mat = ?,
                        prix_perte = ? , date_perte = ?
                        WHERE id = ?
                        ";
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([$description_mat, $prix_perte, $date_perte, $id]);
                if ($stmt) {
                    BaseController::set('success', "Perte materielles modifier avec success");
                    BaseController::redirect("perte_materielles");
                }
            }catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    function getPerteMaterielleParId($id)
    {
        try {
            $db = new DB();
            $sql = "SELECT * FROM pertes_matérielles WHERE id = ?";
            $res = $db::connection()->prepare($sql);
            $res->execute([$id]);
            return current($res->fetchAll(PDO::FETCH_OBJ));
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function deletePerteMateriel($id) 
    {
        try {
            $db = new DB();
            $sql = "DELETE FROM pertes_matérielles WHERE id = ? ";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$id]);
            if($stmt) {
                BaseController::set('success', "Perte materielles supprimer avec success");
                BaseController::redirect("perte_materielles");
            }

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


     // -------------------------------------
    // -- Validation --
    // -------------------------------------



    private function validateDescriptionMat()
    {
        $val = $this->test_input($this->postData['description_mat']);
        if (empty($val)) {
            $this->addError('description_mat', 'Description matériel cannot be empty');
            $result = false;
        } else {
            $this->addValid('description_mat', true);
            $result = true;
        }
        return $result;
    }
    private function validatePrixPerte()
    {
        $val = $this->test_input($this->postData['prix_perte']);
        if (empty($val)) {
            $this->addError('prix_perte', 'Prix perte cannot be empty');
            $result = false;
        }elseif (!preg_match('/^[0-9]+[.]?[0-9]*$/', $val)) {
            $this->addError('prix_perte', 'Prix perte must be 3-10 numbers');
            $result = false;
        } else {
            $this->addValid('prix_perte', true);
            $result = true;
        }
        return $result;
    }
    private function validateDatePerte()
    {
        $val = $this->test_input($this->postData['date_perte']);
        if (empty($val)) {
            $this->addError('date_perte', 'Date perte matériel cannot be empty');
            $result = false;
        } else {
            $this->addValid('date_perte', true);
            $result = true;
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