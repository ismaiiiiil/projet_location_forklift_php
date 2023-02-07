<?php
session_start();

require_once '../../../vendor/autoload.php';

use app\Controllers\MachineController;


if(!isset($_POST['machine_id'])) {
    header('location:index.php');
}

$machines = new MachineController($_POST) ;

$machines = $machines->getMachineParId($_POST['machine_id']);

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
        <article class="card-machine">
            <div class="card-wrapper">
                <div class="card">
                    <!-- card left -->
                    <div class="product-imgs">
                        <div class="img-display">
                            <div class="img-showcase">
                                <img class="img" src="../../../public/images/<?= $machines->image1 ?>" alt="shoe image">
                                <img class="img" src="../../../public/images/<?= $machines->image2 ?>" alt="shoe image">
                                <img class="img" src="../../../public/images/<?= $machines->image3 ?>" alt="shoe image">
                            </div>
                        </div>
                        <div class="img-select">
                            <div class="img-item" style="width:33%;">
                                <a href="#" data-id="1">
                                    <img class="img" style="height: 200px;"
                                        src="../../../public/images/<?= $machines->image1 ?>" alt="shoe image">
                                </a>
                            </div>
                            <div class="img-item" style="width:33%;">
                                <a href="#" data-id="2">
                                    <img class="img" style="height: 200px;"
                                        src="../../../public/images/<?= $machines->image2 ?>" alt="shoe image">
                                </a>
                            </div>
                            <div class="img-item" style="width:33%;">
                                <a href="#" data-id="3">
                                    <img class="img" style="height: 200px;" 
                                        src="../../../public/images/<?= $machines->image3 ?>" alt="shoe image">
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    <!-- card right -->
                    <div class="product-content">
                        <h2 class="product-title"><?= $machines->nom ?></h2>
                        <form id='form_categories' action="machine_list.php" method="post">
                            <input type="hidden" name="category_id" id="category_id">
                        </form>
                        <button onclick="getAllMachine(<?= $machines->id_category ?>)" class="product-link">return list machine</button>

                        

                        <div class="product-detail">
                            <h2>about this machine: </h2>
                            <p>
                            <?= $machines->description ?>
                            </p>
                            
                        </div>

                        <form class="purchase-info">
                            <label>Qte:</label>
                            <input type="number" min="0" value="1">
                            <label>Start Date:</label>
                            <input type="date" name="premier_date">
                            <label>End Date:</label>
                            <input type="date" name="deuxieme_date">
                            <div class="button-card">
                                <button type="button" class="btn">
                                    Add to Cart <i class="fas fa-shopping-cart"></i>
                                </button>
                                <button type="button" class="btn">Generate prix</button>
                            </div>  
                            
                        </form>
                        <div class="product-price">
                            <p class="last-price">Old Price: <span>$257.00</span></p>
                            <p class="new-price">New Price: <span>$249.00 (5%)</span></p>
                        </div>

                    </div>
                </div>
            </div>


        </article>
    </main>

    <?php
    include 'layout/footer.php';
    ?>

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

function slideImage(){
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);
    </script>
</body>

</html>