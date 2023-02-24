<?php

namespace app\Controllers;

use app\Models\Admin;
use PDO;
use Exception;
use database\DB;

class AdminController 
{
    private $postData;
    private $errors = array();
    public $t = [];
    private $cpt = 0;

    public function __construct($post_data)
    {
        $this->postData = $post_data;
    }
    // Route Administration
    public function index($page){
        include("resources/views/admin" . $page . ".php");
    }

    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    function insertAdmin() 
    {
        $db = new DB();

        $sql = "INSERT INTO admin (id, email, nom, prenom, tel,admin_profile,is_admin, password) 
                VALUES (1, ?, ?, ?,?,?, ?, ?);";
        $stmt = $db::connection()->prepare($sql);

        $email = "admin@gmail.com";
        $nom = "admin";
        $prenom = "admin";
        $tel = "0694332279";
        $admin_profile = "image4-1676478414.jpg";
        $is_admin = 1;
        $password = "admin1234";

        // crypter password
        $options  = [
            "cost" => 12
        ];
        $passwordcripter = password_hash($password, PASSWORD_BCRYPT, $options);

        $stmt->execute([$email, $nom, $prenom, $tel,$admin_profile, $is_admin, $passwordcripter]);
    }


    function addManager() {
        try {
            $nom = $this->test_input($this->postData['nom']);
            $prenom = $this->test_input($this->postData['prenom']);
            $email = $this->test_input($this->postData['email']);
            $tel = $this->test_input($this->postData['tel']);
            $this->validateNom();$this->validatePrenom();$this->validateEmail();$this->validateTel();
            $db = new DB();
            if(
            $this->validateNom() !== false && $this->validatePrenom() !== false && $this->validateEmail() !== false && $this->validateTel() !== false 
            ) {
                $sql = "INSERT INTO admin (id, email, nom, prenom, tel,admin_profile,is_admin, password) 
                        VALUES (NULL , ?, ?, ?,?,?, 0, ?);";
                $file =$this->uploadPhotoManger($_FILES["image"]);
                $password = $nom ."_". $prenom ."_". date("Y");
                
            }


        } catch (Exception $e) {
            //throw $th;
        }
    }
    // check if email exists
    private function checkEmailExists($email) 
    {
        if(!empty($email) && $this->validateEmail() !== false) {
            $db = new DB();
            $sql = "SELECT * FROM admin WHERE email = ?";
            $stmt
        }
    }
    function login() 
    {
        $db = new DB();
        $login = $this->test_input($this->postData["login"]);
        $password = $this->test_input($this->postData["password"]);

        if(!empty($login) && !empty($password)) {
            $sql = "SELECT * FROM admin WHERE  email = ?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$login]);
            if($stmt->rowCount() > 0) {
                $admin = current($stmt->fetchAll(PDO::FETCH_OBJ));

                // var_dump($this->postData);
                if( $admin->email === $login 
                    && password_verify( $password, $admin->password )) 
                {
                    if($admin->is_admin	=== 1) {
                        session_start();
                        $_SESSION["nom_admin"] = $admin->nom;
                        $_SESSION["email_admin"] = $admin->email;
                        $_SESSION["login_admin"] = $login;
                        $_SESSION["admin"] = true;
                        BaseController::redirect("dashboard");
                        BaseController::set("success" , "Are you loged successfully");
                    }else {
                        // gérant
                        BaseController::redirect("login-administrateur");
                        BaseController::set("danger" , "You are Gérant HHHH"); 
                    }
                    
                }else {
                    BaseController::redirect("login-administrateur");
                    BaseController::set("danger" , "Password is incorrect");
                }
            }else {
                BaseController::redirect("login-administrateur");
                BaseController::set("danger" , "Login is incorrect");
            }
        }else {
            BaseController::redirect("login-administrateur");
            BaseController::set("danger" , "Tous les champs est obligatoire");
        } 
    }

    function getAllManagement() {
        try {
            $db = new DB();
            $sql = "SELECT * FROM admin WHERE is_admin = 0";
            $stmt = $db::connection()->query($sql);
            while($row = $stmt->fetch()) {
                $management = new Admin($row[0], $row[1], $row[2], $row[3], $row[4],$row[5]);
                $this->t[$this->cpt] = $management;
                $this->cpt++;
            }

        }catch(Exception $e) {
            echo "Error: ".$e->getMessage();
        }
    }

    function getAdminConnecter() 
    {
        try {
            $db = new DB();
            if($_SESSION["admin"] === true ) {
                $sql = "SELECT * FROM admin WHERE email = ? AND nom = ? AND is_admin = 1";
            }else {
                $sql = "SELECT * FROM admin WHERE email = ? AND nom = ? AND is_admin = 0";
            }
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$_SESSION["email_admin"], $_SESSION["nom_admin"] ]);
            return current($stmt->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo "Error: ".$e->getMessage();
        }
    }


    function getNbrUsers()
    {
        try{
            $db = new DB();
            $sql = "SELECT COUNT(*) as nbrUsers FROM users";
            $stmt = $db::connection()->query($sql);
            return current($stmt->fetchAll(PDO::FETCH_OBJ));
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    function getNbrOrders()
    {
        try{
            $db = new DB();
            $sql = "SELECT COUNT(*) as nbrOrders FROM orders";
            $stmt = $db::connection()->query($sql);
            return current($stmt->fetchAll(PDO::FETCH_OBJ));
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }
    function getNbrOrdersNow()
    {
        try{
            $db = new DB();
            $sql = "SELECT COUNT(*) as nbrOrdersNow FROM orders WHERE date_order = CURRENT_DATE";
            $stmt = $db::connection()->query($sql);
            return current($stmt->fetchAll(PDO::FETCH_OBJ));
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    function getNbrMachines()
    {
        try{
            $db = new DB();
            $sql = "SELECT COUNT(*) as nbrMachines FROM machines";
            $stmt = $db::connection()->query($sql);
            return current($stmt->fetchAll(PDO::FETCH_OBJ));
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    function getSumBeneficeNow()
    {
        try{
            $db = new DB();
            $sql = "SELECT SUM(bénéfices.prix_hors_taxe) sumBenefices FROM bénéfices 
                    WHERE date_bénéfices = CURRENT_DATE";
            $stmt = $db::connection()->query($sql);
            return current($stmt->fetchAll(PDO::FETCH_OBJ));
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }

    function getClientPlusFidel()
    {
        try{
            $db = new DB();
            $sql = "SELECT * , countNbrUserByEmail(users.email) nbrOrder
                    FROM users 
                    HAVING nbrOrder > 0
                    ORDER BY nbrOrder DESC
                    LIMIT 10";
            $stmt = $db::connection()->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }





// ------- UPLOAD PHOTO ------------------------
    public function uploadPhoto($imagePoste, $oldImage = null)
    {
        $dir = "./public/images/admin"; // dossier fin timchiw
        $time = time(); // heur
        $name = str_replace(" ", "-", strtolower($imagePoste["name"])); // espace => "-"  , name="image" ->"image" 
        $type = $imagePoste["type"]; // png , jpg .. ?

        $ext = substr($name, strpos($name, ".")); // mnin i9d3 -> image.jpg -> (.jpg)
        $ext = str_replace(".", "", $ext);  // (.jpg) => (jpg)
        $name = preg_replace("/\.[^.\s]{3,4}$/", "", $name); // -,/. -> "" vide
        $imageName = $name . "-" . $time . "." . $ext; // le nom finale image
        if (move_uploaded_file($imagePoste["tmp_name"], $dir . "/" . $imageName)) { // shemain/public/uploads/image-time.png
            if($oldImage !== "admin_default.jpg") {
                $this->deletePhoto($oldImage);
            }
            return $imageName;
        } //ila mabdlch image tanjibo image l9dima
        return $oldImage;
    }

    public function uploadPhotoManger($imagePoste, $oldImage = null)
    {
        $dir = "./public/images/manager"; // dossier fin timchiw
        $time = time(); // heur
        $name = str_replace(" ", "-", strtolower($imagePoste["name"])); // espace => "-"  , name="image" ->"image" 
        $type = $imagePoste["type"]; // png , jpg .. ?

        $ext = substr($name, strpos($name, ".")); // mnin i9d3 -> image.jpg -> (.jpg)
        $ext = str_replace(".", "", $ext);  // (.jpg) => (jpg)
        $name = preg_replace("/\.[^.\s]{3,4}$/", "", $name); // -,/. -> "" vide
        $imageName = $name . "-" . $time . "." . $ext; // le nom finale image
        if (move_uploaded_file($imagePoste["tmp_name"], $dir . "/" . $imageName)) { // shemain/public/uploads/image-time.png
            if($oldImage !== "admin_default.jpg") {
                $this->deletePhotoManager($oldImage);
            }
            return $imageName;
        } 
        return $oldImage;
    }


    public function deletePhoto($name = null)
    {
        $filename = "public/images/admin/$name";
        if (file_exists($filename)) {
            unlink($filename);
            return true;
        }
        return false;
    }
    public function deletePhotoManager($name = null)
    {
        $filename = "public/images/manager/$name";
        if (file_exists($filename)) {
            unlink($filename);
            return true;
        }
        return false;
    }

    function updatePhotoProfile() 
    {
        // try {
            $this->validateImage("image");
            if($this->validateImage("image") !== false )
            {
                $db = new DB();
                $oldImage = $this->postData["current_image"];

                $file = $this->uploadPhoto($_FILES["image"], $oldImage);
                $nom_admin = $_SESSION["nom_admin"]; 
                $email_admin = $_SESSION["email_admin"]; 

                $sql = "UPDATE admin SET admin_profile	= ? WHERE nom = ? AND email = ?";
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([$file, $nom_admin, $email_admin]);
                if($stmt) {
                    BaseController::redirect("profile-administrateur");
                    BaseController::set("success" , "Profile modifier avec success");
                }
            }else {
                BaseController::redirect("profile-administrateur");
                BaseController::set("error" , "Image n\"est pas valid");
            }
        // } catch (PDOException $e) {
        //     echo "Error uploading" . $e->getMessage();
        // }
    }


    function updatePassword()
    {
        $db = new DB();
        $nom_admin = $_SESSION['nom_admin']; //email_admin
        $email_admin = $_SESSION['email_admin']; //email_admin
        $old_pass = $this->test_input($this->postData['old_pass']);
        $password = $this->test_input($this->postData['password']);
        $cpassword = $this->test_input($this->postData['cpassword']);

        $this->validateCPassword();

        if(!empty($old_pass) && !empty($password) && !empty($cpassword)) {

            if($this->validateCPassword() !== false) {
                if($_SESSION["admin"] === true) {
                    $sql = "SELECT * FROM admin WHERE nom = ? AND email = ? AND is_admin = 1";
                }else {
                    $sql = "SELECT * FROM admin WHERE nom = ? AND email = ? AND is_admin = 0";
                }
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([ $nom_admin, $email_admin ]);

                $admin = current($stmt->fetchAll(PDO::FETCH_OBJ));

                if( $admin->nom === $nom_admin 
                    && $admin->email === $email_admin  
                    && password_verify( $old_pass, $admin->password )
                ){
                    // update Password
                    $options = [
                        'cost' => 12
                    ];
                    $password = password_hash($password, PASSWORD_BCRYPT, $options);

                    $sql = "UPDATE admin SET password = ? WHERE nom = ? AND email = ? ";
                    $stmt = $db::connection()->prepare($sql);
                    $stmt->execute([$password, $nom_admin, $email_admin ]);
                    if($stmt) {
                        BaseController::redirect('profile-administrateur');
                        BaseController::set('success' , 'Mot de passe modifier avec success');
                    }
                }else {
                    BaseController::redirect('profile-administrateur');
                    BaseController::set('danger' , 'Password is incorrect');
                }
                
            }
        }else {
            BaseController::redirect('profile-administrateur');
            BaseController::set('danger' , 'Tous les champs est obligatoire');
        } 
    }
    // -------------------------------------
    // -- Validation --
    // -------------------------------------

    private function validateCPassword()
    {
        $pssw = $this->test_input( $this->postData['password']);
        $cpssw = $this->test_input($this->postData['cpassword']);
        if (empty($cpssw)) {
            $this->addError('cpassword', 'Password cannot be empty');
            $result = false;
        } elseif ($pssw !== $cpssw ) {
            $this->addError('cpassword', 'Confirm Password is not correct');
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    function validateImage($nameImg)
    { 
        //$file => $_FILES["name"]
        $file = $_FILES["$nameImg"];

        // type file 
        $file_extension = explode(".", $file["name"]);
        $file_extension = strtolower(end($file_extension));
        $accepted_formate = array("jpeg", "jpg", "png");

        $result = "";
        if ($file["size"] == 0) {
            BaseController::redirect("profile-administrateur");
            BaseController::set("error" , "$nameImg is obligatory");
            $result = false;
        } else {
            $size = $file["size"]; // size in byte
            $mb_2 = 2000000;

            if ($size > $mb_2) {
                BaseController::redirect("profile-administrateur");
                BaseController::set("error" , "File is too large, Upload less than or equal 2MB");
                $result = false;
            } elseif (in_array($file_extension, $accepted_formate)) {
                return true;
            } else {
                BaseController::redirect("profile-administrateur");
                BaseController::set("error" , $file_extension . " This is file not allowed !!");
                $result = false;
            }
        }
        return $result;
    }
    function validateImageManagers($nameImg)
    { 
        //$file => $_FILES["name"]
        $file = $_FILES["$nameImg"];

        // type file 
        $file_extension = explode(".", $file["name"]);
        $file_extension = strtolower(end($file_extension));
        $accepted_formate = array("jpeg", "jpg", "png");

        $result = "";
        if ($file["size"] == 0) {
            $result = true;
        } else {
            $size = $file["size"]; // size in byte
            $mb_2 = 2000000;

            if ($size > $mb_2) {
                BaseController::redirect("add-manager");
                BaseController::set("error" , "File is too large, Upload less than or equal 2MB");
                $result = false;
            } elseif (in_array($file_extension, $accepted_formate)) {
                return true;
            } else {
                BaseController::redirect("add-manager");
                BaseController::set("error" , $file_extension . " This is file not allowed !!");
                $result = false;
            }
        }
        return $result;
    }

    private function validateNom()
    {
        $val = $this->test_input($this->postData['nom']);
        if (empty($val)) {
            $this->addError('nom', 'Nom cannot be empty');
            $result = false;
        } elseif (!preg_match('/^[a-zA-Z]{3,8}$/', $val)) {
            $this->addError('nom', 'Nom must be 3-8 chars');
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function validatePrenom()
    {
        $val = $this->test_input($this->postData['prenom']);
        if (empty($val)) {
            $this->addError('prenom', 'Prenom cannot be empty');
            $result = false;
        } elseif (!preg_match('/^[a-zA-Z]{3,8}$/', $val)) {
            $this->addError('prenom', 'Prenom must be 3-8 chars');
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function validateEmail()
    {
        $val = $this->test_input($this->postData['email']);
        if (empty($val)) {
            $this->addError('email', 'Email cannot be empty');
            $result = false;
        } elseif (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
            $this->addError('email', 'Email not valid');
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function validateTel()
    {
        $val = $this->test_input($this->postData['tel']);
        if (empty($val)) {
            $this->addError('tel', 'tel cannot be empty');
            $result = false;
        } elseif (!preg_match('/^[0-9]{10}$/', $val)) {
            $this->addError('tel', 'tel must be 10 numbers');
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }





    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }
}