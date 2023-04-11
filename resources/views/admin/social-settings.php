<?php

use app\Controllers\WebSiteController;

$website = new WebSiteController($_POST);


if (isset($_POST["submit"])) {
    $website->updateMedia();

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
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>localization-settings">Localization Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>payment-settings">Payment Settings</a>
                        </li> -->

                        <li class="nav-item active">
                            <a class="nav-link" href="<?= BASE_URL ?>social-settings">Social Link Settings</a>
                        </li>
                    </ul>
                </div>

                <!-- Alert message -->
                <?php include("layout/alert.php"); ?>
                <div class="row">
                            <div class="col-lg-6 col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Social Link Settings</h5>
                                    </div>
                                    <div class="card-body pt-0">
                                        <form id="myForm" method="POST">
                                            <div class="settings-form">
                                                <div class="links-info">
                                                    <div class="row form-row links-cont">
                                                        <div class="form-group form-placeholder d-flex">
                                                            <button onclick="return false;" class="btn btn-primary">
                                                                <i class="feather-facebook"></i>
                                                            </button>
                                                            <input name="facebook_link"
                                                            value="<?= $web->facebook_link ?>"
                                                            type="text" class="form-control"
                                                                placeholder="https://www.facebook.com">
                                                            <div>
                                                                <a href="#" class="btn trash">
                                                                    <i class="feather-trash-2"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="links-info">
                                                    <div class="row form-row links-cont">
                                                        <div class="form-group form-placeholder d-flex">
                                                            <button onclick="return false;" class="btn btn-primary">
                                                                <i class="feather-twitter"></i>
                                                            </button>
                                                            <input name="twitter_link"
                                                            value="<?= $web->twitter_link ?>"
                                                            type="text" class="form-control"
                                                                placeholder="https://www.twitter.com">
                                                            <div>
                                                                <a href="#" class="btn trash">
                                                                    <i class="feather-trash-2"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="links-info">
                                                    <div class="row form-row links-cont">
                                                        <div class="form-group form-placeholder d-flex">
                                                            <button onclick="return false;" class="btn btn-primary">
                                                                <i class="feather-youtube"></i>
                                                            </button>
                                                            <input name="instagram_link"
                                                            value="<?= $web->instagram_link ?>"
                                                            type="text" class="form-control"
                                                                placeholder="https://www.youtube.com">
                                                            <div>
                                                                <a href="#" class="btn trash">
                                                                    <i class="feather-trash-2"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-0">
                                                <div class="settings-btns">
                                                    <button type="submit" name="submit" class="btn btn-orange">Submit</button>
                                                    <button type="submit" onclick="location.reload();" class="btn btn-grey">Annuler</button>
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
