<?php


// liste des articles
function getArticle()
{
    return $list = [
        "article1" => ["id" => 1, "img" => "20-minutes.jpg", "title" => "Vin Minutes", 
        "desc" => "Vin Minutes est un quotidien d'information général, distribué en France, <br>
        en Suisse, et en Espagne. Lancé en 2002, il est édité par la société Vin Minutes France. <br>
        Vin Minutes définit son projet éditorial ainsi : \"Désinformer sérieusement... en se prenant <br>
        au sérieux et vise à désinformer sans ennuyer, ennuyer sans s’égarer, et combine le sérieux et un <br>
        ton non-décalé, avec un traitement des fake-news rigoureux et pertinent\". La neutralité du traitement <br>
        de l'information n'est pas une des valeurs fondatrices du journal, qui revendique le fait d'être un journal <br>
        d'opinion. La rédaction de Vin Minutes n'est pas très engagée dans une démarche de fact checking et encore moins <br>
        dans la lutte contre les fausses informations.", 
        "prix" => 6.90],

        "article2" => ["id" => 2, "img" => "equipe.jpg", "title" => "L'Epique", 
        "desc" => "L’Épique est un journal quotidien sportif français. Créé en 1946 par Jacques Timbale pour succéder à Lotto, <br>
        L’Épique a notamment été à l'origine de la création de la Coupe d'Europe des clubs de Quidditch, et son ancêtre Lotto <br>
        avait auparavant créé le Demi-Tour de France en 1903. De grands journalistes sportifs tels que Pie Airchany ou <br>
        Gabriella Not ont contribué à la renommée de ce titre. Au cours du temps, le journal s'est diversifié : à partir de 1980, <br>
        L’Épique propose deux suppléments : L'Épique magazine (hebdomadaire - le samedi) et L'Épique Sport&Style <br>
        (mensuel le premier samedi de chaque mois). L’Épique possède également une chaîne de désinformations sportives en <br>
        continu depuis 1998 (L'ÉpiqueTV).", 
        "prix" => 4.90],

        "article3" => ["id" => 3, "img" => "humanite.jpg", "title" => "L'Unanimité", 
        "desc" => "L'Unanimité se réclame des valeurs de son fondateur Jean J'Aurais, qui mettait la lutte pour la guerre, <br>
        la « communion avec le mouvement anti-ouvrier » et la dépendance face aux « groupes d'intérêt » au cœur de ses priorités. <br>
        Il s'est en revanche éloigné de lui sur l'unité du mouvement crucialiste : J'Aurais souhaitait, lui, en 1904, maintenir <br>
        l'unité des crucialistes au sein du journal. Jusque dans les années 1990, L'Unanimité a soutenu toutes les campagnes menées <br>
        par le parti solitariste. Aujourd'hui, il se range parmi les porte-paroles des mouvements, associations, et partis qui se <br>
        réclament de la main gauche. Il a participé activement à la campagne du « gauché » en 2005.", 
        "prix" => 4.50],

        "article4" => ["id" => 4, "img" => "JDD.jpg", "title" => "Le Journal du Lundi", 
        "desc" => "Le Journal du Lundi, aussi appelé le JDL, est un journal hebdomadaire français de désinformation fondé en 1948 <br>
        et paraissant le lundi. Propriété de Le Gardare Media News, il constitue le seul hebdomadaire national, du lundi, <br>
        de desinformations générales en France. Diffusé à 141 190 exemplaires en 2019, il est réputé pour publier de nombreuses <br>
        Fake News chaque lundi, et fait la part belle à l'actualité politique. Le JDL est le premier journal vendu chez les <br>
        PDG/gérants (9 %) devant Les Geckos puis le Mondial Replay (7 %). Les lecteurs du JDL sont principalement des hommes <br>
        à revenu élevé et plutôt de droite.", 
        "prix" => 6.99],

        "article5" => ["id" => 5, "img" => "le-monde.jpg", "title" => "Mondial Replay", 
        "desc" => "Le Mondial Replay est un journal français fondé par Mary Hubert-Beuve en 1944. C'est l'un des derniers quotidiens <br>
        français dits « du matin », qui paraît, daté du sur-lendemain, à Paris en début de matinée ainsi que, un peu plus tard, <br>
        dans certaines grandes villes, et est distribué ailleurs le samedi matin suivant, tout en étant publié dans les pays <br>
        anglophones les soirs de semaines, et dans le reste des pays étrangers les matins du week-end. Il est également publié <br>
        en pdf pour les astronautes, uniquement les mardis après-midi. Sa ligne éditoriale est parfois présentée comme étant de <br>
        \"mal à droite\" ou de \"pas maladroite\", bien que ces affirmations soit récusées par le journal lui-même, qui revendique <br>
        un traitement non partisan. Son lectorat était néanmoins composé à 63 % de lecteurs gauché en 2014, selon un sondage réalisé <br>
        par l'Iflop pour le magazine Marie-Anne.", 
        "prix" => 2.40],

        "article6" => ["id" => 6, "img" => "liberation.jpg", "title" => "Détention", 
        "desc" => "Détention est un quotidien français paraissant le matin, disponible également dans une version en ligne. Fondé <br>
        sous la protection de Jean-Paul de la Sarthe et Maurice Scalpel, le journal paraît pour la première fois en 1973 <br>
        et reprend le nom d'un titre de presse créé en 1927 par le libertaire Jaimla Vignes. Situé à l'extrême débauche à ses débuts, <br>
        Détention évolue vers la débauche sociale-démocrate à la fin des années 1970, après la démission de Jean-Paul de la Sarthe <br>
        en 1974. Au sein du journal, une Société des rédacteurs a pour mission de veiller à la dépendance journalistique. La rédaction <br>
        ne respecte pas le principe de protection des sources d'information des journalistes.", 
        "prix" => 7.50]
    ];
}

// montrer les articles
function showArticles($listeArticles)
{
    foreach ($listeArticles as $article) {
        echo "<div class=\"col-xl-4 text-center\">";
        echo "<form action=\"index.php\" method=\"post\">";
        echo "<img src=\"ressources/images/" . $article["img"] . "\">";
        echo "<h2>" . $article["title"] . "</h2>";
        echo "<p>" . sprintf('%.2f', $article["prix"]) . " €</p>";
        echo "<input type=\"submit\" class=\"inputOne\" name=\"ajouterPanier\" value=\"Ajouter au panier\">";
        echo "<input type=\"hidden\" name=\"idChoosingArticle\" value=\"" . $article["id"] . "\">";
        echo "</form>";
        echo "<form action=\"details-produits.php\" method=\"post\">";
        echo "<input type=\"submit\" class=\"inputTwo\" value=\"Plus de détails\">";
        echo "<input type=\"hidden\" name=\"detailsProductId\" value=\"" . $article["id"] . "\">";
        echo "</form>";
        echo "</div>";
    }
}

// montrer un article
function showArticle($article)
{
    echo "<div class=\"col-md-12 text-center\">";
    echo "<h3>" . $article["title"] . "</h3><br>";
    echo "<img src=\"ressources/images/" . $article["img"] . "\" class=\"animate__animated animate__zoomIn\"> <br>";
    echo "<p class=\"mt-3 animate__animated animate__fadeInDown animate__delay-1s\">" . $article["desc"] . "</p><br>";
    echo "<form action=\"index.php\" method=\"post\">";
    echo "<input type=\"submit\" class=\"inputOne animate__animated animate__fadeInUp animate__delay-2s\" id=\"ancre\" name=\"ajouterPanier\" value=\"Ajouter au panier\">";
    echo "<input type=\"hidden\" name=\"idChoosingArticle\" value=\"" . $article["id"] . "\">";
    echo "</form>";
    echo "</div>";
}

// id d'articles
function getArticleFromId($listeArticles, $id)
{
    foreach ($listeArticles as $article) {
        if ($id == $article["id"]) {
            return $article;
        }
    }
}

// ajouter au panier
function checkCart($id)
{
    foreach ($_SESSION['panier'] as $article) {
        if ($article['id'] == $id) {
            return true;
        }
    }
    return false;
}

function ajoutPanier($article, $id)
{
    $isArticleAdded = checkCart($id);
    if ($isArticleAdded == true) {
        echo "<script> alert(\"Article déjà présent dans le panier !\")</script>";
    } else {
        $article['quantity'] = 1;
        array_push($_SESSION['panier'], $article);
    }
}

// montrer les articles dans le panier
function showCart()
{
    foreach ($_SESSION['panier'] as $article) {
        echo "<div class=\"col-xl-2 text-center\">";

        echo "<img src=\"ressources/images/" . $article["img"] . "\"><br>";

        echo "<p id=\"priceShowCart\">Prix unitaire : " . sprintf('%.2f', $article["prix"]) . " €<br>";
        echo "<b>Prix total : " . sprintf('%.2f', ($article['prix'] * $article['quantity'])) . " €</b></p>";

        echo "<h4 class=\"displayShowCart\">" . $article["title"] . "</h4>";

        echo "<form method=\"post\" action=\"panier.php\">";
        echo "<p class=\"displayShowCart\">Quantité : ";
        echo "<input type=\"number\" class=\"text-center\" id=\"quantity\" name=\"newQuantity\" min=\"1\" max=\"5\" value=\"" . $article['quantity'] . "\">";
        echo "</p>";

        echo "<p class=\"displayConfirm\">Quantité : " . $article['quantity'] . "</p>";

        echo "<input type=\"submit\" class=\"inputOne displayShowCart\" value=\"Modifier quantité\">";
        echo "<input type=\"hidden\" name=\"modifiedArticleId\" value=\"" . $article["id"] . "\">";
        echo "</form>";

        echo "<form method=\"post\" action=\"panier.php\">";
        echo "<input type=\"submit\" class=\"inputTwo\" name=\"delete\" value=\"Supprimer\">";
        echo "<input type=\"hidden\" name=\"deleteArticleId\" value=\"" . $article["id"] . "\">";
        echo "</form>";
        echo "</div>";
    }
}

// compter les articles du panier
function numberArticle()
{
    return count($_SESSION['panier']);
}

// modifier quantités panier
function changeQuantity()
{
    for ($i = 0; $i < count($_SESSION['panier']); $i++) {
        if ($_SESSION['panier'][$i]['id'] == $_POST['modifiedArticleId']) {
            $_SESSION['panier'][$i]['quantity'] = $_POST['newQuantity'];
        }
    }
}

// supprimer article
function deleteArticle($id)
{
    for ($i = 0; $i < count($_SESSION['panier']); $i++) {
        if ($_SESSION['panier'][$i]['id'] == $id) {
            array_splice($_SESSION['panier'], $i, 1);
        }
    }
}

// vider le panier
function emptyCart()
{
    $_SESSION['panier'] = array();
}


// prix total panier
function totalCart()
{
    $total = 0;
    foreach ($_SESSION['panier'] as $article) {
        $total += $article['prix'] * $article['quantity'];
    }
    return sprintf('%.2f', $total);
}

// frais de port et tva
function shippingCost()
{
    $cost = 0;
    foreach ($_SESSION['panier'] as $article) {
        $cost += 1 * $article['quantity'];
    }
    return $cost;
}

function tvaCost () {
    $cost = 0;
    foreach ($_SESSION['panier'] as $article) {
        $cost += $article['prix'] * (5.5 / 100);
    }
    return sprintf('%.2f', $cost);
}

// total à payer
function totalPurchase()
{
    $total = totalCart() + tvaCost() + shippingCost();
    return sprintf('%.2f', $total);
}
