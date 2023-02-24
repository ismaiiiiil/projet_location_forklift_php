<?php

use app\Controllers\BaseController;
use app\Controllers\OrderController;
use app\Controllers\MachineController;

$order = new OrderController();

$machine= new MachineController($_POST);
$machines = $machine->getAllMachinObj();

if(isset($_POST['id_show'])) {
    $order = $order->getOrdersNotificationById($_POST['id_show']);
}else {
    BaseController::redirect("orders");
}



include 'layout/header.php';
?>

<body>

    <div class="main-wrapper">
        <div id="hide">
            <?php
            include('layout/navbar.php');
            include 'layout/sidebar.php';
            ?>
        </div>

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header"  id="hide">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>orders">Order</a></li>
                                    <li class="breadcrumb-item active">Info order</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

        
                <!-- Alert message -->
                <?php include("layout/alert.php"); ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table comman-shadow">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="card my-5">
                                                <div class="card-header bg-white text-center p-3">
                                                    <h3 class="text-dark">
                                                        <div>
                                                            <img src="public/images/website/<?= $web->logo ?>?v=<?php echo time(); ?>" width="70" alt="">
                                                        </div>
                                                        Order d'un Utilisateur <b class="text-primary"><?= $order->nom_user; ?></b> 
                                                    </h3>
                                                </div>
                                                
                                                <div class="card-body">
                                                    <p class="lead d-flex">
                                                        <span>Order par l'utilisateur : <b class="text-primary"><?= $order->nom_user; ?></b>.</span> 
                                                        <h2 class="table-avatar " style="margin-left: 30%;">
                                                            <span class="avatar avatar-xxl  me-2 ">
                                                                <img class="avatar-img rounded" 
                                                                    src="public/images/users/<?= $order->user_photo ?>" 
                                                                    alt="Category Image">
                                                            </span>
                                                        </h2>
                                                    </p>
                                                    <p class="lead">
                                                        Email de l'utilisateur : <b class="text-primary"><?= $order->email_user; ?></b>.
                                                    </p>
                                                    <p class="lead">
                                                        Nom de machine : <b class="text-primary"><?php 
                                                                                                    foreach($machines as $m) :
                                                                                                        if ( $order->id_machine == $m->id) :
                                                                                                            echo $m->nom;
                                                                                                        endif;
                                                                                                    endforeach;
                                                                                                    ?>
                                                                            </b>.
                                                    </p>
                                                
                                                    <p class="lead">
                                                        Number de jours : <b class="text-primary"><?= $order->number_jours; ?></b>.
                                                    </p>
                                                    <p class="lead">
                                                        Quantité : <b class="text-primary"><?= $order->qte; ?></b>.
                                                    </p>
                                                    <p class="lead">
                                                        Prix : <b class="text-primary"><?= $order->prix; ?></b>.
                                                    </p>
                                                    <p class="lead">
                                                        Date de l'order : <b class="text-primary"><?= $order->date_order; ?></b>.
                                                    </p>
                                                    <p class="lead">
                                                        <b class="text-primary"><?= $order->delivrer ? "Delivré" : "N'est pas délivré" ?></b>.
                                                    </p>
                                                    <p class="lead">
                                                        <b class="text-primary"><?= $order->payer ? "Payer" : "N'est pas payer" ?></b>.
                                                    </p>
                                                    <p class="lead">
                                                        <b class="text-primary"><?= $order->machine_revenir ? "Machine revenir" : "Machine n'est pas revenir" ?></b>.
                                                    </p>
                                                    <p class="m-5">
                                                        ___________
                                                        ___________
                                                    </p>
                                                    <a href="#" id="printPageButton" class="btn btn-sm btn-primary mb-3" 
                                                    onclick="document.getElementById('printPageButton').style.display = 'none';
                                                    setTimeout(function(){
                                                            document.getElementById('printPageButton').style.display = 'inline-block';
                                                    }, 2000)
                                                    window.print();" class="btn btn-md btn-primary mr-2 mb-2">
                                                        <i class="fas fa-print"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer id="hide">
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


        
</body>

</html>