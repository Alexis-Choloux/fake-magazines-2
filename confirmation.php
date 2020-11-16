<?php session_start();

include('functions.php');

if (isset($_POST['emptyCart'])) {
    emptyCart();
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <title>Confirmation achat - Fake Magazines</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width-device, initial-scale=1.0, maximum-scale=1.0">

    <!-- STYLES -->
    <!-- css -->
    <link rel="stylesheet" href="ressources/css/general.css">
    <link rel="stylesheet" href="ressources/css/panier.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- fonts family -->
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all" rel="stylesheet">
    <link href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all" rel="stylesheet">
    <link href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all" rel="stylesheet">
    <!-- animation -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>



<body>
    <!-- NAVBAR -->
    <?php
    include('header.php')
    ?>

    <section id="confirm">

        <!-- bouton retour -->
        <div class="row">
            <div class="col-md-1">
                <a href="./panier.php" id="returnBtn">
                    <button type="button" class="orderBtn animate__animated animate__fadeInLeft animate__delay-1s">
                        < Retour vers le panier </button> </a> </div> </div> 
                        
                        <!-- contenu -->
                            <div class="container-fluid text-center" id="content">

                                <div class="row">
                                    <div class="col-md-12">
                                        <h1>Récapitulatif de commande</h1></br>
                                    </div>
                                </div>

                                <div class="row animate__animated animate__backInDown">
                                    <div class="col-md-12 d-flex flex-column align-items-center" id="confirm">
                                        <?php
                                        showCart();
                                        ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">

                                        <p class="total">Total des achats :
                                            <?php echo totalCart() . " €" ?>
                                        </p>

                                        <p><i>TVA (5,5%) :
                                                <?php echo tvaCost() . " €</i>" ?>
                                        </p>

                                        <p><i>Frais de port :
                                                <?php echo shippingCost() . " €</i>" ?>
                                        </p>

                                        <p class="total"><b>TOTAL A PAYER :
                                                <?php echo totalPurchase() . " €</b>" ?>
                                        </p>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#staticBackdrop" id="confirmBtn">
                                            Confirmer
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                        <h5 class="modal-title" id="staticBackdropLabel">Commande validée !</h5>

                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <?php echo
                                                            "<p>Votre commande, d'un montant de <b>" . totalPurchase() . " €</b>, a bien été prise en compte.</p>
                                    <p>Date de réception estimée : <b>" . date('d-m-Y', strtotime(date('d-m-Y') . ' + 3 days')) . "</b></p>
                                    <p>Merci pour votre confiance !</p>";
                                                        ?>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <form method="post" action="index.php">
                                                            <input type="hidden" name="emptyCart" value="true">
                                                            <input type="submit" class="btn-warning" value="Retourner à l'accueil" id="return">
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
    </section>

    <?php
    include('footer.php')
    ?>

</body>

<!-- BOOTSTRAP -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</html>