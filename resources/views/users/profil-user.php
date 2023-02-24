<?php

use app\Controllers\OrderController;
use app\Controllers\UserController;

$order = new OrderController();

$orderdate = $order->gettDateOrder();


$user = new UserController($_POST);
$userinfo = $user->getUserConnecter();
// var_dump($userinfo);

$old_pass= "";
$password = "";
$cpassword = "";
if(isset($_POST["Modifier"])) {
    $user->updatePassword();
    $errors = $user->errors;

    $old_pass = $_POST["old_pass"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
}

if(isset($_POST['current_image']) )
{
    // var_dump($_POST);
    $user->updatePhotoProfile();
    
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
    <div class="page d-flex" style="margin-top: 3rem;">


        <div class="content w-full">

            <!-- Start Head -->
            <!-- End Head -->
            <h1 class="p-relative">Profile</h1>
            <div class=" m-20">
            <?php
            include('layout/alert.php'); ?>

            </div>

            <div class="profile-page m-20">
                <!-- Start Overview -->
                <div class="overview bg-white rad-10 d-flex align-center">
                    <div class="avatar-box txt-c p-20">
                        <img class="rad-half mb-10" src="public/images/users/<?php echo $userinfo->user_photo ?>" alt="" />
                        <!-- <input type="file" class="btn-cart btn-warning button-cart a">
                            <i class="fa-solid fa-upload"></i> Modifier photo Profil
                        </input> -->
                        <h3 class="m-0"><?= $userinfo->nom ?></h3>

                        <form id="f_upload" method="POST" enctype="multipart/form-data">
                            <div class="upload" >
                                <input type="hidden" name="current_image" value="<?= $userinfo->user_photo ?>">
                                <button type="button" class="btn-warning">
                                    <i class="fa fa-upload"></i> Upload Image
                                    <input type="file" id="image" name="image" onchange="uploadFile()">
                                </button>
                            </div>
                            <div class="w-fit confirm" id="confirm">
                                <label>
                                    <input type="submit" name="Confirmer" value="Confirmer" class="btn-cart btn-primary button-cart a">
                                </label>
                            </div>
                        </form>

                    </div>
                    <div class="info-box w-full txt-c-mobile">
                        <!-- Start Information Row -->
                        <div class="box p-20 d-flex align-center">
                            <h4 class="c-grey fs-15 m-0 w-full">General Information</h4>
                            <div class="fs-14">
                                <span class="c-grey">Nom</span>
                                <span><?= $userinfo->nom ?></span>
                            </div>
                            <div class="fs-14">
                                <span class="c-grey">Preom:</span>
                                <span><?= $userinfo->prenom ?></span>
                            </div>
                            <div class="fs-14">
                                <span class="c-grey">Tel:</span>
                                <span><?= $userinfo->tel ?></span>
                            </div>
                        </div>
                        <?php if ($userinfo->is_entreprise == 1) : ?>
                            <div class="box p-20 d-flex align-center">
                                <h4 class="c-grey fs-15 m-0 w-full">Information de l'entreprise</h4>
                                <div class="fs-14">
                                    <span class="c-grey">Nom Entreprise</span>
                                    <span><?= $userinfo->nom_entreprise ?></span>
                                </div>
                                <div class="fs-14">
                                    <span class="c-grey">Email Entreprise:</span>
                                    <span><?= $userinfo->email_entreprise ?></span>
                                </div>

                            </div>
                        <?php endif; ?>

                        <div class="box p-20 d-flex align-center">
                            <h4 class="c-grey w-full fs-15 m-0">Déconnecter</h4>

                            
                            <div class="fs-14">
                                <label>
                                    <a href="<?php echo BASE_URL ?>logout" class="btn-cart btn-danger button-cart a danger " aria-label="Profile">
                                        <div style="text-align:center;">
                                            Déconnecter
                                        </div>
                                    </a>
                                </label>
                            </div>


                        </div>
                        <!-- End Information Row -->
                    </div>
                </div>
                <!-- Start Settings Box -->
            
                <!-- End Settings Box -->
                <!-- End Overview -->
                <!-- Start Other Data -->
                <div class="other-data d-flex gap-20">

                    <div class="activities p-20 bg-white rad-10 mt-20">
                        <h2 class="mt-0 mb-10">Les dernières commandes que vous avez passées</h2>
                        <p class="mt-0 mb-20 c-grey fs-15">Toutes les commandes que vous avez passées</p>

                        <?php
                        $i = 0;
                        foreach ($orderdate as $date) : ?>
                            <div class="activity d-flex align-center txt-c-mobile">
                                <div class="info">
                                    <span class="d-block mb-10">Commande <?= $i + 1 ?></span>
                                    <span class="c-grey">Commande Efectuée le <?= $date->date_order ?></span>
                                    <?php
                                    $datetime1 = strtotime(date('Y-m-d'));
                                    $datetime2 = strtotime($date->date_order);

                                    $secs = $datetime1 - $datetime2; // == <seconds between the two times>
                                    $days = $secs / 86400;
                                    ?>
                                    <a onclick="afficheOrder('<?= $date->date_order ?>');" class="btn-cart btn-warning button-cart a">
                                        <i class="fa-solid fa-download"></i> Pour télécharger Votre facture cliquer içi .
                                    </a>
                                </div>
                                <div class="date">
                                    <span class="d-block mb-10"><?= $days == 0 ? "Ajourd'huit" : $days . " Jrs" ?></span>
                                    <span class="c-grey"><?= $date->date_order ?></span>
                                </div>
                            </div>
                        <?php
                            $i++;
                        endforeach; ?>
                        <form method="POST" id="form_order" action="<?php echo BASE_URL ?>admin/pdfInvoiceParDate">
                            <input type="hidden" name="date_order" id="date_order">
                            <input type="hidden" name="email_user" id="email_user" value="<?= $_SESSION['email_user'] ?>">
                        </form>

                    </div>
                </div>
                <!-- End Other Data -->

                <form method="POST" class="p-20 bg-white rad-10 mt-20">
                    <h2 class="mt-0 mb-10">Modifier mot de passe</h2>
                    <!-- <p class="mt-0 mb-20 c-grey fs-15">General Information About Your Account</p> -->
                    <div class="mb-15">
                        <label class="fs-14 c-grey d-block mb-10" for="old_pass">Ancien mot de passe</label>
                        <input class="b-none border-ccc p-10 rad-6 d-block w-full" 
                                type="password" name="old_pass" 
                                value="<?= $old_pass ?>"
                                placeholder="Ancien mot de passe" />
                    </div>
                    <div class="mb-15">
                        <label class="fs-14 c-grey d-block mb-5" for="password">Nouveau mot de passe</label>
                        <input class="b-none border-ccc p-10 rad-6 d-block w-full" 
                                id="password" name="password" type="password" 
                                value="<?= $password ?>"
                                placeholder="Nouveau mot de passe" />
                    </div>
                    <div class="mb-15">
                        <label class="fs-14 c-grey d-block mb-5" for="cpassword">Confirmez le mot de passe</label>
                        <input class="email b-none border-ccc p-10 rad-6 w-full mr-10" 
                                id="cpassword" name="cpassword" type="password" 
                                value="<?= $cpassword ?>"
                                placeholder="Confirmez le mot de passe"  />
                        <div class="my-2">
                            <p class=" text-danger">
                                <?php echo $errors['cpassword'] ?? '';  ?>
                            </p>
                        </div>
                    </div>
                    <div class="w-fit  mr-10 ">
                            <label>
                                <input type="submit" name="Modifier" value="Modifier" class="btn-cart btn-primary button-cart a">
                            </label>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include 'layout/footer.php';
    ?>

    <script>
        function afficheOrder(date) {
            var form_order = document.getElementById('form_order');
            var date_order = document.getElementById('date_order');
            date_order.value = date;
            form_order.submit();
        }

        function uploadFile()
        {
            var confirm = document.getElementById('confirm');
            confirm.style.display = "block";
            // alert('Upload');
        }
    </script>


</body>



</html>