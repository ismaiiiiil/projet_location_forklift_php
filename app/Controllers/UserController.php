<?php
namespace app\Controllers;

use PDO;
use Exception;
use database\DB;
use app\Models\User;
use PDOException;

class UserController
{
    private $postData;
    public $errors = [];
    public $t = [];
    public $cpt = 0;

    public function __construct($post_data) {
        $this->postData = $post_data;
    }

    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function validateSignupUser() 
    {
        $this->validateNom();
        $this->validatePrenom();
        $this->validateEmail();
        $this->validateTel();
        $this->validatePassword();
        $this->validateCPassword();
    }

    function getUserById($id) 
    {
        try {
            $db = new DB();
            $sql = "SELECT * FROM users WHERE id = ?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$id]);
            return current($stmt->fetchAll(PDO::FETCH_ASSOC));
        }catch(PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
    }

    function getUserByEmail($email) 
    {
        try {
            $db = new DB();
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$email]);
            return current($stmt->fetchAll(PDO::FETCH_ASSOC));
        }catch(PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
    }
    
    // function getInfoWebSite() 
    // {
    //     try {
    //         $db = new DB();
    //         $sql = "SELECT * FROM website WHERE id = 1";
    //         $res = $db::connection()->query($sql);
    //         return current($res->fetchAll(PDO::FETCH_ASSOC));
    //     } catch (PDOException $e) {
    //         echo "Error fetching" . $e->getMessage();
    //     }
        
    // }

    function signup() 
    {
        $nom = $this->test_input($this->postData['nom']);
        $prenom = $this->test_input($this->postData['prenom']);
        $email = $this->test_input($this->postData['email']);
        $tel = $this->test_input($this->postData['tel']);
        $is_entreprise = $this->test_input($this->postData['is_entreprise']);
        $password = $this->test_input($this->postData['password']);
        $cpassword = $this->test_input($this->postData['cpassword']);

        try {
            $db = new DB();
            $this->validateIsEntreprise();
            $this->validateSignupUser();
            $this->checkEmailExists($email);
    
            if($this->validateIsEntreprise() !== false) {
                if($is_entreprise == "oui") {
                    
                    $this->validateNomEntreprise();
                    $this->validateEmailEntreprise();
                    $nom_entreprise = $this->postData['nom_entreprise'];
                    $email_entreprise = $this->postData['email_entreprise'];
                    if($this->validateNom() !== false && $this->validatePrenom() !== false &&
                        $this->validateEmail() !== false && $this->validateTel() !== false &&
                        $this->validatePassword() !== false && $this->validateCPassword() !== false &&
                        $this->validateNomEntreprise() !== false && $this->validateEmailEntreprise() !== false
                        && $this->checkEmailExists($email) !== false
                    ) {
                        $sql = "INSERT INTO users (id, email, nom, prenom, tel, is_entreprise, nom_entreprise, email_entreprise, password) 
                                VALUES (NULL, ?, ?, ?, ?, 1, ?, ?, ?);";
                        $stmt = $db::connection()->prepare($sql);
                        
                        $options = [
                            'cost' => 12
                        ];
                        $password = password_hash($password, PASSWORD_BCRYPT, $options);
                        $stmt->execute([$email,$nom, $prenom , $tel, $nom_entreprise, $email_entreprise ,$password ]);
                        if($stmt) {
                            BaseController::redirect('login');
                            BaseController::set('success' , 'Are you registered successfully');
                        }
                    }
                }else {
                    if($this->validateNom() !== false && $this->validatePrenom() !== false &&
                        $this->validateEmail() !== false && $this->validateTel() !== false &&
                        $this->validatePassword() !== false && $this->validateCPassword() !== false &&
                        $this->checkEmailExists($email) !== false
                    ) {
                        $sql = "INSERT INTO users (id, email, nom, prenom, tel, is_entreprise, nom_entreprise, email_entreprise, password) 
                                VALUES (NULL, ?, ?, ?, ?, 0, NULL, NULL, ?);";
                        $stmt = $db::connection()->prepare($sql);
                        
                        $options = [
                            'cost' => 12
                        ];
                        $password = password_hash($password, PASSWORD_BCRYPT, $options);

                        if($stmt->execute([$email,$nom, $prenom , $tel,$password ])) {
                            BaseController::redirect('login');
                            BaseController::set('success' , 'Are you registered successfully');
                        }
                    }
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
        
    }

    function getAllUser() 
    {
        try{
            $db =  new DB();
            $sql = "SELECT * FROM users";
            $res = $db::connection()->query($sql);
            while ($row = $res->fetch()) {
                $user = new User($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6], $row[7], $row[8], $row[9], $row[10]);
                $this->t[$this->cpt] = $user;
                $this->cpt++;
            }
        }catch(Exception $e) {
            echo 'Error: '.$e->getMessage();
        }
    }


    function getAllUserSearch() 
    {
        try{
            $db =  new DB();
            $sql = "SELECT * FROM users";
            $res = $db::connection()->query($sql);
            return $res->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e) {
            echo 'Error: '.$e->getMessage();
        }
    }

    function getAllUseresByNameEntreprise($nomUser, $isEntreprise)
    {
        try {
            $db = new DB();
            if(!empty($nomUser)) 
            {
                if($isEntreprise == 1) {
                    $sql = "SELECT * FROM users WHERE nom LIKE ? AND is_entreprise = 1";
                }elseif($isEntreprise == 0){
                    $sql = "SELECT * FROM users WHERE nom LIKE ? AND is_entreprise = 0";
                }else {
                    $sql = "SELECT * FROM users WHERE nom LIKE ? ";
                }
                $res = $db::connection()->prepare($sql);
                $res->execute(["%" . $nomUser . "%"]);
            }elseif(empty($nomUser)) {
                if($isEntreprise == 1) {
                    $sql = "SELECT * FROM users WHERE is_entreprise = 1";
                }elseif($isEntreprise == 0){
                    $sql = "SELECT * FROM users WHERE is_entreprise = 0";
                }else {
                    $sql = "SELECT * FROM users ";
                }
                $res = $db::connection()->query($sql);
                $res->execute();
            }
            
            while ($row = $res->fetch()) {
                $user = new User($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6], $row[7], $row[8],$row[9], $row[10]);
                $this->t[$this->cpt] = $user;
                $this->cpt++;
            }  
        
        }catch (Exception $e) {
            echo 'Error: '.$e->getMessage();
        }
    }

    function deleteUser($id)
    {
        try {
            if (!empty($id)) {
                $user = $this->getUserById($id);
                if($user->user_photo !== "user_default.jpg") {
                    $this->deletePhoto($user->user_photo);
                }

                $db = new DB();
                $id = $this->test_input($id);
                $stmt = $db::connection()->prepare("DELETE FROM users WHERE id = :id");
                $stmt->execute([":id" => $id]);
                BaseController::set('success', "User successfully deleted");
                BaseController::redirect("users");
            }
        } catch (Exception $e) {
            echo "Error deleting" . $e->getMessage();
        }
    }

    public function uploadPhoto($imagePoste, $oldImage = null)
    {
        $dir = "./public/images/users"; // dossier fin timchiw
        $time = time(); // heur
        $name = str_replace(' ', '-', strtolower($imagePoste["name"])); // espace => '-'  , name="image" ->"image" 
        $type = $imagePoste["type"]; // png , jpg .. ?

        $ext = substr($name, strpos($name, '.')); // mnin i9d3 -> image.jpg -> (.jpg)
        $ext = str_replace('.', '', $ext);  // (.jpg) => (jpg)
        $name = preg_replace("/\.[^.\s]{3,4}$/", "", $name); // -,/. -> "" vide
        $imageName = $name . '-' . $time . '.' . $ext; // le nom finale image
        if (move_uploaded_file($imagePoste["tmp_name"], $dir . "/" . $imageName)) { // shemain/public/uploads/image-time.png
            if($oldImage !== "user_default.jpg") {
                $this->deletePhoto($oldImage);
            }
            return $imageName;
        } //ila mabdlch image tanjibo image l9dima
        return $oldImage;
    }


    function forgotPassword() 
    {
        $db = new DB();
        $email = $this->test_input($this->postData['email']);
        if(!empty($email)) {
            $sql = "SELECT * FROM users WHERE email=?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$email]);
            if($stmt->rowCount() > 0) {
                $code = rand(999999, 111111);
                $sql = "UPDATE users SET code = ? WHERE email = ?";
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([$code ,$email]);
                if($stmt) {
                    // $_SESSION["code_number"] = $code;

                    $subject = "Email Verification Code";

                    $sender = "From: <Engiloc@gmail.com>\r\n";
                    $sender .= "MIME-Version: 1.0\r\n";
                    $sender .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                    // create the html message
                    // WEB SITE INFO
                    $web = new WebSiteController($this->postData);
                    $infoWeb = $web->getInfoWebSiteAssoc();
                    // USER INFO
                    $infoUser =$this->getUserByEmail($email);
                    
                    // CREATE THE SWAP VARIABLES ARRAY
                    $swap_var = array(
                        "{SITE_LOGO}" => $infoWeb["logo"],//site
                        "{SITE_NAME}" => $infoWeb["nom_website"],
                        "{SITE_MAIL}" => $infoWeb["adresse1"],
                        "{SITE_NUMERO}" => $infoWeb["tel1"], 

                        "{USER_CODE}" => $code,// user
                        "{USER_NAME}" => $infoUser["nom"]
                    );
                    // ------------
                    $template_file = "./resources/views/users/sendEmailVerify.php";
                    if(file_exists($template_file))
                        $message = file_get_contents($template_file);
                    else 
                        die("unable to load template");

                    // search replace all the swap_vars
                    foreach(array_keys($swap_var) as $key) {
                        if (strlen($key) > 2 && trim($key) != "") {
                            $message = str_replace($key, $swap_var[$key], $message);
                        }
                    }

                    if (mail($email, $subject, $message, $sender)) {
                        $_SESSION["code_email"] = $email;
                        BaseController::redirect("verifyEmail");
                        BaseController::set("info" , "We've sent a verification code to your Email <br> $email");
                    } else {
                        BaseController::redirect("forgot-password");
                        BaseController::set("warning" , "Failed while sending code!");
                    }
                }
            }else {
                BaseController::redirect("forgot-password");
                BaseController::set("error" , "Email is not valid!");
            }
        }
    }

    function verifyEmail()
    {
        $db = new DB();
        $code = $this->test_input($this->postData["code"]);
        if(!empty($code) && is_numeric($code)) {
            $sql = "SELECT * FROM users WHERE code=?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$code]);
            if($stmt->rowCount() > 0) {
                $sql ="UPDATE users SET code = 0 WHERE code = ?";
                $stmt = $db::connection()->prepare($sql);
                
                if($stmt->execute([$code])) {
                    $_SESSION["code_user"] = true;
                    BaseController::redirect("newPassword");
                } else {
                    BaseController::redirect("verifyEmail");
                    BaseController::set("error" , "Error code is invalid!");
                }
            }else {
                BaseController::redirect("verifyEmail");
                BaseController::set("error" , "Error code is invalid!");
            }
        }else {
            BaseController::redirect("verifyEmail");
            BaseController::set("error" , "Error code is invalid!");
        }
    }

    function newPassword()
    {
        $db = new DB();
        $user_email = $_SESSION["code_email"]; //email_user
        $password = $this->test_input($this->postData["password"]);
        $cpassword = $this->test_input($this->postData["cpassword"]);

        $this->validateCPassword();

        if( !empty($password) && !empty($cpassword)) {

            if($this->validateCPassword() !== false) {

                $sql = "SELECT * FROM users WHERE email = ? ";

                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([ $user_email ]);

                if($stmt->rowCount() > 0) {
                    $options = [
                        "cost" => 12
                    ];
                    $password = password_hash($password, PASSWORD_BCRYPT, $options);
    
                    $sql = "UPDATE users SET password = ? WHERE email = ? ";
                    $stmt = $db::connection()->prepare($sql);
                    $stmt->execute([$password, $user_email ]);
                    if($stmt) {
                        unset($_SESSION["code_email"]);
                        unset($_SESSION["code_user"]); //code_user
                        BaseController::redirect("login");
                        BaseController::set("success" , "Mot de passe modifier avec success");
                    }
                }                
            }
        }else {
            BaseController::redirect("newPassword");
            BaseController::set("error" , "Tous les champs est obligatoire");
        } 
    }

    function updatePhotoProfile() 
    {
        try {
            $this->validateImage("image");
            if($this->validateImage("image") !== false )
            {
                $db = new DB();
                $oldImage = $this->postData["current_image"];

                $file = $this->uploadPhoto($_FILES["image"], $oldImage);
                $nom_user = $_SESSION["nom_user"]; 
                $email_user = $_SESSION["email_user"]; 

                $sql = "UPDATE users SET user_photo	= ? WHERE nom = ? AND email = ?";
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([$file, $nom_user, $email_user]);
                if($stmt) {
                    BaseController::redirect("profil-user");
                    BaseController::set("success" , "Profile modifier avec success");
                }
            }else {
                BaseController::redirect('profil-user');
                BaseController::set('error' , 'Image n\'est pas valid');
            }
        } catch (PDOException $e) {
            echo "Error uploading" . $e->getMessage();
        }
    }

    function login() 
    {
        $db = new DB();
        $email = $this->test_input($this->postData['email']);
        $password = $this->test_input($this->postData['password']);

        if(!empty($email) && !empty($password)) {
            $sql = "SELECT * FROM users WHERE email=?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$email]);
            if($stmt->rowCount() > 0) {
                $user = current($stmt->fetchAll(PDO::FETCH_OBJ));

                if( $user->email === $email  && password_verify( $password, $user->password )) 
                {
                    session_start();
                    $_SESSION['id_user'] = $user->id;
                    $_SESSION['nom_user'] = $user->nom;
                    $_SESSION['email_user'] = $user->email;
                    // $_SESSION['email'] = $email;
                    BaseController::redirect('home');
                    BaseController::set('success' , 'Are you loged successfully');
                }else {
                    BaseController::redirect('login');
                    BaseController::set('error' , 'Password is incorrect');
                }
            }else {
                BaseController::redirect('login');
                BaseController::set('error' , 'Login is incorrect');
            }
        }else {
            BaseController::redirect('login');
            BaseController::set('error' , 'Tous les champs est obligatoire');
        } 
    }
    function updatePassword()
    {
        $db = new DB();
        $nom_user = $_SESSION['nom_user']; //email_user
        $email_user = $_SESSION['email_user']; //email_user
        $old_pass = $this->test_input($this->postData['old_pass']);
        $password = $this->test_input($this->postData['password']);
        $cpassword = $this->test_input($this->postData['cpassword']);

        $this->validateCPassword();

        if(!empty($old_pass) &&!empty($password) && !empty($cpassword)) {

            if($this->validateCPassword() !== false) {

                $sql = "SELECT * FROM users WHERE nom = ? AND email = ? ";

                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([ $nom_user, $email_user ]);

                $user = current($stmt->fetchAll(PDO::FETCH_OBJ));

                if( $user->nom === $nom_user 
                    && $user->email === $email_user  
                    && password_verify( $old_pass, $user->password )
                ){
                    // update Password
                    $options = [
                        'cost' => 12
                    ];
                    $password = password_hash($password, PASSWORD_BCRYPT, $options);

                    $sql = "UPDATE users SET password = ? WHERE nom = ? AND email = ? ";
                    $stmt = $db::connection()->prepare($sql);
                    $stmt->execute([$password, $nom_user, $email_user ]);
                    if($stmt) {
                        BaseController::redirect('profil-user');
                        BaseController::set('success' , 'Mot de passe modifier avec success');
                    }
                }else {
                    BaseController::redirect('profil-user');
                    BaseController::set('error' , 'Password is incorrect');
                }
                
            }
        }else {
            BaseController::redirect('profil-user');
            BaseController::set('error' , 'Tous les champs est obligatoire');
        } 
    }

    function getUserConnecter() 
    {
        try {
            $db = new DB();
            $sql = "SELECT * FROM users WHERE nom=? AND email=?";
            $stmt = $db::connection()->prepare($sql);
            $nom_user = $_SESSION['nom_user'];
            $email_user = $_SESSION['email_user'];

            $stmt->execute([$nom_user,$email_user]);
            return current($stmt->fetchAll(PDO::FETCH_OBJ));
            
        } catch (PDOException $e) {
            echo 'error' . $e->getMessage();
        } 

    }

    // Check if email exists
    private function checkEmailExists($email) 
    {
        if(!empty($email) && $this->validateEmail() !== false) {
            $db = new DB();
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([ $email ]);
            if($stmt->rowCount() > 0) {
                $this->addError('email', 'Email already exists');
                $result = false;
            } else {
                $result = true;
            }
            return $result;
        }
    }

    public function deletePhoto($name = null)
    {
        $filename = "public/images/users/$name";
        if (file_exists($filename)) {
            unlink($filename);
            return true;
        }
        return false;
    }
    // -------------------------------------
    // -- Validation --
    // -------------------------------------

    function validateImage($nameImg)
    { 
        //$file => $_FILES['name']
        $file = $_FILES["$nameImg"];

        // type file 
        $file_extension = explode('.', $file['name']);
        $file_extension = strtolower(end($file_extension));
        $accepted_formate = array('jpeg', 'jpg', 'png');

        $result = "";
        if ($file['size'] == 0) {
            BaseController::redirect('profil-user');
            BaseController::set('error' , '$nameImg is obligatory');
            $result = false;
        } else {
            $size = $file['size']; // size in byte
            $mb_2 = 2000000;

            if ($size > $mb_2) {
                BaseController::redirect('profil-user');
                BaseController::set('error' , 'File is too large, Upload less than or equal 2MB');
                $result = false;
            } elseif (in_array($file_extension, $accepted_formate)) {
                return true;
            } else {
                BaseController::redirect('profil-user');
                BaseController::set('error' , $file_extension . ' This is file not allowed !!');
                $result = false;
            }
        }
        return $result;
    }
    private function validateIsEntreprise()
    {
        $val = $this->test_input($this->postData['is_entreprise']);
        if (empty($val)) {
            $this->addError('is_entreprise', 'Choisir si tu est entreprise ou nom');
            $result = false;
        } else {
            $result = true;
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


    // Entreprise email_entreprise
    private function validateNomEntreprise()
    {
        $val = $this->test_input($this->postData['nom_entreprise']);
        if (empty($val)) {
            $this->addError('nom_entreprise', 'Nom entreprise cannot be empty');
            $result = false;
        } elseif (!preg_match('/^[a-zA-Z]{3,8}$/', $val)) {
            $this->addError('nom_entreprise', 'Nom entreprise must be 3-8 chars');
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function validateEmailEntreprise()
    {
        $val = $this->test_input($this->postData['email_entreprise']);
        if (empty($val)) {
            $this->addError('email_entreprise', 'Email entreprise cannot be empty');
            $result = false;
        } elseif (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
            $this->addError('email_entreprise', 'Email entreprise not valid');
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
