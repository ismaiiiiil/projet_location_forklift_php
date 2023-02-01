 <!-- 
    - #FOOTER
  -->

 <footer class="footer">
     <div class="container">
         <div class="footer-top">
             <div class="footer-brand">
                 <a href="#" class="logo">
                     <img src="../../../public/images/logo.svg" alt="Ridex logo" />
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
                 <li>
                     <a href="#" class="social-link">
                         <ion-icon name="logo-facebook"></ion-icon>
                     </a>
                 </li>

                 <li>
                     <a href="#" class="social-link">
                         <ion-icon name="logo-instagram"></ion-icon>
                     </a>
                 </li>

                 <li>
                     <a href="#" class="social-link">
                         <ion-icon name="logo-twitter"></ion-icon>
                     </a>
                 </li>

                 <li>
                     <a href="#" class="social-link">
                         <ion-icon name="logo-linkedin"></ion-icon>
                     </a>
                 </li>

                 <li>
                     <a href="#" class="social-link">
                         <ion-icon name="logo-skype"></ion-icon>
                     </a>
                 </li>

                 <li>
                     <a href="#" class="social-link">
                         <ion-icon name="mail-outline"></ion-icon>
                     </a>
                 </li>
             </ul>

             <p class="copyright">
                 &copy; 2022 <a href="#">codewithsadee</a>. All Rights Reserved
             </p>
         </div>
     </div>
 </footer>

 <!-- 
    - custom js link
  -->
 <script src="../../../public/js/script.js"></script>

 <!-- 
    - ionicon link
  -->
 <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
 <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



<script>
    const loginText = document.querySelector(".title-text .login");
    const wrapper = document.querySelector(".wrapper");
    const loginForm = document.querySelector("form.login");
    const loginBtn = document.querySelector("label.login");
    const signupBtn = document.querySelector("label.signup");
    const signupLink = document.querySelector("form .signup-link a");
    wrapper.style.height = "516px";

    signupBtn.onclick = (() => {
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
        wrapper.style.height = "max-content";
    });
    loginBtn.onclick = (() => {
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
        wrapper.style.height = "516px";
    });
    signupLink.onclick = (() => {
        signupBtn.click();
        return false;
    });

    



    function getAllMachine(id) {
        var form = document.getElementById('form_categories');
        var input = document.getElementById('category_id');
        input.value = id;
        form.submit();
    }
</script>