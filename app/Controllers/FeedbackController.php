<?php

namespace app\Controllers;

use PDO;
use Exception;
use database\DB;

class FeedbackController {
    private $postData;
    public $t = [];
    private $cpt = 0;
    public $errors = [] ;

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

    function addFeedback() {
        try {
            $db = new DB();
            $id_user = $_SESSION['id_user']; 
            $rating = $this->test_input($this->postData["rating"]);
            $description = $this->test_input($this->postData["description"]);

            if(!empty($rating) && !empty($description)) {
                $sql = "INSERT INTO feedback VALUES (NULL, ?, ?, ?, 0, now())";
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([$id_user, $rating, $description]);
                if($stmt) {
                    BaseController::redirect("home");
                    BaseController::set("success", "Bravo! message envoyer avec succes");
                }
            }else {
                BaseController::redirect("home");
                BaseController::set("info", "Entrer tous les champs s'il vous plaît");
            }
        }catch(Exception $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    function changeInactive($id) {
        try {
            $db = new DB();
            $sql = "UPDATE feedback SET active = 0 WHERE id = ?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$id]);
            if($stmt) {
                BaseController::set("success", "Feedback est inactif avec succès");
                BaseController::redirect('testimonials');
            }
        }catch(Exception $e) {
            echo "Error : " . $e->getMessage();
        }
    }
    function changeActive($id) {
        try {
            $db = new DB();
            $sql = "UPDATE feedback SET active = 1 WHERE id = ?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$id]);
            if($stmt) {
                BaseController::set("success", "Feedback est actif avec succès");
                BaseController::redirect('testimonials');
            }
        }catch(Exception $e) {
            echo "Error : " . $e->getMessage();
        }
    }
    function deleteFeedback($id) {
        try {
            $db = new DB();
            $sql = "DELETE FROM feedback WHERE feedback.id = ? ";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$id]);
            if($stmt) {
                BaseController::set("success", "Feedback est supprimer avec succès");
                BaseController::redirect('testimonials');
            }
        }catch(Exception $e) {
            echo "Error : " . $e->getMessage();
        }
    }
    

    function getAllFeedback() {
        try {
            $db = new DB();
            $sql = "SELECT *,feedback.id feedback_id FROM feedback 
                    JOIN users on feedback.id_user = users.id";
            $stmt = $db::connection()->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    function getAllFeedbackActive() 
    {
        try {
            $db = new DB();
            $sql = "SELECT * FROM feedback 
                    JOIN users on feedback.id_user = users.id
                    WHERE active = 1";
            $stmt = $db::connection()->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e) {
            echo "Error : " . $e->getMessage();
        }
    }

    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }
}