<?php session_start();

include('functions.php');

// déconnexion
if (isset($_POST['disconnect'])) {
    session_unset();
  }
  
if (isset($_POST['modifiedAccount'])) {
    modifiedUser();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <title>Mon Profil - Fake Magazines</title>

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
            <div class="row">
                <div class="col-md-4 offset-4 mt-5">

                    <h2 class="text-center mb-3">Mes informations personnelles</h2>

                    <?php echo "
                <p>Prénom : " . $_SESSION['firstName'] . "</p>
                <p>Nom : " . $_SESSION['lastName'] . "</p>
                <p>Email : " . $_SESSION['email'] . "</p>";
                    ?>

                </div>
            </div>

            <div class="row">
                <div class="col-md-4 offset-4 mt-4 text-center">

                    <h2 class="mb-3">Mon adresse de lirvaison/facturation</h2>

                    <?php echo "
                <p>" . $_SESSION['address'] . "</p>
                <p>" . $_SESSION['zip'] . "</p>
                <p>" . $_SESSION['city'] . "</p>";
                    ?>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center mt-3 mb-5">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#staticBackdrop">
                        Modifier mes informations
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Modifier mes informations</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>


                                <div class="modal-body">
                                    <form action="mon-profil.php" method="post">

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail">Email</label>
                                                <input type="email" name="email" class="form-control" id="inputEmail" <?php echo "value=\"" . $_SESSION['email'] . "\"" ?> required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputFirstName">Prénom</label>
                                                <input type="text" name="firstName" class="form-control" id="inputFirstName" <?php echo "value=\"" . $_SESSION['firstName'] . "\"" ?> required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="inputLastName">Nom</label>
                                                <input type="text" name="lastName" class="form-control" id="inputLastName" <?php echo "value=\"" . $_SESSION['lastName'] . "\"" ?> required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputAdresse">Adresse</label>
                                            <input type="text" name="address" class="form-control" id="inputAdresse" <?php echo "value=\"" . $_SESSION['address'] . "\"" ?> required>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-9">
                                                <label for="inputCity">Ville</label>
                                                <input type="text" name="city" class="form-control" id="inputCity" <?php echo "value=\"" . $_SESSION['city'] . "\"" ?> required>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="inputZip">Code postal</label>
                                                <input type="text" name="zip" class="form-control" id="inputZip" <?php echo "value=\"" . $_SESSION['zip'] . "\"" ?> required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12 mt-5">
                                                <label for="exampleInputPassword1">Tapez votre mot de passe</label>
                                                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                            </div>
                                        </div>

                                        <input type="submit" class="btn btn-warning" name="modifiedAccount" value="Modifier">
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