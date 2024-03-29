<?php

use app\Controllers\CategoryController;
use app\Controllers\MachineController;

// require_once '../../../vendor/autoload.php';

$categories = new CategoryController($_POST);
$categories->getAllCategories();


$machines = new MachineController($_POST);
$nom = '';
$description = '';
$type_carburant = '';
$hauteur_plate_forme = '';
$capacité_levage = '';
$quantity = '';
$id_category = '';
$prix_jour = '';
$prix_semaine = '';
$prix_mois = '';

if (isset($_POST['Ajouter'])) {
    $machines->addMachine();
    $errors = $machines->errors;
    $valid = $machines->valid;

    if (isset($_POST['nom'])) $nom = $_POST['nom'];
    if (isset($_POST['description'])) $description = $_POST['description'];
    if (isset($_POST['type_carburant'])) $type_carburant = $_POST['type_carburant'];
    if (isset($_POST['hauteur_plate_forme'])) $hauteur_plate_forme = $_POST['hauteur_plate_forme'];
    if (isset($_POST['capacité_levage'])) $capacité_levage = $_POST['capacité_levage'];
    if (isset($_POST['quantity'])) $quantity = $_POST['quantity'];
    if (isset($_POST['id_category'])) $id_category = $_POST['id_category'];
    if (isset($_POST['prix_jour'])) $prix_jour = $_POST['prix_jour'];
    if (isset($_POST['prix_semaine'])) $prix_semaine = $_POST['prix_semaine'];
    if (isset($_POST['prix_mois'])) $prix_mois = $_POST['prix_mois'];
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
                                <h3 class="page-title">Machine</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>machine.php">Student</a></li>
                                    <li class="breadcrumb-item active">Ajouter une machine</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Alert message -->
                <?php include("layout/alert.php"); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Ajouter nouvelle machine</h5>
                            </div>
                            <div class="card-body">
                                <form id="form" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="card-title">Machine details</h5>
                                            <div class="form-group">
                                                <label>Nom:</label>
                                                <input type="text" name="nom" value="<?= $nom ?>" class="form-control <?= isset($valid['nom']) ? 'is-valid' : '' ?> 
                                                <?= isset($errors['nom']) ? 'is-invalid' : '' ?> ">
                                                <?php if (isset($errors['nom'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['nom'] ?></div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group">
                                                <label>type de carburant:</label>
                                                <input type="text" name="type_carburant" value="<?= $type_carburant ?>" class="form-control <?= isset($errors['type_carburant']) ? 'is-invalid' : '' ?>
                                            <?= isset($valid['type_carburant']) ? 'is-valid' : '' ?>">
                                                <?php if (isset($errors['type_carburant'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['type_carburant'] ?></div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group">
                                                <label>capacité de levage</label>
                                                <input type="text" name="capacité_levage" value="<?= $capacité_levage ?>" 
                                                class="form-control <?= isset($errors['capacité_levage']) ? 'is-invalid' : '' ?>
                                            <?= isset($valid['capacité_levage']) ? 'is-valid' : '' ?>">
                                                <?php if (isset($errors['capacité_levage'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['capacité_levage'] ?></div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group">
                                                <label>Quantiter:</label>
                                                <input type="text" name="quantity" value="<?= $quantity ?>" class="form-control <?= isset($errors['quantity']) ? 'is-invalid' : '' ?>
                                            <?= isset($valid['quantity']) ? 'is-valid' : '' ?>">
                                                <?php if (isset($errors['quantity'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['quantity'] ?></div>
                                                <?php } ?>
                                            </div>
                                            <!-- hauteur_plate_forme -->
                                            <div class="form-group">
                                                <label>hauteur de plate forme:</label>
                                                <input type="text" name="hauteur_plate_forme" value="<?= $hauteur_plate_forme ?>" class="form-control <?= isset($errors['hauteur_plate_forme']) ? 'is-invalid' : '' ?>
                                                <?= isset($valid['hauteur_plate_forme']) ? 'is-valid' : '' ?>">
                                                <?php if (isset($errors['hauteur_plate_forme'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['hauteur_plate_forme'] ?></div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Categories:</label>
                                                <select name="id_category" class="form-control <?= isset($errors['id_category']) ? 'is-invalid' : '' ?>
                                                <?= isset($valid['id_category']) ? 'is-valid' : '' ?>">
                                                    <option value="">Select Category</option>
                                                    <?php for ($i = 0; $i < count($categories->t); $i++) { ?>
                                                        <option <?= $categories->t[$i]->getId() == $id_category ? 'selected' : '' ?> value="<?php echo $categories->t[$i]->getId() ?>">
                                                            <?php echo $categories->t[$i]->getNom()  ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <?php if (isset($errors['id_category'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['id_category'] ?></div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group">
                                                <label>Description:</label>
                                                <textarea rows="5" cols="5" name="description" class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>
                                            <?= isset($valid['description']) ? 'is-valid' : '' ?>" placeholder="Enter message"><?= $description ?></textarea>
                                                <?php if (isset($errors['description'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['description'] ?></div>
                                                <?php } ?>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="card-title">Machine prix</h5>

                                            <div class="form-group">
                                                <label>Prix Jour:</label>
                                                <input type="number" name="prix_jour" class="form-control <?= isset($errors['prix_jour']) ? 'is-invalid' : '' ?>
                                            <?= isset($valid['prix_jour']) ? 'is-valid' : '' ?>" value="<?= $prix_jour ?>">
                                                <?php if (isset($errors['prix_jour'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['prix_jour'] ?></div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Prix Semaine:</label>
                                                <input type="number" name="prix_semaine" class="form-control <?= isset($errors['prix_semaine']) ? 'is-invalid' : '' ?>
                                            <?= isset($valid['prix_semaine']) ? 'is-valid' : '' ?>" value="<?= $prix_semaine ?>">
                                                <?php if (isset($errors['prix_semaine'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['prix_semaine'] ?></div>
                                                <?php } ?>
                                            </div>
                                            <!-- hauteur_plate_forme -->
                                            <div class="form-group">
                                                <label>Prix Mois:</label>
                                                <input type="number" name="prix_mois" class="form-control <?= isset($errors['prix_mois']) ? 'is-invalid' : '' ?>
                                            <?= isset($valid['prix_mois']) ? 'is-valid' : '' ?>" value="<?= $prix_mois ?>">
                                                <?php if (isset($errors['prix_mois'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['prix_mois'] ?></div>
                                                <?php } ?>
                                            </div>

                                            <h5 class="card-title">Machine Images:</h5>

                                            <div class="form-group">
                                                <label>Choose File 1:</label>
                                                <input type="file" class="form-control <?= isset($errors['image1']) ? 'is-invalid' : '' ?>
                                            <?= isset($valid['image1']) ? 'is-valid' : '' ?>" name="image1">
                                                <?php if (isset($errors['image1'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['image1'] ?></div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Choose File 2:</label>
                                                <input type="file" class="form-control <?= isset($errors['image2']) ? 'is-invalid' : '' ?>
                                            <?= isset($valid['image2']) ? 'is-valid' : '' ?>" name="image2">
                                                <?php if (isset($errors['image2'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['image2'] ?></div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Choose File 3:</label>
                                                <input type="file" class="form-control <?= isset($errors['image3']) ? 'is-invalid' : '' ?>
                                                <?= isset($valid['image3']) ? 'is-valid' : '' ?>" name="image3">
                                                <?php if (isset($errors['image3'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['image3'] ?></div>
                                                <?php } ?>
                                            </div>
                                            <!--  -->

                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" name="Ajouter" class="btn btn-primary">Submit</button>
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