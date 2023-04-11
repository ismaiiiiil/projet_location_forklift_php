<?php

use app\Controllers\BeneficeController;



$benefice = new BeneficeController;




$search_date = "";

if (isset($_POST["Search"])) {
    $search_date = isset($_POST["search_date"]) ? $_POST["search_date"] : "";

    if ($search_date === "") {
        $benefice->getAllBenefice();
    } else {
        $benefice->getAllBeneficeParDate($search_date);
    }
} else {
    $benefice->getAllBenefice();
}


if (isset($_POST['id_delete'])) {
    $benefice->deleteBenefice($_POST['id_delete']);
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
                                <h3 class="page-title">Bénéfices</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>benefices">Bénéfices</a></li>
                                    <li class="breadcrumb-item active">All Bénéfices</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="student-group-form">
                    <form method="POST" class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <input class="form-control "
                                value="<?= $search_date ?>"
                                type="date" name="search_date" />
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="search-student-btn">
                                <input type="submit" value="Search" name="Search" class="btn btn-primary">
                            </div>
                        </div>
                        <?php
                            if($search_date !== "") {
                        ?>
                        <div class="col-sm-2">
                            <div class="search-student-btn">
                                <button type="submit" class="btn btn-secondary btn-lg btn-rounded btn-outline-*"
                                onclick="location.reload();"
                                >Annuler</button>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
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
                                            <h3 class="page-title">Bénéfices List</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                        <thead class="student-thread">
                                            <tr>
                                                <th>ID</th>
                                                <th>Total bénéfices</th>
                                                <th>Total perte</th>
                                                <th>Prix hors taxe</th>
                                                <th>date de bénéfices</th>
                                                <?php if(isset($_SESSION["admin"])){ ?>
                                                    <th class="text-end">Action</th>
                                                <?php }elseif(!!$roles->delete_benefice && isset($_SESSION["manager"])){ ?>
                                                    <th class="text-end">Action</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            for ($i = 0; $i < count($benefice->t); $i++) {
                                            ?>
                                                <tr>
                                                    <td><?= $i + 1 ?></td>
                                                    <td>
                                                        <span class="badge badge-outline-primary py-2 px-3">
                                                            <span class="fs-6">
                                                                <?= $benefice->t[$i]->getTotalBénéfices() ?> Dh
                                                            </span>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-outline-danger py-2 px-3">
                                                            <span class="fs-6">
                                                                <?= $benefice->t[$i]->getTotalPert() ?> Dh
                                                            </span>
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <span class="badge badge-outline-success py-2 px-3">
                                                            <span class="fs-6">
                                                                <?= $benefice->t[$i]->getPrixHorsTaxe() ?> Dh
                                                            </span>
                                                        </span>
                                                    </td>

                                                    <td><?= $benefice->t[$i]->getDateBénéfices() ?></td>

                                                    <?php if(isset($_SESSION["admin"])){ ?>
                                                        <td class="text-end">
                                                        <div class="actions ">
                                                            <!-- model  Delete-->
                                                            <a type="button" onclick="deletePerteMateriel(<?= $benefice->t[$i]->getId() ?>)"
                                                                class="btn btn-sm bg-danger-light" data-bs-toggle="modal" data-bs-target="#model-delete">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <?php }elseif(!!$roles->delete_benefice && isset($_SESSION["manager"])){ ?>
                                                        <td class="text-end">
                                                        <div class="actions ">
                                                            <!-- model  Delete-->
                                                            <a type="button" onclick="deletePerteMateriel(<?= $benefice->t[$i]->getId() ?>)"
                                                                class="btn btn-sm bg-danger-light" data-bs-toggle="modal" data-bs-target="#model-delete">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </a>
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


    </script>
</body>

</html>
