<?php session_start();

include('functions.php');

// déconnexion
if (isset($_POST['disconnect'])) {
    session_unset();
  }
  
if (isset($_POST['signIn'])) {
    connectUser();
}

if (isset($_POST['createAccount'])) {
    checkMailPassword();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <title>Catégories - Fake Magazines</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width-device, initial-scale=1.0, maximum-scale=1.0">

    <!-- STYLES -->
    <!-- css -->
    <link rel="stylesheet" href="ressources/css/general.css">
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

    <main>

        <div class="container">

            <div class="row mt-3">
                <div class="col-md-12 text-center">
                    <i class="fas fa-sign-in-alt fa-6x"></i>
                    <h2>Connexion</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 offset-3" id="logInForm">
                    <form action="index.php" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Identifiant</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">Votre email sert d'identifiant</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mot de passe</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="text-center">
                            <button type="submit" name="signIn" class="btn btn-warning mt-3">Connexion</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Pas encore inscrit ?</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center mb-5">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#staticBackdrop">
                        Créer mon compte
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Inscription</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>


                                <div class="modal-body">
                                    <form action="connexion.php" method="post">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail">Email</label>
                                                <input type="email" name="email" class="form-control" id="inputEmail" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="inputPassword">Mot de passe</label>
                                                <input type="password" name="password" class="form-control" id="inputPassword" required>
                                                <small id="passwordHelp" class="form-text text-muted">Au moins : 8 caractères / 1 majuscule, 1 minuscule, 1 chiffre</small>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName">Prénom</label>
                                                <input type="text" name="firstName" class="form-control" id="inputFirstName" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="inputLastName">Nom</label>
                                                <input type="text" name="lastName" class="form-control" id="inputLastName" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputAdresse">Adresse</label>
                                            <input type="text" name="address" class="form-control" id="inputAdresse" required>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-9">
                                                <label for="inputCity">Ville</label>
                                                <input type="text" name="city" class="form-control" id="inputCity" required>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="inputZip">Code postal</label>
                                                <input type="text" name="zip" class="form-control" id="inputZip" required>
                                            </div>
                                        </div>

                                        <input type="submit" class="btn btn-warning" name="createAccount" value="Créer mon compte">
                                    </form>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <?php
    include('footer.php')
    ?>

</body>



<!-- BOOTSTRAP -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</html>