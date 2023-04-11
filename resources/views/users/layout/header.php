<?php
use app\Controllers\WebSiteController;

$website = new WebSiteController($_POST);

$web = $website->getInfoWebSite();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Engiloc - Location</title>

    <meta name="description" content="<?= $web->description_ar ?? '' ?>">
    <meta name="keywords" content="<?= $web->keywords_ar ?? '' ?>">

    <!--
    - favicon
  -->
    <link rel="shortcut icon" href="public/images/website/<?= $web->logo ?>?v=<?php echo time(); ?>" type="image/svg+xml" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

    <!--
    - custom css link
  -->
    <link rel="stylesheet" href="public/css/scroll-top.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="public/css/style.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="public/css/login.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="public/css/contact.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="public/css/machine.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="public/css/cart.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="public/css/loader.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="public/css/profil-user.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="public/css/all.min.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="public/css/all1.min.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="public/css/framework.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="public/css/master.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="public/css/feedback.css?v=<?php echo time(); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />

     <!-- Google Fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&display=swap" rel="stylesheet" />
    <!--
    - google font link
  -->
  <link rel="stylesheet" href="public/css/toast.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<!-- Step 2: Add following HTML code: -->
<!-- <a href="https:/wa.me/+212694332279"  target="_blank" class="whatsapp_float"><i class="fa-brands fa-whatsapp whatsapp-icon"></i></a>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap"
        rel="stylesheet" /> -->

        <!-- Boxicons CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<!-- AfmgicyT7sIXtJrbm9ldbBcujX5D-IODDOsfXDDXYEReuRgy-aKEhlYKge8iIhenxCsBaFfX2_4tbJ09 -->
    <script src="https://www.paypal.com/sdk/js?client-id=<?= $web->paypal_key ?? "" ?>">
        </script>
        <!-- <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Hind&display=swap" rel="stylesheet"> -->

    <?=
    $web->scripts ?? ""
    ?>

</head>

