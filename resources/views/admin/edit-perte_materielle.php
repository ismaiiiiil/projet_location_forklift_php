<?php

use app\Controllers\BaseController;
use app\Controllers\PerteMaterielleController;

$pertmateriel = new PerteMaterielleController($_POST);
if(!isset($_POST['id_edit'])) {
    BaseController::redirect('perte_materielles');
}

$pertmat = $pertmateriel->getPerteMaterielleParId($_POST['id_edit']);


$nom = '';
$description_mat= '';
$prix_perte='';
$date_perte='';

if (isset($_POST['Modifier'])) {
    $pertmateriel->updatePerteMaterielleParId($_POST['id_edit']);
    $errors = $pertmateriel->errors;
    $valid = $pertmateriel->valid;

    if (isset($_POST['description_mat'])) $description_mat = $_POST['description_mat'];
    if (isset($_POST['prix_perte'])) $prix_perte = $_POST['prix_perte'];
    if (isset($_POST['date_perte'])) $date_perte = $_POST['date_perte'];
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
                                <h3 class="page-title">Ajouter matériel perte</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>perte_materielles">matériel perte</a></li>
                                    <li class="breadcrumb-item active">Ajouter matériel perte</li>
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
                                <h5 class="card-title">Modifier matériel perte</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" >
                                    <!-- hidden -->
                                    <input type="hidden" name="id_edit" value="<?= $pertmat->id ?>">

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Description de matériel</label>
                                        <div class="col-md-10">
                                            <textarea rows="5" cols="5" name="description_mat" 
                                            class="form-control <?= isset($errors['description_mat']) ? 'is-invalid' : '' ?>
                                            <?= isset($valid['description_mat']) ? 'is-valid' : '' ?>" placeholder="Enter Description"><?= $pertmat->description_mat ?></textarea>
                                            
                                            <?php if (isset($errors['description_mat'])) {  ?>
                                                <div class="invalid-feedback"><?= $errors['description_mat'] ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                                
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Prix perte</label>
                                        <div class="col-md-10">
                                            <input type="text" 
                                                class="form-control <?= isset($errors['prix_perte']) ? 'is-invalid' : '' ?>
                                                <?= isset($valid['prix_perte']) ? 'is-valid' : '' ?>" 
                                                value="<?= $pertmat->prix_perte ?>"
                                                name="prix_perte">
                                                <?php if (isset($errors['prix_perte'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['prix_perte'] ?></div>
                                                <?php } ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <!-- <label class="col-form-label col-md-2">Date perte</label> -->
                                        <div class="col-md-10">
                                            <input type="hidden"
                                                class="form-control <?= isset($errors['date_perte']) ? 'is-invalid' : '' ?>
                                                <?= isset($valid['date_perte']) ? 'is-valid' : '' ?>" 
                                                value="<?= $pertmat->date_perte ?>"
                                                name="date_perte">
                                                <?php if (isset($errors['date_perte'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['date_perte'] ?></div>
                                                <?php } ?>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group mb-0 row">
                                        <div class="col-md-10">
                                            <button name="Modifier" class="btn btn-primary" type="submit">Modifier</button>
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