<?php

require_once 'vendor/autoload.php';
use app\Controllers\BaseController;
use app\Controllers\MachineController;

$id = $_POST["machine_id"];
$price = $_POST["machine_price"];
$qte = $_POST["machine_qte"];



if(isset($id)){
    $data = new MachineController($_POST);
    $machine = $data->getMachineParId($id);
    if($machine->quantity <= $qte){ // quantiter stock inferieure a quantity commender
        // echo $id;
        BaseController::set("info","La quantité disponible est : " . $machine->quantity);
        BaseController::redirect("cart");
    } else {
        $price_one_machine = $_SESSION["machines_".$id]["total"] / $qte; // nomber une seul machine

        $_SESSION["machines_".$id]["qte"] += 1;
        $_SESSION["machines_".$id]["total"] += $price_one_machine;
        $_SESSION["totaux"] += $price_one_machine;
        BaseController::set("success","Machine incrémenter avec succès");
        BaseController::redirect("cart");    
    }
}
