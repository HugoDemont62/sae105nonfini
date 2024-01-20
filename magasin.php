<?php
session_start();                       // WARNING : NE PAS EFFACER CETTE LIGNE
include('helpers/magasinHelper.php');  // WARNING : NE PAS EFFACER CETTE LIGNE


//je crée mon tableau des produits
$data = chargerFichier('data/products.json');


?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Weackers</title>
    <link rel="stylesheet" href="assets/site/style.css">
</head>

<body>
<header class="header">
    <img class="header__logo" src="assets/site/logo-white.png" alt="Logo Whith">
    <div>
        <h2 class='header__h2'>We take care of your feet</h2>
    </div>
</header>

<nav class="navBar">
    <a href="index.php">Accueil</a>
    <a href="magasin.php">Le shop</a>
    <a href="magasins.html">Nos magasins</a>
    <a href="contact.html">Nous contacter</a>
</nav>

<div class="pannier">
    <div>
        <img class='pannier__img' src='assets/site/pannier.svg' alt='pannier'>
        <p class='pannier__chiffre'>
            <?php
               echo sommesArticles($_SESSION['panier']);
            ?>
        </p>
    </div>
</div>


<div class="produits">
    <?php
    foreach ($data  as $ref=>$p) {
        afficheProduit($p, $ref);
    }
    ?>

</div>

</body>
</html>


