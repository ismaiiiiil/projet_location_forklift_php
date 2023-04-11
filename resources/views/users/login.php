<?php

if(isset($_SESSION['login'])) {
    header('Location: home');
}

use app\Controllers\UserController;

$user = new UserController($_POST);

if(isset($_POST['Login'])) {

    $user->login();
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
                        Login Form
                    </div>
                </div>
                <div class="form-container">
                    
                    <div class="form-inner">
                        <form action="#" method="POST" class="login">
                            <div class="field">
                                <input type="email" 
                                name="email"
                                autocomplete="email"
                                placeholder="Email " >
                            </div>
                            <div class="field field-password">
                                <input type="password"
                                name="password" autocomplete="new-password" placeholder="Password" >
                                <i class="bx bx-hide show-hide"></i>
                            </div>
                            <div class="pass-link">
                                <a href="<?php echo BASE_URL ?>forgot-password">Mot de passe oublié?</a>
                            </div>
                            <div class="field btn">
                                <div class="btn-layer"></div>
                                <input type="submit" value="Login" name="Login">
                            </div>
                            <div class="signup-link">
                                Not a member? <a href="<?php echo BASE_URL ?>signup">Signup now</a>
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