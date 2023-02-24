<?php
namespace app\Controllers;

use app\Models\Benefice;
use database\DB;
use PDOException;

class BeneficeController 
{
    public $t = [];
    private $cpt = 0;

    function getAllBenefice()
    {
        try {
            $db = new DB();
            $sql = "SELECT * FROM bénéfices ORDER BY id DESC";
            $stmt = $db::connection()->query($sql);
            while($row = $stmt->fetch()) {
                $benefice = new Benefice($row[0],$row[1],$row[2],$row[3],$row[4] );
                $this->t[$this->cpt] = $benefice;
                $this->cpt++;
            }
        } catch (PDOException $e) {
            echo "Exception: " . $e->getMessage();
        }
    }
    function deleteBenefice($id)
    {
        try {
            $db = new DB();
            $sql = "DELETE FROM bénéfices WHERE id = ?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$id]);
            if($stmt) {
                BaseController::set('success', "Bénéfice est supprimer avec success");
                BaseController::redirect("benefices");
            }
        } catch (PDOException $e) {
            echo "Exception: " . $e->getMessage();
        }
    }

    function getAllBeneficeParDate($date)
    {
        try {
            $db = new DB();
            $sql = "SELECT * FROM bénéfices WHERE date_bénéfices LIKE ?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$date]);
            while($row = $stmt->fetch()) {
                $benefice = new Benefice($row[0],$row[1],$row[2],$row[3],$row[4] );
                $this->t[$this->cpt] = $benefice;
                $this->cpt++;
            }
        } catch (PDOException $e) {
            echo "Exception: " . $e->getMessage();
        }
    }
}