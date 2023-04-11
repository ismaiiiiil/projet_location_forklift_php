<?php
// session_start();
if(isset($_SESSION['login'])) {
    header('Location: index');
}


use app\Controllers\UserController;

$user = new UserController($_POST);
$nom = '';$prenom = '';$email = '';$tel = '';$is_entreprise = '';$nom_entreprise = '';$email_entreprise = '';$password = '';$cpassword = '';
    
    if(isset($_POST['Signup'])) {
        if(isset($_POST['nom'])) $nom = $_POST['nom'];
        if(isset($_POST['prenom'])) $prenom = $_POST['prenom'];
        if(isset($_POST['email'])) $email = $_POST['email'];
        if(isset($_POST['tel'])) $tel = $_POST['tel'];
        if(isset($_POST['is_entreprise'])) $is_entreprise = $_POST['is_entreprise'];
        if(isset($_POST['nom_entreprise'])) $nom_entreprise = $_POST['nom_entreprise'];
        if(isset($_POST['email_entreprise'])) $email_entreprise = $_POST['email_entreprise'];
        if(isset($_POST['password'])) $password = $_POST['password'];
        if(isset($_POST['cpassword'])) $cpassword = $_POST['cpassword'];

        $user->signup();
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
            <ul class="notifications" >
                <?php include('layout/alert.php'); ?>
            </ul>
            <div class="wrapper">
                <div class="title-text">
                    <div class="title signup">
                        Signup Form
                    </div>
                </div>
                <div class="form-container">
                    
                    <div class="form-inner">
                        <!-- Signup -->
                        <form method="POST" class="signup">
                            <div class="field">
                                <input type="text" name="nom" placeholder="Nom"
                                value="<?= $nom ?>"
                                autocomplete="username">
                            </div>
                            <div class="my-2">
                                <p class=" text-danger">
                                    <?php echo $errors['nom'] ?? '';  ?>
                                </p>
                            </div>

                            <div class="field">
                                <input type="text" name="prenom" placeholder="Prenom" 
                                value="<?= $prenom ?>"
                                autocomplete="username">
                            </div>
                            <div class="my-2">
                                <p class=" text-danger">
                                    <?php echo $errors['prenom'] ?? '';  ?>
                                </p>
                            </div>

                            <div class="field">
                                <input type="text" name="email" placeholder="Email Address"
                                value="<?= $email ?>"
                                autocomplete="username">
                            </div>
                            <div class="my-2">
                                <p class=" text-danger">
                                    <?php echo $errors['email'] ?? '';  ?>
                                </p>
                            </div>

                            <div class="field">
                                <input type="text" name="tel"
                                value="<?= $tel ?>"
                                placeholder="Numero Telephone" >
                            </div>
                            <div class="my-2">
                                <p class=" text-danger">
                                    <?php echo $errors['tel'] ?? '';  ?>
                                </p>
                            </div>
                            
                            <div class="field">
                                <select name="is_entreprise" id='select_entreprise' onchange="isEntreprise()">
                                    <option selected value="">Entreprise ou Non</option>
                                    <option 
                                    <?= $is_entreprise === "oui" ? "selected" : "" ?>
                                    value="oui">Oui</option>
                                    <option value="nom">Non</option>
                                </select>
                            </div>
                            <div class="my-2">
                                <p class=" text-danger">
                                    <?php echo $errors['is_entreprise'] ?? '';  ?>
                                </p>
                            </div>

                            <span id="is_entreprise" style="display: <?= $is_entreprise === "oui" ? "block" : "none" ?>;">
                                <div class="field">
                                    <input type="text" name="nom_entreprise" placeholder="Nom Entreprise"  autocomplete="username" >
                                </div>
                                <div class="my-2">
                                    <p class=" text-danger">
                                        <?php echo $errors['nom_entreprise'] ?? '';  ?>
                                    </p>
                                </div>

                                <div class="field">
                                    <input type="text"
                                    value="<?= $email_entreprise?>"
                                    name="email_entreprise" placeholder="Email Entreprise"   autocomplete="username">
                                </div>
                                <div class="my-2">
                                    <p class=" text-danger">
                                        <?php echo $errors['email_entreprise'] ?? '';  ?>
                                    </p>
                                </div>
                            </span>
                            
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
                                <input type="submit" name="Signup" value="Signup">
                            </div>
                            <div class="signup-link">
                                have account? <a href="<?php echo BASE_URL ?>login">login now</a>
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