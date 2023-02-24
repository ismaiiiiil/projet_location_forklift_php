<?php

use app\Controllers\BaseController;
use app\Controllers\MachineController;

if(isset($_POST["machine_id"])){
    $id = $_POST["machine_id"];
    $data = new MachineController($_POST);
    $machine = $data->getMachineParId($_POST['machine_id']);

    // ila kan f SESSION
    if($_SESSION["machines_".$id]["nom"] === $_POST["nom"]){
        BaseController::set("info","Vous avez déja ajouté cette machine au panier");
        BaseController::redirect("cart");
    }else{
        if($machine->quantity < $_POST["quantity"]){
            BaseController::set("info","La quantité disponible est : $machine->quantity");
            BaseController::redirect("cart");
        }else{ // ila makanch f SESSI  ON(panier)
            $_SESSION["machines_".$machine->id_machine] = array(
                "id" => $machine->id_machine,
                "nom_machine" => $machine->nom,
                "prix" => $machine->prix_jour,
                "qte" => $_POST["quantity"],
                "total" => $_POST["total"],
                "nbr_jours" => $_POST["nbr_jours"],
                "date_fin" => $_POST["date_fin"],
                "image" => $machine->image1
            );
            $_SESSION["totaux"] += $_SESSION["machines_".$machine->id_machine]["total"];
            $_SESSION["count"] += 1;
            BaseController::set("success","Machine ajouter au panier avec succès");
            BaseController::redirect("cart");
        }
    }
}