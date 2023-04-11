<?php

use app\Controllers\AdminController;

$admin = new AdminController($_POST);

// var_dump($adminInfo);



if (isset($_POST["current_image"])) {
    $admin->updatePhotoProfile();
}

// $old_pass= "";
// $password = "";
// $cpassword = "";
// if(isset($_POST["ModifierPass"])) { 
//     $admin->updatePassword();
//     $errors = $admin->errors;

//     $old_pass = $_POST["old_pass"];
//     $password = $_POST["password"];
//     $cpassword = $_POST["cpassword"];
// }







include 'layout/header.php';
?>

<body>

    <div class="main-wrapper">

        <?php 
        include('layout/navbar.php');
        include 'layout/sidebar.php';
        
        ?>


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Profile</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Alert message -->
                <?php include("layout/alert.php"); ?>
                <div class="row">
                    <div class="col-md-12">
                        <form  method="POST" id="upload_image" enctype="multipart/form-data">
                            <div class="profile-header">
                                <div class="row align-items-center">
                                    <div class="col-auto profile-image me-3 ms-3">
                                        
                                        <div class="div-img-admin">
                                            <img src="public/images/<?= isset($_SESSION["admin"]) && $_SESSION["admin"] === true ? 'admin' : 'manager' ?>/<?= $adminInfo->admin_profile ?>" class="main-profile-img" />
                                            <label for="image">
                                                <i class="fa fa-edit icon-input">
                                                </i>
                                            <input type="file"  onchange="changeImage()" id="image" style="display: none;" class="hiden-input" name="image">
                                            </label>
                                            
                                        </div>
                                        
                                        <input type="hidden" name="current_image" value="<?= $adminInfo->admin_profile ?>">
                            
                                    </div>
                                    <div class="col ms-md-n2 profile-user-info mb-5">
                                        <h4 class="user-name mb-0"><?= $adminInfo->nom ?></h4>
                                        <h6 class="text-muted">Admin Teams</h6>
                                    </div>
                                    <!-- <div class="col-auto profile-btn" id="input-edit" style="display: none;">
                                        <input type="submit" class="btn btn-primary" value="Modifier" name="ModifierProfile">
                                    </div> -->
                                </div>
                            </div>
                        </form>

                        <div class="profile-menu">
                            <ul class="nav nav-tabs nav-tabs-solid">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#password_tab">Password</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content profile-tab-cont">

                            <div  class="tab-pane fade show active" id="per_details_tab">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title d-flex justify-content-between">
                                                    <span>Personal Details</span>
                                                    <!-- <a class="edit-link" data-bs-toggle="modal" href="#edit_personal_details"><i class="far fa-edit me-1"></i>Edit</a> -->
                                                </h5>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Name</p>
                                                    <p class="col-sm-9"><?= $adminInfo->nom . " " . $adminInfo->prenom ?></p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email ID</p>
                                                    <p class="col-sm-9"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a1cbcec9cfc5cec4e1c4d9c0ccd1cdc48fc2cecc">[<?= $adminInfo->email ?>]</a></p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Mobile</p>
                                                    <p class="col-sm-9"><?= $adminInfo->tel ?></p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-3">

                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title d-flex justify-content-between">
                                                    <span>Account Status</span>
                                                    <a class="edit-link" href="#"><i class="far fa-edit me-1"></i> Edit</a>
                                                </h5>
                                                <button class="btn btn-success" type="button"><i class="fe fe-check-verified"></i> Active</button>
                                            </div>
                                        </div>


                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title d-flex justify-content-between">
                                                    <span>Skills </span>
                                                    <a class="edit-link" href="#"><i class="far fa-edit me-1"></i> Edit</a>
                                                </h5>
                                                <div class="skill-tags">
                                                    <span>Html5</span>
                                                    <span>CSS3</span>
                                                    <span>WordPress</span>
                                                    <span>Javascript</span>
                                                    <span>Android</span>
                                                    <span>iOS</span>
                                                    <span>Angular</span>
                                                    <span>PHP</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div> -->
                                </div>

                            </div>

                            

                            <div id="password_tab" class="tab-pane fade">
                                <!-- Alert Message danger -->
                                <div style="display: none;" id="alert" class="alert  alert-dismissible fade show mb-3" role="alert">
                                    <span id="content_alert"></span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <!-- End Alert -->
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Change Password</h5>
                                            <div class="row">
                                                <div class="col-md-10 col-lg-6">
                                                    <form method="POST">
                                                        <div class="form-group">
                                                            <label>Old Password</label>
                                                            <input type="password" class="form-control"
                                                                    name="old_pass" id="old_pass" 
                                                                    placeholder="Ancien mot de passe" 
                                                            />
                                                            
                                                        </div>
                                                        <div class="form-group">
                                                            <label>New Password</label>
                                                            <input type="password" class="form-control"
                                                                    name="password" id="password" 
                                                                    placeholder="Nouveau mot de passe" 
                                                            >
                                                            <!-- <div class="my-2">
                                                                <p class="text-danger">
                                                                </p>
                                                            </div> -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Confirm Password</label>
                                                            <input type="password" class="form-control"
                                                                    name="cpassword" id="cpassword" 
                                                                    placeholder="Confirmez le mot de passe" 
                                                            >
                                                            <!-- <div class="my-2">
                                                                <p class="text-danger">
                                                                </p>
                                                            </div> -->
                                                        </div>
                                                    </form>
                                                    <button name="ModifierPass" id="btn_update" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="resources/views/admin/assets/js/jquery-3.6.0.min.js"></script>

    <script src="resources/views/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="resources/views/admin/assets/js/feather.min.js"></script>

    <script src="resources/views/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="resources/views/admin/assets/js/script.js"></script>

    <script>
        function changeImage() {
            var form = document.getElementById('upload_image');
            // var input = document.getElementById('input-edit');
            // input.style.display = "block";
            form.submit();
        }

        const btn_update = document.getElementById('btn_update');
        btn_update.addEventListener("click", function() {
            var old_pass = document.getElementById('old_pass').value;
            var password = document.getElementById('password').value;
            var cpassword = document.getElementById('cpassword').value;

            // // alert
            var content_alert  = document.getElementById('content_alert');
            var alert  = document.getElementById('alert');
            // ------ 
            content_alert.innerHTML = "";
            alert.style.display = "none";
            alert.classList.remove("alert-success", "alert-danger")
            // 

            if(old_pass != '' && password != '' && cpassword != '')
            {
                var ajax = new XMLHttpRequest();
                ajax.open("GET", "resources/views/admin/ajax/action.php?action=update_password&old_pass="+ old_pass + "&password=" + password + "&cpassword=" + cpassword, true);
                ajax.send();
                ajax.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
                        var data = JSON.parse(this.responseText);
                        // console.log(this.responseText);
                        if(data.danger) {
                            content_alert.innerHTML = "Error: " + data.danger;
                            alert.classList.add("alert-danger");
                            alert.style.display = "block";
                        }else{
                            if(data.success) {
                                content_alert.innerHTML = "Bravo: " + data.success;
                                alert.classList.add("alert-success");
                                alert.style.display = "block";
                            }
                        }
                    }
                }
            }else{
                content_alert.innerHTML = "Error: Tous les champs obligator";
                alert.classList.add("alert-danger");
                alert.style.display = "block";
            }
        })
    </script>
</body>

</html>