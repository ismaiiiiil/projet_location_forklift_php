<?php
session_start();
// 
if(isset($_SESSION['login'])) {
    header('Location: index.php');
}


require_once '../../../vendor/autoload.php';



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
        <?php include('layout/alert.php'); ?>

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
                                <input type="text" name="login" placeholder="Email ou name" >
                            </div>
                            <div class="field">
                                <input type="password" name="password" placeholder="Password" >
                            </div>
                    
                            <div class="field btn">
                                <div class="btn-layer"></div>
                                <input type="submit" value="Login" name="Login">
                            </div>
                            <div class="signup-link">
                                Not a member? <a href="signup.php">Signup now</a>
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