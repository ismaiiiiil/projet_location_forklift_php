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

$pages =
        [
            '/home', '/cart', '/contact', '/machine_list', '/machine_detail' ,'/checkout',
            '/emptycart' , '/cancelcart', '/decrementcart', '/incrementcart', '/login', '/signup',
            '/logout', '/addOrder', '/pdfinvoice',
            '/profil-user','/pdfInvoiceParDate',
            '/forgot-password', '/verifyEmail','/newPassword',
            '/new-password-admin',
            '/dashboard' , // admin pages
            '/testimonials',
            '/add-machine', '/machine','/edit-machine',
            '/add-category' , '/category' , '/edit-category',
            '/users',
            '/orders', '/show-order',
            '/logout-administrateur',
            '/login-administrateur', '/forgot-password-admin', '/verify-code-email-admin',
            '/profile-administrateur',
            '/settings' , '/localization-settings','/payment-settings','/social-settings',
            '/perte_materielles' , '/benefices' ,
            '/add-perte_materielle', '/edit-perte_materielle',
            '/show-notification',
            '/add-manager','/manager','/edit-manager',
            "/delete_date"
        ];

$pagesManager = [];

if(isset($_SESSION["manager"])) {
    $roles = $admin->getManagerConnecter();
    if(!!$roles->orders) {
        $pagesManager[] = '/orders' ;
    }
    if(!!$roles->show_order) {
        $pagesManager[] = '/show-order' ;
    }
    if(!!$roles->delete_order) {
        $pagesManager[] = '/login-administrateur' ;
    }
    // if(!!$roles->controle_order) {
    //     $pagesManager[] = '' ;
    // }
    // if(!!$roles->notifications) {
    //     $pagesManager[] = '' ;
    // }
    if(!!$roles->machines) {
        $pagesManager[] = '/machine' ;
    }
    if(!!$roles->add_machine) {
        $pagesManager[] = '/add-machine' ;
    }
    if(!!$roles->edit_machine) {
        $pagesManager[] = '/edit-machine' ;
    }
    // if(!!$roles->delete_machine) {
    //     $pagesManager[] = '' ;
    // }
    if(!!$roles->categories	) {
        $pagesManager[] = '/category' ;
    }
    if(!!$roles->add_category	) {
        $pagesManager[] = '/add-category' ;
    }
    if(!!$roles->edit_category) {
        $pagesManager[] = '/edit-category' ;
    }
    // if(!!$roles->delete_category) {
    //     $pagesManager[] = '' ;
    // }
    if(!!$roles->users) {
        $pagesManager[] = '/users' ;
    }

    // if(!!$roles->delete_user) {
    //     $pagesManager[] = '' ;
    // }
    if(!!$roles->feedback) {
        $pagesManager[] = '/testimonials' ;
    }
    // if(!!$roles->delete_feedback) {
    //     $pagesManager[] = '' ;
    // }

    // if(!!$roles->controle_feedback) {
        // $pagesManager[] = '' ;
    // }
    if(!!$roles->perte_materilles) {
        $pagesManager[] = '/perte_materielles' ;
    }
    if(!!$roles->add_perte_materille) {
        $pagesManager[] = '/add-perte_materielle' ;
    }
    if(!!$roles->edit_perte_materille) {
        $pagesManager[] = '/edit-perte_materielle' ;
    }
    // if(!!$roles->delete_perte_materille	) {
    //     $pagesManager[] = '' ;
    // }
    if(!!$roles->benefices) {
        $pagesManager[] = '/benefices' ;
    }
    // if(!!$roles->delete_benefice	) {
    //     $pagesManager[] = '' ;
    // }
}




if(isset($router)) {
    if(in_array($router, $pages) || preg_match("/delete_date\/[0-9]/i" , $router)) {
        // pages dyal admin
        if(
            $router === '/dashboard' || $router === '/testimonials'
            || $router === '/add-machine' || $router === '/machine' || $router === '/edit-machine' ||
            $router === '/add-category' || $router === '/category' || $router === '/edit-category'
            || $router === '/users' ||
            $router === '/orders' || $router === '/show-order'
            || $router === '/login-administrateur' || $router === '/forgot-password-admin'
            || $router === '/verify-code-email-admin' || $router === '/new-password-admin'
            || $router === '/logout-administrateur'
            || $router === '/profile-administrateur'
            || $router === '/settings'  || $router === '/localization-settings' || $router === '/payment-settings' || $router === '/social-settings'
            || $router === '/perte_materielles' || $router === '/benefices'
            || $router === '/add-perte_materielle' || $router === '/edit-perte_materielle'
            || $router === '/show-notification'
            || $router === '/manager' || $router === '/add-manager' || $router === '/edit-manager'
            || preg_match("/delete_date\/[0-9]/i" , $router)
        ) {

            if(isset($_SESSION["admin"]) && $_SESSION["admin"] == true)
            {
                if(preg_match("/delete_date\/[0-9]/i" , $router) || $router == "/delete_date") {
                    include('./resources/views/admin/delete_date.php');
                    // echo $id;
                }else {
                    $admin->index($router);
                }
            }elseif(isset($_SESSION["manager"]) && $_SESSION["manager"] == true) {
                if (
                    $router === '/dashboard'
                    // || $router === '/testimonials'
                    // || $router === '/orders' || $router === '/show-order'
                    // || $router === '/perte_materielles' || $router === '/benefices'
                    // || $router === '/add-perte_materielle' || $router === '/edit-perte_materielle'
                    // || $router === '/show-notification'
                    || in_array($router, $pagesManager)

                    || $router === '/login-administrateur' ||$router === '/forgot-password-admin' || $router === '/logout-administrateur'
                    || $router === '/profile-administrateur'
                    // || $router === '/settings'  || $router === '/localization-settings' || $router === '/payment-settings' || $router === '/social-settings'
                    || preg_match("/delete_date\/[0-9]/i" , $router)
                ) {
                    if(preg_match("/delete_date\/[0-9]/i" , $router) || $router == "/delete_date") {
                        include('./resources/views/admin/delete_date.php');
                        // echo $id;
                    }else {
                        $admin->index($router);
                    }
                }else{
                    include('resources/views/users/layout/page404.php');
                }
            }elseif($router === "/login-administrateur" || $router === '/forgot-password-admin' || $router === '/verify-code-email-admin' || $router === '/new-password-admin') {
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
