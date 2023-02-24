<?php
// session_start();

use app\Controllers\BaseController;

// if(isset($_SESSION['login'])) {
//     BaseController::redirect('index');
// }

use app\Controllers\UserController;

$user = new UserController($_POST);
$password = '';$cpassword = '';
    
    if(isset($_POST['Modifier'])) {
        if(isset($_POST['password'])) $password = $_POST['password'];
        if(isset($_POST['cpassword'])) $cpassword = $_POST['cpassword'];

        $user->newPassword();
        $errors = $user->errors;
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
                    <div class="title signup">
                        Modifier mot de passe
                    </div>
                </div>
                <div class="form-container">
                    
                    <div class="form-inner">
                        <!-- Signup -->
                        <form method="POST" class="signup">
                            
                            <div class="field field-password">
                                <input type="password"
                                value="<?= $password?>"
                                name="password" autocomplete="new-password" placeholder="Password" >
                                <i class="bx bx-hide show-hide"></i>
                            </div>
                            <div class="my-2">
                                <p class=" text-danger">
                                    <?php echo $errors['password'] ?? '';  ?>
                                </p>
                            </div>

                            <div class="field field-password">
                                <input type="password" 
                                value="<?= $cpassword?>"
                                name="cpassword" autocomplete="new-password" placeholder="Confirm password" >
                                <i class="bx bx-hide show-hide"></i>
                            </div>
                            <div class="my-2">
                                <p class=" text-danger">
                                    <?php echo $errors['cpassword'] ?? '';  ?>
                                </p>
                            </div>

                            <div class="field btn">
                                <div class="btn-layer"></div>
                                <input type="submit" name="Modifier" value="Modifier">
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