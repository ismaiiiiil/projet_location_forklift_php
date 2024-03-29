<?php
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
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Settings</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="settings.html">Settings</a></li>
                                <li class="breadcrumb-item active">Email Settings</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="settings-menu-links">
                            <ul class="nav nav-tabs menu-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="settings.html">General Settings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="localization-details.html">Localization</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="payment-settings.html">Payment Settings</a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="email-settings.html">Email Settings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="social-settings.html">Social Media Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="social-links.html">Social Links</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="seo-settings.html">SEO Settings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="others-settings.html">Others</a>
                                </li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">PHP Mail</h5>
                                        <div class="status-toggle d-flex justify-content-between align-items-center">
                                            <input type="checkbox" id="status_1" class="check">
                                            <label for="status_1" class="checktoggle">checkbox</label>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <form>
                                            <div class="settings-form">
                                                <div class="form-group form-placeholder">
                                                    <label>Email From Address <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Email Password <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Emails From Name <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group mb-0">
                                                    <div class="settings-btns">
                                                        <button type="submit" class="btn btn-orange">Submit</button>
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
                                        <h5 class="card-title">SMTP</h5>
                                        <div class="status-toggle d-flex justify-content-between align-items-center">
                                            <input type="checkbox" id="status_2" class="check" checked="">
                                            <label for="status_2" class="checktoggle">checkbox</label>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <form>
                                            <div class="settings-form">
                                                <div class="form-group form-placeholder">
                                                    <label>Email From Address <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Email Password <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Email Host <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group form-placeholder">
                                                    <label>Email Port <span class="star-red">*</span></label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group mb-0">
                                                    <div class="settings-btns">
                                                        <button type="submit" class="btn btn-orange">Submit</button>
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
            </div>
        </div>

    </div>

    <?php
    include 'layout/footer.php';
?>