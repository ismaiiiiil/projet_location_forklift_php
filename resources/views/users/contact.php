<?php

use app\Controllers\WebSiteController;

$website = new WebSiteController($_POST);

$web = $website->getInfoWebSite();

if(isset($_POST['Send'])) {
    $website->contactEntreprise();
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
        <article>
        
            <section  class="contacts_form">
                        <!-- contact form -->
                        <div class="alert-message">
          <?php include('layout/alert.php'); ?>
        </div>
            <div class="container-contact">
                <div class="content-contact">
                    <div class="left-side">
                        
                        <div class="address details">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="topic">Address</div>
                            <div class="text-one"><?= $web->localisation ?></div>
                            <!-- <div class="text-two">Birendranagar 06</div> -->
                        </div>
                        <div class="phone details">
                            <i class="fas fa-phone-alt"></i>
                            <div class="topic">Phone</div>
                            <div class="text-one"><?= $web->tel1 ?></div>
                            <div class="text-two"><?= $web->tel1 ?></div>
                        </div>
                        <div class="email details">
                            <i class="fas fa-envelope"></i>
                            <div class="topic">Email</div>
                            <div class="text-one"><?= $web->adresse1 ?></div>
                            <div class="text-two"><?= $web->adresse2 ?></div>
                        </div>
                    </div>
                    <div class="right-side">
                        <div class="topic-text">OBTENIR UN DEVIS</div>
                        <p>Formulaire de contact</p>
                        <form method="POST">
                            <div class="input-box">
                                <input type="text" name="nom" placeholder="Entrez votre nom">
                            </div>

                            <div class="input-box">
                                <input type="text" name="email" placeholder="Entrez votre email">
                            </div>

                            <div class="input-box">
                                <input type="text" name="numero" placeholder="Entrez votre numéro">
                            </div>

                            <div class="input-box">
                                <textarea name="message" placeholder="Entez votre message" rows="5" cols="5"></textarea>
                            </div>
                            
                            <div class="button">
                                <input type="submit" class="btn-contact" name="Send" value="Envoyer maintenant">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </section>
    
            <section class="container-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d158857.7281066703!2d-0.24168144921176335!3d51.5287718408761!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C%20UK!5e0!3m2!1sen!2sin!4v1569921526194!5m2!1sen!2sin" 
                    width="100%" height="600px" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </section>
            
            <!-- //contact form -->


        </article>
    </main>

    <?php
    include 'layout/footer.php';
    ?>
    
</body>

</html>