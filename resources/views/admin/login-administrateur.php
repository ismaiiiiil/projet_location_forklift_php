<?php

use app\Controllers\AdminController;
use app\Controllers\BaseController;
use app\Controllers\WebSiteController;
if(isset($_SESSION['login_admin'])) {
    BaseController::redirect('dashboard');
}
$admin = new AdminController($_POST);


$website = new WebSiteController($_POST);

$web = $website->getInfoWebSite();

// $admin->insertAdmin();





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title><?= $web->nom_website ?> - Login</title>

    <link rel="shortcut icon" href="public/images/website/<?= $web->favicon ?>">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="resources/views/admin/assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="resources/views/admin/assets/plugins/feather/feather.css">

    <link rel="stylesheet" href="resources/views/admin/assets/plugins/icons/flags/flags.css">

    <link rel="stylesheet" href="resources/views/admin/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="resources/views/admin/assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="resources/views/admin/assets/css/style.css">
</head>

<body>
    <div class="mx-auto d-block w-75 mb-0 mt-5">
        <?php include("layout/alert.php"); 
        if(isset($_POST["Login"])) {
            $admin->login();
        }?>
    </div>
    <div class="main-wrapper login-body">
    <!-- Alert message -->
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" 
                        style="margin-bottom: 40px;"
                        src="public/images/website/login.png" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                        <?php 
                            if(isset($_POST["Login"])) {
                                $admin->login();
                            }?>
                            <h1>Welcome to Engiloc</h1>
                            <div class="login-or">
                                <span class="or-line"></span>
                            </div>
                            <!-- <p class="account-subtitle">Need an account? <a href="register.html">Sign Up</a></p> -->
                            <h2>Connexion</h2>

                            <form method="POST">
                                <div class="form-group">
                                    <label>Username <span class="login-danger">*</span></label>
                                    <input class="form-control" name="login" type="text">
                                    <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                                </div>
                                <div class="form-group">
                                    <label>Password <span class="login-danger">*</span></label>
                                    <input class="form-control pass-input" name="password" type="password">
                                    <span class="profile-views feather-eye toggle-password"></span>
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" name="Login" type="submit">Connexion</button>
                                </div>
                                <div class="forgotpass mt-3">
                                    <div class="remember-me">
                                        <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Remember me
                                            <input type="checkbox" name="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <a href="forgot-password.html">Forgot Password?</a>
                                </div>
                            </form>

                            <div class="login-or">
                                <span class="or-line"></span>
                            </div>                           

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="resources/views/admin/assets/js/jquery-3.6.0.min.js"></script>

    <script src="resources/views/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="resources/views/admin/assets/js/feather.min.js"></script>

    <script src="resources/views/admin/assets/js/script.js"></script>
</body>

</html>