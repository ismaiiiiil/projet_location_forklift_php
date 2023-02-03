<?php
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
            <div class="container-contact">
                <div class="content-contact">
                    <div class="left-side">
                        
                        <div class="address details">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="topic">Address</div>
                            <div class="text-one">Surkhet, NP12</div>
                            <div class="text-two">Birendranagar 06</div>
                        </div>
                        <div class="phone details">
                            <i class="fas fa-phone-alt"></i>
                            <div class="topic">Phone</div>
                            <div class="text-one">+212 6 94 33 22 79</div>
                            <div class="text-two">+212 6 94 33 22 79</div>
                        </div>
                        <div class="email details">
                            <i class="fas fa-envelope"></i>
                            <div class="topic">Email</div>
                            <div class="text-one">rharrafismail@gmail.com</div>
                            <div class="text-two">rharrafismail@gmail.com</div>
                        </div>
                    </div>
                    <div class="right-side">
                        <div class="topic-text">Send us a message</div>
                        <p>If you have any work from me or any types of quries related to my tutorial, you can send me message from here. It's my pleasure to help you.</p>
                        <form action="#">
                            <div class="input-box">
                                <input type="text" placeholder="Enter your name">
                            </div>
                            <div class="input-box">
                                <input type="text" placeholder="Enter your email">
                            </div>

                            <div class="input-box">
                                <textarea placeholder="Enter your email" rows="5" cols="5"></textarea>
                            </div>
                            <!-- <div class="input-box message-box">

                            </div> -->
                            <div class="button">
                                <input type="button" value="Send Now">
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