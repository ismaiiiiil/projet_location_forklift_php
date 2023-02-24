<?php

use app\Controllers\BaseController;

$id = $_POST["machine_id"];
$price = $_POST["machine_price"];
$qte = $_POST["machine_qte"];

unset($_SESSION["machines_".$id]);

$_SESSION["count"] -= 1;
$_SESSION["totaux"] -= (int)$_POST["machine_total"];
BaseController::set("success","Machine supprimer avec succès");

BaseController::redirect("cart");