<?php

use app\Controllers\MachineController;
use app\Controllers\OrderController;
use app\Controllers\UserController;

$order = new OrderController();

$machine= new MachineController($_POST);
$machines = $machine->getAllMachinObj();

$orderSearch = $order->getAllOrdersSearch();

$search_email = "";
$search_entreprise = "";

if (isset($_POST["Search"])) {
    $search_email = isset($_POST["search_email"]) ? $_POST["search_email"] : "";
    $search_entreprise = isset($_POST['search_entreprise']) ? $_POST['search_entreprise'] : "";

    if ($search_email === "all") {
        $order->getAllOrders();
    } else {
        $order->getAllOrdersByNameAndEntreprise($search_email, $search_entreprise);
    }
} else {
    $order->getAllOrders();
}


if (isset($_POST['id_delete'])) {
    $order->deleteOrder($_POST['id_delete']);
}
if (isset($_POST['id_delivred'])) {
    $order->delivredOrder($_POST['id_delivred']);
}

if (isset($_POST['id_not_delivred'] ))
{
    $order->notDelivredOrder($_POST['id_not_delivred']);
}





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
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Orders</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="user.php">Orders</a></li>
                                    <li class="breadcrumb-item active">All Orders</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="student-group-form">
                    <form method="POST" class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <select class="form-control " name="search_email">
                                    <option disabled selected>Search by Email user...</option>
                                    <option value="all">Select all users </option>
                                    <?php foreach($orderSearch as $orderR) : ?>
                                        <option
                                            <?= $orderR->email_user === $search_email ? "selected" : "" ?>
                                            value="<?= $orderR->email_user ?>">
                                                <?= $orderR->email_user ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <select class="form-control " name="search_entreprise">
                                    <option value="all">Is entreprise ou non</option>
                                    <option <?= $search_entreprise == "1" ? "selected" : ""  ?> value="1">
                                        Oui
                                    </option>
                                    <option <?= $search_entreprise == "0" ? "selected" : ""  ?> value="0">
                                        Nom
                                    </option>
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
                                            <h3 class="page-title">Orders</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">


                                    <div class="table-responsive">
                                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                            <thead class="student-thread">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nom User</th>
                                                    <th>Email User</th>
                                                    <th>Nom de machine</th>
                                                    <th>Number de jours</th>
                                                    <th>Quantité</th>
                                                    <th>Prix Total</th>
                                                    <th>Date de l'order</th>
                                                    <th>Delivrer</th>
                                                    <th>Payer</th>
                                                    <th>Machine revenie </th>
                                                    <th class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                for ($i = 0; $i < count($order->t); $i++) {
                                                ?>
                                                    <tr>
                                                        <td><?= $i + 1 ?></td>
                                                        <td><?= $order->t[$i]->getNomUser() ?></td>
                                                        <td><?= $order->t[$i]->getEmailUser() ?></td>
                                                        <td><?php 
                                                            foreach($machines as $m) :
                                                                if ( $order->t[$i]->getIdMachine() == $m->id) :
                                                                    echo $m->nom;
                                                                endif;
                                                            endforeach;
                                                            ?></td>
                                                        <td><?= $order->t[$i]->getNumberJours() ?></td>
                                                        <td><?= $order->t[$i]->getQte() ?></td>
                                                        <td><?= $order->t[$i]->getPrix() ?></td>
                                                        <td><?= $order->t[$i]->getDateOrder() ?></td>
                                                        <td>
                                                            <?php if($order->t[$i]->getDelivrer() === 0 ) { ?>
                                                                <span class="fs-6 badge badge-danger">non</span>    
                                                            <?php } else { ?>
                                                                <span class="fs-6 badge badge-success">oui</span>    
                                                            <?php }?>
                                                        </td>
                                                        <td>
                                                            <?php if($order->t[$i]->getPayer() === 0 ) { ?>
                                                                <span class="fs-6 badge badge-danger">non</span>    
                                                            <?php } else { ?>
                                                                <span class="fs-6 badge badge-success">oui</span>    
                                                            <?php }?>
                                                        </td>
                                                        <td>
                                                            <?php if($order->t[$i]->getMachineRevenir() === 0 ) { ?>
                                                                <span class="fs-6 badge badge-danger">non</span>    
                                                            <?php } else { ?>
                                                                <span class="fs-6 badge badge-success">oui</span>    
                                                            <?php }?>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="actions ">
                                                                <form action="<?php echo BASE_URL ?>show-order" id="form_show" method="POST">
                                                                    <input type="hidden" name="id_show" id="id_show">
                                                                </form>
                                                                <a href="javascript:;"  onclick="showOrder(<?= $order->t[$i]->getId() ?>);"
                                                                class="btn btn-sm bg-success-light me-2 ">
                                                                    <i class="feather-eye"></i>
                                                                </a>
                                                                <!-- model  Delete-->
                                                                <a type="button" onclick="deleteOrder(<?= $order->t[$i]->getId() ?>)" class="btn btn-sm bg-danger-light me-2" data-bs-toggle="modal" data-bs-target="#model-delete">
                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                </a>
                                                                <?php if($order->t[$i]->getDelivrer() === 0 ) { ?>
                                                                    <form id="form_delivred" method="POST">
                                                                        <input type="hidden" name="id_delivred" id="id_delivred">
                                                                    </form>
                                                                    <a onclick="delivredOrder(<?= $order->t[$i]->getId() ?>)" class="btn text-light btn-sm bg-success rounded ">
                                                                        <i class="fa-solid fa-check"></i>
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <form id="form_not_delivred" method="POST">
                                                                        <input type="hidden" name="id_not_delivred" id="id_not_delivred">
                                                                    </form>
                                                                    <a onclick="notDelivredOrder(<?= $order->t[$i]->getId() ?>)" class="btn text-light btn-sm bg-danger rounded ">
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                    </a>
                                                                <?php }  ?>
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
                                    <h4 class="mt-0">Voulez-vous vraiment supprimer cet Order ?</h4>
                                    <small class="font-weight-bold" style="color:#edb200;">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Cette action ne peut pas être annulée !
                                    </small>
                                    <hr />
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
            function deleteOrder($id) {
                var form = document.getElementById('form_delete');
                var input = document.getElementById('id_delete');
                input.value = $id;
            }

            function submitFormDetete() {
                var form = document.getElementById('form_delete');
                form.submit();
            }

            function showOrder($id) 
            {
                var form = document.getElementById('form_show');
                var input = document.getElementById('id_show');
                input.value = $id;
                form.submit();
            }


            function delivredOrder($id) 
            {
                var form = document.getElementById('form_delivred');
                var input = document.getElementById('id_delivred');
                input.value = $id;
                form.submit();
            }

            function notDelivredOrder($id)
            {
                var form = document.getElementById('form_not_delivred');
                var input = document.getElementById('id_not_delivred');
                input.value = $id;
                form.submit();
            }
        </script>
</body>

</html>