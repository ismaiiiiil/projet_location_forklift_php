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

            <!-- 
        - #HERO
        -->

            <section class="section hero" id="home">
                <div class="container">

                    <div class="hero-content">
                        <h2 class="h1 hero-title">The easy way to takeover a lease</h2>

                        <p class="hero-text">
                            Live in New York, New Jerset and Connecticut!
                        </p>
                    </div>

                    <div class="hero-banner"></div>
                    <!-- FORM SEARCH -->
                    <form action="" class="hero-form">

                        <div class="input-wrapper">
                            <label for="input-1" class="input-label">Car, model, or brand</label>

                            <input type="text" name="car-model" id="input-1" class="input-field" placeholder="What car are you looking?">
                        </div>

                        <div class="input-wrapper">
                            <label for="input-1" class="input-label">Car, model, or brand</label>

                            <input type="text" name="car-model" id="input-1" class="input-field" placeholder="What car are you looking?">
                        </div>

                        <div class="input-wrapper">
                            <label for="input-1" class="input-label">Car, model, or brand</label>

                            <input type="text" name="car-model" id="input-1" class="input-field" placeholder="What car are you looking?">
                        </div>
                        <div class="input-wrapper">
                            <label for="input-1" class="input-label">Car, model, or brand</label>

                            <input type="text" name="car-model" id="input-1" class="input-field" placeholder="What car are you looking?">
                        </div>

                        <div class="input-wrapper">
                            <label for="input-1" class="input-label">Car, model, or brand</label>

                            <input type="text" name="car-model" id="input-1" class="input-field" placeholder="What car are you looking?">
                        </div>

                        <div class="input-wrapper">
                            <label for="input-2" class="input-label">Max. monthly payment</label>

                            <input type="text" name="monthly-pay" id="input-2" class="input-field" placeholder="Add an amount in $">
                        </div>

                        <div class="input-wrapper">
                            <label for="input-3" class="input-label">Make Year</label>

                            <input type="text" name="year" id="input-3" class="input-field" placeholder="Add a minimal make year">
                        </div>

                        <button type="submit" class="btn">Search</button>

                    </form>

                </div>
            </section>

            <!-- 
        - #FEATURED CAR MACHINES
    -->

            <section class="section featured-car" id="featured-car">
                <div class="container">
                    <div class="title-wrapper">
                        <h2 class="h2 section-title">Featured cars</h2>

                        <a href="#" class="featured-car-link">
                            <span>View more</span>

                            <ion-icon name="arrow-forward-outline"></ion-icon>
                        </a>
                    </div>

                    <ul class="featured-car-list">
                        <li>
                            <div class="featured-car-card">
                                <figure class="card-banner">
                                    <img src="../../../public/images/car-1.jpg" alt="Toyota RAV4 2021" loading="lazy" width="440" height="300" class="w-100" />
                                </figure>

                                <div class="card-content">
                                    <div class="card-title-wrapper">
                                        <h3 class="h3 card-title">
                                            <a href="#">Toyota RAV4</a>
                                        </h3>

                                        <data class="year" value="2021">2021</data>
                                    </div>

                                    <ul class="card-list">
                                        <li class="card-list-item">
                                            <ion-icon name="people-outline"></ion-icon>

                                            <span class="card-item-text">4 People</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="flash-outline"></ion-icon>

                                            <span class="card-item-text">Hybrid</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="speedometer-outline"></ion-icon>

                                            <span class="card-item-text">6.1km / 1-litre</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="hardware-chip-outline"></ion-icon>

                                            <span class="card-item-text">Automatic</span>
                                        </li>
                                    </ul>

                                    <div class="card-price-wrapper">
                                        <p class="card-price"><strong>$440</strong> / month</p>

                                        <button class="btn fav-btn" aria-label="Add to favourite list">
                                            <ion-icon name="heart-outline"></ion-icon>
                                        </button>

                                        <button class="btn">Rent now</button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="featured-car-card">
                                <figure class="card-banner">
                                    <img src="../../../public/images/car-2.jpg" alt="BMW 3 Series 2019" loading="lazy" width="440" height="300" class="w-100" />
                                </figure>

                                <div class="card-content">
                                    <div class="card-title-wrapper">
                                        <h3 class="h3 card-title">
                                            <a href="#">BMW 3 Series</a>
                                        </h3>

                                        <data class="year" value="2019">2019</data>
                                    </div>

                                    <ul class="card-list">
                                        <li class="card-list-item">
                                            <ion-icon name="people-outline"></ion-icon>

                                            <span class="card-item-text">4 People</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="flash-outline"></ion-icon>

                                            <span class="card-item-text">Gasoline</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="speedometer-outline"></ion-icon>

                                            <span class="card-item-text">8.2km / 1-litre</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="hardware-chip-outline"></ion-icon>

                                            <span class="card-item-text">Automatic</span>
                                        </li>
                                    </ul>

                                    <div class="card-price-wrapper">
                                        <p class="card-price"><strong>$350</strong> / month</p>

                                        <button class="btn fav-btn" aria-label="Add to favourite list">
                                            <ion-icon name="heart-outline"></ion-icon>
                                        </button>

                                        <button class="btn">Rent now</button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="featured-car-card">
                                <figure class="card-banner">
                                    <img src="../../../public/images/car-3.jpg" alt="Volkswagen T-Cross 2020" loading="lazy" width="440" height="300" class="w-100" />
                                </figure>

                                <div class="card-content">
                                    <div class="card-title-wrapper">
                                        <h3 class="h3 card-title">
                                            <a href="#">Volkswagen T-Cross</a>
                                        </h3>

                                        <data class="year" value="2020">2020</data>
                                    </div>

                                    <ul class="card-list">
                                        <li class="card-list-item">
                                            <ion-icon name="people-outline"></ion-icon>

                                            <span class="card-item-text">4 People</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="flash-outline"></ion-icon>

                                            <span class="card-item-text">Gasoline</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="speedometer-outline"></ion-icon>

                                            <span class="card-item-text">5.3km / 1-litre</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="hardware-chip-outline"></ion-icon>

                                            <span class="card-item-text">Automatic</span>
                                        </li>
                                    </ul>

                                    <div class="card-price-wrapper">
                                        <p class="card-price"><strong>$400</strong> / month</p>

                                        <button class="btn fav-btn" aria-label="Add to favourite list">
                                            <ion-icon name="heart-outline"></ion-icon>
                                        </button>

                                        <button class="btn">Rent now</button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="featured-car-card">
                                <figure class="card-banner">
                                    <img src="../../../public/images/car-4.jpg" alt="Cadillac Escalade 2020" loading="lazy" width="440" height="300" class="w-100" />
                                </figure>

                                <div class="card-content">
                                    <div class="card-title-wrapper">
                                        <h3 class="h3 card-title">
                                            <a href="#">Cadillac Escalade</a>
                                        </h3>

                                        <data class="year" value="2020">2020</data>
                                    </div>

                                    <ul class="card-list">
                                        <li class="card-list-item">
                                            <ion-icon name="people-outline"></ion-icon>

                                            <span class="card-item-text">4 People</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="flash-outline"></ion-icon>

                                            <span class="card-item-text">Gasoline</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="speedometer-outline"></ion-icon>

                                            <span class="card-item-text">7.7km / 1-litre</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="hardware-chip-outline"></ion-icon>

                                            <span class="card-item-text">Automatic</span>
                                        </li>
                                    </ul>

                                    <div class="card-price-wrapper">
                                        <p class="card-price"><strong>$620</strong> / month</p>

                                        <button class="btn fav-btn" aria-label="Add to favourite list">
                                            <ion-icon name="heart-outline"></ion-icon>
                                        </button>

                                        <button class="btn">Rent now</button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="featured-car-card">
                                <figure class="card-banner">
                                    <img src="../../../public/images/car-5.jpg" alt="BMW 4 Series GTI 2021" loading="lazy" width="440" height="300" class="w-100" />
                                </figure>

                                <div class="card-content">
                                    <div class="card-title-wrapper">
                                        <h3 class="h3 card-title">
                                            <a href="#">BMW 4 Series GTI</a>
                                        </h3>

                                        <data class="year" value="2021">2021</data>
                                    </div>

                                    <ul class="card-list">
                                        <li class="card-list-item">
                                            <ion-icon name="people-outline"></ion-icon>

                                            <span class="card-item-text">4 People</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="flash-outline"></ion-icon>

                                            <span class="card-item-text">Gasoline</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="speedometer-outline"></ion-icon>

                                            <span class="card-item-text">7.6km / 1-litre</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="hardware-chip-outline"></ion-icon>

                                            <span class="card-item-text">Automatic</span>
                                        </li>
                                    </ul>

                                    <div class="card-price-wrapper">
                                        <p class="card-price"><strong>$530</strong> / month</p>

                                        <button class="btn fav-btn" aria-label="Add to favourite list">
                                            <ion-icon name="heart-outline"></ion-icon>
                                        </button>

                                        <button class="btn">Rent now</button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="featured-car-card">
                                <figure class="card-banner">
                                    <img src="../../../public/images/car-6.jpg" alt="BMW 4 Series 2019" loading="lazy" width="440" height="300" class="w-100" />
                                </figure>

                                <div class="card-content">
                                    <div class="card-title-wrapper">
                                        <h3 class="h3 card-title">
                                            <a href="#">BMW 4 Series</a>
                                        </h3>

                                        <data class="year" value="2019">2019</data>
                                    </div>

                                    <ul class="card-list">
                                        <li class="card-list-item">
                                            <ion-icon name="people-outline"></ion-icon>

                                            <span class="card-item-text">4 People</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="flash-outline"></ion-icon>

                                            <span class="card-item-text">Gasoline</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="speedometer-outline"></ion-icon>

                                            <span class="card-item-text">7.2km / 1-litre</span>
                                        </li>

                                        <li class="card-list-item">
                                            <ion-icon name="hardware-chip-outline"></ion-icon>

                                            <span class="card-item-text">Automatic</span>
                                        </li>
                                    </ul>

                                    <div class="card-price-wrapper">
                                        <p class="card-price"><strong>$490</strong> / month</p>

                                        <button class="btn fav-btn" aria-label="Add to favourite list">
                                            <ion-icon name="heart-outline"></ion-icon>
                                        </button>

                                        <button class="btn">Rent now</button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>

            <!-- 
        - #GET START
    -->

            <section class="section get-start">
                <div class="container">
                    <h2 class="h2 section-title">Get started with 4 simple steps</h2>

                    <ul class="get-start-list">
                        <li>
                            <div class="get-start-card">
                                <div class="card-icon icon-1">
                                    <ion-icon name="person-add-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Create a profile</h3>

                                <p class="card-text">
                                    If you are going to use a passage of Lorem Ipsum, you need
                                    to be sure.
                                </p>

                                <a href="#" class="card-link">Get started</a>
                            </div>
                        </li>

                        <li>
                            <div class="get-start-card">
                                <div class="card-icon icon-2">
                                    <ion-icon name="car-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Tell us what car you want</h3>

                                <p class="card-text">
                                    Various versions have evolved over the years, sometimes by
                                    accident, sometimes on purpose
                                </p>
                            </div>
                        </li>

                        <li>
                            <div class="get-start-card">
                                <div class="card-icon icon-3">
                                    <ion-icon name="person-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Match with seller</h3>

                                <p class="card-text">
                                    It to make a type specimen book. It has survived not only
                                    five centuries, but also the leap into electronic
                                </p>
                            </div>
                        </li>

                        <li>
                            <div class="get-start-card">
                                <div class="card-icon icon-4">
                                    <ion-icon name="card-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">Make a deal</h3>

                                <p class="card-text">
                                    There are many variations of passages of Lorem available,
                                    but the majority have suffered alteration
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>


        </article>
    </main>

    <?php
    include 'layout/footer.php';
    ?>
</body>

</html>