<?php

use app\Controllers\BaseController;


foreach($_SESSION as $name => $machine){ // vider panier
    if(substr($name,0,9) == "machines_"){
        unset($_SESSION[$name]);
        unset($_SESSION["count"]);
        unset($_SESSION["totaux"]);
        BaseController::redirect("cart");
    }
}