<?php


if(isset($_GET["action"])) 
{
    if($_GET["action"] == "generateprix") 
    {
        $premier_date = $_GET["premier_date"];
        $deuxieme_date = $_GET["deuxieme_date"];
        $quantity = $_GET["quantity"];
        $prix_jour = $_GET["prix_jour"];   

        $datetime1 = strtotime($premier_date);
        $datetime2 = strtotime($deuxieme_date);

        $secs = $datetime2 - $datetime1;// == <seconds between the two times>
        $days = $secs / 86400;
        
        $output = array();
        if(( $datetime1 - strtotime(date('Y-m-d')) ) < 0) {
            $output = array(
                "danger"=>"Invalid La date premier"
            );
        }elseif(( $datetime2 - $datetime1 ) <= 0 ) {
            $output = array(
                "danger"=>"Invalid La date deuxieme"
            );
        }else {
            $pourcentages = "";
            if(($days) >= 7) {
                $oldPrice = ($days * $prix_jour) * $quantity ;
                $newPrice = $oldPrice - ($oldPrice)*0.02; // -2 %
                $pourcentages = 2;

            }elseif(($days) >= 30) {
                $oldPrice = ($days * $prix_jour)  * $quantity ;
                $newPrice =  $oldPrice - ($oldPrice) * 0.10; // -10 %
                $pourcentages = 10; 

            }elseif(($days) < 7){
                $oldPrice = $days * $prix_jour * $quantity ; 
                $newPrice = $oldPrice - ($oldPrice) * 0.01; // -1 %
                $pourcentages = 1;
            }
            $output = array(
                "success" => "Le prix a été calculer avec succès",
                "oldPrice" => $oldPrice,
                "newPrice" => $newPrice,
                "pourcentages" => $pourcentages,
                'nbrjours' => $days,
                "quantity" => $quantity,
                "date_fin" => $deuxieme_date
            );
        }
        echo json_encode($output,JSON_FORCE_OBJECT);
    }

   
}