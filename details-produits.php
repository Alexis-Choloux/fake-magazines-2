<?php session_start();

include('functions.php');

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

if (isset($_POST['detailsProductId'])) {
    $id = $_POST['detailsProductId'];
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <title>Details produits - Fake Magazines</title>

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

    <section>

        <div class="container-fluid text-center" id="content">

            <div class="row">
                <div class="col-md-12">
                    <h1>Détails produits</h1></br>
                </div>
            </div>

            <div class="row" id="detail">
                <?php
                showArticle(getArticleFromId($id));
                ?>
            </div>

            <?php
            include('footer.php')
            ?>


</body>

<!-- BOOTSTRAP -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</html>