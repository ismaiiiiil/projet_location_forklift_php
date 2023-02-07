<?php

use app\Controllers\CategoryController;
use app\Controllers\MachineController;

require_once '../../../vendor/autoload.php';

$categories = new CategoryController($_POST);


$nom = '';

if (isset($_POST['Ajouter'])) {
    $categories->addCategory();
    $errors = $categories->errors;

    if (isset($_POST['nom'])) $nom = $_POST['nom'];
}

include 'layout/header.php';
?>

<body>

    <div class="main-wrapper">

        <?= include('layout/navbar.php') ;
        include 'layout/sidebar.php';
        ?>
        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Category</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="category.php">Category</a></li>
                                    <li class="breadcrumb-item active">Ajouter une category</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Alert message -->
                <?php include("layout/alert.php"); ?>
                <div class="row">
                
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Ajouter une category</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data" >
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Nom Category</label>
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
                                        <label class="col-form-label col-md-2">Photo Category</label>
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
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="assets/plugins/select2/js/select2.min.js"></script>

    <script src="assets/plugins/moment/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="assets/js/script.js"></script>

</body>

</html>