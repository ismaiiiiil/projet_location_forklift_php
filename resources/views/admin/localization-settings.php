<?php

use app\Controllers\WebSiteController;

$website = new WebSiteController($_POST);


if (isset($_POST["Update"])) {
    $website->updateWebsite();
    $errors = $website->errors;
    $valid = $website->valid;
    var_dump($errors);

    $web = $website->getInfoWebSite();
} else {
    $web = $website->getInfoWebSite();
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
                                <h3 class="page-title">Settings</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>settings">Settings</a></li>
                                    <li class="breadcrumb-item active">Modifier Settings</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="settings-menu-links">
                    <ul class="nav nav-tabs menu-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>settings">General Settings</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= BASE_URL ?>localization-settings">Localization</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>payment-settings">Payment Settings</a>
                        </li>
            
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>social-settings">Social Media Login</a>
                        </li>
                    </ul>
                </div>

                <!-- Alert message -->
                <?php include("layout/alert.php"); ?>

                <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Localization Details</h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <form>
                                                <div class="settings-form">
                                                    <div class="form-group">
                                                        <label>Time Zone</label>
                                                        <select class="select form-control">
                                                            <option selected="selected">(UTC +5:30) Antarctica/Palmer
                                                            </option>
                                                            <option>(UTC+05:30) India</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Date Format</label>
                                                        <select class="select form-control">
                                                            <option selected="selected">15 May 2016</option>
                                                            <option>15/05/2016</option>
                                                            <option>15.05.2016</option>
                                                            <option>15-05-2016</option>
                                                            <option>05/15/2016</option>
                                                            <option>2016/05/15</option>
                                                            <option>2016-05-15</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Time Format</label>
                                                        <select class="select form-control">
                                                            <option selected="selected">12 Hours</option>
                                                            <option>24 Hours</option>
                                                            <option>36 Hours</option>
                                                            <option>48 Hours</option>
                                                            <option>60 Hours</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Currency Symbol</label>
                                                        <select class="select form-control">
                                                            <option selected="selected">$</option>
                                                            <option>₹</option>
                                                            <option>£</option>
                                                            <option>€</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <div class="settings-btns">
                                                            <button type="submit" class="btn btn-orange">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                </div>
        </div>
    <!-- </div> -->

    </div>

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