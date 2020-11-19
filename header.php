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

                <li class="nav-item">
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

                <?php
                if (isset($_SESSION['id'])) {
                    echo "<li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"./mon-profil.php\">| Mon compte
                    </a>
                    </li>
                    
                    <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"./mes-commandes.php\">Mes commandes
                    </a>
                    </li>";                        
                    }
                ?>

            </ul>

            <?php
            if (isset($_SESSION['id'])) {
                echo "<form action=\"index.php\" method=\"post\">
                <p>Connecté en tant que <b>" . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . 
                "</b><input type=\"submit\" name=\"disconnect\" value=\"Déconnexion\" class=\"btn btn-warning ml-2\">
                </form>";
            } 
            else {
                echo "<a href=\"connexion.php\">
                <button type=\"button\" class=\"btn btn-warning\">
                Connexion / Inscription
            </button></a>";
            }
            ?>

        </div>
    </nav>
</header>