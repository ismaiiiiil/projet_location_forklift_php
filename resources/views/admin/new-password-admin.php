<?php

use app\Controllers\AdminController;
use app\Controllers\BaseController;
use app\Controllers\WebSiteController;

if(isset($_SESSION['login_admin'])) {
    BaseController::redirect('dashboard');
}

$admin = new AdminController($_POST);
$password = '';$cpassword = '';
if(isset($_SESSION["code_admin"]) && $_SESSION["code_admin"] === true) {
    if(isset($_POST["Modifier"])) {
        if(isset($_POST['password'])) $password = $_POST['password'];
        if(isset($_POST['cpassword'])) $cpassword = $_POST['cpassword'];
    
        $admin->newPassword();
        $errors = $admin->errors;
    }
}else{
    BaseController::redirect("verify-code-email-admin");
}

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
        ?>
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
                
                            <h1>Welcome to Engiloc</h1>
                            <div class="login-or">
                                <span class="or-line"></span>
                            </div>
                            <!-- <p class="account-subtitle">Need an account? <a href="register.html">Sign Up</a></p> -->
                            <h2>Modifier Mot de pass</h2>

                            <form method="POST">
                                <div class="form-group">
                                    <label>nouvelle password <span class="login-danger">*</span></label>
                                    <input class="form-control pass-input" 
                                    value="<?= $password?>"
                                    name="password" type="password">
                                    <span class="profile-views feather-eye toggle-password"></span>
                                </div>
                                <div class="my-2">
                                    <p class=" text-danger">
                                        <?php echo $errors['password'] ?? '';  ?>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Confirme nouvelle password <span class="login-danger">*</span></label>
                                    <input class="form-control pass-confirm" 
                                    value="<?= $cpassword?>"
                                    name="cpassword" type="password">
                                    <span class="profile-views feather-eye reg-toggle-password"></span>
                                </div>
                                <div class="my-2">
                                    <p class=" text-danger">
                                        <?php echo $errors['cpassword'] ?? '';  ?>
                                    </p>
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" name="Modifier" type="submit">Modifier</button>
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