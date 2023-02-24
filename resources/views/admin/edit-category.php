<?php

use app\Controllers\BaseController;
use app\Controllers\CategoryController;
use app\Controllers\MachineController;


$categories = new CategoryController($_POST);
$id = "";
if(isset($_POST['id_edit'])) {
    $id = $_POST['id_edit'];
    $category = $categories->getCategoriesId($_POST['id_edit']);
}
else{
    BaseController::redirect('category');
}

$nom = '';

if (isset($_POST['Modifier'])) {
    $categories->updateCategory();
    $errors = $categories->errors;
    $valid = $categories->valid;
    // var_dump($_POST);
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
                                <h3 class="page-title">Category</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>category">Category</a></li>
                                    <li class="breadcrumb-item active">Modifier category <?= $category->nom ?></li>
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
                                <h5 class="card-title">Modifier category <?= $category->nom ?></h5>
                            </div>
                            <div class="card-body">
                                
                                <form method="POST" enctype="multipart/form-data" >
                                    <!-- current_image1 -->
                                    <input type="hidden" name="id_edit" value="<?= $id ?>">
                                    <input type="hidden" name="current_image" value="<?= $category->image ?>">
                                
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Nom Category</label>
                                        <div class="col-md-10">
                                            <input type="text" name="nom" value="<?= $category->nom ?>" 
                                                class="form-control <?= isset($valid['nom']) ? 'is-valid' : '' ?> 
                                                    <?= isset($errors['nom']) ? 'is-invalid' : '' ?> ">

                                                <?php if (isset($errors['nom'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['nom'] ?></div>
                                                <?php } ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <h2 class="table-avatar ">
                                            <span class="avatar avatar-xxl  me-2 ">
                                                <img class="avatar-img rounded" 
                                                    src="public/images/category/<?= $category->image ?>" 
                                                    alt="Category Image">
                                            </span>
                                        </h2>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Photo Category</label>
                                        <div class="col-md-10">
                                            <input type="file" 
                                                class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>
                                                <?= isset($valid['image']) ? 'is-valid' : '' ?>" 
                                                name="image">
                                                <?php if (isset($errors['image'])) {  ?>
                                                    <div class="invalid-feedback"><?= $errors['image'] ?></div>
                                                <?php } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-0 row">
                                        <div class="col-md-10">
                                            <button name="Modifier" class="btn btn-warning" type="submit">Modifier</button>
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