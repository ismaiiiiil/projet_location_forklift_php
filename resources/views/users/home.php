<?php

use app\Controllers\CategoryController;
use app\Controllers\FeedbackController;

$category = new CategoryController($_POST);


if (isset($_POST['searchCategory']) && !empty(['searchCategory'])) {
  $category->getAllCategoriesByName($_POST['searchCategory']);
} else {
  $category->getAllCategories();
}

$feedback = new FeedbackController($_POST);

$description ="";
if (isset($_POST["add-feedback"])) {
  $description = isset($_POST["description"]) ? $_POST["description"] : "";
  $feedback->addFeedback();
}

$feedbackList = $feedback->getAllFeedbackActive();

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

      <!-- 
        - #HERO FIlter 
    -->

      <section class="section hero" id="home">
        <div class="container">
          <div class="hero-content">
            <h2 class="h1 hero-title">Engiloc Entreprise De Location Forklift </h2>

            <p class="hero-text">
              Vivre au Maroc!
            </p>
          </div>

          <div class="hero-banner"></div>

          <form method="POST">
            <div class="input-box">
              <i class="uil uil-search"></i>
              <input autocomplete="off" name="searchCategory" id="search" type="text" placeholder="Search here..." />
              <button class="button">Search</button>
            </div>
          </form>
          <div class="search-box" id="show-list">
            <!-- Here autocomplete list will be display -->
          </div>
        </div>
      </section>

      <!-- 
        - #FEATURED CAR MACHINES
      -->
      <ul class="notifications">
        <?php include('layout/alert.php'); ?>
      </ul>

      <section class="section featured-car" id="featured-car">

        <div class="container">

          <div class="title-wrapper">
            <h2 class="h2 section-title">Featured cars</h2>

            <a href="#" class="featured-car-link">
              <span>View more</span>

              <ion-icon name="arrow-forward-outline"></ion-icon>
            </a>
          </div>

          <form id='form_categories' action="<?php echo BASE_URL; ?>machine_list" method="post">
            <input type="hidden" name="category_id" id="category_id">
          </form>

          <ul class="featured-car-list">
            <?php for ($i = 0; $i < count($category->t); $i++) { ?>
              <li onclick="getAllMachine(<?= $category->t[$i]->getId() ?>)" class="car-category">
                <div class="featured-car-card">

                  <figure class="card-banner">
                    <img src="public/images/category/<?= $category->t[$i]->getImage() ?>" alt="Toyota RAV4 2021" loading="lazy" width="440" height="300" class="w-img-100 image-card">
                  </figure>

                  <div class="card-content">

                    <div class="card-title-wrapper">
                      <h3 class="h3 card-title">
                        <a href="#"><?= $category->t[$i]->getNom() ?></a>
                      </h3>
                    </div>
                  </div>
                </div>
              </li>
            <?php } ?>
          </ul>

        </div>
      </section>





      <!-- 
        - #GET START
      -->

      <!-- <section class="section get-start">

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
                  If you are going to use a passage of Lorem Ipsum, you need to be sure.
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
                  Various versions have evolved over the years, sometimes by accident, sometimes on purpose
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
                  It to make a type specimen book. It has survived not only five centuries, but also the leap into
                  electronic
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
                  There are many variations of passages of Lorem available, but the majority have suffered alteration
                </p>

              </div>
            </li>

          </ul>

        </div>
      </section> -->

      <?php if (isset($_SESSION['id_user'])) : ?>
        <section class="section ">
          <div class="container">

            <div class="wrapper-feedback">
              <h3>Écrivez vos commentaires.</h3>
              <form id="feedback_form" method="POST">
                <div class="rating">
                  <input name="rating" type="hidden" id="rating">
                  <i class='bx bx-star star' style="--i: 0;"></i>
                  <i class='bx bx-star star' style="--i: 1;"></i>
                  <i class='bx bx-star star' style="--i: 2;"></i>
                  <i class='bx bx-star star' style="--i: 3;"></i>
                  <i class='bx bx-star star' style="--i: 4;"></i>
                </div>
                <textarea name="description" id="description" cols="100" rows="5" placeholder="Écrivez vos commentaires..."><?php echo $description ?? '' ?></textarea>
                <div class="btn-group">
                  <button type="submit" name="add-feedback" class="btn submit">Submit</button>
                  <button class="btn cancel">Cancel</button>
                </div>
              </form>
            </div>

          </div>
        </section>
      <?php endif; ?>

      <section class="section">
        <!-- Start Testimonials -->
        <div class="testimonials" id="testimonials">
          <h2 class="main-title"> Feedback Client </h2>
          <div class="container">
          
            <?php foreach($feedbackList as $feedback): ?>
              <div class="box">
                <img src="public/images/users/<?= $feedback->user_photo ?>" alt="" />
                <h3><?= $feedback->nom ." " . $feedback->prenom ?></h3>
                <span class="title"><?php echo date('d F Y', strtotime($feedback->date_feedback)) ?></span>
                <div class="rate">
                  <?php for($i=0; $i < $feedback->rating; $i++ ): ?>
                    <i class="filled fas fa-star"></i>
                  <?php endfor; ?>
                </div>
                <p>
                  <?= $feedback->description ?>
                </p>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <!-- End Testimonials -->
      </section>

      <!-- 
        - #BLOG
      -->

      <section class="section blog" id="blog">
        <div class="container">

          <h2 class="h2 section-title">Our Blog</h2>

          <ul class="blog-list has-scrollbar">

            <li>
              <div class="blog-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="public/images/users/user_default.jpg" alt="" />
                  </a>

                  <a href="#" class="btn card-badge">Company</a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">Opening of new offices of the company</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2022-01-14">January 14, 2022</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="114">114</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="blog-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="public/images/website/blog-2.jpg" alt="What cars are most vulnerable" loading="lazy" class="w-img-100">
                  </a>

                  <a href="#" class="btn card-badge">Repair</a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">What cars are most vulnerable</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2022-01-14">January 14, 2022</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="114">114</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="blog-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="public/images/website/blog-3.jpg" alt="Statistics showed which average age" loading="lazy" class="w-img-100">
                  </a>

                  <a href="#" class="btn card-badge">Cars</a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">Statistics showed which average age</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2022-01-14">January 14, 2022</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="114">114</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="blog-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="public/images/website/blog-4.jpg" alt="What´s required when renting a car?" loading="lazy" class="w-img-100">
                  </a>

                  <a href="#" class="btn card-badge">Cars</a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">What´s required when renting a car?</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2022-01-14">January 14, 2022</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="114">114</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="blog-card">

                <figure class="card-banner">

                  <a href="#">
                    <img src="public/images/website/blog-5.jpg" alt="New rules for handling our cars" loading="lazy" class="w-img-100">
                  </a>

                  <a href="#" class="btn card-badge">Company</a>

                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">
                    <a href="#">New rules for handling our cars</a>
                  </h3>

                  <div class="card-meta">

                    <div class="publish-date">
                      <ion-icon name="time-outline"></ion-icon>

                      <time datetime="2022-01-14">January 14, 2022</time>
                    </div>

                    <div class="comments">
                      <ion-icon name="chatbubble-ellipses-outline"></ion-icon>

                      <data value="114">114</data>
                    </div>

                  </div>

                </div>

              </div>
            </li>

          </ul>

        </div>
      </section>

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->
  <?php
  include 'layout/footer.php';
  ?>

</body>

</html>