<?php
// session_start();

use app\Controllers\MachineController;

$machine_id = "";

if (isset($_POST['machine_id'])) {
    $machine_id = $_POST['machine_id'];
    // }elseif(isset($_GET['machine_id'])) {
    //     $machine_id = $_GET['machine_id'];
} else {
    header('location:home');
}

// -----------------
$premier_date = "";
$deuxieme_date = "";
$quantity = "";
// -----------------



if (isset($_POST['add_to_card'])) {
}
$machines = new MachineController($_POST);

$machines = $machines->getMachineParId($machine_id);



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
        <?php //echo $machine_info;
        ?>
        <article class="card-machine">

            <!-- Alert  -->
            <ul class="notifications ">
                <div id="alert" class="alert-machine">
                    <li class="toast " id="class_alert">
                        <div class="column">
                            <i class="fa-solid" id="i"></i>
                            <span id="content_alert"></span>
                        </div>
                        <i class="fa-solid fa-xmark" onclick="removeToast(this.parentElement)"></i>
                    </li>
                </div>
            </ul>
            <!-- ----------- -->

            <div class="card-wrapper">
                <div class="card">
                    <!-- card left -->
                    <div class="product-imgs">
                        <div class="img-display">
                            <div class="img-showcase">
                                <img class="img" src="public/images/machine/<?= $machines->image1 ?>" alt="shoe image">
                                <img class="img" src="public/images/machine/<?= $machines->image2 ?>" alt="shoe image">
                                <img class="img" src="public/images/machine/<?= $machines->image3 ?>" alt="shoe image">
                            </div>
                        </div>
                        <div class="img-select">
                            <div class="img-item" style="width:33%;">
                                <a href="#" data-id="1">
                                    <img class="img" style="height: 200px;" src="public/images/machine/<?= $machines->image1 ?>" alt="shoe image">
                                </a>
                            </div>
                            <div class="img-item" style="width:33%;">
                                <a href="#" data-id="2">
                                    <img class="img" style="height: 200px;" src="public/images/machine/<?= $machines->image2 ?>" alt="shoe image">
                                </a>
                            </div>
                            <div class="img-item" style="width:33%;">
                                <a href="#" data-id="3">
                                    <img class="img" style="height: 200px;" src="public/images/machine/<?= $machines->image3 ?>" alt="shoe image">
                                </a>
                            </div>

                        </div>
                    </div>
                    <!-- card right -->
                    <div class="product-content">
                        <h2 class="product-title"><?= $machines->nom ?? "" ?></h2>
                        <form id='form_categories' action="<?php echo BASE_URL; ?>machine_list" method="post">
                            <input type="hidden" name="category_id" id="category_id">
                        </form>
                        <button onclick="getAllMachine(<?= $machines->id_category ?>)" class="product-link">return list machine</button>



                        <div class="product-detail">
                            <h2>about this machine: </h2>
                            <p>
                                <?= substr($machines->description, 0, 200) ?>
                            </p>

                        </div>

                        <div class="purchase-info">
                            <form action="<?php echo BASE_URL; ?>checkout" id="<?= $machine_id  ?>" method="POST">
                                <!-- hidden  -->
                                <input type="hidden" name="machine_id" value="<?= $machine_id  ?>">
                                <input type="hidden" name="nom" value="<?= $machines->nom ?>">
                                <input type="hidden" name="image" value="<?= $machines->image1 ?>">
                                <input type="hidden" name="prix_jour" id="prix_jour" value="<?= $machines->prix_jour ?>">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="date_fin" id="date_fin">
                                <input type="hidden" name="nbr_jours" id="nbr_jours">
                                <!-- -- nbr_jours---- -->

                                <label>Qte:</label>
                                <input type="number" name="quantity" id="quantity" min="0" max="<?= $machines->quantity ?>" value="<?= $quantity ? $quantity : "1" ?>">

                                <label>Start Date:</label>
                                <input type="date" name="premier_date" id="premier_date" value="<?php if (!empty($premier_date)) {
                                                                                                    echo $premier_date;
                                                                                                } else {
                                                                                                    echo date('Y-m-d');
                                                                                                } ?>">

                                <label>End Date:</label>
                                <input type="date" name="deuxieme_date" id="deuxieme_date" value="<?php if (!empty($deuxieme_date)) {
                                                                                                        echo $deuxieme_date;
                                                                                                    } else {
                                                                                                        echo date('Y-m-d');
                                                                                                    } ?>">
                            </form>

                            <div>

                                <button name="generate_prix" type="button" class="btn" id="generate_prix">
                                    Generate prix
                                </button>

                            </div>


                        </div>
                        <div class="product-price" id="result">

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
        //  const toast = document.querySelector(".toast"); // Creating a new 'li' element for the toast
        var alert = document.getElementById('alert');

        const generate_prix = document.getElementById('generate_prix');
        generate_prix.addEventListener("click", function() {
            var quantity = document.getElementById('quantity').value;
            var prix_jour = document.getElementById('prix_jour').value;
            var premier_date = document.getElementById('premier_date').value;
            var deuxieme_date = document.getElementById('deuxieme_date').value;

            var result = document.getElementById('result');

            var total = document.getElementById('total');
            var nbr_jours = document.getElementById('nbr_jours');

            var date_fin = document.getElementById('date_fin');


            var content_alert = document.getElementById('content_alert');
            var class_alert = document.getElementById('class_alert');
            var class_i = document.getElementById('i');
            const toast = document.querySelector(".toast"); // Creating a new 'li' element for the toast

            content_alert.innerHTML = "";
            alert.classList.add("alert-machine");
            class_alert.classList.remove("success", "error")
            class_i.classList.remove("fa-circle-check", "fa-circle-xmark")
            clearTimeout(timeoutId);

            result.innerHTML = "";
            total.value = "";
            if (quantity != '' && premier_date != '' && deuxieme_date != '' && prix_jour != "") {
                var ajax = new XMLHttpRequest();
                ajax.open("GET", "resources/views/users/ajax/action.php?action=generateprix&quantity=" + quantity + "&premier_date=" + premier_date + "&deuxieme_date=" + deuxieme_date + "&prix_jour=" + prix_jour, true);
                ajax.send();
                ajax.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // document.getElementById("result").innerHTML = this.responseText;
                        var data = JSON.parse(this.responseText);
                        if (data.danger) {
                            // -------------------------
                            content_alert.innerHTML = "Error: " + data.danger;
                            timeoutId();
                            class_alert.classList.add("error");
                            class_i.classList.add("fa-circle-xmark")
                            alert.classList.remove("alert-machine");
                            // -------------------------
                        } else {
                            if (data.success) {
                                // -------------------------
                                content_alert.innerHTML = "Bravo: " + data.success;
                                alert.classList.remove("alert-machine");
                                timeoutId();
                                class_alert.classList.add("success");
                                class_i.classList.add("fa-circle-check")
                                // -------------------------

                                var html = "";
                                html += '<h4>Nombre de jour : ' + data.nbrjours + ' , La quantiter est : ' + data.quantity + '</h4> <hr/> <br/>';
                                html += '<h4 class="last-price">Old Price: <span>' + data.oldPrice + ' Dh</span></h4>';
                                html += '<h4 class="new-price">New Price: <span>' + data.newPrice + 'Dh ( -' + data.pourcentages + '%)</span></h4>';
                                html += '<button onclick="addToCart(<?= $machine_id ?>)" type="button" name="add_to_card" id="btn_add" class="btn mt-20">Ajouter au panier <i class="fas fa-shopping-cart"></i></button>';
                                result.innerHTML += html;

                                total.value = data.newPrice;
                                nbr_jours.value = data.nbrjours;
                                date_fin.value = data.date_fin;
                            }
                        }
                    }
                }
            }
            return false;
        })
        function timeoutId() {
            setTimeout(() => {
                alert.classList.add("alert-machine");
            }, 5000)
        };

        function addToCart($id) {
            var form = document.getElementById($id);
            form.submit();
        }

        const removeToast = (toast) => {
            alert.classList.add("alert-machine") ;// Removing the toast after 500ms
        };

        const premier_date = document.getElementById('premier_date');
        const deuxieme_date = document.getElementById('deuxieme_date');

        // var today = new Date().toISOString().split('T')[0];
        const date = new Date();

        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();

        month = month.toString().length === 1 ? `0${month}` : month;
        let currentDate = `${year}-${month}-${day}`;
        premier_date.setAttribute('min', currentDate);
        deuxieme_date.setAttribute('min', currentDate);
    </script>
</body>

</html>
