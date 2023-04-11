<?php
namespace app\Controllers;

use PDO;
use Exception;
use database\DB;
use app\Models\Calendrier;

class CalendrierController {
    public $t = [];
    private $cpt = 0;
    private $postData;

    function __construct($post) {
        $this->postData = $post;
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // function getAllDate() {
    //     try {
    //         $db = new DB();
    //         $sql = "SELECT * FROM calendrier";
    //         $stmt = $db::connection()->query($sql);
    //         while ($row = $stmt->fetch()) {
    //             $date = new Calendrier($row[0],$row[1], $row[2],$row[3], $row[4]);
    //             $this->t[$this->cpt] = $date;
    //             $this->cpt++;
    //         }
    //     }catch(Exception $e) {
    //         echo "Error : " . $e->getMessage();
    //     }
    // }
    function getAllDate() {
        try {
            $db = new DB();
            $sql = "SELECT * FROM calendrier";
            $stmt = $db::connection()->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    function saveChanges() {
        try {
            $id = $this->test_input($this->postData['id']);
            $title = $this->test_input($this->postData['title']);
            $description = $this->test_input($this->postData['description']);
            $start_datetime = $this->test_input($this->postData['start_datetime']);
            $end_datetime = $this->test_input($this->postData['end_datetime']);

            $db = new DB();
            if(empty($id)) {
                $sql = "INSERT INTO calendrier (id, title, description, start_datetime, end_datetime) 
                        VALUES (NULL, ?, ?, ?, ?);";
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([$title, $description, $start_datetime, $end_datetime]);
                BaseController::set("success", "Rappel ajouté avec succès");
            } else {
                $sql = "UPDATE calendrier 
                        SET title = ?, description = ?, start_datetime = ?, end_datetime =? 
                        WHERE id = ?";
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([$title, $description, $start_datetime, $end_datetime ,$id]);
                BaseController::set("success", "Rappel modifié avec succès");
            }
            BaseController::redirect("dashboard");

        }catch(Exception $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    function deleteDate($id) {
        if(!empty($id)) {
            $id = $this->test_input($id);

            $db = new DB();
            $sql = "DELETE FROM calendrier WHERE id = ?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$id]);
            if($stmt) {
                BaseController::redirect('../dashboard');
                BaseController::set('success', 'Rappel supprimer avec succès');
            }
        }else {
            BaseController::redirect('../dashboard');
            BaseController::set('danger', "erreur dans l'identifiant de rappel");
        }
    }
}