<?php

use app\Controllers\PerteMaterielleController;



$perte = new PerteMaterielleController($_POST);



$perte->getAllPerteMaterielle();

// $search_name = "";
// $search_entreprise="";

// if (isset($_POST["Search"])) {
//     $search_name = isset($_POST["search_name"]) ? $_POST["search_name"] : "";
//     $search_entreprise = isset($_POST['search_entreprise']) ? $_POST['search_entreprise'] : "";

//     if ($search_name === "all") {
//         $perte->getAllUser();
//     } else {
//         $perte->getAllperteByNameEntreprise($search_name, $search_entreprise);
//     }
// } else {
//     $perte->getAllUser();
// }


if (isset($_POST['id_delete'])) {
    $perte->deletePerteMateriel($_POST['id_delete']);
}
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
                                <h3 class="page-title">Perte Matérielles</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>perte_matérielles">Perte Matérielles</a></li>
                                    <li class="breadcrumb-item active">All Perte Matérielles</li>
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
                                            <h3 class="page-title">Perte Matérielles List</h3>
                                        </div>
                                        <div class="col-auto text-end float-end ms-auto download-grp">
                                            <?php if(isset($_SESSION["admin"])){ ?>
                                                <a href="<?php echo BASE_URL ?>add-perte_materielle" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                            <?php }elseif(!!$roles->add_perte_materille && isset($_SESSION["manager"])){ ?>
                                                <a href="<?php echo BASE_URL ?>add-perte_materielle" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                        <thead class="student-thread">
                                            <tr>
                                                <th>ID</th>
                                                <th>description de matérielles</th>
                                                <th>prix perte</th>
                                                <th>date de perte</th>
                                                <?php if(isset($_SESSION["admin"])){ ?>
                                                    <th class="text-end">Action</th>
                                                <?php }elseif(!!$roles->edit_perte_materille || !!$roles->delete_perte_materille && isset($_SESSION["manager"])){ ?>
                                                    <th class="text-end">Action</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            for ($i = 0; $i < count($perte->t); $i++) {
                                            ?>
                                                <tr>
                                                    <td><?= $i + 1 ?></td>

                                                    <td><?= $perte->t[$i]->getDescriptionMat() ?></td>
                                                    <td>
                                                        <span class="badge badge-outline-danger py-2 px-3">
                                                            <span class="mark fs-6">
                                                                <?= $perte->t[$i]->getPrixPerte() ?> Dh
                                                            </span>
                                                        </span>
                                                    </td>
                                                    <td><?= $perte->t[$i]->getDatePerte() ?></td>

                                                    <?php if(isset($_SESSION["admin"])){ ?>
                                                        <td class="text-end">
                                                            <div class="actions ">
                                                            <!-- edit -->
                                                                <a onclick="editPertMareriel(<?= $perte->t[$i]->getId() ?>)" class="btn btn-sm bg-danger-light me-2">
                                                                    <i class="feather-edit"></i>
                                                                </a>
                                                                <form id='form_edit' action="<?php echo BASE_URL ?>edit-perte_materielle" method="POST">
                                                                    <input type="hidden" name="id_edit" id="id_edit">
                                                                </form>

                                                                <!-- model  Delete-->
                                                                <a type="button" onclick="deletePerteMateriel(<?= $perte->t[$i]->getId() ?>)"
                                                                    class="btn btn-sm bg-danger-light" data-bs-toggle="modal" data-bs-target="#model-delete">
                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    <?php }elseif(!!$roles->edit_perte_materille || !!$roles->delete_perte_materille && isset($_SESSION["manager"])){ ?>
                                                        <td class="text-end">
                                                            <div class="actions ">
                                                                <!-- edit -->
                                                                <?php if(!!$roles->edit_perte_materille){ ?>
                                                                    <a onclick="editPertMareriel(<?= $perte->t[$i]->getId() ?>)" class="btn btn-sm bg-danger-light me-2">
                                                                        <i class="feather-edit"></i>
                                                                    </a>
                                                                    <form id='form_edit' action="<?php echo BASE_URL ?>edit-perte_materielle" method="POST">
                                                                        <input type="hidden" name="id_edit" id="id_edit">
                                                                    </form>
                                                                <?php } ?>
                                                                <?php if(!!$roles->delete_perte_materille){ ?>
                                                                    <!-- model  Delete-->
                                                                    <a type="button" onclick="deletePerteMateriel(<?= $perte->t[$i]->getId() ?>)"
                                                                        class="btn btn-sm bg-danger-light" data-bs-toggle="modal" data-bs-target="#model-delete">
                                                                        <i class="fa-solid fa-trash-can"></i>
                                                                    </a>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    <?php } ?>

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
        function deletePerteMateriel($id) {
            var form = document.getElementById('form_delete');
            var input = document.getElementById('id_delete');
            input.value = $id;
        }
        function submitFormDetete() {
            var form = document.getElementById('form_delete');
            form.submit();
        }

        function editPertMareriel($id) {
            var form = document.getElementById('form_edit');
            var input = document.getElementById('id_edit');
            input.value = $id;
            form.submit();
        }
    </script>
</body>

</html>
