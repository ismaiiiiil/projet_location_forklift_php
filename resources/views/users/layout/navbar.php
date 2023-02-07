<header class="header" data-header>
        <div class="container">
            <div class="overlay" data-overlay></div>

            <a href="#" class="logo">
                <img src="../../../public/images/logoSite.png" width="50" alt="Engiloc logo" />                
            </a>
            <!-- NavBar -->
            <nav class="navbar" data-navbar>
                <ul class="navbar-list">
                    <li>
                        <a href="index.php" class="navbar-link" data-nav-link>Home</a>
                    </li>

                    <li>
                        <a href="#featured-car" class="navbar-link" data-nav-link>Category</a>
                    </li>

                    <li>
                        <a href="#" class="navbar-link" data-nav-link>Service</a>
                    </li>

                    <li>
                        <a href="contact.php" class="navbar-link" data-nav-link>Contact</a>
                    </li>
                </ul>
            </nav>

            <div class="header-actions">
                <div class="header-contact">
                    <a href="tel:0694332279" class="contact-link">+212 6 94 33 22 79</a>

                    <span class="contact-time">Mon - Sat: 8:00 am - 6:00 pm</span>
                </div>

                <a href="index.php" class="btn" aria-labelledby="aria-label-txt">
                    <ion-icon name="home-outline"></ion-icon>
                    <span id="aria-label-txt">Home</span>
                </a>
                <?php if(!isset($_SESSION['login'])) { ?>
                <a href="login.php" class="btn user-btn" aria-label="Profile">
                    <ion-icon name="person-outline"></ion-icon>
                </a>
                <?php }else { ?>
                    <a href="logout.php" class="btn user-btn danger" aria-label="Profile">
                        <ion-icon name="log-in-outline"></ion-icon>
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