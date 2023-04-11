<?php

namespace app\Controllers;

use PDO;
use Exception;
use database\DB;
use app\Models\Admin;
use app\Controllers\WebSiteController;

class AdminController
{
    private $postData;
    public $errors = array();
    public $valid = [];
    public $t = [];
    private $cpt = 0;

    public function __construct($post_data)
    {
        $this->postData = $post_data;
    }
    // Route Administration
    public function index($page)
    {
        include("resources/views/admin" . $page . ".php");
    }
    // End Route


    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function getAdminByEmail($email) {
        try {
            $db = new DB();
            $sql = "SELECT * FROM admin WHERE email LIKE ?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$email]);
            return current($stmt->fetchAll(PDO::FETCH_ASSOC));
        }catch(Exception $e) {
            echo "Error : " . $e->getMessage();
        }
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

        $stmt->execute([$email, $nom, $prenom, $tel, $admin_profile, $is_admin, $passwordcripter]);
    }


    function lastIdManager()
    {
        $db = new DB();
        $sql = "SELECT max(id)+1 FROM admin";
        return $db::connection()->query($sql)->fetchAll();
    }

    function checkExistManager($id) {
        $db = new DB();
        $sql = "SELECT * FROM roles_manager WHERE manager_id = $id";
        return $db::connection()->query($sql)->fetchAll();
    }
    function addManager()
    {

        //  print_r();
        try {
            $dataRoles = explode(",", $this->postData["roles"]);

            $nom = $this->test_input($this->postData['nom']);
            $prenom = $this->test_input($this->postData['prenom']);
            $email = $this->test_input($this->postData['email']);
            $tel = $this->test_input($this->postData['tel']);
            $this->validateNom();
            $this->validatePrenom();
            $this->validateEmail();
            $this->validateTel();
            $this->checkEmailExists($email);
            $db = new DB();
            if (
                $this->validateNom() !== false && $this->validatePrenom() !== false && $this->validateEmail() !== false && $this->validateTel() !== false &&
                $this->checkEmailExists($email) !== false
            ) {

                $id_manager = $this->lastIdManager();
                if ($id_manager[0][0] == NULL) {
                    $id_manager[0][0] = 1;
                }

                $sql = "INSERT INTO admin(id, email, nom, prenom, tel,admin_profile,is_admin, password)
                        VALUES (".$id_manager[0][0]." , ?, ?, ?,?,?, 0, ?);";
                // echo $sql;
                $file = $this->uploadPhotoManger($_FILES["image"]);
                $pass = $nom . "_" . $prenom . "_" . date("Y");

                $options = [
                    'cost' => 12
                ];
                $password = password_hash($pass, PASSWORD_BCRYPT, $options);

                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([
                    $email, $nom, $prenom, $tel, $file, $password
                ]);

                if ($stmt) {
                    if(count($this->checkExistManager($id_manager[0][0])) == 0) {
                        // echo count($dataRoles);
                        // echo(!!$dataRoles[0]);
                        if(!!$dataRoles[0]) {
                            $sqlManager = "INSERT INTO roles_manager(manager_id,";
                            for($i=0; $i < count($dataRoles); $i++) {
                                if(count($dataRoles) == $i + 1) {
                                    $sqlManager .= "$dataRoles[$i]";
                                }else{
                                    $sqlManager .= "$dataRoles[$i],";
                                }
                            }
                            $sqlManager .=") VALUES(".$id_manager[0][0] ."," ;
                            for($i=0; $i < count($dataRoles); $i++) {
                                if(count($dataRoles) == $i + 1) {
                                    $sqlManager .= "1" ;
                                }else{
                                    $sqlManager .= "1," ;
                                }
                            }
                            $sqlManager .=");";
                        }else {
                            $sqlManager = "INSERT INTO roles_manager(id,manager_id) VALUES(NULL,". $id_manager[0][0] .")";
                        }

                        // echo $sqlManager . "<hr/>";
                        $stmt1 = $db::connection()->exec($sqlManager);

                        if($stmt1){
                            BaseController::redirect("manager");
                            BaseController::set("success", "Manager ajouter avec succés");
                        }
                    }
                    BaseController::redirect("manager");
                    BaseController::set("success", "Manager ajouter avec succés");
                }
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function getManagerConnecter(){
        if (!isset($_SESSION["admin"])) {
            $manager = $this->getAdminConnecter();
            return $this->getRoles($manager->id);
        }
    }
    function getRoles($manager_id) {
        $db = new DB();
        $sql = "SELECT * FROM roles_manager WHERE manager_id = ? ";
        $stmt = $db::connection()->prepare($sql);
        $stmt->execute([$manager_id]);
        return current($stmt->fetchAll(PDO::FETCH_OBJ));
    }
    function getManagerById($id)
    {
        try {
            $db = new DB();

            $sql = "SELECT * FROM admin WHERE id = ? AND is_admin = 0";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$id]);
            return current($stmt->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function getAllRolesById($id)
    {
        $manager = $this->getManagerById($id);
        $roles =  $this->getRoles($manager->id);
        $result = [];

        if(!!$roles->orders) {
            $result[] = 'orders' ;
        }
        if(!!$roles->show_order) {
            $result[] = 'show-order' ;
        }
        if(!!$roles->delete_order) {
            $result[] = 'delete_order' ;
        }
        if(!!$roles->controle_order) {
            $result[] = 'controle_order' ;
        }
        if(!!$roles->notifications) {
            $result[] = 'notifications' ;
        }
        if(!!$roles->machines) {
            $result[] = 'machine' ;
        }
        if(!!$roles->add_machine) {
            $result[] = 'add-machine' ;
        }
        if(!!$roles->edit_machine) {
            $result[] = 'edit-machine' ;
        }
        if(!!$roles->delete_machine) {
            $result[] = 'delete_machine' ;
        }
        if(!!$roles->categories	) {
            $result[] = 'category' ;
        }
        if(!!$roles->add_category	) {
            $result[] = 'add-category' ;
        }
        if(!!$roles->edit_category) {
            $result[] = 'edit-category' ;
        }
        if(!!$roles->delete_category) {
            $result[] = 'delete_category' ;
        }
        if(!!$roles->users) {
            $result[] = 'users' ;
        }

        if(!!$roles->delete_user) {
            $result[] = 'delete_user' ;
        }
        if(!!$roles->feedback) {
            $result[] = 'testimonials' ;
        }

        if(!!$roles->perte_materilles) {
            $result[] = 'perte_materielles' ;
        }
        if(!!$roles->add_perte_materille) {
            $result[] = 'add-perte_materielle' ;
        }
        if(!!$roles->edit_perte_materille) {
            $result[] = 'edit-perte_materielle' ;
        }
        if(!!$roles->delete_perte_materille	) {
            $result[] = 'delete_perte_materille' ;
        }
        if(!!$roles->benefices) {
            $result[] = 'benefices' ;
        }
        if(!!$roles->delete_benefice) {
            $result[] = 'delete_benefice' ;
        }

        return $result;

    }
    function editManager($id)
    {
        try {
            $nom = $this->test_input($this->postData['nom']);
            $prenom = $this->test_input($this->postData['prenom']);
            $email = $this->test_input($this->postData['email']);
            $tel = $this->test_input($this->postData['tel']);
            $manager = $this->getManagerById($id);

            $this->validateNom();
            $this->validatePrenom();
            $this->validateEmail();
            $this->validateTel();
            $this->checkEmailEditExists($email, $id);
            $db = new DB();

            if (
                $this->validateNom() !== false && $this->validatePrenom() !== false && $this->validateEmail() !== false && $this->validateTel() !== false
                && $this->checkEmailEditExists($email, $id) !== false
            ) {
                $sql = "UPDATE admin SET email = ?, nom = ?, prenom = ?, tel = ?,admin_profile = ?, password = ?
                            WHERE id = ? AND is_admin = 0";
                $pass = $nom . "_" . $prenom . "_" . date("Y");

                $options = [
                    'cost' => 12
                ];
                $password = password_hash($pass, PASSWORD_BCRYPT, $options);

                $oldImage = $this->postData['current_image'];
                $file = $this->uploadPhotoManger($_FILES["image"], $oldImage);

                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([
                    $email, $nom, $prenom, $tel, $file, $password, $id
                ]);

                $dataRoles = explode(",", $this->postData["roles"]);

                $resetSql = "UPDATE `roles_manager` SET `orders` = '0', `show_order` = '0', `delete_order` = '0',
                                                        `controle_order` = '0', `notifications` = '0', `machines` = '0',
                                                        `add_machine` = '0', `edit_machine` = '0', `delete_machine` = '0',
                                                        `categories` = '0', `add_category` = '0', `edit_category` = '0',
                                                        `delete_category` = '0', `users` = '0', `delete_user` = '0',
                                                        `feedback` = '0', `delete_feedback` = '0',
                                                        `controle_feedback` = '0', `perte_materilles` = '0',
                                                        `add_perte_materille` = '0', `edit_perte_materille` = '0',
                                                        `delete_perte_materille` = '0', `benefices` = '0',
                                                        `delete_benefice` = '0' WHERE manager_id = $id";
                $db::connection()->exec($resetSql);

                if(!!$dataRoles[0]) {
                    $sqlManager = "UPDATE roles_manager SET";
                    for($i=0; $i < count($dataRoles); $i++) {
                        if(count($dataRoles) == $i + 1) {
                            $sqlManager .= " $dataRoles[$i] = 1";
                        }else{
                            $sqlManager .= " $dataRoles[$i] = 1,";
                        }
                    }

                    $sqlManager .=" WHERE manager_id = $id ;";
                    // echo $sqlManager;
                    $db::connection()->exec($sqlManager);
                }
                if ($stmt) {
                    BaseController::redirect("manager");
                    BaseController::set("success", "Manager modifier avec succés");
                }
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    // check if email exists
    private function checkEmailExists($email)
    {
        if (!empty($email) && $this->validateEmail() !== false) {
            $db = new DB();
            $sql = "SELECT * FROM admin WHERE email = ?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                $this->addError('email','Email already exists');
                $result = false;
            } else {
                $result = true;
            }
            return $result;
        }
    }
    // check if email exists
    private function checkEmailEditExists($email, $id)
    {
        if (!empty($email) && $this->validateEmail() !== false) {
            $manager = $this->getManagerById($id);
            if ($manager->email !== $email) {
                $db = new DB();
                $sql = "SELECT * FROM admin WHERE email = ? AND is_admin = 0";
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([$email]);
                if ($stmt->rowCount() > 0) {
                    $this->addError('email', 'Email already exists');
                    $result = false;
                } else {
                    $result = true;
                }
            } else {
                $result = true;
            }
            return $result;
        }
    }
    function login()
    {
        $db = new DB();
        $login = $this->test_input($this->postData["login"]);
        $password = $this->test_input($this->postData["password"]);

        if (!empty($login) && !empty($password)) {
            $sql = "SELECT * FROM admin WHERE  email = ?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$login]);
            if ($stmt->rowCount() > 0) {
                $admin = current($stmt->fetchAll(PDO::FETCH_OBJ));

                // var_dump($this->postData);
                if (
                    $admin->email === $login
                    && password_verify($password, $admin->password)
                ) {
                    if ($admin->is_admin    === 1) {
                        session_start();
                        $_SESSION["nom_admin"] = $admin->nom;
                        $_SESSION["email_admin"] = $admin->email;
                        $_SESSION["login_admin"] = $login;
                        $_SESSION["admin"] = true;
                        BaseController::redirect("dashboard");
                        BaseController::set("success", "Are you loged successfully");
                    } elseif ($admin->is_admin === 0) {
                        session_start();
                        $_SESSION["nom_admin"] = $admin->nom;
                        $_SESSION["email_admin"] = $admin->email;
                        $_SESSION["login_admin"] = $login;
                        $_SESSION["manager"] = true;
                        BaseController::redirect("dashboard");
                        BaseController::set("success", "Are you loged successfully");
                    }
                } else {
                    BaseController::redirect("login-administrateur");
                    BaseController::set("danger", "Password is incorrect");
                }
            } else {
                BaseController::redirect("login-administrateur");
                BaseController::set("danger", "Login is incorrect");
            }
        } else {
            BaseController::redirect("login-administrateur");
            BaseController::set("danger", "Tous les champs est obligatoire");
        }
    }

    function getAllManagement()
    {
        try {
            $db = new DB();
            $sql = "SELECT * FROM admin WHERE is_admin = 0";
            $stmt = $db::connection()->query($sql);
            while ($row = $stmt->fetch()) {
                $management = new Admin($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
                $this->t[$this->cpt] = $management;
                $this->cpt++;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function getAdminConnecter()
    {
        try {
            $db = new DB();
            if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
                $sql = "SELECT * FROM admin WHERE email = ? AND nom = ? AND is_admin = 1";
            } else {
                $sql = "SELECT * FROM admin WHERE email = ? AND nom = ? AND is_admin = 0";
            }
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$_SESSION["email_admin"], $_SESSION["nom_admin"]]);
            return current($stmt->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    function getNbrUsers()
    {
        try {
            $db = new DB();
            $sql = "SELECT COUNT(*) as nbrUsers FROM users";
            $stmt = $db::connection()->query($sql);
            return current($stmt->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function getNbrOrders()
    {
        try {
            $db = new DB();
            $sql = "SELECT COUNT(*) as nbrOrders FROM orders";
            $stmt = $db::connection()->query($sql);
            return current($stmt->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    function getNbrOrdersNow()
    {
        try {
            $db = new DB();
            $sql = "SELECT COUNT(*) as nbrOrdersNow FROM orders WHERE date_order = CURRENT_DATE";
            $stmt = $db::connection()->query($sql);
            return current($stmt->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function getNbrMachines()
    {
        try {
            $db = new DB();
            $sql = "SELECT COUNT(*) as nbrMachines FROM machines";
            $stmt = $db::connection()->query($sql);
            return current($stmt->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function getSumBeneficeNow()
    {
        try {
            $db = new DB();
            $sql = "SELECT SUM(bénéfices.prix_hors_taxe) sumBenefices FROM bénéfices
                    WHERE date_bénéfices = CURRENT_DATE";
            $stmt = $db::connection()->query($sql);
            return current($stmt->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function getClientPlusFidel()
    {
        try {
            $db = new DB();
            $sql = "SELECT * , countNbrUserByEmail(users.email) nbrOrder
                    FROM users
                    HAVING nbrOrder > 0
                    ORDER BY nbrOrder DESC
                    LIMIT 10";
            $stmt = $db::connection()->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }




    // ------------ Forgot Password ----------------------
    function forgotPassword()
    {
        try {
            $db = new DB();
            $email = $this->test_input($this->postData["email"]);
            if (!empty($email)) {
                $sql = "SELECT * FROM admin WHERE email LIKE ?";
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([$email]);
                if ($stmt->rowCount() > 0) {
                    $code = rand(999990, 111111);
                    $sql = "UPDATE admin SET code = ? WHERE email LIKE ?";
                    $stmt = $db::connection()->prepare($sql);
                    $stmt->execute([$code, $email]);
                    if ($stmt) {
                        $subject = "Email Verification Code";

                        $sender = "From: <Engiloc@gmail.com>\r\n";
                        $sender .= "MIME-Version: 1.0\r\n";
                        $sender .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                        // create the html message
                        // WEB SITE INFO
                        $web  = new WebSiteController($this->postData);
                        $infoWeb = $web->getInfoWebSiteAssoc();
                        // USER INFO

                        $infoAdmin = $this->getAdminByEmail($email);

                        // CREATE THE SWAP VARIABLES ARRAY
                        $swap_var = array(
                            "{SITE_LOGO}" => $infoWeb["logo"], //site
                            "{SITE_NAME}" => $infoWeb["nom_website"],
                            "{SITE_MAIL}" => $infoWeb["adresse1"],
                            "{SITE_NUMERO}" => $infoWeb["tel1"],

                            "{USER_CODE}" => $code, // user
                            "{USER_NAME}" => $infoAdmin["nom"]
                        );
                        // ------------
                        $template_file = "./resources/views/users/sendEmailVerify.php";
                        if (file_exists($template_file))
                            $message = file_get_contents($template_file);
                        else
                            die("unable to load template");

                        // search replace all the swap_vars
                        foreach (array_keys($swap_var) as $key) {
                            if (strlen($key) > 2 && trim($key) != "") {
                                $message = str_replace($key, $swap_var[$key], $message);
                            }
                        }

                        if (mail($email, $subject, $message, $sender)) {
                            $_SESSION["email_code_admin"] = $email;
                            BaseController::redirect("verify-code-email-admin");
                            BaseController::set("info", "We've sent a verification code to your Email <br> $email");
                        } else {
                            BaseController::redirect("forgot-password-admin");
                            BaseController::set("warning", "Failed while sending code!");
                        }
                    }
                }else {
                    BaseController::redirect("forgot-password-admin");
                    BaseController::set("danger" , "Email is not valid!");
                }
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function verifierCodeEmail()
    {
        try {
            $db = new DB();
            $email = $_SESSION["email_code_admin"];
            $code = $this->test_input($this->postData["code"]);

            if(!empty($code) && is_numeric($code)) {
                $sql = "SELECT * FROM admin WHERE code = ? AND email = ?";
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([$code, $email ]);
                if($stmt->rowCount() > 0) {
                    $sql = "UPDATE admin SET code = 0 WHERE code = ? AND email = ?";
                    $stmt = $db::connection()->prepare($sql);

                    if($stmt->execute([$code, $email])) {
                        $_SESSION["code_admin"] = true;
                        BaseController::redirect("new-password-admin");
                    } else {
                        BaseController::redirect("verify-code-email-admin");
                        BaseController::set("danger" , "Error code is invalid!");
                    }
                }else {
                    BaseController::redirect("verify-code-email-admin");
                    BaseController::set("danger" , "Error code is invalid!");
                }
            }else {
                BaseController::redirect("verify-code-email-admin");
                BaseController::set("danger" , "Error code is invalid!");
            }
        }catch(Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function newPassword()
    {
        $db = new DB();
        $email = $_SESSION["email_code_admin"];
        $password = $this->test_input($this->postData['password']);
        $cpassword = $this->test_input($this->postData['cpassword']);
        $this->validateCPassword();
        $this->validatePassword();
        if(!empty($password) && !empty($cpassword)) {
            if($this->validateCPassword() !== false) {
                $sql = "SELECT * FROM admin WHERE email = ?";
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([$email]);

                if($stmt->rowCount() > 0) {
                    $options = [
                        "cost" => 12
                    ];
                    $password = password_hash($password, PASSWORD_BCRYPT, $options);
                    $sql = "UPDATE admin SET password = ? WHERE email = ?";
                    $stmt = $db::connection()->prepare($sql);
                    $stmt->execute([$password, $email]);
                    if($stmt) {
                        unset($_SESSION["email_code_admin"]);
                        unset($_SESSION["code_admin"]);
                        BaseController::redirect("login-administrateur");
                        BaseController::set("success" , "Mot de passe modifier avec success");
                    }
                }
            }
        }else {
            BaseController::redirect("new-password-admin");
            BaseController::set("danger" , "Tous les champs est obligatoire");
        }
    }
    // ------------ End Forgot Password ------------------


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
            if ($oldImage !== "admin_default.jpg") {
                $this->deletePhoto($oldImage);
            }
            return $imageName;
        } //ila mabdlch image tanjibo image l9dima
        return $oldImage;
    }

    public function uploadPhotoManger($imagePoste, $oldImage = null)
    {
        if ($imagePoste["size"] === 0) {
            return "admin_default.jpg";
        } else {
            $dir = "./public/images/manager"; // dossier fin timchiw
            $time = time(); // heur
            $name = str_replace(" ", "-", strtolower($imagePoste["name"])); // espace => "-"  , name="image" ->"image"
            $type = $imagePoste["type"]; // png , jpg .. ?

            $ext = substr($name, strpos($name, ".")); // mnin i9d3 -> image.jpg -> (.jpg)
            $ext = str_replace(".", "", $ext);  // (.jpg) => (jpg)
            $name = preg_replace("/\.[^.\s]{3,4}$/", "", $name); // -,/. -> "" vide
            $imageName = $name . "-" . $time . "." . $ext; // le nom finale image
            if (move_uploaded_file($imagePoste["tmp_name"], $dir . "/" . $imageName)) { // shemain/public/uploads/image-time.png
                if ($oldImage !== "admin_default.jpg") {
                    $this->deletePhotoManager($oldImage);
                }
                return $imageName;
            }
            return $oldImage;
        }
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

    function deleteManager($id)
    {
        try {
            if (!empty($id) && is_numeric($id)) {
                $db = new DB();
                $id = $this->test_input($id);
                $manager = $this->getManagerById($id);
                $this->deletePhotoManager($manager->admin_profile);

                $sql = "DELETE FROM admin WHERE id = :id";
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([":id" => $id]);
                if ($stmt) {
                    BaseController::set('success', 'Manager supprimer avec success');
                    BaseController::redirect('manager');
                }
            }
        } catch (Exception $e) {
            echo "Error deleting" . $e->getMessage();
        }
    }

    function getAllManagementSelect()
    {
        try {
            $db = new DB();
            $sql = "SELECT * FROM admin WHERE is_admin = 0";
            $stmt = $db::connection()->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            echo "Error : " . $e->getMessage();
        }
    }
    function getAllmanagerByName($nom)
    {
        try {
            $db = new DB();
            $sql = "SELECT * FROM admin WHERE nom = ? AND is_admin = 0";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$nom]);
            while ($row = $stmt->fetch()) {
                $manager = new Admin($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7]);
                $this->t[$this->cpt] = $manager;
                $this->cpt++;
            }
        } catch (Exception $e) {
            echo "Error " . $e->getMessage();
        }
    }

    function updatePhotoProfile()
    {
        // try {
        $this->validateImage("image");
        if ($this->validateImage("image") !== false) {
            $db = new DB();
            $oldImage = $this->postData["current_image"];

            if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
                $file = $this->uploadPhoto($_FILES["image"], $oldImage);
            } else {
                $file = $this->uploadPhotoManger($_FILES["image"], $oldImage);
            }
            $nom_admin = $_SESSION["nom_admin"];
            $email_admin = $_SESSION["email_admin"];

            $sql = "UPDATE admin SET admin_profile	= ? WHERE nom = ? AND email = ?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$file, $nom_admin, $email_admin]);
            if ($stmt) {
                BaseController::redirect("profile-administrateur");
                BaseController::set("success", "Profile modifier avec success");
            }
        } else {
            BaseController::redirect("profile-administrateur");
            BaseController::set("danger", "Image n\"est pas valid");
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

        if (!empty($old_pass) && !empty($password) && !empty($cpassword)) {

            if ($this->validateCPassword() !== false) {
                if ($_SESSION["admin"] === true) {
                    $sql = "SELECT * FROM admin WHERE nom = ? AND email = ? AND is_admin = 1";
                } else {
                    $sql = "SELECT * FROM admin WHERE nom = ? AND email = ? AND is_admin = 0";
                }
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([$nom_admin, $email_admin]);

                $admin = current($stmt->fetchAll(PDO::FETCH_OBJ));

                if (
                    $admin->nom === $nom_admin
                    && $admin->email === $email_admin
                    && password_verify($old_pass, $admin->password)
                ) {
                    // update Password
                    $options = [
                        'cost' => 12
                    ];
                    $password = password_hash($password, PASSWORD_BCRYPT, $options);

                    $sql = "UPDATE admin SET password = ? WHERE nom = ? AND email = ? ";
                    $stmt = $db::connection()->prepare($sql);
                    $stmt->execute([$password, $nom_admin, $email_admin]);
                    if ($stmt) {
                        BaseController::redirect('profile-administrateur');
                        BaseController::set('success', 'Mot de passe modifier avec success');
                    }
                } else {
                    BaseController::redirect('profile-administrateur');
                    BaseController::set('danger', 'Password is incorrect');
                }
            }
        } else {
            BaseController::redirect('profile-administrateur');
            BaseController::set('danger', 'Tous les champs est obligatoire');
        }
    }
    // -------------------------------------
    // -- Validation --
    // -------------------------------------

    private function validateCPassword()
    {
        $pssw = $this->test_input($this->postData['password']);
        $cpssw = $this->test_input($this->postData['cpassword']);
        if (empty($cpssw)) {
            $this->addError('cpassword', 'Password cannot be empty');
            $result = false;
        } elseif ($pssw !== $cpssw) {
            $this->addError('cpassword', 'Confirm Password is not correct');
            $result = false;
        } else {
            $result = true;
            $this->addValid('cpassword', true);
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
            BaseController::set("danger", "$nameImg is obligatory");
            $result = false;
        } else {
            $size = $file["size"]; // size in byte
            $mb_2 = 2000000;

            if ($size > $mb_2) {
                BaseController::redirect("profile-administrateur");
                BaseController::set("danger", "File is too large, Upload less than or equal 2MB");
                $result = false;
            } elseif (in_array($file_extension, $accepted_formate)) {
                return true;
            } else {
                BaseController::redirect("profile-administrateur");
                BaseController::set("danger", $file_extension . " This is file not allowed !!");
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
                BaseController::set("danger", "File is too large, Upload less than or equal 2MB");
                $result = false;
            } elseif (in_array($file_extension, $accepted_formate)) {
                return true;
            } else {
                BaseController::redirect("add-manager");
                BaseController::set("danger", $file_extension . " This is file not allowed !!");
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
            $this->addValid('nom', true);
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
            $this->addValid('prenom', true);
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
            $this->addValid('email', true);
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
        } elseif (!preg_match('/^[0-9]{9,12}$/', $val)) {
            $this->addError('tel', 'tel must be 9 a 12 numbers');
            $result = false;
        } else {
            $this->addValid('tel', true);
            $result = true;
        }
        return $result;
    }

    private function validatePassword()
    {
        $val = $this->test_input($this->postData['password']);
        // Validate password strength
        $uppercase    = preg_match('@[A-Z]@', $val);
        $lowercase    = preg_match('@[a-z]@', $val);
        $number       = preg_match('@[0-9]@', $val);
        $specialchars = preg_match('@[^\w]@', $val);
        if (empty($val)) {
            $this->addError('password', 'Password cannot be empty');
            $result = false;
        // } elseif (!$uppercase || !$lowercase || !$number || !$specialchars || strlen($val) < 8) {
        } elseif (!preg_match('/[a-zA-Z0-9\w]{5,12}/', $val)) {
            $this->addError('password', 'Password is not Strong');
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
    private function addValid($key, $val)
    {
        $this->valid[$key] = $val;
    }
}
