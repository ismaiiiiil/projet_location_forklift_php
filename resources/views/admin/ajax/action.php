<?php

require_once '../../../../vendor/autoload.php';
session_start();
// use PDO;
use database\DB;


if(isset($_GET["action"])) 
{
    if( $_GET["action"] == "update_password" )
    {
        $nom_admin = $_SESSION['nom_admin']; //email_admin
        $email_admin = $_SESSION['email_admin']; //email_admin
        $old_pass = $_GET['old_pass'];
        $password = $_GET['password'];
        $cpassword = $_GET['cpassword'];
    
        $output = array();
        if($password !== $password)
        {
            $output = array(
                "danger" => "Confirm Password is not valid!"
            );
        }else 
        {
            $db =new DB();
            $sql = "SELECT * FROM admin WHERE nom = ? AND email = ? ";

            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([ $nom_admin, $email_admin ]);

            $admin = current($stmt->fetchAll(PDO::FETCH_OBJ));
            if( 
                // password_verify( $password, $admin->password )
                $old_pass === $admin->password 
            ){
            
                $options = [
                    'cost' => 12
                ];
                $password = password_hash($password, PASSWORD_BCRYPT, $options);

                $sql = "UPDATE admin SET password = ? WHERE nom = ? AND email = ? ";
                $stmt = $db::connection()->prepare($sql);
                $stmt->execute([$password, $nom_admin, $email_admin ]);
                if($stmt) {
                    $output = array(
                        "success" => "Mot de passe modifier avec success!"
                    );
                }
            }
            else {
                $output = array(
                    "danger" => "Password is incorrect!"
                );
            }
        }
        echo json_encode($output,JSON_FORCE_OBJECT);
        
    }
}