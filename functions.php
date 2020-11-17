<?php

// connection to DB
function getConnection()
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=boutique-en-ligne;charset=utf8', 'alexis', 'GRTY247mys/*/', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    return $db;
}


// get articles
function getArticles()
{
    $db = getConnection();
    $query = $db->query('SELECT * FROM articles');
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// liste des articles
function showArticles($articles)
{
    foreach ($articles as $article) {
            echo "<div class=\"col-xl-4 text-center\">";
            echo "<form action=\"index.php\" method=\"post\">";
            echo "<img src=\"ressources/images/" . $article["image"] . "\">";
            echo "<h2>" . $article["nom"] . "</h2>";
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
    echo "<h3>" . $article["nom"] . "</h3><br>";
    echo "<img src=\"ressources/images/" . $article["image"] . "\" class=\"animate__animated animate__zoomIn\"> <br>";
    echo "<p class=\"mt-3 animate__animated animate__fadeInDown animate__delay-1s\">" . $article["description_detaillee"] . "</p><br>";
    echo "<form action=\"index.php\" method=\"post\">";
    echo "<input type=\"submit\" class=\"inputOne animate__animated animate__fadeInUp animate__delay-2s\" id=\"ancre\" name=\"ajouterPanier\" value=\"Ajouter au panier\">";
    echo "<input type=\"hidden\" name=\"idChoosingArticle\" value=\"" . $article["id"] . "\">";
    echo "</form>";
    echo "</div>";
}

// id d'articles
function getArticleFromId($id)
{
    $db = getConnection();
    $query = $db->query('SELECT * FROM articles');

    foreach ($query as $article) {
        if ($id == $article['id']) {
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

        echo "<img src=\"ressources/images/" . $article["image"] . "\"><br>";

        echo "<p id=\"priceShowCart\">Prix unitaire : " . sprintf('%.2f', $article["prix"]) . " €<br>";
        echo "<b>Prix total : " . sprintf('%.2f', ($article['prix'] * $article['quantity'])) . " €</b></p>";

        echo "<h4 class=\"displayShowCart\">" . $article["nom"] . "</h4>";

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
