<?php
include 'layout/header.php';
?>

<body>
    <!-- 
    - #HEADER
-->

    <?php
    include 'layout/navbar.php';
    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
    ?>


    <!--
        - main container
    -->

    <main class="container-cart">
        <ul class="notifications" >
            <?php include('layout/alert.php'); ?>
        </ul>
        <h1 class="heading">
            <ion-icon name="cart-outline"></ion-icon> Shopping Cart
        </h1>

        <div class="item-flex">

            <!--
   - checkout section
  -->
            <section class="checkout">

                <h2 class="section-heading">Payment Details</h2>

                <div class="payment-form">

                    <div class="payment-method">

                        <button class="method selected button-cart">
                            <ion-icon name="card"></ion-icon>

                            <span>Credit Card</span>

                            <ion-icon class="checkmark fill" name="checkmark-circle"></ion-icon>
                        </button>

                        <button class="method button-cart">
                            <ion-icon name="logo-paypal"></ion-icon>

                            <span>PayPal</span>

                            <ion-icon class="checkmark" name="checkmark-circle-outline"></ion-icon>
                        </button>

                    </div>

                    <form action="#">

                        <div class="cardholder-name">
                            <label for="cardholder-name" class="label-default">Cardholder name</label>
                            <input type="text" name="cardholder-name" id="cardholder-name" class="input-default">
                        </div>

                        <div class="card-number">
                            <label for="card-number" class="label-default">Card number</label>
                            <input type="number" name="card-number" id="card-number" class="input-default">
                        </div>

                        <div class="input-flex">

                            <div class="expire-date">
                                <label for="expire-date" class="label-default">Expiration date</label>

                                <div class="input-flex">

                                    <input type="number" name="day" id="expire-date" placeholder="31" min="1" max="31" class="input-default">
                                    /
                                    <input type="number" name="month" id="expire-date" placeholder="12" min="1" max="12" class="input-default">

                                </div>
                            </div>

                            <div class="cvv">
                                <label for="cvv" class="label-default">CVV</label>
                                <input type="number" name="cvv" id="cvv" class="input-default">
                            </div>

                        </div>

                    </form>

                </div>

                <?php if(isset($_SESSION['commander']) && $_SESSION['commander'] === 1 && isset($_SESSION["email_user"]) ) { ?>
                    <a href="<?php echo BASE_URL ?>admin/pdfinvoice" class="btn-cart btn-warning button-cart a">
                    <i class="fa-solid fa-download"></i> Pour télécharger Votre facture cliquer içi .
                    </a>
                <?php } ?>
                <!-- paypal -->
                <?php if(isset($_SESSION["count"]) && $_SESSION["count"] > 0   && isset($_SESSION["email_user"]) )  : ?>
                    <div id="paypal-button-container"></div>
                <?php elseif(isset($_SESSION["count"]) && $_SESSION["count"] > 0 ): //ila makanch m connecter ?>
                    <a href="<?php echo BASE_URL ?>login" class="btn-cart btn-primary button-cart a">Connectez vous pour terminer vos achats</a>
                <?php endif; ?>

            </section>


            <!--
                - cart section
            -->
            <section class="cart">

                <div class="cart-item-box">

                    <h2 class="section-heading">Order Summery</h2>

                <?php foreach($_SESSION as $name => $machine) : ?>
                    <?php if(substr($name,0,9) == "machines_") : ?>
                    <div class="product-card">

                        <div class="card">

                            <div class="img-box">
                                <img src="public/images/machine/<?php echo $machine["image"] ?>" alt="Green tomatoes" width="80px" class="product-img">
                            </div>

                            <div class="detail">

                                <h4 class="product-name"><?php echo $machine["nom_machine"] ?></h4>

                                <div class="wrapper-cart">

                                    <div class="product-qty">
                                            <button onclick="decrementCart(<?php echo $machine['id'];?>)" name="decrement" class="button-cart" id="decrement">
                                                <ion-icon name="remove-outline"></ion-icon>
                                            </button>

                                            <span id="quantity"><?php echo $machine["qte"] ?></span>

                                            <button onclick="incrementCart(<?php echo $machine['id'];?>)" name="increment" class="button-cart" id="increment">
                                                <ion-icon name="add-outline"></ion-icon>
                                            </button>
                                    </div>
                                    <form action="<?php echo BASE_URL;?>decrementcart" id="form_dec<?php echo $machine["id"];?>" method="POST">
                                        <input type="hidden" name="machine_id" value="<?php echo $machine["id"];?>">
                                        <input type="hidden" name="machine_price" value="<?php echo $machine["prix"];?>">
                                        <input type="hidden" name="machine_total" value="<?php echo $machine["total"];?>">
                                        <input type="hidden" name="machine_qte" value="<?php echo $machine["qte"];?>">
                                    </form>
                                    <form action="<?php echo BASE_URL;?>incrementcart" id="form_inc<?php echo $machine["id"];?>" method="POST">
                                        <input type="hidden" name="machine_id" value="<?php echo $machine["id"];?>">
                                        <input type="hidden" name="machine_price" value="<?php echo $machine["prix"];?>">
                                        <input type="hidden" name="machine_total" value="<?php echo $machine["total"];?>">
                                        <input type="hidden" name="machine_qte" value="<?php echo $machine["qte"];?>">
                                    </form>
                                    

                                    <div class="price">
                                        <span id="price"><?php echo $machine["total"] ?></span> Dh
                                    </div>
                                    <div class="price">
                                        <span id="price"> Nombre de jour: <b><?php echo $machine["nbr_jours"] ?></b></span> jrs
                                    </div>
                                    

                                </div>

                            </div>

                            
                            <form method="POST" action="<?php echo BASE_URL;?>cancelcart">
                                <input type="hidden" name="machine_id" value="<?php echo $machine["id"];?>">
                                <input type="hidden" name="machine_price" value="<?php echo $machine["prix"];?>">
                                <input type="hidden" name="machine_total" value="<?php echo $machine["total"];?>">
                                <input type="hidden" name="machine_qte" value="<?php echo $machine["qte"];?>">
                                <button type="submit" class="product-close-btn button-cart">
                                    <ion-icon name="close-outline"></ion-icon>
                                </button>
                            </form>

                        </div>

                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                

                </div>

                <div class="wrapper-cart">

                    <div class="amount">

                        <div class="subtotal">
                            <span>Nombre machine</span> <span><span id="subtotal"><?= $_SESSION["count"] ?? "0" ?></span></span>
                        </div>

                        <div class="tax">
                            <span>Tax</span> <span>$ <span id="tax">0.10</span></span>
                        </div>

                        <div class="shipping">
                            <span>Shipping</span> <span>$ <span id="shipping">0.00</span></span>
                        </div>

                        <div class="total" id="amount" data-amount="<?php echo  isset($_SESSION["totaux"]) ? $_SESSION["totaux"] : 0;?>">
                            <span>Total Prix :</span> <span><span id="total"><?= $_SESSION["totaux"] ?? "0" ?></span> Dh</span>
                        </div>

                        <?php if(isset($_SESSION["count"]) && $_SESSION["count"] > 0 ) : ?>
                            <form method="POST" action="<?php echo BASE_URL;?>emptycart">
                                <button class="btn btn-danger button-cart">
                                    <b>Vider le panier</b>
                                </button>
                            </form>
                            <!-- form de commend -->
                            <form method="POST" id="addOrder" action="<?php echo BASE_URL;?>addOrder"></form>

                        <?php endif; ?>

                    </div>

                </div>

            </section>

        </div>

    </main>


    <?php
    include 'layout/footer.php';
    ?>

    <script>
        let amount = document.querySelector("#amount").dataset.amount; // data-amount="amount"
        let finalAmount = Math.floor(amount/ 10.25); // convert to Dollar
        paypal.Buttons({
            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: finalAmount.toString() // convert to string
                        }
                    }]
                });
            },
            // fach lpayment daz
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert('Commande effectuée par ' + details.payer.name.given_name); // name 
                    document.querySelector("#addOrder").submit();
                });
            }
        }).render('#paypal-button-container');
    </script>

    <script>
        function decrementCart(id) {
            var form_dec = document.getElementById("form_dec"+ id);
            form_dec.submit();
        }
        function incrementCart(id) {
            var form_inc = document.getElementById('form_inc'+ id);
            form_inc.submit();
        }
    </script>

</body>

</html>