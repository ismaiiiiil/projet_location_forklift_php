<?php

namespace app\Controllers;

use PDO;
use Exception;
use database\DB;
use app\Models\Category;

class CategoryController {
    private $cpt = 0;
    public $t = [];
    private $postData;
    public $errors = [];
    public $valid = [];

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

    function getAllCategoriesSelecte() 
    {
        $db = new DB();
        $sql = "SELECT DISTINCT nom FROM categories";
        $res = $db::connection()->query($sql);
        return $res->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllCategories() 
    {
        $db = new DB();
        $sql = 'SELECT * FROM categories';
        $res = $db::connection()->query($sql);

        while ( $row = $res->fetch() ) {
            $category = new Category($row[0], $row[1], $row[2]);
            $this->t[$this->cpt] = $category;
            $this->cpt++;
        }
    }

    public function getAllCategoriesSearch($search) 
    {
        $db = new DB();
        $sql = 'SELECT * FROM categories WHERE nom LIKE ?';
        $stmt = $db::connection()->prepare($sql);
        $stmt->execute(['%' . $search . '%']);
        return $stmt->fetchAll();
    }

    public function getCategoriesId($id) 
    {
        $db = new DB();
        $sql = 'SELECT * FROM categories WHERE id= ?';
        $stmt = $db::connection()->prepare($sql);
        $stmt->execute([$id]);
        return current($stmt->fetchAll(PDO::FETCH_OBJ));
    }

    public function getAllCategoriesByName($name) 
    {
        $db = new DB();
        $sql = 'SELECT * FROM categories WHERE nom LIKE ?';
        $stmt = $db::connection()->prepare($sql);
        $stmt->execute([$name]);
        if($stmt->rowCount() > 0 ) {
            while ( $row = $stmt->fetch() ) {
                $category = new Category($row[0], $row[1], $row[2]);
                $this->t[$this->cpt] = $category;
                $this->cpt++;
            }
        }else {
            $this->getAllCategories();
        }
    }

    function getCategoryParNameSearch($nom)
    {
        $db = new DB();
        $sql = 'SELECT * FROM categories WHERE nom LIKE ?';
        $res = $db::connection()->prepare($sql);
        $res->execute(["%". $nom . "%"]);
        
        while ( $row = $res->fetch() ) {
            $category = new Category($row[0], $row[1], $row[2]);
            $this->t[$this->cpt] = $category;
            $this->cpt++;
        }
    }

    
    public function uploadPhoto($imagePoste, $oldImage = null)
    {
        $dir = "./public/images/category"; // dossier fin timchiw
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
        $filename = "public/images/category/$name";
        if (file_exists($filename)) {
            unlink($filename);
            return true;
        }
        return false;
    }
    function addCategory() {
        $nom = $this->postData['nom'];

        $this->validateNom();
        $this->validateImage("image");
        if($this->validateNom() !== false && $this->validateImage("image") !== false) {
            $db = new DB();
            $sql = "INSERT INTO categories VALUES(NULL, ?,?)";
            $stmt = $db::connection()->prepare($sql);
            $file = $this->uploadPhoto($_FILES["image"]);
            $stmt->execute([$nom,$file ]);
            if ($stmt) {
                BaseController::set('success', "Category Added successfully");
                BaseController::redirect("category");
            }
        }
    }

    function updateCategory() {
        $nom = $this->test_input($this->postData['nom']);
        $id = $this->test_input($this->postData['id_edit']);

        $this->validateNom();
        $this->validateImage("image");
        if($this->validateNom() !== false ) {
            $db = new DB();
            $sql = "UPDATE categories 
                    SET nom=?,image=? 
                    WHERE id=?";
            $stmt = $db::connection()->prepare($sql);

            $oldImage = $this->postData['current_image'];
            $file = $this->uploadPhoto($_FILES["image"], $oldImage);
            $stmt->execute([$nom,$file,$id ]);
            if ($stmt) {
                BaseController::set('success', "Category Updated successfully");
                BaseController::redirect("category");
            }
        }
    }
    function deleteMachine($id)
    {
        try {
            if (!empty($id)) {
                $db = new DB();
                // delete image 
                $category = $this->getCategoriesId($id);
                $this->deletePhoto($category->image);

                $id = $this->test_input($id);
                $stmt = $db::connection()->prepare("DELETE FROM categories WHERE id = :id");
                $stmt->execute([":id" => $id]);
                BaseController::set('success', "Category successfully deleted");
                BaseController::redirect("category");
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
        } elseif (!preg_match('/^[a-zA-Z\s]{3,20}$/', $val)) {
            $this->addError('nom', 'Nom must be 3-20 chars');
            $result = false;
        } else {
            $this->addValid('nom', true);
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