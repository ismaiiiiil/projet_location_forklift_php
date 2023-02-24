<?php

use app\Controllers\AdminController;


$admin = new AdminController($_POST);
$nom = '';
$prenom = '';
$email = '';
$tel = '';


if (isset($_POST['Ajouter'])) {
    // $admin->addManager();
    // $errors = $machines->errors;
    // $valid = $machines->valid;

    if (isset($_POST['nom'])) $nom = $_POST['nom'];
    if (isset($_POST['prenom'])) $prenom = $_POST['prenom'];
    if (isset($_POST['email'])) $email = $_POST['email'];
    if (isset($_POST['tel'])) $tel = $_POST['tel'];
}

include 'layout/header.php';
?>

<body>

    <div class="main-wrapper">

        <?php include('layout/navbar.php') ;
        include 'layout/sidebar.php';
        ?>

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Manager</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>manager">Manager</a></li>
                                    <li class="breadcrumb-item active">Ajouter un manager</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include("layout/alert.php"); ?>
                <div class="row">
                
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Ajouter un manager</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data" >
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Nom Manager</label>
                                        <div class="col-md-10">
                                            <input type="text" name="nom" value="<?= $nom ?>" 
                                                class="form-control <?= isset($valid['nom']) ? 'is-valid' : '' ?> 
                                                <?= isset($errors['nom']) ? 'is-invalid' : '' ?> ">

                                                <?php if (isset($errors['nom'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['nom'] ?></div>
                                                <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Prenom Manager</label>
                                        <div class="col-md-10">
                                            <input type="text" name="prenom" value="<?= $prenom ?>" 
                                                class="form-control <?= isset($valid['prenom']) ? 'is-valid' : '' ?> 
                                                <?= isset($errors['prenom']) ? 'is-invalid' : '' ?> ">

                                                <?php if (isset($errors['prenom'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['prenom'] ?></div>
                                                <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Email Manager</label>
                                        <div class="col-md-10">
                                            <input type="text" name="email" value="<?= $email ?>" 
                                                class="form-control <?= isset($valid['email']) ? 'is-valid' : '' ?> 
                                                <?= isset($errors['email']) ? 'is-invalid' : '' ?> ">

                                                <?php if (isset($errors['email'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['email'] ?></div>
                                                <?php } ?>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Tel Manager</label>
                                        <div class="col-md-10">
                                            <input type="text" name="tel" value="<?= $tel ?>" 
                                                class="form-control <?= isset($valid['tel']) ? 'is-valid' : '' ?> 
                                                <?= isset($errors['tel']) ? 'is-invalid' : '' ?> ">

                                                <?php if (isset($errors['tel'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['tel'] ?></div>
                                                <?php } ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Photo Manager</label>
                                        <div class="col-md-10">
                                            <input type="file" 
                                                class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>
                                                <?= isset($valid['image']) ? 'is-valid' : '' ?>" 
                                                name="image">
                                                <?php if (isset($errors['image'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['image'] ?></div>
                                                <?php } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-0 row">
                                        <div class="col-md-10">
                                            <button name="Ajouter" class="btn btn-primary" type="submit">Ajouter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>

    </script>
    <script src="resources/views/admin/assets/js/jquery-3.6.0.min.js"></script>

    <script src="resources/views/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="resources/views/admin/assets/js/feather.min.js"></script>

    <script src="resources/views/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="resources/views/admin/assets/plugins/select2/js/select2.min.js"></script>

    <script src="resources/views/admin/assets/plugins/moment/moment.min.js"></script>
    <script src="resources/views/admin/assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="resources/views/admin/assets/js/script.js"></script>

</body>

</html>