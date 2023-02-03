<?php
require_once '../../../vendor/autoload.php';



use app\Controllers\UserController;

$user = new UserController($_POST);

if(isset($_POST['Signup'])) {
    var_dump($_POST);
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
                                <input type="text" placeholder="Email Address" >
                            </div>
                            <div class="field">
                                <input type="password" placeholder="Password" >
                            </div>
                    
                            <div class="field btn">
                                <div class="btn-layer"></div>
                                <input type="submit" value="Login">
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