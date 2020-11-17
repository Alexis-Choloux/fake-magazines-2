<header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand animate__animated animate__flipInX" href="./index.php">
            <h1>Fake Magazines</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="./index.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./categories.php">Catégories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./panier.php">Panier
                        <?php echo "(" . numberArticle() . ")" ?>
                    </a>
                </li>

                <li class="nav-item text-left">
  
                </li>
            </ul>

            <a href="connexion.php"><button type="button" class="btn btn-warning">
                Connexion / Inscription
            </button></a>
        </div>
    </nav>
</header>