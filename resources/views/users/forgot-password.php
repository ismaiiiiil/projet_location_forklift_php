<?php

if(isset($_SESSION['login'])) {
    header('Location: home');
}

use app\Controllers\UserController;

$user = new UserController($_POST);

if(isset($_POST['verifier'])) {

    $user->forgotPassword();
}

include 'layout/header.php';

?>

<body>
    <!-- 
    - #HEADER
-->

    <?php
    include 'layout/navbar.php';
    ?>
    <main>
        <article class="login_register">
        <?php include('layout/alert.php'); ?>

            <div class="wrapper">
                <div class="title-text">
                    <div class="title login">
                        Vérification <br> de l'E-mail
                    </div>
                </div>
                <div class="form-container">
                    
                    <div class="form-inner">
                        <form action="#" method="POST" class="login">
                            <div class="field">
                                <input type="text" 
                                name="email"
                                placeholder="Email" >
                            </div>
                    
                            <div class="field btn">
                                <div class="btn-layer"></div>
                                <input type="submit" value="Vérifier" name="verifier">
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </article>
    </main>

    <?php
    include 'layout/footer.php';
    ?>
</body>

</html>