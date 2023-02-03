<?php
namespace app\Controllers;

use database\DB;

class UserController
{
    private $postData;
    public $errors = [];

    public function __construct($post_data) {
        $this->postData = $post_data;
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function validateSignupUser() {
        $this->validateNom();
        $this->validatePrenom();
        $this->validateEmail();
        $this->validateTel();
        $this->validatePassword();
        $this->validateCPassword();
        
    }

    function signup() {
        $nom = $this->test_input($this->postData['nom']);
        $prenom = $this->test_input($this->postData['prenom']);
        $email = $this->test_input($this->postData['email']);
        $tel = $this->test_input($this->postData['tel']);
        $is_entreprise = $this->test_input($this->postData['is_entreprise']);
        $password = $this->test_input($this->postData['password']);
        $cpassword = $this->test_input($this->postData['cpassword']);

        $db = new DB();
        
        if($is_entreprise == "oui") {
            $this->validateSignupUser();
            $this->checkEmailExists($email);
            $this->validateNomEntreprise();
            $this->validateEmailEntreprise();
            $nom_entreprise = $this->postData['nom_entreprise'];
            $email_entreprise = $this->postData['email_entreprise'];
            if($this->validateNom() !== false && $this->validatePrenom() !== false &&
                $this->validateEmail() !== false && $this->validateTel() !== false &&
                $this->validatePassword() !== false && $this->validateCPassword() !== false &&
                $this->validateNomEntreprise() !== false && $this->validateEmailEntreprise() !== false
            ) {
                $sql = "INSERT INTO users (id, email, nom, prenom, tel, is_entreprise, nom_entreprise, email_entreprise, password) 
                        VALUES (NULL, ?, ?, ?, ?, 1, ?, ?, ?);";
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([$email,$nom, $prenom , $tel, $nom_entreprise, $email_entreprise ,$password ]);
                if($stmt) {
                    BaseController::redirect('signup');
                    BaseController::set('success' , 'Are you registered successfully');
                }
            }
        }else {
            $this->validateSignupUser();
            $this->checkEmailExists($email);

            if($this->validateNom() !== false && $this->validatePrenom() !== false &&
                $this->validateEmail() !== false && $this->validateTel() !== false &&
                $this->validatePassword() !== false && $this->validateCPassword() !== false &&
                $this->checkEmailExists($email) !== false
            ) {
                $sql = "INSERT INTO users (id, email, nom, prenom, tel, is_entreprise, nom_entreprise, email_entreprise, password) 
                        VALUES (NULL, ?, ?, ?, ?, 0, NULL, NULL, ?);";
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([$email,$nom, $prenom , $tel,$password ]);
                if($stmt) {
                    BaseController::redirect('signup');
                    BaseController::set('success' , 'Are you registered successfully');
                }
            }
        }
    }


    // Check if email exists
    private function checkEmailExists($email) {
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













    // -------------------------------------
    // -- Validation --
    // -------------------------------------

    

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
