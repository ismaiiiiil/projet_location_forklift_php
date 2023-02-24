<?php

namespace app\Controllers;

class HomeController{
    // Route Utilisateur
    public function index($page){
        include('resources/views/users'.$page.'.php');
    }
}


?>