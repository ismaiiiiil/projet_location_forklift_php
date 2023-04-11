<?php

use app\Controllers\OrderController;
use app\Controllers\WebSiteController;
use app\Controllers\AdminController;

$website = new WebSiteController($_POST);

$web = $website->getInfoWebSite();






// Notification
$orderNotification = new OrderController();
$notification = $orderNotification->getAllOrdersNotification();


$admin = new AdminController($_POST);

$adminInfo = $admin->getAdminConnecter();


$nbrOrderNow = $admin->getNbrOrdersNow();

$roles = $admin->getManagerConnecter();


// Roles
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Engiloc - Location</title>
    <link rel="shortcut icon" href="public/images/website/<?= $web->logo ?>?v=<?php echo time(); ?>" type="image/svg+xml">
    <!-- <link rel="shortcut icon" href="../../../../public/images/logoSite.png"> -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&display=swap">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="resources/views/admin/assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="resources/views/admin/assets/plugins/feather/feather.css">

    <link rel="stylesheet" href="resources/views/admin/assets/plugins/icons/flags/flags.css">

    <link rel="stylesheet" href="resources/views/admin/assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="public/css/loader.css?v=<?php echo time(); ?>" />

    <link rel="stylesheet" href="resources/views/admin/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="resources/views/admin/assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="resources/views/admin/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel=”stylesheet” href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <link rel=”stylesheet” href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="resources/views/admin/assets/plugins/datatables/datatables.min.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/js/fullcalendar/lib/main.min.css">
    <!-- <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script> -->
    <script src="./public/js/fullcalendar/lib/main.min.js"></script>

    <!-- ................ Select ..................... -->
    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <!-- Load Bootstrap -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

    <!-- Load the plugin bundle. -->
    <!-- <link rel="stylesheet" href="resources/views/admin/assets/css/filter_multi_select.css?v=<?php echo time(); ?>" />
    <script src="resources/views/admin/assets/js/filter-multi-select-bundle.min.js?v=<?php echo time(); ?>"></script> -->

    <!-- ..................................... -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css?v=<?php echo time(); ?>">


    <link rel="stylesheet" href="resources/views/admin/assets/css/style.css?v=<?php echo time(); ?>">
    <style>
        @media print {
            #hide {
                display: none;
            }
        }
    </style>

    <script>
        function showNotification($id) {
            var form = document.getElementById('form_notification');
            var input = document.getElementById('id_notification');
            input.value = $id;
            form.submit();
        }
    </script>
</head>
