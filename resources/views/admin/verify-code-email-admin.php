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
if(isset($_POST['verifier'])) {
    $admin->verifierCodeEmail();
    // var_dump($_POST);
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title><?= $web->nom_website ?> - Forgot Password</title>

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
                            <h1>Code de verification</h1>
                            <p class="account-subtitle">Let Us Help You</p>

                            <form method="POST">
                                <div class="form-group">
                                    <label>Enter code de verification <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text"   name="code"
                                placeholder="Code" >
                                    <span class="profile-views"><i class="fas fa-envelope"></i></span>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" name="verifier" type="submit">Vérifier</button>
                                </div>
                                <div class="form-group mb-0">
                                    <a class="btn btn-primary primary-reset btn-block" 
                                    href="<?= BASE_URL ?>login-administrateur"
                                    >Login</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>