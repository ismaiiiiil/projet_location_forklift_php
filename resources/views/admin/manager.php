<?php

use app\Controllers\AdminController;



$manager = new AdminController($_POST);



$manager->getAllManagement();

// $search_name = "";
// $search_entreprise="";

// if (isset($_POST["Search"])) {
//     $search_name = isset($_POST["search_name"]) ? $_POST["search_name"] : "";
//     $search_entreprise = isset($_POST['search_entreprise']) ? $_POST['search_entreprise'] : "";

//     if ($search_name === "all") {
//         $manager->getAllUser();
//     } else {
//         $manager->getAllmanagerByNameEntreprise($search_name, $search_entreprise);
//     }
// } else {
//     $manager->getAllUser();
// }


// if (isset($_POST['id_delete'])) {
//     $manager->deleteUser($_POST['id_delete']);
// }
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
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Managers</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>manager">Managers</a></li>
                                    <li class="breadcrumb-item active">All Managers</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="student-group-form">
                    <form method="POST" class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <select class="form-control " name="search_name">
                                    <option disabled selected>Search by Name user...</option>
                                    <option value="all">Select all users </option>
                                    
                                </select>
                            </div>
                        </div>

                    

                        <div class="col-lg-2">
                            <div class="search-student-btn">
                                <input type="submit" value="Search" name="Search" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Alert message -->
                <?php include("layout/alert.php"); ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table comman-shadow">
                            <div class="card-body">

                                <div class="page-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h3 class="page-title">Managers</h3>
                                        </div>
                                        <div class="col-auto text-end float-end ms-auto download-grp">
                                            <a href="<?php echo BASE_URL ?>add-manager" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                        <thead class="student-thread">
                                            <tr>
                                                <th>ID</th>
                                                <th>Profile</th>
                                                <th>Nom</th>
                                                <th>Prenom</th>
                                                <th>Email</th>
                                                <th>Tel</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            for ($i = 0; $i < count($manager->t); $i++) {
                                            ?>
                                                <tr>
                                                    <td><?= $i + 1 ?></td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <span
                                                                class="avatar avatar-sm me-2"><img
                                                                    class="avatar-img rounded-circle"
                                                                    src="public/images/manager/<?= $manager->t[$i]->getAdminProfile() ?>"
                                                                    alt="User Image">
                                                                </span>
                                                            <!-- <a href="teacher-details.html">Aaliyah</a> -->
                                                        </h2>
                                                    </td>
                                                
                                                    <td><?= $manager->t[$i]->getNom() ?></td>
                                                    <td><?= $manager->t[$i]->getPrenom() ?></td>
                                                    <td><?= $manager->t[$i]->getEmail() ?></td>
                                                    <td><?= $manager->t[$i]->getTel() ?></td>

                                                    <td class="text-end">
                                                        <div class="actions ">
                                
                                                            <!-- model  Delete-->
                                                            <a type="button" onclick="deleteUser(<?= $manager->t[$i]->getId() ?>)" class="btn btn-sm bg-danger-light" data-bs-toggle="modal" data-bs-target="#model-delete">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </a>

                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="model-delete" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-right">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <h4 class="mt-0">Voulez-vous vraiment supprimer cet user ?</h4>
                                <small class="font-weight-bold" style="color:#edb200;">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Cette action ne peut pas être annulée !
                                </small>
                                <hr/>
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                <!-- delete -->
                                <button type="submit" onclick="submitFormDetete()" class="btn btn-danger btn-sm" data-bs-dismiss="modal">
                                    Delete
                                </button>

                                <form id='form_delete' method="POST">
                                    <input type="hidden" name="id_delete" id="id_delete">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Prix Machine -->
            <footer>
                <p>Copyright © 2022 Dreamguys.</p>
            </footer>

        </div>

    </div>


    <script src="resources/views/admin/assets/js/jquery-3.6.0.min.js"></script>

    <script src="resources/views/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="resources/views/admin/assets/js/feather.min.js"></script>

    <script src="resources/views/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="resources/views/admin/assets/plugins/datatables/datatables.min.js"></script>

    <script src="resources/views/admin/assets/js/script.js"></script>


    <script>
        function deleteUser($id) {
            var form = document.getElementById('form_delete');
            var input = document.getElementById('id_delete');
            input.value = $id;
        }
        function submitFormDetete() {
            var form = document.getElementById('form_delete');
            form.submit();
        }
    </script>
</body>

</html>