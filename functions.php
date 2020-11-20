<?php

// GENERAL ====================================================================================
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


// TOOLS ====================================================================================
// article from id
function getArticleFromId($id)
{
    $db = getConnection();
    $query = $db->prepare('SELECT * FROM articles WHERE id = ?');
    $query->execute(array($id));
    return $query->fetch();
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


// INDEX ==================================================================================
// liste des articles
function showArticles($articles)
{
    foreach ($articles as $article) {
        echo "<div class=\"col-xl-4 text-center\">
        <form action=\"index.php\" method=\"post\">
        <img src=\"ressources/images/" . $article["image"] . "\">";

        echo showStock($article);

        echo "</div>";
    }
}

// montrer les stocks
function showStock($article)
{
    $articleId = $article['id'];

    $db = getConnection();
    $query = $db->prepare("SELECT stock FROM articles WHERE id = ?");
    $query->execute(array($articleId));
    $dbQuantity = $query->fetch();
    $dbQuantity = $dbQuantity[0];

    if ($dbQuantity > 5) {
        echo "<button type=\"button\" class=\"btn btn-success stockBtn mb-2\">
        En stock 
        <span class=\"badge badge-light animate__animated animate__tada animate__infinite\">" . $dbQuantity . "</span></button>";
        echo "<h2>" . $article["nom"] . "</h2>";
        echo "<p>" . sprintf('%.2f', $article["prix"]) . " €</p>";
        echo "<input type=\"submit\" class=\"inputOne\" name=\"ajouterPanier\" value=\"Ajouter au panier\">";
        echo "<input type=\"hidden\" name=\"idChoosingArticle\" value=\"" . $article["id"] . "\">";
        echo "</form>";
        echo "<form action=\"details-produits.php\" method=\"post\">";
        echo "<input type=\"submit\" class=\"inputTwo\" value=\"Plus de détails\">";
        echo "<input type=\"hidden\" name=\"detailsProductId\" value=\"" . $article["id"] . "\">";
        echo "</form>";
    } elseif ($dbQuantity == 0) {
        echo "<button type=\"button\" class=\"btn btn-danger stockBtn mb-2\">
        Rupture de stock 
        <span class=\"badge badge-light\">0</span></button>";
        echo "<h2>" . $article["nom"] . "</h2>";
        echo "</form>";
    } else {
        echo "<button type=\"button\" class=\"btn btn-warning stockBtn mb-2\">
        Presque épuisé 
        <span class=\"badge badge-light animate__animated animate__heartBeat animate__infinite\">" . $dbQuantity . "</span></button>";
        echo "<h2>" . $article["nom"] . "</h2>";
        echo "<p>" . sprintf('%.2f', $article["prix"]) . " €</p>";
        echo "<input type=\"submit\" class=\"inputOne\" name=\"ajouterPanier\" value=\"Ajouter au panier\">";
        echo "<input type=\"hidden\" name=\"idChoosingArticle\" value=\"" . $article["id"] . "\">";
        echo "</form>";
        echo "<form action=\"details-produits.php\" method=\"post\">";
        echo "<input type=\"submit\" class=\"inputTwo\" value=\"Plus de détails\">";
        echo "<input type=\"hidden\" name=\"detailsProductId\" value=\"" . $article["id"] . "\">";
        echo "</form>";
    }
}


// DETAILS PRODUITS ============================================================================
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


// CATEGORIES ================================================================================
function getRanges()
{
    $db = getConnection();
    $query = $db->query('SELECT * FROM gammes');
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function articleByRanges($id)
{
    $db = getConnection();
    $query = $db->prepare('SELECT * FROM articles WHERE id_gammes = ?');
    $query->execute(array($id));
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function showRanges()
{

    foreach (getRanges() as $gamme) {
        echo "<div class\"row\">
                <div class=\"col-md-12 text-center mt-5\">
                    <h1 class=\"animate__animated animate__fadeInUp animate__delay-1s\"><b>" . $gamme['nom'] . "</b></h1>
                </div>
            </div>
            
            <div class=\"row mt-3  animate__animated animate__fadeInRight\" id=\"rangesContent\">";

        foreach (articleByRanges($gamme['id']) as $article) {
            echo "<div class=\"col-md-4 text-center mt-3\">
                    <form action=\"categories.php\" method=\"post\">

                    <img src=\"ressources/images/" . $article["image"] . "\"> <br>

                    <h3 class=\"mt-2\">" . $article["nom"] . "</h3>

                    <p>" . sprintf('%.2f', $article["prix"]) . " €</p>

                    <input type=\"submit\" class=\"inputOne\" name=\"ajouterPanier\" value=\"Ajouter au panier\">
                    <input type=\"hidden\" name=\"idChoosingArticle\" value=\"" . $article["id"] . "\">
                    </form>

                    <form action=\"details-produits.php\" method=\"post\">
                    <input type=\"submit\" class=\"inputTwo\" value=\"Plus de détails\">
                    <input type=\"hidden\" name=\"detailsProductId\" value=\"" . $article["id"] . "\">
                    </form>

                </div>";
        }
        echo "</div>";
    }
}



// PANIER =====================================================================================
// montrer les articles dans le panier
function showCart()
{
    foreach ($_SESSION['panier'] as $article) {
        echo "<div class=\"col-xl-2 text-center\">";

        echo "<img src=\"ressources/images/" . $article["image"] . "\"><br>";

        echo "<p id=\"priceShowCart\">Prix unitaire : " . sprintf('%.2f', $article["prix"]) . " €<br>";
        echo "<b>Prix total : " . sprintf('%.2f', ($article['prix'] * $article['quantity'])) . " €</b></p>";

        echo "<h4 class=\"displayShowCart\">" . $article["nom"] . "</h4>";

        echo checkStock($article);

        echo "<form method=\"post\" action=\"panier.php\">";
        echo "<input type=\"submit\" class=\"inputTwo\" name=\"delete\" value=\"Supprimer\">";
        echo "<input type=\"hidden\" name=\"deleteArticleId\" value=\"" . $article["id"] . "\">";
        echo "</form>";
        echo "</div>";
    }
}

// contrôle des stocks
function checkStock($article)
{
    $orderQuantity = $article['quantity'];
    $articleId = $article['id'];

    $db = getConnection();
    $query = $db->prepare("SELECT stock FROM articles WHERE id = ?");
    $query->execute(array($articleId));
    $dbQuantity = $query->fetch();
    $dbQuantity = $dbQuantity[0];

    if ($orderQuantity <= $dbQuantity) {
        echo "<form method=\"post\" action=\"panier.php\">";
        echo "<p class=\"displayShowCart\">Quantité : ";
        echo "<input type=\"number\" class=\"text-center\" id=\"quantity\" name=\"newQuantity\" min=\"1\" max=\"5\" value=\"" . $article['quantity'] . "\">";
        echo "<small id=\"emailHelp\" class=\"form-text text-muted\">Produit en stock</small>";
        echo "</p>";
        echo "<p class=\"displayConfirm\">Quantité : " . $article['quantity'] . "</p>";

        echo "<input type=\"submit\" class=\"inputOne displayShowCart\" value=\"Modifier quantité\">";
        echo "<input type=\"hidden\" name=\"modifiedArticleId\" value=\"" . $article["id"] . "\">";
        echo "</form>";
    } elseif ($dbQuantity <= 0) {
        echo "<p>Ce produit est actuellement en rupture de stock</p>";
    } else {
        echo "<form method=\"post\" action=\"panier.php\">";
        echo "<p class=\"displayShowCart\">Quantité : ";
        echo "<input type=\"number\" class=\"text-center\" id=\"quantity\" name=\"newQuantity\" min=\"1\" max=\"" . $dbQuantity . "\" value=\"" . $article['quantity'] . "\">";
        echo "</p>";
        echo "<p class=\"displayConfirm\">Quantité : " . $article['quantity'] . "</p>";
        echo "<small id=\"emailHelp\" class=\"form-text text-muted\">
        Il ne reste plus que <b>" . $dbQuantity . "</b> articles en stock !</small>";

        echo "<input type=\"submit\" class=\"inputOne displayShowCart\" value=\"Modifier quantité\">";
        echo "<input type=\"hidden\" name=\"modifiedArticleId\" value=\"" . $article["id"] . "\">";
        echo "</form>";
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


// CONFIRMATION =======================================================================================
// frais de port et tva
function shippingCost()
{
    $cost = 0;
    foreach ($_SESSION['panier'] as $article) {
        $cost += 1 * $article['quantity'];
    }
    return $cost;
}

function tvaCost()
{
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

// compter cmds déjà passées
function countOrders()
{
    $db = getConnection();
    $sql = ('SELECT COUNT(*) FROM commandes');
    $res = $db->query($sql);
    $count = $res->fetchColumn();
    return str_pad($count, 3, '0', STR_PAD_LEFT);
}

//  récupération cmd vers db
function createOrder()
{

    $day = date('d');
    $month = date('m');
    $count = countOrders();
    $total = totalPurchase();

    $db = getConnection();
    $sql = "INSERT INTO `commandes` (`id_client`, `numero`, `date_commande`, `prix`) 
     VALUES (:id_client, :numero, :date_commande, :prix)";
    $res = $db->prepare($sql);
    $exec = $res->execute(array(
        "id_client" => strip_tags($_SESSION['id']),
        "numero" => $day . $month . $count,
        "date_commande" => date('d-m-Y'),
        "prix" => $total
    ));

    if ($exec) {
        $query = $db->query('SELECT LAST_INSERT_ID() FROM clients');
        $lastId = $query->fetch();
        $lastId = $lastId[0];

        foreach ($_SESSION['panier'] as $article) {
            $sql = "INSERT INTO `commande_articles` (`id_commande`, `id_article`, `quantite`) 
            VALUES (:id_commande, :id_article, :quantite)";
            $res = $db->prepare($sql);
            $exec = $res->execute(array(
                "id_commande" => $lastId,
                "id_article" => $article['id'],
                "quantite" => $article['quantity']
            ));

            updateStock($article['quantity'], $article['id']);
        }
    } else {
        echo "Il y a eu une erreur lors de la saisie de votre commande. Veuillez réessayer.";
    }
}

// mise à jour des stocks
function updateStock($orderQuantity, $articleId)
{
    $db = getConnection();
    $query = $db->prepare("SELECT stock FROM articles WHERE id = ?");
    $query->execute(array($articleId));
    $result = $query->fetch();
    $dbQuantity = $result[0];

    $newQuantity = $dbQuantity - $orderQuantity;

    $query = $db->prepare("UPDATE articles SET stock = :newQuantity WHERE id = :articleId");
    $query->execute(array(
        "newQuantity" => $newQuantity,
        "articleId" => $articleId
    ));
}


// SIGN IN / SIGN UP ================================================================
// nouvel utilisateur / sign up
function createUser()
{

    $hashedPassword = password_hash(strip_tags($_POST['password']), PASSWORD_DEFAULT);

    $db = getConnection();
    $sql = "INSERT INTO `clients` (`nom`, `prenom`, `email`, `mot_de_passe`) VALUES (:nom, :prenom, :email, :mot_de_passe)";
    $res = $db->prepare($sql);
    $exec = $res->execute(array(
        "nom" => strip_tags($_POST['lastName']),
        "prenom" => strip_tags($_POST['firstName']),
        "email" => strip_tags($_POST['email']),
        "mot_de_passe" => $hashedPassword
    ));

    if ($exec) {
        echo "<script> alert(\"Compte créé avec succès !\")</script>";

        $query = $db->query('SELECT LAST_INSERT_ID() FROM clients');
        $lastId = $query->fetch();
        $lastId = $lastId[0];

        $sql = "INSERT INTO `adresses` (`id_client`, `adresse`, `code_postal`, `ville`) VALUES (:id_client, :adresse, :code_postal, :ville)";
        $res = $db->prepare($sql);
        $exec = $res->execute(array(
            "id_client" => $lastId,
            "adresse" => strip_tags($_POST['address']),
            "code_postal" => strip_tags($_POST['zip']),
            "ville" => strip_tags($_POST['city'])
        ));
    } else {
        echo "<script> alert(\"Echec lors de la création du compte !\")</script>";
    }
}

// vérifier si email et mot de passe déjà existant
function checkMailPassword()
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);

    $db = getConnection();
    $check = $db->prepare("SELECT * FROM clients WHERE email=?");
    $check->execute([$email]);
    $user = $check->fetch();

    if ($user) {

        echo "<script> alert(\"Erreur : Email déjà renseigné pour un autre compte !\")</script>";
    } elseif (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
        echo "<script> alert(\"Erreur : Le mot de passe doit contenir au moins 8 caractères, des majuscules, des minuscules, et des chiffres !\")</script>";
    } else {
        createUser();
    }
}

// connexion
function connectUser()
{
    $db = getConnection();
    $query = $db->prepare('SELECT * FROM clients WHERE email = ?');
    $query->execute([$_POST['email']]);
    $user = $query->fetch(PDO::FETCH_ASSOC);


    if ($user && password_verify($_POST['password'], $user['mot_de_passe'])) {
        echo "<script> alert(\"Vous êtes maintenant connecté !\")</script>";

        $_SESSION['id'] = $user['id'];
        $_SESSION['lastName'] = $user['nom'];
        $_SESSION['firstName'] = $user['prenom'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['password'] = $user['mot_de_passe'];

        $query = $db->prepare('SELECT * FROM adresses WHERE id_client = ?');
        $query->execute([$user['id']]);
        $address = $query->fetch(PDO::FETCH_ASSOC);

        $_SESSION['address'] = $address['adresse'];
        $_SESSION['zip'] = $address['code_postal'];
        $_SESSION['city'] = $address['ville'];

    } else {
        echo "<script> alert(\"Identifiant ou mot de passe incorrect !\")</script>";
    }
}


// MON PROFIL ==========================================================================
// modifier compte
function modifiedUser()
{

    $hashedPassword = password_hash(strip_tags($_POST['password']), PASSWORD_DEFAULT);

    $db = getConnection();
    $query = $db->prepare('SELECT * FROM clients');
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($_POST['password'], $user['mot_de_passe'])) {

        $sql = "UPDATE clients SET 
        nom = :nom, 
        prenom = :prenom, 
        email = :email, 
        mot_de_passe = :mot_de_passe
        ";
        $res = $db->prepare($sql);

        $lastName = strip_tags($_POST['lastName']);
        $firstName = strip_tags($_POST['firstName']);
        $email = strip_tags($_POST['email']);

        $res->bindParam(':nom', $lastName, PDO::PARAM_STR);
        $res->bindParam(':prenom', $firstName, PDO::PARAM_STR);
        $res->bindParam(':email', $email, PDO::PARAM_STR);
        $res->bindParam(':mot_de_passe', $hashedPassword, PDO::PARAM_STR);
        $res->execute();

        if ($res) {
            echo "<script> alert(\"Informations personnelles mises à jour !\")</script>";

            // maj des infos
            $_SESSION['lastName'] = $lastName;
            $_SESSION['firstName'] = $firstName;
            $_SESSION['email'] = $email;

            $sql = "UPDATE adresses SET 
            adresse = :adresse, 
            ville = :ville, 
            code_postal = :code_postal
            ";
            $res = $db->prepare($sql);

            $address = strip_tags($_POST['address']);
            $city = strip_tags($_POST['city']);
            $zip = strip_tags($_POST['zip']);

            $res->bindParam(':adresse', $address, PDO::PARAM_STR);
            $res->bindParam(':ville', $city, PDO::PARAM_STR);
            $res->bindParam(':code_postal', $zip, PDO::PARAM_STR);
            $res->execute();

            if ($res) {
                echo "<script> alert(\"Adresse mise à jour !\")</script>";

                // maj des infos
                $_SESSION['address'] = $address;
                $_SESSION['city'] = $city;
                $_SESSION['zip'] = $zip;
            } else {
                echo "<script> alert(\"Echec lors de la mise à jour des informations personnels !\")</script>";
            }
        } else {
            echo "<script> alert(\"Echec lors de la mise à jour de l'adresse !\")</script>";
        }
    } else {
        echo "<script> alert(\"Mot de passe incorrect !\")</script>";
    }
}

function getUserPassword()
{
    $db = getConnection();
    $query = $db->prepare('SELECT * FROM clients WHERE id = ?');
    $query->execute(array($_SESSION['id']));
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['mot_de_passe'];
}

// modifier mot de passe
function modifiedPassword()
{
    $oldPasswordDb = getUserPassword();

    if (!empty($_POST['newPassword']) && ($_POST['password'])) {
        if (password_verify($_POST['password'], $oldPasswordDb)) {
            $hashedNewPassword = password_hash(strip_tags($_POST['newPassword']), PASSWORD_DEFAULT);

            $db = getConnection();
            $query = $db->prepare('UPDATE clients SET mot_de_passe = :mot_de_passe WHERE id = :id');

            $query->bindParam(':mot_de_passe', $hashedNewPassword, PDO::PARAM_STR);
            $query->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
            $query->execute();

            if ($query) {
                echo "<script> alert(\"Mot de passe mis à jour !\")</script>";
            } else {
                echo "<script> alert(\"Echec lors de la mise à jour du mot de passe !\")</script>";
            }
        } else {
            echo "<script> alert(\"Ancien mot de passe incorrect !\")</script>";
        }
    }else {
        echo "<script> alert(\"Veuillez remplir les champs !\")</script>";
    }
}

// verifier mdp
function checkNewPassword()
{
    $password = $_POST['newPassword'];

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);

    if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
        echo "<script> alert(\"Erreur : Le mot de passe doit contenir au moins 8 caractères, des majuscules, des minuscules, et des chiffres !\")</script>";
    } else {
        modifiedPassword();
    }
}


// MES COMMANDES ==========================================================================
function getUserOrders()
{
    $id = $_SESSION['id'];

    $db = getConnection();
    $query = $db->prepare('SELECT * FROM commandes WHERE id_client = ?');
    $query->execute(array($id));
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function showUserOrders($orders)
{
    foreach ($orders as $order) {
        echo "<tr>
                    <td>" . $order['numero'] . "</td>
                    <td>" . $order['date_commande'] . "</td>
                    <td>" . sprintf('%.2f', $order["prix"]) . " €</td>
                    <td>
                    <form action=\"details-commande.php\" method=\"post\">
                    <input type=\"submit\" class=\"btn btn-warning\" value=\"Détails\">
                    <input type=\"hidden\" name=\"orderId\" value=\"" . $order['id'] . "\">
                    </form>
                    <td>
                </tr>";
    }
}

function getOrderArticles($id)
{
    $db = getConnection();
    $query = $db->prepare('SELECT * FROM commande_articles ca INNER JOIN articles a ON a.id = ca.id_article 
    WHERE id_commande = ?');
    $query->execute(array($id));
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function displayOrderArticle ($orderArticles) {

    foreach ($orderArticles as $article) {

        echo "<tr>
        <td class=\"table-warning\">" . $article['nom'] . "</td>
        <td class=\"table-warning\">" . sprintf('%.2f', $article["prix"]) . " €</td>
        <td class=\"table-warning\">" . $article['quantite'] . "</td>
        <td class=\"table-warning\">" . sprintf('%.2f', $article['quantite'] * $article['prix']) . " €</td>

    </tr>";
    }
}