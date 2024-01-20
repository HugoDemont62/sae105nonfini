<?php
session_start();                       // WARNING : NE PAS EFFACER CETTE LIGNE
include('helpers/magasinHelper.php');  // WARNING : NE PAS EFFACER CETTE LIGNE


//je crée mon tableau des produits (il sera utile...)
$data = chargerFichier('data/products.json');
$avis = chargerFichier('data/avis.json');
$ref = $_GET['reference'];


?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Weackers</title>
    <link rel="stylesheet" href="assets/site/style.css">
</head>

<body class="white">
<header class="header">
    <img class="header__logo" src="assets/site/logo-white.png" alt="Logo Whith">
    <div>
        <h2 class='header__h2'>We take care of your feet</h2>
    </div>
</header>

<nav class="navBar">
    <a href="index.php">Accueil</a>
    <a href="magasin.php">Le shop</a>
    <a href="#">Nos magasins</a>
    <a href="#">Nous contacter</a>
</nav>
<div class='pannier'>
    <div>
        <img class='pannier__img' src='assets/site/pannier.svg' alt='pannier'>
        <p class='pannier__chiffre'>
            <?php
            echo sommesArticles($_SESSION['panier']);
            ?>
        </p>
    </div>
</div>
<div class="fiche">
    <div class="infos">
        <img class="infos__image" src='assets/produits/sneaker13.webp' alt='sohaiuhd'>
        <div class="infos__informations">
            <h2 class='infos__titre'>
                Air jordna v2 pro moteur
            </h2>
            <h3 class='infos__prix'>
                140 €
            </h3>
            <p class='infos__description'>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur ea eum iusto qui, quia quod
                reiciendis similique sint tempora voluptatum? Aperiam corporis deserunt dignissimos dolor dolore dolores
                eius ex, facere inventore maiores, natus nihil, nobis omnis quam repudiandae sequi sit tempora velit.
                Ad, alias cum dolore dolores eius et in labore laboriosam molestiae, quaerat, sint voluptate. Ad
                asperiores culpa, deserunt dolor eos facilis id itaque minus nostrum numquam placeat provident, quas
                quia sequi, ut vel vero? Aut ducimus ea in porro reprehenderit? Facilis fugiat illo neque nulla
                recusandae suscipit tempora? Alias aliquid commodi illo ipsum optio pariatur quibusdam suscipit tempore?
            </p>
            <div>
                <a href='#' class="infos__ajout">Ajouter au panier</a>
            </div>
        </div>
    </div>
</div>

<?php
afficheArticle($ref,$data);


?>


<div class="contComm">
    <h1>
        <?php
            echo  calculeMoyenne($ref);
         ?>
    </h1>
    <div class='commentaires'>
        <?php
        foreach ($avis as $commentaires => $comm) { //je parcours mon tableau d'avis
            for ($i = 0; $i < count($comm); $i++){
                if ($comm[$i]['reference'] == $ref) {
                    afficheCommentaire($comm[$i]);
                }
            }
        }
        ?>
    </div>

    <?php

// RECUP LES ARTICLES Similaire
    $type = [];
    foreach ($data as $reference => $produit) {
            if ($reference == $ref) {
                $type = $produit['type'];
            }
    }
    afficheArticleSimilaire($type, $data);


    ?>

</div>

</body>
</html>
