<?php

use app\Controllers\AdminController;
use app\Controllers\BeneficeController;
use app\Controllers\CalendrierController;

$admin = new AdminController($_POST);

$nbrUser = $admin->getNbrUsers();
$nbrOrder = $admin->getNbrOrders();
$nbrMachine = $admin->getNbrMachines();
$sumBenefice = $admin->getSumBeneficeNow();


$benefice = new BeneficeController;
$benefice->getAllBenefice();


$clients = $admin->getClientPlusFidel();

// ---------------
$calendrier = new CalendrierController($_POST);
$schedules = $calendrier->getAllDate();

if(isset($_POST["add-date"])) {
    $calendrier->saveChanges();
}

// ------------
$benefices = new BeneficeController();

$start_date= "";
$end_date = "";
if(isset($_POST['Search'])) {
    $start_date = isset($_POST["start_date"]) ? $_POST["start_date"] : "";
    $end_date = isset($_POST["end_date"]) ? $_POST["end_date"] : "";

    $listBenefices = $benefices->getAllBeneficeFetch($start_date, $end_date);
}else{
    $listBenefices = $benefices->getAllBeneficeFetch();
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
                                        <h3 class="counter"><?= $nbrUser->nbrUsers ?></h3>
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
                                        <h3 class="counter"><?= $nbrOrder->nbrOrders ?></h3>
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
                                        <h3 class="counter"><?= $nbrMachine->nbrMachines ?></h3>
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
                                        <h3 class="counter"><?= $sumBenefice->sumBenefices ?? 0 ?> DH</h3>
                                    </div>
                                    <div class="db-icon">
                                        <img src="resources/views/admin/assets/img/icons/dash-icon-04.svg" alt="Dashboard Icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Alert -->
                <?php include("layout/alert.php"); ?>


                <?php
                echo "<script>
                    var my_2d=" . json_encode($listBenefices) . "
                    </script>";

                ?>
                <div class="row">
                    <div class="student-group-form">
                        <form method="POST" class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="date" value="<?= $start_date ?? "" ?>" name="start_date" id="">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="date" value="<?= $end_date ?? "" ?>" name="end_date" id="">
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="search-student-btn">
                                    <input type="submit" value="Search" name="Search" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="card card-chart" id='chart_div'>
                            <!-- <div class=" text-center" id='chart_div'></div> -->
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
                                    <table class="table datatable star-student table-hover table-center table-borderless table-striped">
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
                                                    <?php if($benefice->t[$i]->getPrixHorsTaxe() < 0) {  ?>
                                                    <td class="text-center text-danger">
                                                        <?= $benefice->t[$i]->getPrixHorsTaxe() ?> Dh
                                                    </td>
                                                    <?php }else { ?>
                                                        <td class="text-center text-primary">
                                                            <?= $benefice->t[$i]->getPrixHorsTaxe() ?> Dh
                                                        </td>
                                                    <?php } ?>
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
                                    <table class="table datatable star-student table-hover table-center table-borderless table-striped">
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
                                            $i = 1;
                                            foreach ($clients as $client) :
                                            ?>
                                                <tr>
                                                    <td class="text-nowrap">
                                                        <div><?= $i++ ?></div>
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <a href="profile.html">
                                                            <img class="rounded-circle" src="public/images/users/<?= $client->user_photo ?>" width="30" height="30" alt="Star Students">

                                                            <?= $client->nom . " " . $client->prenom ?>
                                                        </a>
                                                    </td>
                                                    <td class="text-center"><?= $client->tel ?></td>

                                                    <?php if ($client->is_entreprise === 0) { ?>
                                                        <td class="text-center">
                                                            <span class="badge badge-danger">non</span>
                                                        </td>
                                                    <?php } else { ?>
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



                <!-- Calendrier -->
                <div class="row">
                    <div class="container py-5" id="page-container">
                        <div class="row">
                            <div class="col-md-9 col-xl-9"   id="calendar">
                                <!-- <div  ></div> -->
                            </div>
                            <div class="col-md-3 col-xl-3">
                                <div class="card rounded-0 shadow">
                                    <div class="card-header bg-gradient bg-primary text-light">
                                        <h5 class="card-title">Form de rappel</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="container-fluid">

                                            <form  method="post" id="schedule-form">

                                                <input type="hidden" name="id" value="">
                                                <div class="form-group mb-2">
                                                    <label for="title" class="control-label">Title</label>
                                                    <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" >
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="description" class="control-label">Description</label>
                                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" ></textarea>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="start_datetime" class="control-label">Start</label>
                                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" >
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="end_datetime" class="control-label">End</label>
                                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" >
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-center">
                                            <button name="add-date" class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                                            <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Event Details Modal -->
                    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-0">
                                <div class="modal-header rounded-0">
                                    <h5 class="modal-title">Schedule Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body rounded-0">
                                    <div class="container-fluid">
                                        <dl>
                                            <dt class="text-muted">Title</dt>
                                            <dd id="title" class="fw-bold fs-4"></dd>
                                            <dt class="text-muted">Description</dt>
                                            <dd id="description" class=""></dd>
                                            <dt class="text-muted">Start</dt>
                                            <dd id="start" class=""></dd>
                                            <dt class="text-muted">End</dt>
                                            <dd id="end" class=""></dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="modal-footer rounded-0">
                                    <div class="text-end">
                                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Event Details Modal -->
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
