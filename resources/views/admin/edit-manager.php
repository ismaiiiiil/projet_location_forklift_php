<?php

use app\Controllers\AdminController;
use app\Controllers\BaseController;

$admin = new AdminController($_POST);

$id = "";
if (isset($_POST['id_edit']) && is_numeric($_POST['id_edit'])) {
    $id = $_POST['id_edit'];
    $manager = $admin->getManagerById($id);
    // $roles = $admin->getRoles($manager->id);
    $rolesEdit = $admin->getRoles($manager->id);
} else {
    BaseController::redirect('manager');
}


if (isset($_POST['roles'])) {
    $admin->editManager($id);
    $errors = $admin->errors;
    $valid = $admin->valid;
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
                                <h5 class="card-title">Modifier le manager <?= $manager->nom ?></h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" id="f" enctype="multipart/form-data">
                                    <!-- hide input -->
                                    <input type="hidden" name="current_image" value="<?= $manager->admin_profile ?>">
                                    <input type="hidden" name="id_edit" value="<?= $id ?>">
                                    <!-- ---------- -->

                                    <!-- <div class="form-group row">
                                        <label class="col-2 col-form-label" for="animals">Roles</label>
                                        <div class="col-10">
                                            <select name="countries" id="countries" multiple>
                                                <option <?= !!$rolesEdit->orders ? "selected" : "" ?> value="orders">orders</option>
                                                <option <?= !!$rolesEdit->show_order ? "selected" : "" ?> value="show_order">show_order</option>
                                                <option <?= !!$rolesEdit->delete_order ? "selected" : "" ?> value="delete_order">delete_order</option>
                                                <option <?= !!$rolesEdit->controle_order ? "selected" : "" ?> value="controle_order">controle_order</option>
                                                <option <?= !!$rolesEdit->notifications ? "selected" : "" ?> value="notifications">notifications</option>
                                                <option <?= !!$rolesEdit->machines ? "selected" : "" ?> value="machines">machines</option>
                                                <option <?= !!$rolesEdit->add_machine ? "selected" : "" ?> value="add_machine">add_machine</option>
                                                <option <?= !!$rolesEdit->edit_machine ? "selected" : "" ?> value="edit_machine">edit_machine</option>
                                                <option <?= !!$rolesEdit->delete_machine ? "selected" : "" ?> value="delete_machine">delete_machine</option>
                                                <option <?= !!$rolesEdit->categories ? "selected" : "" ?> value="categories">categories</option>
                                                <option <?= !!$rolesEdit->add_category ? "selected" : "" ?> value="add_category">add_category</option>
                                                <option <?= !!$rolesEdit->edit_category ? "selected" : "" ?> value="edit_category">edit_category</option>
                                                <option <?= !!$rolesEdit->delete_category ? "selected" : "" ?> value="delete_category">delete_category</option>
                                                <option <?= !!$rolesEdit->users ? "selected" : "" ?> value="users">users</option>
                                                <option <?= !!$rolesEdit->delete_user ? "selected" : "" ?> value="delete_user">notifications</option>
                                                <option <?= !!$rolesEdit->feedback ? "selected" : "" ?> value="feedback">feedback</option>
                                                <option <?= !!$rolesEdit->delete_feedback ? "selected" : "" ?> value="delete_feedback">delete_feedback</option>
                                                <option <?= !!$rolesEdit->controle_feedback ? "selected" : "" ?> value="controle_feedback">controle_feedback</option>
                                                <option <?= !!$rolesEdit->perte_materilles ? "selected" : "" ?> value="perte_materilles">perte_materilles</option>
                                                <option <?= !!$rolesEdit->add_perte_materille ? "selected" : "" ?> value="add_perte_materille">add_perte_materille</option>
                                                <option <?= !!$rolesEdit->edit_perte_materille ? "selected" : "" ?> value="edit_perte_materille">edit_perte_materille</option>
                                                <option <?= !!$rolesEdit->delete_perte_materille ? "selected" : "" ?> value="delete_perte_materille">delete_perte_materille</option>
                                                <option <?= !!$rolesEdit->benefices ? "selected" : "" ?> value="benefices">benefices</option>
                                                <option <?= !!$rolesEdit->delete_benefice ? "selected" : "" ?> value="delete_benefice">delete_benefice</option>
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="form-group row">
                                        <div mbsc-page class="demo-multiple-select">
                                            <div style="height:100%">
                                                <label>
                                                    Roles manager
                                                    <input mbsc-input id="demo-multiple-select-input" placeholder="Please select..." data-dropdown="true" data-input-style="outline" data-label-style="stacked" data-tags="true" />
                                                </label>
                                                <select id="demo-multiple-select" multiple>
                                                    <option <?= !!$rolesEdit->orders ? "selected" : "" ?> value="orders">orders</option>
                                                    <option <?= !!$rolesEdit->show_order ? "selected" : "" ?> value="show_order">show_order</option>
                                                    <option <?= !!$rolesEdit->delete_order ? "selected" : "" ?> value="delete_order">delete_order</option>
                                                    <option <?= !!$rolesEdit->controle_order ? "selected" : "" ?> value="controle_order">controle_order</option>
                                                    <option <?= !!$rolesEdit->notifications ? "selected" : "" ?> value="notifications">notifications</option>
                                                    <option <?= !!$rolesEdit->machines ? "selected" : "" ?> value="machines">machines</option>
                                                    <option <?= !!$rolesEdit->add_machine ? "selected" : "" ?> value="add_machine">add_machine</option>
                                                    <option <?= !!$rolesEdit->edit_machine ? "selected" : "" ?> value="edit_machine">edit_machine</option>
                                                    <option <?= !!$rolesEdit->delete_machine ? "selected" : "" ?> value="delete_machine">delete_machine</option>
                                                    <option <?= !!$rolesEdit->categories ? "selected" : "" ?> value="categories">categories</option>
                                                    <option <?= !!$rolesEdit->add_category ? "selected" : "" ?> value="add_category">add_category</option>
                                                    <option <?= !!$rolesEdit->edit_category ? "selected" : "" ?> value="edit_category">edit_category</option>
                                                    <option <?= !!$rolesEdit->delete_category ? "selected" : "" ?> value="delete_category">delete_category</option>
                                                    <option <?= !!$rolesEdit->users ? "selected" : "" ?> value="users">users</option>
                                                    <option <?= !!$rolesEdit->delete_user ? "selected" : "" ?> value="delete_user">notifications</option>
                                                    <option <?= !!$rolesEdit->feedback ? "selected" : "" ?> value="feedback">feedback</option>
                                                    <option <?= !!$rolesEdit->delete_feedback ? "selected" : "" ?> value="delete_feedback">delete_feedback</option>
                                                    <option <?= !!$rolesEdit->controle_feedback ? "selected" : "" ?> value="controle_feedback">controle_feedback</option>
                                                    <option <?= !!$rolesEdit->perte_materilles ? "selected" : "" ?> value="perte_materilles">perte_materilles</option>
                                                    <option <?= !!$rolesEdit->add_perte_materille ? "selected" : "" ?> value="add_perte_materille">add_perte_materille</option>
                                                    <option <?= !!$rolesEdit->edit_perte_materille ? "selected" : "" ?> value="edit_perte_materille">edit_perte_materille</option>
                                                    <option <?= !!$rolesEdit->delete_perte_materille ? "selected" : "" ?> value="delete_perte_materille">delete_perte_materille</option>
                                                    <option <?= !!$rolesEdit->benefices ? "selected" : "" ?> value="benefices">benefices</option>
                                                    <option <?= !!$rolesEdit->delete_benefice ? "selected" : "" ?> value="delete_benefice">delete_benefice</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Nom Manager</label>
                                        <div class="col-md-10">
                                            <input type="text" name="nom" value="<?= $manager->nom ?>" class="form-control <?= isset($valid['nom']) ? 'is-valid' : '' ?>
                                                <?= isset($errors['nom']) ? 'is-invalid' : '' ?> ">

                                            <?php if (isset($errors['nom'])) {  ?>
                                                <div class="invalid-feedback"><?= $errors['nom'] ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Prenom Manager</label>
                                        <div class="col-md-10">
                                            <input type="text" name="prenom" value="<?= $manager->nom ?>" class="form-control <?= isset($valid['prenom']) ? 'is-valid' : '' ?>
                                                <?= isset($errors['prenom']) ? 'is-invalid' : '' ?> ">

                                            <?php if (isset($errors['prenom'])) {  ?>
                                                <div class="invalid-feedback"><?= $errors['prenom'] ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Email Manager</label>
                                        <div class="col-md-10">
                                            <input type="text" name="email" value="<?= $manager->email ?>" class="form-control <?= isset($valid['email']) ? 'is-valid' : '' ?>
                                                <?= isset($errors['email']) ? 'is-invalid' : '' ?> ">

                                            <?php if (isset($errors['email'])) {  ?>
                                                <div class="invalid-feedback"><?= $errors['email'] ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Tel Manager</label>
                                        <div class="col-md-10">
                                            <input type="text" name="tel" value="<?= $manager->tel ?>" class="form-control <?= isset($valid['tel']) ? 'is-valid' : '' ?>
                                                <?= isset($errors['tel']) ? 'is-invalid' : '' ?> ">

                                            <?php if (isset($errors['tel'])) {  ?>
                                                <div class="invalid-feedback"><?= $errors['tel'] ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <!-- <h5 class="card-title">Old Image:</h5> -->
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Old Image</label>
                                        <h2 class="table-avatar col-md-10">
                                            <span class="avatar avatar-xxl  me-2">
                                                <img class="avatar-img rounded" src="public/images/manager/<?php echo $manager->admin_profile ?>" alt="User Image">
                                            </span>
                                        </h2>
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
                                            <button name="Modifier" id="Modifier" onclick="return false" class="btn btn-warning" type="submit">Modifier</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- <button id="selectAll">ALL</button> -->
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

    <!-- <script src="resources/views/admin/assets/js/script.js"></script> -->

    <script src="resources/views/admin/assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="resources/views/admin/assets/js/script.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
    <script>
        // new MultiSelectTag('countries')  // id
        new MultiSelectTag('countries', {
            rounded: true, // default true
            shadow: true // default false
        });
    </script>
    <script>
        document.getElementById('Modifier').addEventListener('click', function() {
            var select = document.getElementById('countries');
            var result = [];
            var options = select && select.options;
            var opt;

            for (var i = 0, iLen = options.length; i < iLen; i++) {
                opt = options[i];

                if (opt.selected) {
                    result.push(opt.value || opt.text);
                }
            }
            // return result;
            document.getElementById('roles').value = result;
            document.getElementById('f').submit();
        });

    </script> -->


    <script>
        mobiscroll.setOptions({
            locale: mobiscroll.localeAr, // Specify language like: locale: mobiscroll.localePl or omit setting to use default
            theme: 'ios', // Specify theme like: theme: 'ios' or omit setting to use default
            themeVariant: 'light' // More info about themeVariant: https://docs.mobiscroll.com/5-22-3/javascript/select#opt-themeVariant
        });


        mobiscroll.select('#demo-multiple-select', {
            inputElement: document.getElementById('demo-multiple-select-input') // More info about inputElement: https://docs.mobiscroll.com/5-22-3/javascript/select#opt-inputElement
        });
        // mobiscroll.getInst();

        // mobiscroll.select('#demo-multiple-select-input');
        // the initialization function returns the instance of the select component
        // const inst = mobiscroll.select('#demo-multiple-select-input', {
        //     data: [{text:"orders",selected:"selected" }],
        // });
        // inst.setOptions({ data: ['Item 1', 'Item 2', 'Item 3']}); // update the component with new data
    </script>
    <script>

        // var select = document.getElementById('demo-multiple-select-input').value = "orders, machines";

        document.getElementById('Modifier').addEventListener('click', function() {
            var select = document.getElementById('demo-multiple-select-input');
            document.getElementById('roles').value = select.value;
            document.getElementById('f').submit();
        });

        jQuery(document).ready(function($){
            $('select').find('option[value="orders"]').attr('selected','selected');
        });

        $('#selectAll').click(function() {
            $('#demo-multiple-select option').attr("selected","selected");
        });
        $('#deselectAll').click(function() {
            $('#demo-multiple-select option').removeAttr("selected");
        });
    </script>

</body>

</html>
