<?php

use app\Controllers\AdminController;


$admin = new AdminController($_POST);
$nom = '';
$prenom = '';
$email = '';
$tel = '';


if (isset($_POST['roles'])) {
    $admin->addManager();

    $errors = $admin->errors;
    $valid = $admin->valid;

    if (isset($_POST['nom'])) $nom = $_POST['nom'];
    if (isset($_POST['prenom'])) $prenom = $_POST['prenom'];
    if (isset($_POST['email'])) $email = $_POST['email'];
    if (isset($_POST['tel'])) $tel = $_POST['tel'];
}

include 'layout/header.php';
?>

<body>
    <style>
        .notification-class {
            color: red;
            font-size: 85%;
        }

        .color-none {
            background-color: white !important;
        }
    </style>
    <script>
        // Ignore this in your implementation
        window.isMbscDemo = true;
    </script>

    <title>
        Multiple select
    </title>

    <!-- Mobiscroll JS and CSS Includes -->
    <link rel="stylesheet" href="resources/views/admin/assets/css/mobiscroll.javascript.min.css">
    <script src="resources/views/admin/assets/js/mobiscroll.javascript.min.js"></script>

    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
        }

        button {
            display: inline-block;
            margin: 5px 5px 0 0;
            padding: 10px 30px;
            outline: 0;
            border: 0;
            cursor: pointer;
            background: #5185a8;
            color: #fff;
            text-decoration: none;
            font-family: arial, verdana, sans-serif;
            font-size: 14px;
            font-weight: 100;
        }

        input {
            width: 100%;
            margin: 0 0 5px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 0;
            font-family: arial, verdana, sans-serif;
            font-size: 14px;
            box-sizing: border-box;
            -webkit-appearance: none;
        }

        .mbsc-page {
            padding: 1em;
        }
    </style>
    <div class="main-wrapper">

        <?php include('layout/navbar.php');
        include 'layout/sidebar.php';
        ?>

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Manager
                                </h3>
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
                                <form method="POST" id="f" enctype="multipart/form-data">
                                    <!-- <div class="form-group row">
                                        <button id="select_all" onclick="return false;">
                                            All
                                        </button>
                                    </div> -->
                                    <div class="form-group row">
                                        <div mbsc-page class="demo-multiple-select">
                                            <div style="height:100%">
                                                <label>
                                                    Roles manager
                                                    <input mbsc-input id="demo-multiple-select-input" placeholder="Please select..." data-dropdown="true" data-input-style="outline" data-label-style="stacked" data-tags="true" />
                                                </label>
                                                <select id="demo-multiple-select" multiple>
                                                    <option value="orders">orders</option>
                                                    <option value="show_order">show_order</option>
                                                    <option value="delete_order">delete_order</option>
                                                    <option value="controle_order">controle_order</option>
                                                    <option value="notifications">notifications</option>
                                                    <option value="machines">machines</option>
                                                    <option value="add_machine">add_machine</option>
                                                    <option value="edit_machine">edit_machine</option>
                                                    <option value="delete_machine">delete_machine</option>
                                                    <option value="categories">categories</option>
                                                    <option value="add_category">add_category</option>
                                                    <option value="edit_category">edit_category</option>
                                                    <option value="delete_category">delete_category</option>
                                                    <option value="users">users</option>
                                                    <option value="delete_user">notifications</option>
                                                    <option value="feedback">feedback</option>
                                                    <option value="delete_feedback">delete_feedback</option>
                                                    <option value="controle_feedback">controle_feedback</option>
                                                    <option value="perte_materilles">perte_materilles</option>
                                                    <option value="add_perte_materille">add_perte_materille</option>
                                                    <option value="edit_perte_materille">edit_perte_materille</option>
                                                    <option value="delete_perte_materille">delete_perte_materille</option>
                                                    <option value="benefices">benefices</option>
                                                    <option value="delete_benefice">delete_benefice</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label class="col-2 col-form-label" for="animals">Roles</label>
                                        <div class="col-10">
                                            <select name="countries" id="countries" multiple>
                                                <option value="orders">orders</option>
                                                <option value="show_order">show_order</option>
                                                <option value="delete_order">delete_order</option>
                                                <option value="controle_order">controle_order</option>
                                                <option value="notifications">notifications</option>
                                                <option value="machines">machines</option>
                                                <option value="add_machine">add_machine</option>
                                                <option value="edit_machine">edit_machine</option>
                                                <option value="delete_machine">delete_machine</option>
                                                <option value="categories">categories</option>
                                                <option value="add_category">add_category</option>
                                                <option value="edit_category">edit_category</option>
                                                <option value="delete_category">delete_category</option>
                                                <option value="users">users</option>
                                                <option value="delete_user">notifications</option>
                                                <option value="feedback">feedback</option>
                                                <option value="delete_feedback">delete_feedback</option>
                                                <option value="controle_feedback">controle_feedback</option>
                                                <option value="perte_materilles">perte_materilles</option>
                                                <option value="add_perte_materille">add_perte_materille</option>
                                                <option value="edit_perte_materille">edit_perte_materille</option>
                                                <option value="delete_perte_materille">delete_perte_materille</option>
                                                <option value="benefices">benefices</option>
                                                <option value="delete_benefice">delete_benefice</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Nom Manager</label>
                                        <div class="col-md-10">
                                            <input type="text" name="nom" value="<?= $nom ?>" class="form-control <?= isset($valid['nom']) ? 'is-valid' : '' ?>
                                                <?= isset($errors['nom']) ? 'is-invalid' : '' ?> ">

                                            <?php if (isset($errors['nom'])) {  ?>
                                                <div class="invalid-feedback"><?= $errors['nom'] ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Prenom Manager</label>
                                        <div class="col-md-10">
                                            <input type="text" name="prenom" value="<?= $prenom ?>" class="form-control <?= isset($valid['prenom']) ? 'is-valid' : '' ?>
                                                <?= isset($errors['prenom']) ? 'is-invalid' : '' ?> ">

                                            <?php if (isset($errors['prenom'])) {  ?>
                                                <div class="invalid-feedback"><?= $errors['prenom'] ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Email Manager</label>
                                        <div class="col-md-10">
                                            <input type="text" name="email" value="<?= $email ?>" class="form-control <?= isset($valid['email']) ? 'is-valid' : '' ?>
                                                <?= isset($errors['email']) ? 'is-invalid' : '' ?> ">

                                            <?php if (isset($errors['email'])) {  ?>
                                                <div class="invalid-feedback"><?= $errors['email'] ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Tel Manager</label>
                                        <div class="col-md-10">
                                            <input type="text" name="tel" value="<?= $tel ?>" class="form-control <?= isset($valid['tel']) ? 'is-valid' : '' ?>
                                                <?= isset($errors['tel']) ? 'is-invalid' : '' ?> ">

                                            <?php if (isset($errors['tel'])) {  ?>
                                                <div class="invalid-feedback"><?= $errors['tel'] ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-10" id="tnotifications">&nbsp;</div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Photo Manager</label>
                                        <div class="col-md-10">
                                            <input type="file" class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>
                                                <?= isset($valid['image']) ? 'is-valid' : '' ?>" name="image">
                                            <?php if (isset($errors['image'])) {  ?>
                                                <div class="invalid-feedback"><?= $errors['image'] ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <input type="hidden" name="roles" id="roles">

                                    <div class="form-group mb-0 row">
                                        <div class="col-md-10">
                                            <!-- <button name="Ajouter"  class="btn btn-primary" type="submit">Ajouter</button> -->
                                            <button name="Ajouter" id="Ajouter" onclick="return false" class="btn btn-primary" type="button">Ajouter</button>
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

    <script src="resources/views/admin/assets/js/jquery-3.6.0.min.js"></script>

    <script src="resources/views/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="resources/views/admin/assets/js/feather.min.js"></script>

    <script src="resources/views/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="resources/views/admin/assets/plugins/select2/js/select2.min.js"></script>

    <script src="resources/views/admin/assets/plugins/moment/moment.min.js"></script>
    <script src="resources/views/admin/assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="resources/views/admin/assets/js/script.js"></script>



    <script>
        mobiscroll.setOptions({
            locale: mobiscroll.localeAr, // Specify language like: locale: mobiscroll.localePl or omit setting to use default
            theme: 'ios', // Specify theme like: theme: 'ios' or omit setting to use default
            themeVariant: 'light' // More info about themeVariant: https://docs.mobiscroll.com/5-22-3/javascript/select#opt-themeVariant
        });

        mobiscroll.select('#demo-multiple-select', {
            inputElement: document.getElementById('demo-multiple-select-input') // More info about inputElement: https://docs.mobiscroll.com/5-22-3/javascript/select#opt-inputElement
        });
    </script>
    <script>

        document.getElementById('Ajouter').addEventListener('click', function() {
            var select = document.getElementById('demo-multiple-select-input');
            document.getElementById('roles').value = select.value;
            document.getElementById('f').submit();
        });
    </script>

    </html>
