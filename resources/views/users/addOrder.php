<?php


use app\Controllers\OrderController;

$order = new OrderController();

foreach($_SESSION as $name => $machine) {
    if(substr($name,0,9) == "machines_" )
    {
        $data = array(
            "nom_user" => $_SESSION["nom_user"],
            "email_user" => $_SESSION["email_user"],
            "id_machine" => $machine["id"],
            "number_jours" => $machine["nbr_jours"],
            "qte" => $machine["qte"],
            "total" => $machine["total"],
            "date_fin" => $machine["date_fin"]
        );
        $order->createOrder($data);
    }
}