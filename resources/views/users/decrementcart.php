<?php

use app\Controllers\BaseController;

$id = $_POST["machine_id"];
$price = $_POST["machine_price"];
$qte = $_POST["machine_qte"];


$price_one_machine = $_SESSION["machines_".$id]["total"] / $qte; // nomber une seul machine

if($qte > 1) {

    // var_dump($price_one_machine);
    $_SESSION["machines_".$id]["qte"] -= 1;

    $_SESSION["machines_".$id]["total"] -= $price_one_machine;
    $_SESSION["totaux"] -= $price_one_machine;
    BaseController::set("success","Machine décrementer avec succès");
    BaseController::redirect("cart");    
} else {
    unset($_SESSION["machines_".$id]);

    $_SESSION["count"] -= 1;
    $_SESSION["totaux"] -= $price_one_machine;

    BaseController::set("success","Machine supprimer avec succès");

    BaseController::redirect("cart");
}

// $_SESSION["count"] -= 1;
// $_SESSION["totaux"] -= (int)$_POST["machine_total"];
