<?php

use app\Controllers\WebSiteController;

$website = new WebSiteController($_POST);

// $description_ar = '';
// $description_fr = '';
// $keywords_ar = '';
// $keywords_fr = '';
// $scripts = '';

if (isset($_POST['Update'])) {
    $website->updateWebsite();
    $errors = $website->errors;
    $valid = $website->valid;
    // // print_r($_POST);
    // if (isset($_POST['description_ar'])) $description_ar = $_POST['description_ar'];
    // if (isset($_POST['description_fr'])) $description_fr = $_POST['description_fr'];
    // if (isset($_POST['keywords_ar'])) $keywords_ar = $_POST['keywords_ar'];
    // if (isset($_POST['keywords_fr'])) $keywords_fr = $_POST['keywords_fr'];
    // if (isset($_POST['scripts'])) $scripts = $_POST['scripts'];


    $web = $website->getInfoWebSite();
} else {
    $web = $website->getInfoWebSite();
}
include 'layout/header.php';
?>

<body>

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
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= BASE_URL ?>settings">General Settings</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>localization-settings">Localization</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>payment-settings">Payment Settings</a>
                        </li> -->

                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>social-settings">Social Media Login</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="social-links.html">Social Links</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="seo-settings.html">SEO Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="others-settings.html">Others</a>
                        </li> -->
                    </ul>
                </div>

                <!-- Alert message -->
                <?php include("layout/alert.php"); ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Website Details

                                <?php
                                    // if(isset($_POST))
                                    //     print_r($_POST);
                                ?>
                                </h5>
                            </div>
                            <form class="row" method="POST" enctype="multipart/form-data">
                                <!-- Hidden input -->
                                <input type="hidden" name="current_favicon" value="<?= $web->favicon ?>">
                                <input type="hidden" name="current_logo" value="<?= $web->logo ?>">
                                <!-- ----------- -->
                                <div class="col-md-6">
                                    <div class="card-body pt-0">
                                        <div class="settings-form">
                                            <div class="form-group">
                                                <label>Nom Website <span class="star-red">*</span></label>
                                                <input type="text" name="nom_website" value="<?= $web->nom_website ?? "" ?>" class="form-control <?= isset($errors['nom_website']) ? 'is-invalid' : '' ?>" placeholder="Enter Website Name">
                                                <?php if (isset($errors['nom_website'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['nom_website'] ?? "" ?></div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group">
                                                <p class="settings-label">Logo <span class="star-red">*</span></p>
                                                <div class="settings-btn">
                                                    <input type="file" accept="image/*" name="logo" id="file" onchange="loadFile(event)" class="hide-input">
                                                    <label for="file" class="upload">
                                                        <i class="feather-upload"></i>
                                                    </label>
                                                </div>
                                                <h6 class="settings-size">Recommended image size is <span>150px x 150px</span></h6>
                                                <div class="upload-images">
                                                    <img src="public/images/website/<?= $web->logo ?>?v=<?php echo time(); ?>" alt="Image">
                                                    <a href="javascript:void(0);" class="btn-icon logo-hide-btn">
                                                        <i class="feather-x-circle"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <p class="settings-label">Favicon <span class="star-red">*</span></p>
                                                <div class="settings-btn">
                                                    <input type="file" accept="image/*" name="favicon" id="file" onchange="loadFile(event)" class="hide-input">
                                                    <label for="file" class="upload">
                                                        <i class="feather-upload"></i>
                                                    </label>
                                                </div>
                                                <h6 class="settings-size">
                                                    Recommended image size is <span>16px x 16px or 32px x 32px</span>
                                                </h6>
                                                <h6 class="settings-size mt-1">Accepted formats: only png and ico</h6>
                                                <div class="upload-images upload-size">
                                                    <img src="public/images/website/<?= $web->favicon ?>?v=<?php echo time(); ?>" alt="Image">
                                                    <a href="javascript:void(0);" class="btn-icon logo-hide-btn">
                                                        <i class="feather-x-circle"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Address Line 1 <span class="star-red">*</span></label>
                                                <input type="text" class="form-control <?= isset($errors['adresse1']) ? 'is-invalid' : '' ?>" placeholder="Enter Address Line 1" name="adresse1" value="<?= $web->adresse1 ?>">
                                                <?php if (isset($errors['adresse1'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['adresse1'] ?></div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Address Line 2 <span class="star-red">*</span></label>
                                                <input type="text" class="form-control <?= isset($errors['adresse2']) ? 'is-invalid' : '' ?>" placeholder="Enter Address Line 2" name="adresse2" value="<?= $web->adresse2 ?>">
                                                <?php if (isset($errors['adresse2'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['adresse2'] ?></div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Tel Line 1 <span class="star-red">*</span></label>
                                                <input type="text" class="form-control <?= isset($errors['tel1']) ? 'is-invalid' : '' ?>" placeholder="Enter Address Line 1" name="tel1" value="<?= $web->tel1 ?>">
                                                <?php if (isset($errors['tel1'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['tel1'] ?></div>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Tel Line 2 <span class="star-red">*</span></label>
                                                <input type="text" class="form-control <?= isset($errors['tel2']) ? 'is-invalid' : '' ?>" placeholder="Enter Address Line 2" name="tel2" value="<?= $web->tel2 ?>">
                                                <?php if (isset($errors['tel2'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['tel2'] ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card-body pt-0">
                                        <div class="settings-form">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Ville <span class="star-red">*</span></label>
                                                        <input type="text" class="form-control <?= isset($errors['ville']) ? 'is-invalid' : '' ?>" name="ville" value="<?= $web->ville ?>">
                                                        <?php if (isset($errors['ville'])) {  ?>
                                                            <div class="invalid-feedback"><?= $errors['ville'] ?></div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Pays <span class="star-red">*</span></label>
                                                        <input type="text" name="pays" value="<?= $web->pays ?>" class="form-control <?= isset($errors['pays']) ? 'is-invalid' : '' ?>">
                                                        <?php if (isset($errors['pays'])) {  ?>
                                                            <div class="invalid-feedback"><?= $errors['pays'] ?></div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <!-- </div> -->
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label>Code Postal <span class="star-red">*</span></label>
                                                    <input type="text" name="code_postal" value="<?= $web->code_postal ?>" class="form-control <?= isset($errors['code_postal']) ? 'is-invalid' : '' ?>">
                                                    <?php if (isset($errors['code_postal'])) {  ?>
                                                        <div class="invalid-feedback"><?= $errors['code_postal'] ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label>Localisation <span class="star-red">*</span></label>
                                                    <input type="text" name="localisation" value="<?= $web->localisation ?>" class="form-control <?= isset($errors['localisation']) ? 'is-invalid' : '' ?>">
                                                    <?php if (isset($errors['localisation'])) {  ?>
                                                        <div class="invalid-feedback"><?= $errors['localisation'] ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label>Localisation Map<span class="star-red">*</span></label>
                                                    <input type="text" name="localisation_map" value="<?= $web->localisation_map ?>" class="form-control <?= isset($errors['localisation_map']) ? 'is-invalid' : '' ?>">
                                                    <?php if (isset($errors['localisation_map'])) {  ?>

                                                        <div class="invalid-feedback"><?= $errors['localisation_map'] ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label>Paypal Key<span class="star-red">*</span></label>
                                                    <input type="text" name="paypal_key" value="<?= $web->paypal_key ?>" class="form-control <?= isset($errors['paypal_key']) ? 'is-invalid' : '' ?>">
                                                    <?php if (isset($errors['paypal_key'])) {  ?>
                                                        <div class="invalid-feedback"><?= $errors['paypal_key'] ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label>keywords Ar<span class="star-red">*</span></label>
                                                    <textarea class="form-control" name="keywords_ar" id="keywords_ar" rows="10"><?= $web->keywords_ar ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label>keywords Fr<span class="star-red">*</span></label>
                                                    <textarea class="form-control" name="keywords_fr" id="keywords_fr" rows="10"><?= $web->keywords_fr ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label>description Ar<span class="star-red">*</span></label>
                                                    <textarea class="form-control" name="description_ar" id="description_ar" rows="10"><?= $web->description_ar ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label>description Fr<span class="star-red">*</span></label>
                                                    <textarea class="form-control" name="description_fr" id="description_fr" rows="10"><?= $web->description_fr ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label>Script<span class="star-red">*</span></label>
                                                    <textarea class="form-control" name="scripts" id="scripts" rows="10"><?= $web->scripts ?></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 mx-5">
                                    <div class="settings-btns">
                                        <button type="submit" name="Update" class="btn btn-orange">Update</button>
                                        <button type="submit" onclick="location.reload();" class="btn btn-grey">Cancel</button>
                                    </div>
                                </div>

                            </form>
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
