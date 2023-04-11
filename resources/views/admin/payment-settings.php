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
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>localization-settings">Localization</a>
                        </li>
                        <li class="nav-item active">
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
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Paypal</h5>
                                        <div class="status-toggle d-flex justify-content-between align-items-center">
                                            <input type="checkbox" id="status_1" class="check">
                                            <label for="status_1" class="checktoggle">checkbox</label>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <form>
                                            <div class="settings-form">
                                                <div class="form-group">
                                                    <p class="pay-cont">Paypal Option</p>
                                                    <label class="custom_radio me-4">
                                                        <input type="radio" name="budget" value="Yes" checked="">
                                                        <span class="checkmark"></span> Sandbox
                                                    </label>
                                                    <label class="custom_radio">
                                                        <input type="radio" name="budget" value="Yes">
                                                        <span class="checkmark"></span> Live
                                                    </label>
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Braintree Tokenization key <span
                                                            class="star-red">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="sandbox_pgjcppvs_pd6gznv7zbrx9hb8">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Braintree Merchant ID <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="pd6gznv7zbrx9hb8">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Braintree Public key <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="h8bydrz7gcjkp7d4">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Braintree Private key <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="sandbox_pgjcppvs_pd6gznv7zbrx9hb8">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Paypal APP ID <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="pd6gznv7zbrx9hb8">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Paypal Secret Key <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="h8bydrz7gcjkp7d4">
                                                </div>
                                                <div class="form-group mb-0">
                                                    <div class="settings-btns">
                                                        <button type="submit" class="btn btn-orange">Save</button>
                                                        <button type="submit" class="btn btn-grey">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Stripe</h5>
                                        <div class="status-toggle d-flex justify-content-between align-items-center">
                                            <input type="checkbox" id="status_2" class="check" checked="">
                                            <label for="status_2" class="checktoggle">checkbox</label>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <form>
                                            <div class="settings-form">
                                                <div class="form-group">
                                                    <p class="pay-cont">Stripe Option</p>
                                                    <label class="custom_radio me-4">
                                                        <input type="radio" name="budget" value="Yes" checked="">
                                                        <span class="checkmark"></span> Sandbox
                                                    </label>
                                                    <label class="custom_radio">
                                                        <input type="radio" name="budget" value="Yes">
                                                        <span class="checkmark"></span> Live
                                                    </label>
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Gateway Name <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Stripe">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>API Key <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="pk_test_AealxxOygZz84AruCGadWvUV00mJQZdLvr">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Rest Key <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="sk_test_8HwqAWwBd4C4E77bgAO1jUgk00hDlERgn3">
                                                </div>
                                                <div class="form-group mb-0">
                                                    <div class="settings-btns">
                                                        <button type="submit" class="btn btn-orange">Save</button>
                                                        <button type="submit" class="btn btn-grey">Cancel</button>
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