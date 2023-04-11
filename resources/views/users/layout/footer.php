 <!--
    - #FOOTER
  -->
 <div class="div-loader">
     <span class="loader"></span>

 </div>
 <footer class="footer">
     <div class="container">
         <div class="footer-top">
             <div class="footer-brand">
                 <a href="#" class="logo">
                     <img src="public/images/website/<?= $web->logo ?>?v=<?php echo time(); ?>" width="70px" alt="Engiloc logo" />
                 </a>

                 <p class="footer-text">
                     Search for cheap rental cars in New York. With a diverse fleet of
                     19,000 vehicles, Waydex offers its consumers an attractive and fun
                     selection.
                 </p>
             </div>

             <ul class="footer-list">
                 <li>
                     <p class="footer-list-title">Company</p>
                 </li>

                 <li>
                     <a href="#" class="footer-link">About us</a>
                 </li>

                 <li>
                     <a href="#" class="footer-link">Pricing plans</a>
                 </li>

                 <li>
                     <a href="#" class="footer-link">Our blog</a>
                 </li>

                 <li>
                     <a href="#" class="footer-link">Contacts</a>
                 </li>
             </ul>

             <ul class="footer-list">
                 <li>
                     <p class="footer-list-title">Support</p>
                 </li>

                 <li>
                     <a href="#" class="footer-link">Help center</a>
                 </li>

                 <li>
                     <a href="#" class="footer-link">Ask a question</a>
                 </li>

                 <li>
                     <a href="#" class="footer-link">Privacy policy</a>
                 </li>

                 <li>
                     <a href="#" class="footer-link">Terms & conditions</a>
                 </li>
             </ul>

             <ul class="footer-list">
                 <li>
                     <p class="footer-list-title">Neighborhoods in New York</p>
                 </li>

                 <li>
                     <a href="#" class="footer-link">Manhattan</a>
                 </li>

                 <li>
                     <a href="#" class="footer-link">Central New York City</a>
                 </li>

                 <li>
                     <a href="#" class="footer-link">Upper East Side</a>
                 </li>

                 <li>
                     <a href="#" class="footer-link">Queens</a>
                 </li>

                 <li>
                     <a href="#" class="footer-link">Theater District</a>
                 </li>

                 <li>
                     <a href="#" class="footer-link">Midtown</a>
                 </li>

                 <li>
                     <a href="#" class="footer-link">SoHo</a>
                 </li>

                 <li>
                     <a href="#" class="footer-link">Chelsea</a>
                 </li>
             </ul>
         </div>

         <div class="footer-bottom">
             <ul class="social-list">
                <?php if( !!$web->facebook_link ): ?>
                 <li>
                     <a href="<?= $web->facebook_link ?>" class="social-link">
                         <ion-icon name="logo-facebook"></ion-icon>
                     </a>
                 </li>
                <?php endif; ?>

                <?php if( !!$web->instagram_link ): ?>
                 <li>
                     <a href="<?= $web->instagram_link ?>" class="social-link">
                         <ion-icon name="logo-instagram"></ion-icon>
                     </a>
                 </li>
                 <?php endif; ?>

                 <?php if( !!$web->facebook_link ): ?>
                 <li>
                     <a href="<?= $web->facebook_link ?>" class="social-link">
                         <ion-icon name="logo-twitter"></ion-icon>
                     </a>
                 </li>
                 <?php endif; ?>

                <!--
                 <li>
                     <a href="#" class="social-link">
                         <ion-icon name="logo-linkedin"></ion-icon>
                     </a>
                 </li> -->

                 <!-- <li>
                     <a href="#" class="social-link">
                         <ion-icon name="logo-skype"></ion-icon>
                     </a>
                 </li> -->
                 <?php if( !!$web->adresse1 ): ?>
                 <li>
                     <a href="mailto: <?= $web->adresse1 ?>" class="social-link">
                         <ion-icon name="mail-outline"></ion-icon>
                     </a>
                 </li>
                 <?php endif; ?>
             </ul>

             <p class="copyright">
                 &copy; 2022-<?php echo date("Y"); ?> <a href="#"><?= $web->nom_website ?></a>.
             </p>
         </div>
     </div>
 </footer>

 <!--
    - custom js link
  -->
 <script src="public/js/script.js"></script>

 <!--
    - ionicon link
  -->
 <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
 <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



 <script>
     function getAllMachine(id) {
         var form = document.getElementById('form_categories');
         var input = document.getElementById('category_id');
         input.value = id;
         form.submit();
     }

     function getMachineDetail(id) {
         var form = document.getElementById('form_machine');
         var input = document.getElementById('machine_id');
         input.value = id;
         form.submit();
     }
 </script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <!-- <script src="../public/js/jQuery/jquery-3.6.0.min.js"></script> -->
 <script>
     $(document).ready(function() {
         // Send Search Text to the server
         $("#search").keyup(function() {
             let searchText = $(this).val();
             if (searchText != "") {
                 $.ajax({
                     url: "resources/views/users/action/actionSearch.php",
                     method: "post",
                     data: {
                         query: searchText,
                     },
                     success: function(response) {
                         $("#show-list").css('display', 'block');
                         $("#show-list").html(response);
                     },
                 });
             } else {
                 $("#show-list").css('display', 'none');
                 $("#show-list").html("");
             }
         });
         // Set searched text in input field on click of search button
         $(document).on("click", "a", function() {
             $("#search").val($(this).text());
             $("#show-list").html("");
         });
     });


     function hideLink() {
         $("#show-list").css("display", "none");
     }
 </script>

 <script>
     function isEntreprise() {
         const select = document.getElementById('select_entreprise').value;
         const showEntreprise = document.getElementById('is_entreprise');

         if (select == "oui") {
             showEntreprise.style.display = "block";
         } else {
             showEntreprise.style.display = "none";
         }
     }


     // password hide
     // Hide and show password
     const eyeIcons = document.querySelectorAll(".show-hide");

     eyeIcons.forEach((eyeIcon) => {
         eyeIcon.addEventListener("click", () => {
             const pInput = eyeIcon.parentElement.querySelector("input"); //getting parent element of eye icon and selecting the password input
             if (pInput.type === "password") {
                 eyeIcon.classList.replace("bx-hide", "bx-show");
                 return (pInput.type = "text");
             }
             eyeIcon.classList.replace("bx-show", "bx-hide");
             pInput.type = "password";
         });
     });
 </script>
 <!--
- custom js link
-->

 <script>
     // -------- Image Machine -----------
     const imgs = document.querySelectorAll('.img-select a');
     const imgBtns = [...imgs];
     let imgId = 1;

     imgBtns.forEach((imgItem) => {
         imgItem.addEventListener('click', (event) => {
             event.preventDefault();
             imgId = imgItem.dataset.id;
             slideImage();
         });
     });

     function slideImage() {
         const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

         document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
     }

     window.addEventListener('resize', slideImage);
 </script>
 <!--
- ionicon link
-->
 <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
 <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
 <script src="public/js/scriptcart.js"></script>
 <script src="public/js/loader.js?v=<?php echo time(); ?>"></script>
 <script src="public/js/feedback.js?v=<?php echo time(); ?>"></script>

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script>
     $(document).ready(function() {
         var progressPath = document.querySelector('.t-progress-wrap path');
         var pathLength = progressPath.getTotalLength();

         progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
         progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
         progressPath.style.strokeDashoffset = pathLength;
         progressPath.getBoundingClientRect();
         progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';

         var updateProgress = function() {
             var scroll = $(window).scrollTop();
             var height = $(document).height() - $(window).height();
             var progress = pathLength - (scroll * pathLength / height);
             progressPath.style.strokeDashoffset = progress;
         }

         updateProgress();
         $(window).scroll(updateProgress);

         var offset = 50;
         var duration = 550;

         jQuery(window).on('scroll', function() {
             if (jQuery(this).scrollTop() > offset) {
                 jQuery('.t-progress-wrap').addClass('active-progress');
             } else {
                 jQuery('.t-progress-wrap').removeClass('active-progress');
             }
         });

         jQuery('.t-progress-wrap').on('click', function(event) {
             event.preventDefault();
             jQuery('html, body').animate({
                 scrollTop: 0
             }, duration);
             return false;
         })
     });
 </script>
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></script> -->
<?php if($web->tel1): ?>
 <div id="d-whatsapp">
     <a href="https:/wa.me/<?= $web->tel1 ?? "" ?>" target="_blank" id="toggle1" class="wtsapp">
         <!-- <i class="fa fa-whatsapp"></i> -->
         <i class="fa-brands fa-whatsapp"></i>
     </a>
 </div>
 <?php endif; ?>
 <div class="t-progress-wrap">
     <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
         <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
     </svg>
 </div>

