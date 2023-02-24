<header class="header" data-header>
        <div class="container">
            <div class="overlay" data-overlay></div>

            <a href="<?php echo BASE_URL ?>home" class="logo">
                <img src="public/images/website/<?= $web->logo ?>?v=<?php echo time(); ?>" width="70" height="70" alt="Engiloc logo" />                
            </a>
            <!-- NavBar -->
            <nav class="navbar" data-navbar>
                <ul class="navbar-list">
                    <li>
                        <a href="<?php echo BASE_URL ?>home" class="navbar-link" data-nav-link>Home</a>
                    </li>

                    <li>
                        <a href="<?php echo BASE_URL ?>home" class="navbar-link" data-nav-link>Category</a>
                    </li>

                    <li>
                        <a href="<?php echo BASE_URL ?>home" class="navbar-link" data-nav-link>Service</a>
                    </li>

                    <li>
                        <a href="<?php echo BASE_URL ?>contact" class="navbar-link" data-nav-link>Contact</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL ?>cart" class="navbar-link" data-nav-link>Panier(<?= $_SESSION["count"] ?? 0 ?>) </a>
                    </li>
                </ul>
            </nav>

            <div class="header-actions">
                <div class="header-contact">
                    <a href="<?php echo BASE_URL ?>tel:0694332279" class="contact-link">+212 6 94 33 22 79</a>

                    <span class="contact-time">Mon - Sat: 8:00 am - 6:00 pm</span>
                </div>

                <a href="<?php echo BASE_URL ?>home" class="btn" aria-labelledby="aria-label-txt">
                    <ion-icon name="home-outline"></ion-icon>
                    <span id="aria-label-txt">Home</span>
                </a>
                <?php if(!isset($_SESSION['nom_user'])) { ?>
                <a href="<?php echo BASE_URL ?>login" class="btn user-btn" aria-label="Profile">
                    <ion-icon name="person-outline"></ion-icon>
                </a>
                <?php }else { ?>
                    <a href="<?php echo BASE_URL ?>profil-user" class="btn user-btn danger" aria-label="Profile">
                        <div style="display: flex;">
                            <ion-icon name="person-outline"></ion-icon>
                            <span id="aria-label-txt">Profile</span>
                        </div>
                    </a>
                <?php } ?>
                

                <button class="nav-toggle-btn" data-nav-toggle-btn aria-label="Toggle Menu">
                    <span class="one"></span>
                    <span class="two"></span>
                    <span class="three"></span>
                </button>
            </div>
        </div>
    </header>