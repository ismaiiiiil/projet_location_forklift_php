<?php

if(isset($_SESSION['login'])) {
    header('Location: home');
}

use app\Controllers\UserController;

$user = new UserController($_POST);

if(isset($_POST['Verifier'])) {

    $user->verifyEmail();
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
        <ul class="notifications" >
            <?php include('layout/alert.php'); ?>
        </ul>

            <div class="wrapper">
                <div class="title-text">
                    <div class="title login">
                        Code Vérification 
                    </div>
                </div>
                <div class="form-container">
                    
                    <div class="form-inner">
                        <form action="#" method="POST" class="login">
                            <div class="field">
                                <input type="number" 
                                name="code"
                                autocomplete="username"
                                placeholder="Code de vérification" >
                            </div>

                            <div class="field btn">
                                <div class="btn-layer"></div>
                                <input type="submit" value="Vérifier" name="Verifier">
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