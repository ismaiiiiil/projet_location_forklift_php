<?php

use app\Controllers\BaseController;
use app\Controllers\MachineController;


if (!isset($_POST['category_id'])) {
    BaseController::redirect('home');
}
$id_category = $_POST['category_id'];


$machines = new MachineController($_POST);

// if(count($machinesList) < 1) {
//     BaseController::redirect('home');
// }


$prixMachine = $machines->getPrixMachinByCategory($id_category);
$hauteurPlateFormMachine = $machines->getHauteurPlateFormeMachinByCategory($id_category);
$capaciteLevageMachine = $machines->getCapaciteLevageMachinByCategory($id_category);

$prix_jour = "";
$hauteur_plate_forme = "";
$capacité_levage = "";
if(isset($_POST['find'])) {
    $prix_jour = isset($_POST["prix_jour"]) ? $_POST["prix_jour"] : "";
    $hauteur_plate_forme = isset($_POST["hauteur_plate_forme"]) ? $_POST["hauteur_plate_forme"] : "";
    $capacité_levage = isset($_POST["capacité_levage"]) ? $_POST["capacité_levage"] : "";
    $machinesList = $machines->searchMachineByCategoryPrixHauteurCapaciter($id_category,$prix_jour, $hauteur_plate_forme , $capacité_levage  );
}else {
    $machinesList = $machines->getMachineParCategory($id_category);
}

include 'layout/header.php';

?>

<body>
    <!-- 
    - #HEADER
-->

    <?php
    include 'layout/navbar.php';
    ?>
    <main>
        <article>

            <!-- 
        - #HERO
        -->

            <section class="section hero" id="home">
                <div class="container">

                    <div class="hero-content">
                        <h2 class="h1 hero-title">The easy way to takeover a lease</h2>

                        <p class="hero-text">
                            Live in New York, New Jerset and Connecticut!
                        </p>
                    </div>

                    <div class="hero-banner"></div>

                    <form method="POST" class="hero-form">
                        <input type="hidden" name="category_id" value="<?= $id_category ?>">
                        <div class="input-wrapper">
                            <label for="input-1" class="input-label">hauteur de plate forme</label>
                            <select name="hauteur_plate_forme" id="input-1" class="input-field" >
                                <option value="" >Filtrer par hauteur de plate forme</option>
                                <?php foreach($hauteurPlateFormMachine as $h) : ?>
                                    <option
                                    <?= $h->hauteur_plate_forme == $hauteur_plate_forme ? "selected" : "" ?>
                                    value="<?= $h->hauteur_plate_forme ?>">
                                        <?= $h->hauteur_plate_forme ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="input-wrapper">
                            <label for="input-2" class="input-label">capacité de levage</label>

                            <select name="capacité_levage" id="input-2" class="input-field">
                                <option value="" >Filtrer par capacité de levage</option>
                                <?php foreach($capaciteLevageMachine as $c) : ?>
                                    <option
                                    <?= $c->capacité_levage == $capacité_levage ? "selected" : "" ?>
                                    value="<?= $c->capacité_levage ?>">
                                        <?= $c->capacité_levage ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="input-wrapper">
                            <label for="input-3" class="input-label">prix</label>

                            <select name="prix_jour" id="input-3" class="input-field">
                                <option value="" >Filtrer par prix</option>
                                <?php foreach($prixMachine as $prix) : ?>
                                    <option
                                    <?=  $prix->prix_jour == $prix_jour ? "selected" : "" ?>
                                    value="<?= $prix->prix_jour ?>">
                                        <?= $prix->prix_jour ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                        </div>

                        <button type="submit" name="find" class="btn">
                            <ion-icon name="funnel-outline"></ion-icon>    
                            Search
                        </button>

                    </form>

                </div>
            </section>

            <!-- 
        - #FEATURED CAR machinesList
    -->

            <section class="section featured-car" id="featured-car">
                <div class="container">
                    <div class="title-wrapper">
                        <h2 class="h2 section-title">Featured cars</h2>

                        <a href="#" class="featured-car-link">
                            <span>View more</span>

                            <ion-icon name="arrow-forward-outline"></ion-icon>
                        </a>
                    </div>

                    <ul class="featured-car-list">
                        <?php
                        foreach ($machinesList as $machine) :
                        ?>
                            <li>
                                <div class="featured-car-card">
                                    <figure class="card-banner">
                                        <img src="public/images/machine/<?= $machine->image1 ?>" alt="Toyota RAV4 2021" loading="lazy" width="440" height="300" class="w-img-100" />
                                    </figure>

                                    <div class="card-content">
                                        <div class="card-title-wrapper">
                                            <h3 class="h3 card-title">
                                                <a href="#">
                                                    <?= $machine->nom ?>
                                                </a>
                                            </h3>

                                            <data class="year" value="2021">2021</data>
                                        </div>

                                        <ul class="card-list">
                                            <li class="card-list-item">
                                                <!-- <ion-icon name="people-outline"></ion-icon> -->
                                                <ion-icon name="logo-steam"></ion-icon>
                                                <span class="card-item-text">
                                                    <?= $machine->hauteur_plate_forme ?>
                                                </span>
                                            </li>

                                            <li class="card-list-item">
                                                <ion-icon name="flash-outline"></ion-icon>

                                                <span class="card-item-text">Hybrid</span>
                                            </li>

                                            <li class="card-list-item">
                                                <!-- <ion-icon name="speedometer-outline"></ion-icon> -->
                                                <ion-icon name="analytics-outline"></ion-icon>
                                                <span class="card-item-text">
                                                    <?= $machine->capacité_levage ?>
                                                </span>
                                            </li>

                                            <li class="card-list-item">
                                                <!-- <ion-icon name="hardware-chip-outline"></ion-icon> -->
                                                <ion-icon name="flame-outline"></ion-icon>
                                                <span class="card-item-text">
                                                    <?= $machine->type_carburant ?>
                                                </span>
                                            </li>
                                        </ul>

                                        <div class="card-price-wrapper">
                                            <p class="card-price"><b><?= $machine->prix_jour ?> Dh</b> / Jour</p>
                                            <p class="card-price"><b><?= $machine->prix_semaine ?> Dh</b> / Semaine</p>
                                            <p class="card-price"><b><?= $machine->prix_mois ?> Dh</b> / Mois</p>

                                            <button class="btn fav-btn" aria-label="Add to favourite list">
                                                <ion-icon name="heart-outline"></ion-icon>
                                            </button>

                                            <button type="button" class="btn" onclick="getMachineDetail(<?= $machine->id_machine ?>)">Rent now</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php
                        endforeach;
                        ?>
                        <form id='form_machine' action="<?php echo BASE_URL; ?>machine_detail" method="POST">
                            <input type="hidden" name="machine_id" id="machine_id">
                        </form>

                    </ul>
                </div>
            </section>

            <!-- 
        - #GET START
    -->

            <section class="section get-start">
                <div class="container">
                    <h2 class="h2 section-title">Get started with 4 simple steps</h2>

                    <ul class="get-start-list">
                        <li>
                            <div class="get-start-card">
                                <div class="card-icon icon-1">
                                    <ion-icon name="person-add-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Create a profile</h3>

                                <p class="card-text">
                                    If you are going to use a passage of Lorem Ipsum, you need
                                    to be sure.
                                </p>

                                <a href="#" class="card-link">Get started</a>
                            </div>
                        </li>

                        <li>
                            <div class="get-start-card">
                                <div class="card-icon icon-2">
                                    <ion-icon name="car-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Tell us what car you want</h3>

                                <p class="card-text">
                                    Various versions have evolved over the years, sometimes by
                                    accident, sometimes on purpose
                                </p>
                            </div>
                        </li>

                        <li>
                            <div class="get-start-card">
                                <div class="card-icon icon-3">
                                    <ion-icon name="person-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Match with seller</h3>

                                <p class="card-text">
                                    It to make a type specimen book. It has survived not only
                                    five centuries, but also the leap into electronic
                                </p>
                            </div>
                        </li>

                        <li>
                            <div class="get-start-card">
                                <div class="card-icon icon-4">
                                    <ion-icon name="card-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Make a deal</h3>

                                <p class="card-text">
                                    There are many variations of passages of Lorem available,
                                    but the majority have suffered alteration
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>


        </article>
    </main>

    <?php
    include 'layout/footer.php';
    ?>
</body>

</html>