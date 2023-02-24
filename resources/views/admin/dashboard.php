
<?php

use app\Controllers\AdminController;
use app\Controllers\BeneficeController;

$admin = new AdminController($_POST);

$nbrUser = $admin->getNbrUsers();
$nbrOrder = $admin->getNbrOrders();
$nbrMachine = $admin->getNbrMachines();
$sumBenefice = $admin->getSumBeneficeNow();


$benefice = new BeneficeController;
$benefice->getAllBenefice();


$clients = $admin->getClientPlusFidel();

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
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Welcome <?= $_SESSION['nom_admin'] ?>!</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active">Admin</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Utilisateurs</h6>
                                        <h3><?= $nbrUser->nbrUsers ?></h3>
                                    </div>
                                    <div class="db-icon">
                                        <img src="public/images/website/users.png" width="85" alt="Dashboard Icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Orders</h6>
                                        <h3><?= $nbrOrder->nbrOrders ?></h3>
                                    </div>
                                    <div class="db-icon">
                                        <img src="resources/views/admin/assets/img/icons/list-orders.svg" alt="Dashboard Icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Machines</h6>
                                        <h3><?= $nbrMachine->nbrMachines ?></h3>
                                    </div>
                                    <div class="db-icon">
                                        <img src="resources/views/admin/assets/img/icons/forklift.svg" alt="Dashboard Icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Bénéfice aujourd'hui</h6>
                                        <h3><?= $sumBenefice->sumBenefices ?? 0 ?> DH</h3>
                                    </div>
                                    <div class="db-icon">
                                        <img src="resources/views/admin/assets/img/icons/dash-icon-04.svg" alt="Dashboard Icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="row">
                    <div class="col-xl-6 d-flex">

                        <div class="card flex-fill student-space comman-shadow">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title">Bénéfices</h5>
                                <ul class="chart-list-out student-ellips">
                                    <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table
                                        class="table star-student table-hover table-center table-borderless table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th class="text-center">taux d'intérêt</th>
                                                <th class="text-center">Year</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            for ($i = 0; $i < count($benefice->t); $i++) :
                                            ?>
                                            <tr>
                                                <td class="text-nowrap">
                                                    <div><?= $i + 1 ?></div>
                                                </td>
                                                
                                                <td class="text-center">
                                                    <?= $benefice->t[$i]->getPrixHorsTaxe() ?> Dh
                                                </td>
                                                <td class="text-center">
                                                    <div>
                                                    <?= $benefice->t[$i]->getDateBénéfices() ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            endfor;
                                        ?>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-6 d-flex">

                        <div class="card flex-fill student-space comman-shadow">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title">Client plus Fidel</h5>
                                <ul class="chart-list-out student-ellips">
                                    <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table
                                        class="table star-student table-hover table-center table-borderless table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th class="text-center">Tel</th>
                                                <th class="text-center">Enreprise</th>
                                                <th class="text-center">Nombre d'orders</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i=1;
                                            foreach($clients as $client): 
                                            ?>
                                            <tr>
                                                <td class="text-nowrap">
                                                    <div><?= $i++ ?></div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <a href="profile.html">
                                                        <img class="rounded-circle"
                                                            src="public/images/users/<?= $client->user_photo ?>" width="30"
                                                            height="30"
                                                            alt="Star Students">
                                                        
                                                            <?= $client->nom ." ". $client->prenom ?>
                                                    </a>
                                                </td>
                                                <td class="text-center"><?= $client->tel ?></td>

                                                <?php if($client->is_entreprise === 0){ ?>
                                                    <td class="text-center">
                                                        <span class="badge badge-danger">non</span>    
                                                    </td>
                                                <?php }else{ ?>
                                                    <td class="text-center"><?= $client->nom_entreprise ?></td>
                                                <?php } ?>
                                                <td class="text-center">
                                                    <div><?= $client->nbrOrder ?></div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card flex-fill fb sm-box">
                            <div class="social-likes">
                                <p>Like us on facebook</p>
                                <h6>50,095</h6>
                            </div>
                            <div class="social-boxs">
                                <img src="resources/views/admin/assets/img/icons/social-icon-01.svg" alt="Social Icon">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card flex-fill twitter sm-box">
                            <div class="social-likes">
                                <p>Follow us on twitter</p>
                                <h6>48,596</h6>
                            </div>
                            <div class="social-boxs">
                                <img src="resources/views/admin/assets/img/icons/social-icon-02.svg" alt="Social Icon">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card flex-fill insta sm-box">
                            <div class="social-likes">
                                <p>Follow us on instagram</p>
                                <h6>52,085</h6>
                            </div>
                            <div class="social-boxs">
                                <img src="resources/views/admin/assets/img/icons/social-icon-03.svg" alt="Social Icon">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card flex-fill linkedin sm-box">
                            <div class="social-likes">
                                <p>Follow us on linkedin</p>
                                <h6>69,050</h6>
                            </div>
                            <div class="social-boxs">
                                <img src="resources/views/admin/assets/img/icons/social-icon-04.svg" alt="Social Icon">
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
<?php
    include 'layout/footer.php';
?>