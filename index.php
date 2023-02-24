<?php

use app\Controllers\AdminController;
use app\Controllers\HomeController;
session_start();

include 'bootstrap.php';
require_once 'vendor/autoload.php';


$request = $_SERVER['REQUEST_URI']; // Lesson%20Router%20PHP/product

$router = str_replace('/Projet%20Location%20forklift%20Route','', $request); // /product

$arr = explode('/',$router);
$id = "";
if(isset($arr[2])) {
    $id = $arr[2];
}

$home = new HomeController();
$admin = new AdminController($_POST);

$pages = [
            '/home', '/cart', '/contact', '/machine_list', '/machine_detail' ,'/checkout',
            '/emptycart' , '/cancelcart', '/decrementcart', '/incrementcart', '/login', '/signup',
            '/logout', '/addOrder', '/pdfinvoice',
            '/profil-user','/pdfInvoiceParDate',
            '/forgot-password', '/verifyEmail','/newPassword', 
            '/dashboard' , // admin pages
            '/add-machine', '/machine','/edit-machine',
            '/add-category' , '/category' , '/edit-category',
            '/users', 
            '/orders', '/show-order',
            '/logout-administrateur',
            '/login-administrateur', '/profile-administrateur',
            '/settings' , '/perte_materielles' , '/benefices' ,
            '/add-perte_materielle', '/edit-perte_materielle',
            '/show-notification',
            '/add-manager','/manager','/edit-manager'
        ];
if(isset($router)) {
    if(in_array($router, $pages)) {
        // pages dyal admin 
        if(
            $router === '/dashboard' || $router === '/add-machine' || $router === '/machine' || 
            $router === '/edit-machine' || $router === '/add-category' || $router === '/category' ||
            $router === '/edit-category' || $router === '/users' || $router === '/orders' ||  
            $router === '/show-order' || $router === '/login-administrateur' 
            || $router === '/logout-administrateur'
            || $router === '/profile-administrateur' || $router === '/settings'
            || $router === '/perte_materielles' || $router === '/benefices'
            || $router === '/add-perte_materielle' || $router === '/edit-perte_materielle'
            || $router === '/show-notification' 
            || $router === '/manager' || $router === '/add-manager' || $router === '/edit-manager'
        ) {

            if(isset($_SESSION["admin"]) && $_SESSION["admin"] == true) 
            {
                $admin->index($router);

            }elseif($router === "/login-administrateur") {
                $admin->index($router);
            }else{
                include('resources/views/users/layout/page404.php');
            }
            // Page login user
        }elseif( $router === '/logout' || $router === '/profil-user' || 
                    $router === '/pdfInvoiceParDate' || $router === '/pdfinvoice'
        ){
            if(isset($_SESSION["nom_user"]) && $_SESSION["email_user"]) {
                $home->index($router);
            } else {
                include('resources/views/users/layout/page404.php');
            }
        }elseif( $router === '/newPassword' ){ // New password
            if(isset($_SESSION["code_email"]) && isset($_SESSION["code_user"]) && $_SESSION["code_user"] === true) {
                $home->index($router);
            } else {
                include('resources/views/users/layout/page404.php');
            }
        } else {
            $home->index($router);
        }
    } elseif($router == "/") {
        $home->index('/home');
    } elseif($router == "/admin/pdfinvoice") {
        $admin->index('/pdfinvoice');
    }elseif($router == "/admin/pdfInvoiceParDate") {
        $admin->index('/pdfInvoiceParDate');
    }  else {
        include('resources/views/users/layout/page404.php');
    }
} else {
    $home->index('/home');
}










?>